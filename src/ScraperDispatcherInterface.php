<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper;

use Carbon\CarbonInterface;

/**
 * @psalm-import-type ScrapedRaces from \BVP\FukuokaScraper\ScraperType
 *
 * @author shimomo
 */
interface ScraperDispatcherInterface extends ScraperContractInterface
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
    public function scrapeComments(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array;

    /**
     * @psalm-param \Carbon\CarbonInterface|non-empty-string|null $date
     * @psalm-param int<1, 12>|non-empty-string|non-empty-list<int<1, 12>>|null $numbers
     * @psalm-return ScrapedRaces
     *
     * @param \Carbon\CarbonInterface|string|null $date
     * @param int|string|array|null $numbers
     * @return array
     */
    public function scrapeForecasts(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array;

    /**
     * @psalm-param \Carbon\CarbonInterface|non-empty-string|null $date
     * @psalm-param int<1, 12>|non-empty-string|non-empty-list<int<1, 12>>|null $numbers
     * @psalm-return ScrapedRaces
     *
     * @param \Carbon\CarbonInterface|string|null $date
     * @param int|string|array|null $numbers
     * @return array
     */
    public function scrapeTimes(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array;
}
