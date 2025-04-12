<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Scrapers;

use BVP\FukuokaScraper\ScraperContractInterface;
use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
interface CommentScraperInterface extends ScraperContractInterface
{
    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrape(string|int $raceNumber, CarbonInterface|string|null $date = null): array;
}
