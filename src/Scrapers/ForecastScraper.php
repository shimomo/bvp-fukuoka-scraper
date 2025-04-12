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
class ForecastScraper extends BaseScraper
{
    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     */
    public function scrape(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        return array_merge(...[
            $this->scrapeYesterday($raceNumber, $raceDate),
            $this->scrapeToday($raceNumber, $raceDate),
        ]);
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     *
     * @throws \RuntimeException
     */
    private function scrapeYesterday(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        $raceDate = Carbon::parse($raceDate ?? 'today')->format('Ymd');
        $crawlerUrl = sprintf($this->baseUrl, 'syussou', $raceDate, $raceNumber);
        $crawler = Scraper::getInstance()->request('GET', $crawlerUrl);
        $forecasts = Scraper::filterByKeys($crawler, [
            '.sinnyu',
            '.yComment > tr:nth-child(2) > td',
            '.jishindo > tr:nth-child(2) > td',
        ]);

        foreach ($forecasts as $key => $value) {
            if (empty($value)) {
                throw new \RuntimeException(
                    __METHOD__ . "() - The specified key '{$key}' is not found " .
                    "in the content of the URL: '{$crawlerUrl}'."
                );
            }
        }

        $courses = explode(' ', $forecasts['.sinnyu'][0]);
        if (($position = strrpos($courses[2], 'S')) !== false) {
            $courses[1] = substr_replace($courses[1], '/', $position + 1, 0);
        }

        $reporterYesterdayCommentLabel = '記者予想 前日コメント';
        $reporterYesterdayReliabilityLabel = '記者予想 前日信頼度';
        $reporterYesterdayCourseLabel = '記者予想 前日コース';

        $reporterYesterdayComment = Normalizer::normalize($forecasts['.yComment > tr:nth-child(2) > td'][0]);
        $reporterYesterdayReliability = Normalizer::normalize($forecasts['.jishindo > tr:nth-child(2) > td'][0]);
        $reporterYesterdayCourse = Normalizer::normalize($courses[1]);

        return [
            'reporter_yesterday_comment_label' => $reporterYesterdayCommentLabel,
            'reporter_yesterday_comment' => $reporterYesterdayComment,
            'reporter_yesterday_reliability_label' => $reporterYesterdayReliabilityLabel,
            'reporter_yesterday_reliability' => $reporterYesterdayReliability,
            'reporter_yesterday_course_label' => $reporterYesterdayCourseLabel,
            'reporter_yesterday_course' => $reporterYesterdayCourse,
        ];
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     *
     * @throws \RuntimeException
     */
    private function scrapeToday(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        $raceDate = Carbon::parse($raceDate ?? 'today')->format('Ymd');
        $crawlerUrl = sprintf($this->baseUrl, 'cyokuzen', $raceDate, $raceNumber);
        $crawler = Scraper::getInstance()->request('GET', $crawlerUrl);
        $forecasts = Scraper::filterByKeys($crawler, [
            '.cComment__title',
            '.cComment__come',
        ]);

        foreach ($forecasts as $key => $value) {
            if (empty($value)) {
                throw new \RuntimeException(
                    __METHOD__ . "() - The specified key '{$key}' is not found " .
                    "in the content of the URL: '{$crawlerUrl}'."
                );
            }
        }

        $focus = [];
        $focusIndex = 0;
        $crawler->filter('.cComment__num')->each(function ($node) use (&$focus, &$focusIndex) {
            $node->filter('img, span')->each(function ($node) use (&$focus, &$focusIndex) {
                $focus[$focusIndex] ??= '';
                $focus[$focusIndex] .= $node->nodeName() === 'img' ? '-' : $node->text();

                if (trim($node->getNode(0)?->nextSibling?->textContent ?? '') === "\u{3000}") {
                    $focusIndex++;
                }
            });

            $focusIndex++;
        });

        if (empty($focus)) {
            throw new \RuntimeException(
                __METHOD__ . "() - The specified key '.cComment__num' is not found " .
                "in the content of the URL: '{$crawlerUrl}'."
            );
        }

        $reporterTodayCommentLabel = '記者予想 当日コメント';
        $reporterTodayFocusLabel = '記者予想 当日フォーカス';
        $reporterTodayFocusExactaLabel = '記者予想 当日フォーカス 2連単';
        $reporterTodayFocusTrifectaLabel = '記者予想 当日フォーカス 3連単';

        $reporterTodayComment = Normalizer::normalize(implode('', array_map('implode', $forecasts)));
        $reporterTodayFocus = Normalizer::normalize(array_values($focus));
        $reporterTodayFocusExacta = array_values(array_filter($reporterTodayFocus, function ($focus) {
            return (substr_count($focus, '-') + substr_count($focus, '=')) === 1;
        }));
        $reporterTodayFocusTrifecta = array_values(array_filter($reporterTodayFocus, function ($focus) {
            return (substr_count($focus, '-') + substr_count($focus, '=')) === 2;
        }));

        return [
            'reporter_today_comment_label' => $reporterTodayCommentLabel,
            'reporter_today_comment' => $reporterTodayComment,
            'reporter_today_focus_label' => $reporterTodayFocusLabel,
            'reporter_today_focus' => $reporterTodayFocus,
            'reporter_today_focus_exacta_label' => $reporterTodayFocusExactaLabel,
            'reporter_today_focus_exacta' => $reporterTodayFocusExacta,
            'reporter_today_focus_trifecta_label' => $reporterTodayFocusTrifectaLabel,
            'reporter_today_focus_trifecta' => $reporterTodayFocusTrifecta,
        ];
    }
}
