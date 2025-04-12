<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper;

use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
interface ScraperCoreInterface extends ScraperContractInterface
{
    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeComments(string|int $raceNumber, CarbonInterface|string|null $date = null): array;

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeForecasts(string|int $raceNumber, CarbonInterface|string|null $date = null): array;

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeTimes(string|int $raceNumber, CarbonInterface|string|null $date = null): array;
}
