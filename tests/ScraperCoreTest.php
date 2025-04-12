<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests;

use BVP\FukuokaScraper\ScraperCore;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class ScraperCoreTest extends TestCase
{
    /**
     * @var \BVP\FukuokaScraper\ScraperCore
     */
    protected ScraperCore $scraper;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->scraper = new ScraperCore();
    }

    /**
     * @param  array  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(ScraperCoreDataProvider::class, 'scrapeCommentsProvider')]
    public function testScrapeComments(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrapeComments(...$arguments));
    }

    /**
     * @param  array  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(ScraperCoreDataProvider::class, 'scrapeForecastsProvider')]
    public function testScrapeForecasts(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrapeForecasts(...$arguments));
    }

    /**
     * @param  array  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(ScraperCoreDataProvider::class, 'scrapeTimesProvider')]
    public function testScrapeTimes(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrapeTimes(...$arguments));
    }

    /**
     * @return void
     */
    public function testScrapeCommentsWithRaceCode1AndDate20250110(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\CommentScraper::scrape() - " .
            "The specified key '.com-rname' is not found in the content of the URL: " .
            "'https://www.boatrace-fukuoka.com/modules/yosou/syussou.php?day=20250110&race=1'."
        );

        $this->scraper->scrapeComments(1, '2025-01-10');
    }

    /**
     * @return void
     */
    public function testScrapeForecastsWithRaceCode1AndDate20250110(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\ForecastScraper::scrape() - " .
            "The specified key '.sinnyu' is not found in the content of the URL: " .
            "'https://www.boatrace-fukuoka.com/modules/yosou/syussou.php?day=20250110&race=1'."
        );

        $this->scraper->scrapeForecasts(1, '2025-01-10');
    }

    /**
     * @return void
     */
    public function testScrapeTimesWithRaceCode1AndDate20250110(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\TimeScraper::scrape() - " .
            "The specified key '.com-rname' is not found in the content of the URL: " .
            "'https://www.boatrace-fukuoka.com/modules/yosou/tenji_info.php?day=20250110&race=1'."
        );

        $this->scraper->scrapeTimes(1, '2025-01-10');
    }

    /**
     * @return void
     */
    public function testInvalidWithRaceCode1AndDate20250110(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\ScraperCore::__call() - " .
            "Call to undefined method 'BVP\FukuokaScraper\ScraperCore::invalid()'."
        );

        $this->scraper->invalid(1, '2025-01-10');
    }
}
