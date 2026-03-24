<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper;

/**
 * @author shimomo
 */
interface ScraperInterface extends ScraperContractInterface
{
    /**
     * @psalm-param ?\BVP\FukuokaScraper\ScraperDispatcherInterface $scraperDispatcher
     * @psalm-return \BVP\FukuokaScraper\ScraperInterface
     *
     * @param ?\BVP\FukuokaScraper\ScraperDispatcherInterface $scraperDispatcher
     * @return \BVP\FukuokaScraper\ScraperInterface
     */
    public static function getInstance(?ScraperDispatcherInterface $scraperDispatcher = null): ScraperInterface;

    /**
     * @psalm-param ?\BVP\FukuokaScraper\ScraperDispatcherInterface $scraperDispatcher
     * @psalm-return \BVP\FukuokaScraper\ScraperInterface
     *
     * @param ?\BVP\FukuokaScraper\ScraperDispatcherInterface $scraperDispatcher
     * @return \BVP\FukuokaScraper\ScraperInterface
     */
    public static function createInstance(?ScraperDispatcherInterface $scraperDispatcher = null): ScraperInterface;

    /**
     * @psalm-return void
     *
     * @return void
     */
    public static function resetInstance(): void;
}
