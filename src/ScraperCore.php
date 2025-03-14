<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper;

use BVP\FukuokaScraper\Scrapers\CommentScraper;
use BVP\FukuokaScraper\Scrapers\ForecastScraper;
use BVP\FukuokaScraper\Scrapers\TimeScraper;
use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
class ScraperCore implements ScraperCoreInterface
{
    /**
     * @var array
     */
    private array $instances = [];

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
     * @param  string|int                           $raceCode
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeComments(string|int $raceCode, CarbonInterface|string|null $date = null): array
    {
        return ($this->instances['CommentScraper'] ??= new CommentScraper())->scrape($raceCode, $date);
    }

    /**
     * @param  string|int                           $raceCode
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeForecasts(string|int $raceCode, CarbonInterface|string|null $date = null): array
    {
        return ($this->instances['ForecastScraper'] ??= new ForecastScraper())->scrape($raceCode, $date);
    }

    /**
     * @param  string|int                           $raceCode
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrapeTimes(string|int $raceCode, CarbonInterface|string|null $date = null): array
    {
        return ($this->instances['TimeScraper'] ??= new TimeScraper())->scrape($raceCode, $date);
    }
}
