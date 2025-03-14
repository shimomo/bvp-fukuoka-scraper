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
     * @param  string|int                           $raceCode
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeComments(string|int $raceCode, CarbonInterface|string|null $date = null): array;

    /**
     * @param  string|int                           $raceCode
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeForecasts(string|int $raceCode, CarbonInterface|string|null $date = null): array;

    /**
     * @param  string|int                           $raceCode
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeTimes(string|int $raceCode, CarbonInterface|string|null $date = null): array;
}
