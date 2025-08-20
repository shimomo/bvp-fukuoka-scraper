<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests;

use Carbon\CarbonImmutable as Carbon;

/**
 * テスト用スクレイパー生成ヘルパー
 *
 * このクラスはテストで使用する Fixture HTML を読み込み、
 * HttpBrowser をモック化して任意のスクレイパーに注入します。
 *
 * @author shimomo
 */
final class ScraperTestHelper
{
    /**
     * [レース番号, レース開催日] からフィクスチャのプレフィックスを生成
     *
     * @param  array{int|string, string}  $raceData
     * @return string
     */
    public static function generateFixturePrefix(array $raceData): string
    {
        [$raceNumber, $raceDate] = $raceData;

        $formattedRaceDate = Carbon::parse($raceDate)->format('Ymd');
        $formattedRaceNumber = str_pad((string) $raceNumber, 2, '0', STR_PAD_LEFT);

        return $formattedRaceDate . '_' . $formattedRaceNumber;
    }
}
