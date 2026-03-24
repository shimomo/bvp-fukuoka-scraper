<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Scrapers;

use BVP\ScraperCore\Normalizer;
use BVP\ScraperCore\Resolver;
use Carbon\CarbonImmutable as Carbon;
use Carbon\CarbonInterface;

/**
 * @psalm-import-type ScrapedRaces from \BVP\FukuokaScraper\ScraperType
 *
 * @author shimomo
 */
final class CommentScraper extends BaseScraper implements CommentScraperInterface
{
    /**
     * @psalm-param \Carbon\CarbonInterface|non-empty-string|null $date
     * @psalm-param int<1, 12>|non-empty-string|non-empty-list<int<1, 12>>|null $numbers
     * @psalm-return ScrapedRaces
     *
     * @param \Carbon\CarbonInterface|string|null $date
     * @param int|string|array|null $numbers
     * @return array
     */
    #[\Override]
    public function scrape(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array {
        $response = [];

        $resolvedDate = Resolver::resolveDate($date);
        $resolvedNumbers = Resolver::resolveNumbers($numbers);

        foreach ($resolvedNumbers as $resolvedNumber) {
            $url = $this->generateUrl('syussou', $resolvedDate, $resolvedNumber);
            $crawler = $this->request($url);
            $data = $this->filterByKeys($crawler, ['.com-rname', '.box']);
            $comments = $this->validate($data, ['url' => $url]);
            sleep(1);

            foreach (range(1, 6) as $racerBoatNumber) {
                /** @psalm-var int<1, 6> $racerBoatNumber */

                $racerName = $comments['.com-rname'][$racerBoatNumber - 1] ?? '';
                $racerName = Normalizer::normalize($racerName, ['shouldRemoveAllSpaces' => true]);
                if (!is_string($racerName) || $racerName === '') {
                    $racerName = null;
                }

                $racerYesterdayCommentLabel = '前日コメント';
                $racerYesterdayCommentText = $comments['.box'][$racerBoatNumber * 2 - 1] ?? '';
                $racerYesterdayCommentText = Normalizer::normalize($racerYesterdayCommentText);
                if (!is_string($racerYesterdayCommentText) || $racerYesterdayCommentText === '') {
                    $racerYesterdayCommentText = null;
                }

                $response[$resolvedNumber]['boats'][$racerBoatNumber] = [
                    'racer_boat_number' => $racerBoatNumber,
                    'racer_name' => $racerName,
                    'racer_yesterday_comment_label' => $racerYesterdayCommentLabel,
                    'racer_yesterday_comment_text' => $racerYesterdayCommentText,
                ];
            }
        }

        return $response;
    }
}
