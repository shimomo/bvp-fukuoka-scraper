<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

use BVP\FukuokaScraper\Scrapers\CommentScraper;
use BVP\FukuokaScraper\Tests\ScraperTestHelper;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author shimomo
 */
final class CommentScraperTest extends TestCase
{
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
    #[DataProviderExternal(CommentScraperDataProvider::class, 'scrapeProvider')]
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
            "BVP\FukuokaScraper\Scrapers\CommentScraper::scrape() - " .
            "Specified key `.com-rname` is not found in the content of the URL: " .
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
     * @psalm-return \BVP\FukuokaScraper\Scrapers\CommentScraper
     *
     * @param string $fixturePrefix
     * @return \BVP\FukuokaScraper\Scrapers\CommentScraper
     * @throws \LogicException
     * @throws \RuntimeException
     */
    protected function createScraperFromFixturePrefix(string $fixturePrefix): CommentScraper
    {
        $fixtures = [
            'syussou' => __DIR__ . '/../Fixtures/' . $fixturePrefix . '_comments.html',
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
                            throw new \RuntimeException("Fixture file not found: `{$path}`");
                        }

                        $contents = file_get_contents($path);
                        if ($contents === false) {
                            throw new \RuntimeException("Failed to read the fixture file: `{$path}`");
                        }

                        return new Crawler($contents);
                    }
                }
            });

        return new CommentScraper($browserStub);
    }
}
