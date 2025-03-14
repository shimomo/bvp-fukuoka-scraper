<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

/**
 * @author shimomo
 */
final class TimeScraperDataProvider
{
    /**
     * @return array
     */
    public static function scrapeProvider(): array
    {
        return [
            [
                'arguments' => [1, '2025-01-03'],
                'expected' => [
                    'boat_number_1_racer_name' => '渡辺浩司',
                    'boat_number_1_racer_exhibition_time' => 6.84,
                    'boat_number_1_racer_lap_time' => 37.18,
                    'boat_number_1_racer_turn_time' => 5.48,
                    'boat_number_1_racer_straight_time' => 7.67,
                    'boat_number_2_racer_name' => '藤丸光一',
                    'boat_number_2_racer_exhibition_time' => 6.84,
                    'boat_number_2_racer_lap_time' => 38.12,
                    'boat_number_2_racer_turn_time' => 5.44,
                    'boat_number_2_racer_straight_time' => 7.63,
                    'boat_number_3_racer_name' => '松本真広',
                    'boat_number_3_racer_exhibition_time' => 6.89,
                    'boat_number_3_racer_lap_time' => 37.86,
                    'boat_number_3_racer_turn_time' => 5.72,
                    'boat_number_3_racer_straight_time' => 7.71,
                    'boat_number_4_racer_name' => '土井歩夢',
                    'boat_number_4_racer_exhibition_time' => 6.88,
                    'boat_number_4_racer_lap_time' => 38.57,
                    'boat_number_4_racer_turn_time' => 5.67,
                    'boat_number_4_racer_straight_time' => 7.63,
                    'boat_number_5_racer_name' => '國弘翔平',
                    'boat_number_5_racer_exhibition_time' => 6.84,
                    'boat_number_5_racer_lap_time' => 38.20,
                    'boat_number_5_racer_turn_time' => 5.97,
                    'boat_number_5_racer_straight_time' => 7.60,
                    'boat_number_6_racer_name' => '出畑孝成',
                    'boat_number_6_racer_exhibition_time' => 6.93,
                    'boat_number_6_racer_lap_time' => 37.77,
                    'boat_number_6_racer_turn_time' => 6.07,
                    'boat_number_6_racer_straight_time' => 7.57,
                ],
            ],
            [
                'arguments' => [9, '2025-01-03'],
                'expected' => [
                    'boat_number_1_racer_name' => '竹下大樹',
                    'boat_number_1_racer_exhibition_time' => 6.79,
                    'boat_number_1_racer_lap_time' => 37.26,
                    'boat_number_1_racer_turn_time' => 5.41,
                    'boat_number_1_racer_straight_time' => 7.57,
                    'boat_number_2_racer_name' => '加倉侑征',
                    'boat_number_2_racer_exhibition_time' => 6.90,
                    'boat_number_2_racer_lap_time' => 37.43,
                    'boat_number_2_racer_turn_time' => 5.83,
                    'boat_number_2_racer_straight_time' => 7.63,
                    'boat_number_3_racer_name' => '鶴田勇雄',
                    'boat_number_3_racer_exhibition_time' => 6.84,
                    'boat_number_3_racer_lap_time' => 37.83,
                    'boat_number_3_racer_turn_time' => 5.84,
                    'boat_number_3_racer_straight_time' => 7.61,
                    'boat_number_4_racer_name' => '上野俊樹',
                    'boat_number_4_racer_exhibition_time' => 6.90,
                    'boat_number_4_racer_lap_time' => 37.30,
                    'boat_number_4_racer_turn_time' => 5.55,
                    'boat_number_4_racer_straight_time' => 7.63,
                    'boat_number_5_racer_name' => '小川晃司',
                    'boat_number_5_racer_exhibition_time' => 6.93,
                    'boat_number_5_racer_lap_time' => 37.76,
                    'boat_number_5_racer_turn_time' => 5.81,
                    'boat_number_5_racer_straight_time' => 7.84,
                    'boat_number_6_racer_name' => '江夏満',
                    'boat_number_6_racer_exhibition_time' => 6.87,
                    'boat_number_6_racer_lap_time' => 38.37,
                    'boat_number_6_racer_turn_time' => 6.03,
                    'boat_number_6_racer_straight_time' => 7.56,
                ],
            ],
        ];
    }
}
