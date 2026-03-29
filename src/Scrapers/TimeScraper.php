<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Scrapers;

use BVP\ScraperCore\Normalizer;
use BVP\ScraperCore\Resolver;
use Carbon\CarbonInterface;

/**
 * @psalm-import-type ScrapedRaces from \BVP\FukuokaScraper\ScraperType
 *
 * @author shimomo
 */
final class TimeScraper extends BaseScraper implements TimeScraperInterface
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
            $url = $this->generateUrl('tenji_info', $resolvedDate, $resolvedNumber);
            $crawler = $this->request($url);
            $data = $this->filterByKeys($crawler, ['.com-rname', '.col6', '.col7', '.col8', '.col9']);
            $times = $this->validate($data, ['url' => $url]);

            foreach (range(1, 6) as $racerBoatNumber) {
                /** @psalm-var int<1, 6> $racerBoatNumber */

                $racerName = $times['.com-rname'][$racerBoatNumber - 1] ?? '';
                $racerName = Normalizer::normalize($racerName, ['shouldRemoveAllSpaces' => true]);
                if (!is_string($racerName) || $racerName === '') {
                    $racerName = null;
                }

                $racerExhibitionTime = Normalizer::normalize($times['.col6'][$racerBoatNumber] ?? 0.0);
                if (!is_float($racerExhibitionTime)) {
                    $racerExhibitionTime = null;
                }

                $racerLapTime = Normalizer::normalize($times['.col7'][$racerBoatNumber] ?? 0.0);
                if (!is_float($racerLapTime)) {
                    $racerLapTime = null;
                }

                $racerTurnTime = Normalizer::normalize($times['.col8'][$racerBoatNumber] ?? 0.0);
                if (!is_float($racerTurnTime)) {
                    $racerTurnTime = null;
                }

                $racerStraightTime = Normalizer::normalize($times['.col9'][$racerBoatNumber] ?? 0.0);
                if (!is_float($racerStraightTime)) {
                    $racerStraightTime = null;
                }

                $response[$resolvedNumber]['boats'][$racerBoatNumber] = [
                    'racer_boat_number' => $racerBoatNumber,
                    'racer_name' => $racerName,
                    'racer_exhibition_time' => $racerExhibitionTime,
                    'racer_lap_time' => $racerLapTime,
                    'racer_turn_time' => $racerTurnTime,
                    'racer_straight_time' => $racerStraightTime,
                ];
            }

            sleep(1);
        }

        return $response;
    }
}
