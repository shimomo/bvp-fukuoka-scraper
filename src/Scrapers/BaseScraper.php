<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Scrapers;

use BVP\ScraperCore\Scraper;
use Carbon\CarbonImmutable as Carbon;
use Carbon\CarbonInterface;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @psalm-import-type ScrapedRaces from \BVP\FukuokaScraper\ScraperType
 *
 * @author shimomo
 */
abstract class BaseScraper implements BaseScraperInterface
{
    /**
     * @psalm-var non-empty-string
     *
     * @var string
     */
    protected string $baseUrl = 'https://www.boatrace-fukuoka.com/modules/yosou/%s.php?day=%s&race=%d';

    /**
     * @psalm-var \Symfony\Component\BrowserKit\HttpBrowser
     *
     * @var \Symfony\Component\BrowserKit\HttpBrowser
     */
    protected HttpBrowser $scraper;

    /**
     * @psalm-param ?\Symfony\Component\BrowserKit\HttpBrowser $scraper
     *
     * @param ?\Symfony\Component\BrowserKit\HttpBrowser $scraper
     */
    public function __construct(?HttpBrowser $scraper = null)
    {
        $this->scraper = $scraper ?? Scraper::getInstance();
    }

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param list<mixed> $arguments
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
     * @psalm-param non-empty-string $type
     * @psalm-param \Carbon\CarbonInterface|string $date
     * @psalm-param int|string $number
     * @psalm-return non-empty-string
     *
     * @param string $type
     * @param \Carbon\CarbonInterface|string $date
     * @param int|string $number
     * @return string
     */
    final protected function generateUrl(
        string $type,
        CarbonInterface|string $date,
        int|string $number,
    ): string {
        $date = Carbon::parse($date)->format('Ymd');

        return sprintf($this->baseUrl, $type, $date, $number);
    }

    /**
     * @psalm-param non-empty-string $url
     * @psalm-return \Symfony\Component\DomCrawler\Crawler
     *
     * @param string $url
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    final protected function request(string $url): Crawler
    {
        return $this->scraper->request('GET', $url);
    }

    /**
     * @psalm-param \Symfony\Component\DomCrawler\Crawler $crawler
     * @psalm-param list<non-empty-string> $keys
     * @psalm-return array<non-empty-string, array<int, float|string>>
     *
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     * @param array $keys
     * @return array
     */
    final protected function filterByKeys(Crawler $crawler, array $keys): array
    {
        /** @psalm-var array<non-empty-string, array<int, float|string>> */
        return Scraper::filterByKeys($crawler, $keys);
    }

    /**
     * @psalm-param array<non-empty-string, array<array-key, int|float|string>> $data
     * @psalm-param array<non-empty-string, mixed> $options
     * @psalm-return array<non-empty-string, array<array-key, int|float|string>>
     *
     * @param array $data
     * @param array $options
     * @return array
     * @throws \RuntimeException
     */
    final protected function validate(array $data, array $options): array
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                throw new \RuntimeException(
                    get_class($this) . "::scrape() - Specified key `{$key}` is not found " .
                    "in the content of the URL: `{$options['url']}`."
                );
            }
        }

        return $data;
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
    abstract public function scrape(
        CarbonInterface|string|null $date = null,
        int|string|array|null $numbers = null
    ): array;
}
