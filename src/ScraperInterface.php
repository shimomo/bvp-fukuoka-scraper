<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper;

/**
 * @author shimomo
 */
interface ScraperInterface extends ScraperContractInterface
{
    /**
     * @param  \BVP\FukuokaScraper\ScraperCoreInterface
     * @return \BVP\FukuokaScraper\ScraperInterface
     */
    public static function getInstance(?ScraperCoreInterface $scraperCore = null): ScraperInterface;

    /**
     * @param  \BVP\FukuokaScraper\ScraperCoreInterface
     * @return \BVP\FukuokaScraper\ScraperInterface
     */
    public static function createInstance(?ScraperCoreInterface $scraperCore = null): ScraperInterface;

    /**
     * @return void
     */
    public static function resetInstance(): void;
}
