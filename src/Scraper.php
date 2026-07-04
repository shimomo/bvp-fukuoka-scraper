<?php

declare(strict_types=1);

namespace BVP\Scraper\Fukuoka;

use BadMethodCallException;
use Turnmark\Scraper\Fukuoka\Scraper as ScraperFukuoka;

/**
 * @author shimomo
 */
final class Scraper
{
    /**
     * @param non-empty-string $name
     * @param list<mixed> $arguments
     * @return array<non-empty-string, mixed>|array<int<1, 12>, array<non-empty-string, mixed>>
     */
    public static function __callStatic(string $name, array $arguments): array
    {
        if (!method_exists(ScraperFukuoka::class, $name)) {
            throw new BadMethodCallException(
                sprintf('Undefined method %s::%s()', self::class, $name),
            );
        }

        return forward_static_call([ScraperFukuoka::class, $name], ...$arguments);
    }
}
