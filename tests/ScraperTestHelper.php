<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests;

use Carbon\CarbonImmutable as Carbon;

/**
 * @author shimomo
 */
final class ScraperTestHelper
{
    /**
     * @psalm-param array{\Carbon\CarbonInterface|non-empty-string|null, int<1, 12>} $data
     * @psalm-return non-empty-string
     *
     * @param array $data
     * @return string
     */
    public static function generateFixturePrefix(array $data): string
    {
        [$date, $number] = $data;

        $formattedDate = Carbon::parse($date)->format('Ymd');
        $formattedNumber = str_pad((string) $number, 2, '0', STR_PAD_LEFT);

        return $formattedDate . '_' . $formattedNumber;
    }
}
