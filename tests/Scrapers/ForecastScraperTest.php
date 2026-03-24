<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

use BVP\FukuokaScraper\Scrapers\ForecastScraper;
use BVP\FukuokaScraper\Tests\ScraperTestHelper;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author shimomo
 */
final class ForecastScraperTest extends TestCase
{
    /**
     * @psalm-param array{\Carbon\CarbonInterface|non-empty-string|null, int<1, 12>} $arguments
     * @psalm-param array<int<1, 12>, mixed> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(ForecastScraperDataProvider::class, 'scrapeProvider')]
    public function testScrape(array $arguments, array $expected): void
    {
        $scraper = $this->createScraperFromFixturePrefix(
            ScraperTestHelper::generateFixturePrefix($arguments)
        );

        $this->assertSame($expected, $scraper->scrape(...$arguments));
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    public function testThrowsExceptionWhenKeyNotFound(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\FukuokaScraper\Scrapers\ForecastScraper::scrape() - " .
            "Specified key `.sinnyu` is not found in the content of the URL: " .
            "`https://www.boatrace-fukuoka.com/modules/yosou/syussou.php?day=20250110&race=1`."
        );

        $arguments = ['2025-01-10', 1];
        $scraper = $this->createScraperFromFixturePrefix(
            ScraperTestHelper::generateFixturePrefix($arguments)
        );

        $scraper->scrape(...$arguments);
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
            "BVP\FukuokaScraper\Scrapers\BaseScraper::__call() - " .
            "Call to undefined method `BVP\FukuokaScraper\Scrapers\BaseScraper::ghost()`."
        );

        $arguments = ['2025-01-10', 1];
        $scraper = $this->createScraperFromFixturePrefix(
            ScraperTestHelper::generateFixturePrefix($arguments)
        );

        /** @psalm-suppress UndefinedMagicMethod */
        $scraper->ghost(...$arguments);
    }

    /**
     * @psalm-param non-empty-string $fixturePrefix
     * @psalm-return \BVP\FukuokaScraper\Scrapers\ForecastScraper
     *
     * @param string $fixturePrefix
     * @return \BVP\FukuokaScraper\Scrapers\ForecastScraper
     * @throws \LogicException
     * @throws \RuntimeException
     */
    protected function createScraperFromFixturePrefix(string $fixturePrefix): ForecastScraper
    {
        $fixtures = [
            'syussou' => __DIR__ . '/../Fixtures/' . $fixturePrefix . '_forecasts_yesterday.html',
            'cyokuzen'  => __DIR__ . '/../Fixtures/' . $fixturePrefix . '_forecasts_today.html',
        ];

        $browserStub = $this->createStub(HttpBrowser::class);
        $browserStub->method('request')
            ->willReturnCallback(function (string $method, string $url) use ($fixtures) {
                if ($method !== 'GET') {
                    throw new \LogicException("Request method is invalid: `{$method}`");
                }

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

        return new ForecastScraper($browserStub);
    }
}
