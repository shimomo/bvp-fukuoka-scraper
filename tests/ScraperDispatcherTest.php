<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests;

use BVP\FukuokaScraper\ScraperDispatcher;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class ScraperDispatcherTest extends TestCase
{
    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @psalm-var \BVP\FukuokaScraper\ScraperDispatcher
     *
     * @var \BVP\FukuokaScraper\ScraperDispatcher
     */
    protected ScraperDispatcher $scraper;

    /**
     * @psalm-return void
     *
     * @return void
     */
    #[\Override]
    protected function setUp(): void
    {
        $this->scraper = new ScraperDispatcher();
    }

    /**
     * @psalm-param array{\Carbon\CarbonInterface|non-empty-string|null, int<1, 12>} $arguments
     * @psalm-param array<int<1, 12>, array{
     *     boats: array<int<1, 6>, mixed>
     * }> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(ScraperDataProvider::class, 'scrapeCommentsProvider')]
    public function testScrapeComments(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrapeComments(...$arguments));
    }

    /**
     * @psalm-param array{\Carbon\CarbonInterface|non-empty-string|null, int<1, 12>} $arguments
     * @psalm-param array<int<1, 12>, mixed> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(ScraperDataProvider::class, 'scrapeForecastsProvider')]
    public function testScrapeForecasts(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrapeForecasts(...$arguments));
    }

    /**
     * @psalm-param array{\Carbon\CarbonInterface|non-empty-string|null, int<1, 12>} $arguments
     * @psalm-param array<int<1, 12>, array{
     *     boats: array<int<1, 6>, mixed>
     * }> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(ScraperDataProvider::class, 'scrapeTimesProvider')]
    public function testScrapeTimes(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrapeTimes(...$arguments));
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    public function testThrowsExceptionWhenKeyNotFoundInComments(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\CommentScraper::scrape() - " .
            "Specified key `.com-rname` is not found in the content of the URL: " .
            "`https://www.boatrace-fukuoka.com/modules/yosou/syussou.php?day=20250110&race=1`."
        );

        $this->scraper->scrapeComments('2025-01-10', 1);
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    public function testThrowsExceptionWhenKeyNotFoundInForecasts(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\ForecastScraper::scrape() - " .
            "Specified key `.sinnyu` is not found in the content of the URL: " .
            "`https://www.boatrace-fukuoka.com/modules/yosou/syussou.php?day=20250110&race=1`."
        );

        $this->scraper->scrapeForecasts('2025-01-10', 1);
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    public function testThrowsExceptionWhenKeyNotFoundInTimes(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\TimeScraper::scrape() - " .
            "Specified key `.com-rname` is not found in the content of the URL: " .
            "`https://www.boatrace-fukuoka.com/modules/yosou/tenji_info.php?day=20250110&race=1`."
        );

        $this->scraper->scrapeTimes('2025-01-10', 1);
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    public function testThrowsExceptionWhenMethodDoesNotExist(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\ScraperDispatcher::__call() - " .
            "Call to undefined method `BVP\FukuokaScraper\ScraperDispatcher::ghost()`."
        );

        /** @psalm-suppress UndefinedMagicMethod */
        $this->scraper->ghost('2025-01-10', 1);
    }
}
