<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper;

use BVP\FukuokaScraper\Scrapers\CommentScraper;
use BVP\FukuokaScraper\Scrapers\ForecastScraper;
use BVP\FukuokaScraper\Scrapers\TimeScraper;
use Carbon\CarbonInterface;

/**
 * @psalm-import-type ScrapedRaces from \BVP\FukuokaScraper\ScraperType
 *
 * @author shimomo
 */
final class ScraperDispatcher implements ScraperDispatcherInterface
{
    /**
     * @psalm-var array<
     *     non-empty-string,
     *     \BVP\FukuokaScraper\Scrapers\CommentScraper
     *     | \BVP\FukuokaScraper\Scrapers\ForecastScraper
     *     | \BVP\FukuokaScraper\Scrapers\TimeScraper
     * >
     *
     * @var array
     */
    private array $instances = [];

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param array<int, mixed> $arguments
     * @psalm-return never
     *
     * @param string $name
     * @param array $arguments
     * @return never
     * @throws \BadMethodCallException
     */
    public function __call(string $name, array $arguments): never
    {
        throw new \BadMethodCallException(
            __METHOD__ . "() - Call to undefined method `" . self::class . "::{$name}()`."
        );
    }

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
    public function scrapeComments(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array {
        return ($this->instances['CommentScraper'] ??= new CommentScraper())
            ->scrape($date, $numbers);
    }

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
    public function scrapeForecasts(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array {
        return ($this->instances['ForecastScraper'] ??= new ForecastScraper())
            ->scrape($date, $numbers);
    }

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
    public function scrapeTimes(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array {
        return ($this->instances['TimeScraper'] ??= new TimeScraper())
            ->scrape($date, $numbers);
    }
}
