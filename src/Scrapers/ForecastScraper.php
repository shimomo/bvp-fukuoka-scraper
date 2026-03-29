<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Scrapers;

use BVP\ScraperCore\Normalizer;
use BVP\ScraperCore\Resolver;
use Carbon\CarbonImmutable as Carbon;
use Carbon\CarbonInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @psalm-import-type ScrapedRaces from \BVP\FukuokaScraper\ScraperType
 *
 * @author shimomo
 */
final class ForecastScraper extends BaseScraper
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
        $yesterday = $this->scrapeYesterday($date, $numbers);
        $today = $this->scrapeToday($date, $numbers);

        $response = [];

        foreach (array_keys($yesterday + $today) as $number) {
            $response[$number] = array_merge(
                $yesterday[$number] ?? [],
                $today[$number] ?? [],
            );
        }

        return $response;
    }

    /**
     * @psalm-param \Carbon\CarbonInterface|non-empty-string|null $date
     * @psalm-param int<1, 12>|non-empty-string|non-empty-list<int<1, 12>>|null $numbers
     * @psalm-return array<int<1, 12>, array{
     *     reporter_yesterday_comment_label: ?string,
     *     reporter_yesterday_comment_text: ?string,
     *     reporter_yesterday_reliability_label: ?string,
     *     reporter_yesterday_reliability_text: ?string,
     *     reporter_yesterday_course_label: ?string,
     *     reporter_yesterday_course_text: ?string,
     * }>
     *
     * @param \Carbon\CarbonInterface|string|null $date
     * @param int|string|array|null $numbers
     * @return array
     */
    private function scrapeYesterday(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array {
        $response = [];

        $resolvedDate = Resolver::resolveDate($date);
        $resolvedNumbers = Resolver::resolveNumbers($numbers);

        foreach ($resolvedNumbers as $resolvedNumber) {
            $url = $this->generateUrl('syussou', $resolvedDate, $resolvedNumber);
            $crawler = $this->request($url);
            $data = $this->filterByKeys($crawler, [
                '.sinnyu',
                '.yComment tr:nth-child(2) > td',
                '.jishindo tr:nth-child(2) > td',
            ]);
            $forecasts = $this->validate($data, ['url' => $url]);

            $courses = explode(' ', (string) ($forecasts['.sinnyu'][0] ?? ''));
            if (($position = strrpos($courses[2] ?? '', 'S')) !== false) {
                $courses[1] = substr_replace($courses[1] ?? '', '/', $position + 1, 0);
            }

            $reporterYesterdayCommentLabel = '記者予想 前日コメント';
            $reporterYesterdayCommentText = Normalizer::normalize(
                $forecasts['.yComment tr:nth-child(2) > td'][0] ?? ''
            );
            if (!is_string($reporterYesterdayCommentText) || $reporterYesterdayCommentText === '') {
                $reporterYesterdayCommentText = null;
            }

            $reporterYesterdayReliabilityLabel = '記者予想 前日信頼度';
            $reporterYesterdayReliabilityText = Normalizer::normalize(
                $forecasts['.jishindo tr:nth-child(2) > td'][0] ?? ''
            );
            if (!is_string($reporterYesterdayReliabilityText) || $reporterYesterdayReliabilityText === '') {
                $reporterYesterdayReliabilityText = null;
            }

            $reporterYesterdayCourseLabel = '記者予想 前日コース';
            $reporterYesterdayCourseText = Normalizer::normalize($courses[1] ?? '');
            if (!is_string($reporterYesterdayCourseText) || $reporterYesterdayCourseText === '') {
                $reporterYesterdayCourseText = null;
            }

            $response[$resolvedNumber] = [
                'reporter_yesterday_comment_label' => $reporterYesterdayCommentLabel,
                'reporter_yesterday_comment_text' => $reporterYesterdayCommentText,
                'reporter_yesterday_reliability_label' => $reporterYesterdayReliabilityLabel,
                'reporter_yesterday_reliability_text' => $reporterYesterdayReliabilityText,
                'reporter_yesterday_course_label' => $reporterYesterdayCourseLabel,
                'reporter_yesterday_course_text' => $reporterYesterdayCourseText,
            ];
        }

        return $response;
    }

    /**
     * @psalm-param \Carbon\CarbonInterface|non-empty-string|null $date
     * @psalm-param int<1, 12>|non-empty-string|non-empty-list<int<1, 12>>|null $numbers
     * @psalm-return array<int<1, 12>, array{
     *     reporter_today_comment_label: ?string,
     *     reporter_today_comment_text: ?string,
     *     reporter_today_focus_label: ?string,
     *     reporter_today_focus_list: list<mixed>,
     *     reporter_today_focus_exacta_label: ?string,
     *     reporter_today_focus_exacta_list: list<mixed>,
     *     reporter_today_focus_trifecta_label: ?string,
     *     reporter_today_focus_trifecta_list: list<mixed>,
     * }>
     *
     * @param \Carbon\CarbonInterface|string|null $date
     * @param int|string|array|null $numbers
     * @return array
     */
    private function scrapeToday(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array {
        $response = [];

        $resolvedDate = Resolver::resolveDate($date);
        $resolvedNumbers = Resolver::resolveNumbers($numbers);

        foreach ($resolvedNumbers as $resolvedNumber) {
            $url = $this->generateUrl('cyokuzen', $resolvedDate, $resolvedNumber);
            $crawler = $this->request($url);
            $data = $this->filterByKeys($crawler, ['.cComment__title', '.cComment__come']);
            $forecasts = $this->validate($data, ['url' => $url]);

            $focus = [];
            $focusIndex = 0;
            $crawler->filter('.cComment__num')->each(function (Crawler $node) use (&$focus, &$focusIndex): void {
                $node->filter('img, span')->each(function (Crawler $node) use (&$focus, &$focusIndex): void {
                    $focus[$focusIndex] ??= '';
                    $focus[$focusIndex] .= $node->nodeName() === 'img' ? '-' : $node->text();

                    if (trim($node->getNode(0)?->nextSibling?->textContent ?? '') === "\u{3000}") {
                        $focusIndex++;
                    }
                });

                $focusIndex++;
            });

            if ($focus === []) {
                throw new \RuntimeException(
                    __METHOD__ . "() - Specified key `.cComment__num` is not found " .
                    "in the content of the URL: `{$url}`."
                );
            }

            $reporterTodayCommentLabel = '記者予想 当日コメント';
            $reporterTodayCommentText = Normalizer::normalize(implode('', array_map('implode', $forecasts)));
            if (!is_string($reporterTodayCommentText) || $reporterTodayCommentText === '') {
                $reporterTodayCommentText = null;
            }

            $reporterTodayFocusLabel = '記者予想 当日フォーカス';
            $reporterTodayFocusList = Normalizer::normalize(array_values($focus));
            $reporterTodayFocusList = is_array($reporterTodayFocusList) ? array_values($reporterTodayFocusList) : [];

            $reporterTodayFocusExactaLabel = '記者予想 当日フォーカス 2連単';
            $reporterTodayFocusExactaList = array_values(
                array_filter($reporterTodayFocusList, function (string $reporterTodayFocus): bool {
                    return (substr_count($reporterTodayFocus, '-') + substr_count($reporterTodayFocus, '=')) === 1;
                })
            );

            $reporterTodayFocusTrifectaLabel = '記者予想 当日フォーカス 3連単';
            $reporterTodayFocusTrifectaList = array_values(
                array_filter($reporterTodayFocusList, function (string $reporterTodayFocus): bool {
                    return (substr_count($reporterTodayFocus, '-') + substr_count($reporterTodayFocus, '=')) === 2;
                })
            );

            $response[$resolvedNumber] = [
                'reporter_today_comment_label' => $reporterTodayCommentLabel,
                'reporter_today_comment_text' => $reporterTodayCommentText,
                'reporter_today_focus_label' => $reporterTodayFocusLabel,
                'reporter_today_focus_list' => $reporterTodayFocusList,
                'reporter_today_focus_exacta_label' => $reporterTodayFocusExactaLabel,
                'reporter_today_focus_exacta_list' => $reporterTodayFocusExactaList,
                'reporter_today_focus_trifecta_label' => $reporterTodayFocusTrifectaLabel,
                'reporter_today_focus_trifecta_list' => $reporterTodayFocusTrifectaList,
            ];

            sleep(1);
        }

        return $response;
    }
}
