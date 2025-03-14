<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

use BVP\FukuokaScraper\Scrapers\CommentScraper;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class CommentScraperTest extends TestCase
{
    /**
     * @var \BVP\FukuokaScraper\Scrapers\CommentScraper
     */
    protected CommentScraper $scraper;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->scraper = new CommentScraper();
    }

    /**
     * @param  array  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(CommentScraperDataProvider::class, 'scrapeProvider')]
    public function testScrape(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrape(...$arguments));
    }

    /**
     * @return void
     */
    public function testScrapeWithRaceCode1AndDate20250110(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\CommentScraper::scrapeYesterday() - " .
            "The specified key '.com-rname' is not found in the content of the URL: " .
            "'https://www.boatrace-fukuoka.com/modules/yosou/syussou.php?day=20250110&race=1'."
        );

        $this->scraper->scrape(1, '2025-01-10');
    }

    /**
     * @return void
     */
    public function testInvalidWithRaceCode1AndDate20250110(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\BaseScraper::__call() - " .
            "Call to undefined method 'BVP\FukuokaScraper\Scrapers\BaseScraper::invalid()'."
        );

        $this->scraper->invalid(1, '2025-01-10');
    }
}
