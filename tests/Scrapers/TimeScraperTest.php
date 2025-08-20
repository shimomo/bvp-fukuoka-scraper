<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

use BVP\FukuokaScraper\Scrapers\TimeScraper;
use BVP\FukuokaScraper\Tests\ScraperTestHelper;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author shimomo
 */
final class TimeScraperTest extends TestCase
{
    /**
     * @var \BVP\FukuokaScraper\Scrapers\TimeScraper
     */
    protected TimeScraper $scraper;

    /**
     * @param  array<int|string, string>  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(TimeScraperDataProvider::class, 'scrapeProvider')]
    public function testScrape(array $arguments, array $expected): void
    {
        $scraper = $this->createScraperFromFixturePrefix(
            ScraperTestHelper::generateFixturePrefix($arguments)
        );

        $this->assertSame($expected, $scraper->scrape(...$arguments));
    }

    /**
     * @return void
     */
    public function testThrowsExceptionWhenKeyNotFound(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\TimeScraper::scrape() - " .
            "The specified key '.com-rname' is not found in the content of the URL: " .
            "'https://www.boatrace-fukuoka.com/modules/yosou/tenji_info.php?day=20250110&race=1'."
        );

        $arguments = [1, '2025-01-10'];
        $scraper = $this->createScraperFromFixturePrefix(
            ScraperTestHelper::generateFixturePrefix($arguments)
        );

        $scraper->scrape(...$arguments);
    }

    /**
     * @return void
     */
    public function testThrowsExceptionWhenMethodDoesNotExist(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\BaseScraper::__call() - " .
            "Call to undefined method 'BVP\FukuokaScraper\Scrapers\BaseScraper::ghost()'."
        );

        $arguments = [1, '2025-01-10'];
        $scraper = $this->createScraperFromFixturePrefix(
            ScraperTestHelper::generateFixturePrefix($arguments)
        );

        $scraper->ghost(...$arguments);
    }

    /**
     * @param  string  $fixturePrefix
     * @return \BVP\FukuokaScraper\Scrapers\TimeScraper
     * @throws \RuntimeException
     */
    protected function createScraperFromFixturePrefix(string $fixturePrefix): TimeScraper
    {
        $fixtures = [
            'tenji_info' => __DIR__ . '/../Fixtures/' . $fixturePrefix . '_times.html',
        ];

        $browserMock = $this->createMock(HttpBrowser::class);
        $browserMock->method('request')
            ->willReturnCallback(function ($method, $url) use ($fixtures) {
                foreach ($fixtures as $keyword => $path) {
                    if (strpos($url, $keyword) !== false) {
                        if (!file_exists($path)) {
                            throw new \RuntimeException("Fixture file not found: {$path}");
                        }

                        $contents = file_get_contents($path);
                        if ($contents === false) {
                            throw new \RuntimeException("Failed to read the fixture file: {$path}");
                        }

                        return new Crawler($contents);
                    }
                }
            });

        return new TimeScraper($browserMock);
    }
}
