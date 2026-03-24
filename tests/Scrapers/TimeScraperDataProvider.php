<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

/**
 * @author shimomo
 */
final class TimeScraperDataProvider
{
    /**
     * @psalm-return non-empty-list<array{
     *     arguments: array{\Carbon\CarbonInterface|non-empty-string|null, int<1, 12>},
     *     expected: array<int<1, 12>, array{
     *         boats: array<int<1, 6>, mixed>
     *     }>
     * }>
     *
     * @return array
     */
    public static function scrapeProvider(): array
    {
        return [
            [
                'arguments' => ['2025-01-03', 1],
                'expected' => [
                    1 => [
                        'boats' => [
                            1 => [
                                'racer_boat_number' => 1,
                                'racer_name' => '渡辺浩司',
                                'racer_exhibition_time' => 6.84,
                                'racer_lap_time' => 37.18,
                                'racer_turn_time' => 5.48,
                                'racer_straight_time' => 7.67,
                            ],
                            2 => [
                                'racer_boat_number' => 2,
                                'racer_name' => '藤丸光一',
                                'racer_exhibition_time' => 6.84,
                                'racer_lap_time' => 38.12,
                                'racer_turn_time' => 5.44,
                                'racer_straight_time' => 7.63,
                            ],
                            3 => [
                                'racer_boat_number' => 3,
                                'racer_name' => '松本真広',
                                'racer_exhibition_time' => 6.89,
                                'racer_lap_time' => 37.86,
                                'racer_turn_time' => 5.72,
                                'racer_straight_time' => 7.71,
                            ],
                            4 => [
                                'racer_boat_number' => 4,
                                'racer_name' => '土井歩夢',
                                'racer_exhibition_time' => 6.88,
                                'racer_lap_time' => 38.57,
                                'racer_turn_time' => 5.67,
                                'racer_straight_time' => 7.63,
                            ],
                            5 => [
                                'racer_boat_number' => 5,
                                'racer_name' => '國弘翔平',
                                'racer_exhibition_time' => 6.84,
                                'racer_lap_time' => 38.20,
                                'racer_turn_time' => 5.97,
                                'racer_straight_time' => 7.60,
                            ],
                            6 => [
                                'racer_boat_number' => 6,
                                'racer_name' => '出畑孝成',
                                'racer_exhibition_time' => 6.93,
                                'racer_lap_time' => 37.77,
                                'racer_turn_time' => 6.07,
                                'racer_straight_time' => 7.57,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'arguments' => ['2025-01-03', 9],
                'expected' => [
                    9 => [
                        'boats' => [
                            1 => [
                                'racer_boat_number' => 1,
                                'racer_name' => '竹下大樹',
                                'racer_exhibition_time' => 6.79,
                                'racer_lap_time' => 37.26,
                                'racer_turn_time' => 5.41,
                                'racer_straight_time' => 7.57,
                            ],
                            2 => [
                                'racer_boat_number' => 2,
                                'racer_name' => '加倉侑征',
                                'racer_exhibition_time' => 6.90,
                                'racer_lap_time' => 37.43,
                                'racer_turn_time' => 5.83,
                                'racer_straight_time' => 7.63,
                            ],
                            3 => [
                                'racer_boat_number' => 3,
                                'racer_name' => '鶴田勇雄',
                                'racer_exhibition_time' => 6.84,
                                'racer_lap_time' => 37.83,
                                'racer_turn_time' => 5.84,
                                'racer_straight_time' => 7.61,
                            ],
                            4 => [
                                'racer_boat_number' => 4,
                                'racer_name' => '上野俊樹',
                                'racer_exhibition_time' => 6.90,
                                'racer_lap_time' => 37.30,
                                'racer_turn_time' => 5.55,
                                'racer_straight_time' => 7.63,
                            ],
                            5 => [
                                'racer_boat_number' => 5,
                                'racer_name' => '小川晃司',
                                'racer_exhibition_time' => 6.93,
                                'racer_lap_time' => 37.76,
                                'racer_turn_time' => 5.81,
                                'racer_straight_time' => 7.84,
                            ],
                            6 => [
                                'racer_boat_number' => 6,
                                'racer_name' => '江夏満',
                                'racer_exhibition_time' => 6.87,
                                'racer_lap_time' => 38.37,
                                'racer_turn_time' => 6.03,
                                'racer_straight_time' => 7.56,
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
