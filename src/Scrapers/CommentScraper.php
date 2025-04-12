<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Scrapers;

use BVP\ScraperCore\Normalizer;
use BVP\ScraperCore\Scraper;
use Carbon\CarbonImmutable as Carbon;
use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
class CommentScraper extends BaseScraper implements CommentScraperInterface
{
    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrape(string|int $raceNumber, CarbonInterface|string|null $date = null): array
    {
        return array_merge(...[
            $this->scrapeYesterday($raceNumber, $date),
            $this->scrapeToday($raceNumber, $date),
        ]);
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     *
     * @throws \RuntimeException
     */
    private function scrapeYesterday(string|int $raceNumber, CarbonInterface|string|null $date = null): array
    {
        $date = Carbon::parse($date ?? 'today')->format('Ymd');
        $crawlerUrl = sprintf($this->baseUrl, 'syussou', $date, $raceNumber);
        $crawler = Scraper::getInstance()->request('GET', $crawlerUrl);
        $comments = Scraper::filterByKeys($crawler, [
            '.com-rname',
            '.box',
        ]);

        foreach ($comments as $key => $value) {
            if (empty($value)) {
                throw new \RuntimeException(
                    __METHOD__ . "() - The specified key '{$key}' is not found " .
                    "in the content of the URL: '{$crawlerUrl}'."
                );
            }
        }

        $response = [];
        foreach (range(1, 6) as $boatNumber) {
            $racerName = $comments['.com-rname'][$boatNumber - 1] ?? '';
            $racerName = Normalizer::normalize($racerName, ['shouldRemoveAllSpaces' => true]);
            $racerYesterdayCommentLabel = '前日コメント';
            $racerYesterdayComment = $comments['.box'][$boatNumber * 2 - 1] ?? '';
            $racerYesterdayComment = Normalizer::normalize($racerYesterdayComment);

            $response['boat_number_' . $boatNumber . '_racer_name'] = $racerName;
            $response['boat_number_' . $boatNumber . '_racer_yesterday_comment_label'] = $racerYesterdayCommentLabel;
            $response['boat_number_' . $boatNumber . '_racer_yesterday_comment'] = $racerYesterdayComment;
        }

        return $response;
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    private function scrapeToday(string|int $raceNumber, CarbonInterface|string|null $date = null): array
    {
        return [];
    }
}
