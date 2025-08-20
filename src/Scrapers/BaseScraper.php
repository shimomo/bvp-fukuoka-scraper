<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Scrapers;

use BVP\ScraperCore\Scraper;
use Carbon\CarbonImmutable as Carbon;
use Carbon\CarbonInterface;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author shimomo
 */
abstract class BaseScraper implements BaseScraperInterface
{
    /**
     * @var string
     */
    protected string $baseUrl = 'https://www.boatrace-fukuoka.com/modules/yosou/%s.php?day=%s&race=%d';

    /**
     * @var \Symfony\Component\BrowserKit\HttpBrowser
     */
    protected HttpBrowser $scraper;

    /**
     * @param  \Symfony\Component\BrowserKit\HttpBrowser|null  $scraper
     * @return void
     */
    public function __construct(?HttpBrowser $scraper = null)
    {
        $this->scraper = $scraper ?? Scraper::getInstance();
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return never
     *
     * @throws \BadMethodCallException
     */
    public function __call(string $name, array $arguments): never
    {
        throw new \BadMethodCallException(
            __METHOD__ . "() - Call to undefined method '" . self::class . "::{$name}()'."
        );
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return string
     */
    final protected function generateRaceUrl(string $pageType, string|int $raceNumber, CarbonInterface|string|null $raceDate = null): string
    {
        $raceDate = Carbon::parse($raceDate ?? 'today')->format('Ymd');
        return sprintf($this->baseUrl, $pageType, $raceDate, $raceNumber);
    }

    /**
     * @param  string  $raceUrl
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    final protected function requestPage(string $raceUrl): Crawler
    {
        return $this->scraper->request('GET', $raceUrl);
    }

    /**
     * @param  \Symfony\Component\DomCrawler\Crawler  $crawler
     * @param  array                                  $keys
     * @return array
     */
    final protected function filterDataByKeys(Crawler $crawler, array $keys): array
    {
        return Scraper::filterByKeys($crawler, $keys);
    }

    /**
     * @param  array   $data
     * @param  string  $raceUrl
     * @return array
     *
     * @throws \RuntimeException
     */
    final protected function validateData(array $data, string $raceUrl): array
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                throw new \RuntimeException(
                    get_class($this) . "::scrape() - The specified key '{$key}' is not found " .
                    "in the content of the URL: '{$raceUrl}'."
                );
            }
        }

        return $data;
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     */
    abstract public function scrape(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array;
}
