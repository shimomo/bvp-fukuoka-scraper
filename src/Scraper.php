<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper;

/**
 * @psalm-method static array<array-key, mixed> scrapeComments(mixed ...$arguments)
 * @psalm-method static array<array-key, mixed> scrapeForecasts(mixed ...$arguments)
 * @psalm-method static array<array-key, mixed> scrapeTimes(mixed ...$arguments)
 *
 * @method static array<array-key, mixed> scrapeComments(mixed ...$arguments)
 * @method static array<array-key, mixed> scrapeForecasts(mixed ...$arguments)
 * @method static array<array-key, mixed> scrapeTimes(mixed ...$arguments)
 *
 * @author shimomo
 */
final class Scraper implements ScraperInterface
{
    /**
     * @psalm-var \BVP\FukuokaScraper\ScraperInterface|null
     *
     * @var \BVP\FukuokaScraper\ScraperInterface|null
     */
    private static ?ScraperInterface $instance;

    /**
     * @psalm-param \BVP\FukuokaScraper\ScraperDispatcherInterface $scraper
     *
     * @param \BVP\FukuokaScraper\ScraperDispatcherInterface $scraper
     */
    public function __construct(private readonly ScraperDispatcherInterface $scraper)
    {
        //
    }

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param array<int, mixed> $arguments
     * @psalm-return array<non-empty-string, float|string|array<int, string>>
     *
     * @param string $name
     * @param array $arguments
     * @return array
     */
    public function __call(string $name, array $arguments): array
    {
        /** @psalm-var array<non-empty-string, float|string|array<int, string>> */
        return $this->scraper->$name(...$arguments);
    }

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param array<int, mixed> $arguments
     * @psalm-return array<non-empty-string, float|string|array<int, string>>
     *
     * @param string $name
     * @param array $arguments
     * @return array
     */
    public static function __callStatic(string $name, array $arguments): array
    {
        /** @psalm-var array<non-empty-string, float|string|array<int, string>> */
        return self::getInstance()->$name(...$arguments);
    }

    /**
     * @psalm-param ?\BVP\FukuokaScraper\ScraperDispatcherInterface $scraperDispatcher
     * @psalm-return \BVP\FukuokaScraper\ScraperInterface
     *
     * @param ?\BVP\FukuokaScraper\ScraperDispatcherInterface $scraperDispatcher
     * @return \BVP\FukuokaScraper\ScraperInterface
     */
    #[\Override]
    public static function getInstance(?ScraperDispatcherInterface $scraperDispatcher = null): ScraperInterface
    {
        return self::$instance ??= new self($scraperDispatcher ?? new ScraperDispatcher());
    }

    /**
     * @psalm-param ?\BVP\FukuokaScraper\ScraperDispatcherInterface $scraperDispatcher
     * @psalm-return \BVP\FukuokaScraper\ScraperInterface
     *
     * @param ?\BVP\FukuokaScraper\ScraperDispatcherInterface $scraperDispatcher
     * @return \BVP\FukuokaScraper\ScraperInterface
     */
    #[\Override]
    public static function createInstance(?ScraperDispatcherInterface $scraperDispatcher = null): ScraperInterface
    {
        return self::$instance = new self($scraperDispatcher ?? new ScraperDispatcher());
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    #[\Override]
    public static function resetInstance(): void
    {
        self::$instance = null;
    }
}
