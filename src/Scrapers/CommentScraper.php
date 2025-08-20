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
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     */
    public function scrape(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        $raceUrl = $this->generateRaceUrl('syussou', $raceNumber, $raceDate);
        $crawler = $this->requestPage($raceUrl);
        $filteredData = $this->filterDataByKeys($crawler, ['.com-rname', '.box']);
        $comments = $this->validateData($filteredData, $raceUrl);

        $response = [];
        foreach (range(1, 6) as $boatNumber) {
            $racerName = $comments['.com-rname'][$boatNumber - 1] ?? '';
            $racerName = Normalizer::normalize($racerName, ['shouldRemoveAllSpaces' => true]);
            $racerYesterdayCommentLabel = '前日コメント';
            $racerYesterdayComment = $comments['.box'][$boatNumber * 2 - 1] ?? '';
            $racerYesterdayComment = Normalizer::normalize($racerYesterdayComment);

            $response["boat_number_{$boatNumber}_racer_name"] = $racerName;
            $response["boat_number_{$boatNumber}_racer_yesterday_comment_label"] = $racerYesterdayCommentLabel;
            $response["boat_number_{$boatNumber}_racer_yesterday_comment"] = $racerYesterdayComment;
        }

        return $response;
    }
}
