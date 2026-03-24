<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests;

/**
 * @author shimomo
 */
final class ScraperDataProvider
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
    public static function scrapeCommentsProvider(): array
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
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '乗った感じは悪くないし、直線も悪くない。',
                            ],
                            2 => [
                                'racer_boat_number' => 2,
                                'racer_name' => '藤丸光一',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '起こしに違和感はない。足は普通くらい。',
                            ],
                            3 => [
                                'racer_boat_number' => 3,
                                'racer_name' => '松本真広',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '直線で下がることはない。ただ、回転不足。',
                            ],
                            4 => [
                                'racer_boat_number' => 4,
                                'racer_name' => '土井歩夢',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '手前の感じがあまり良くなかった。',
                            ],
                            5 => [
                                'racer_boat_number' => 5,
                                'racer_name' => '國弘翔平',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '出足や行き足は良さそう。伸びることはない。',
                            ],
                            6 => [
                                'racer_boat_number' => 6,
                                'racer_name' => '出畑孝成',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => 'エンジン自体は問題ないと思う。',
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
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '全体的にいいところがない感じだった。',
                            ],
                            2 => [
                                'racer_boat_number' => 2,
                                'racer_name' => '加倉侑征',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '反応が出ているので上積みできそう。',
                            ],
                            3 => [
                                'racer_boat_number' => 3,
                                'racer_name' => '鶴田勇雄',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => 'スタートは届いていた。比較も悪くない。',
                            ],
                            4 => [
                                'racer_boat_number' => 4,
                                'racer_name' => '上野俊樹',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '回転が上がっていたし、起こしも悪くない。',
                            ],
                            5 => [
                                'racer_boat_number' => 5,
                                'racer_name' => '小川晃司',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '体感が良かった。下がることもない。',
                            ],
                            6 => [
                                'racer_boat_number' => 6,
                                'racer_name' => '江夏満',
                                'racer_yesterday_comment_label' => '前日コメント',
                                'racer_yesterday_comment_text' => '変なところはない。行き足は悪くない。',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<array{
     *     arguments: array{\Carbon\CarbonInterface|non-empty-string|null, int<1, 12>},
     *     expected: array<int<1, 12>, mixed>
     * }>
     *
     * @return array
     */
    public static function scrapeForecastsProvider(): array
    {
        return [
            [
                'arguments' => ['2025-01-03', 1],
                'expected' => [
                    1 => [
                        'reporter_yesterday_comment_label' => '記者予想 前日コメント',
                        'reporter_yesterday_comment_text'
                            => '実力断然の渡辺がイン速攻で決着をつける。藤丸が的確に運んで追走一番手。土井、國弘はセンター連動で浮上したい。松本の先攻め一考。',
                        'reporter_yesterday_reliability_label' => '記者予想 前日信頼度',
                        'reporter_yesterday_reliability_text' => '60%',
                        'reporter_yesterday_course_label' => '記者予想 前日コース',
                        'reporter_yesterday_course_text' => '123/456',
                        'reporter_today_comment_label' => '記者予想 当日コメント',
                        'reporter_today_comment_text'
                            => '周回展示は國弘のターン回りが良さそうだった。そのほかに目立つ足はない。渡辺がイン速攻で他艇完封へ。気配重視で國弘を2、3着で狙いたい。',
                        'reporter_today_focus_label' => '記者予想 当日フォーカス',
                        'reporter_today_focus_list' => ['1-5-24', '1-24-5'],
                        'reporter_today_focus_exacta_label' => '記者予想 当日フォーカス 2連単',
                        'reporter_today_focus_exacta_list' => [],
                        'reporter_today_focus_trifecta_label' => '記者予想 当日フォーカス 3連単',
                        'reporter_today_focus_trifecta_list' => ['1-5-24', '1-24-5'],
                    ],
                ],
            ],
            [
                'arguments' => ['2025-01-03', 9],
                'expected' => [
                    9 => [
                        'reporter_yesterday_comment_label' => '記者予想 前日コメント',
                        'reporter_yesterday_comment_text'
                            => 'イン戦は目下7連勝中の竹下を中心に推す。鶴田が外マイから2マーク勝負に持ち込む。江夏、小川はターン勝負で追い上げを図る。',
                        'reporter_yesterday_reliability_label' => '記者予想 前日信頼度',
                        'reporter_yesterday_reliability_text' => '60%',
                        'reporter_yesterday_course_label' => '記者予想 前日コース',
                        'reporter_yesterday_course_text' => '123/465',
                        'reporter_today_comment_label' => '記者予想 当日コメント',
                        'reporter_today_comment_text'
                            => '周回展示で目立つ動きの選手はいなかったが、悪い選手も見当たらなかった。竹下がスタートに集中して先マイへ。さばき的確な江夏が次位争いをリード。',
                        'reporter_today_focus_label' => '記者予想 当日フォーカス',
                        'reporter_today_focus_list' => ['1-6-23', '1-23-6'],
                        'reporter_today_focus_exacta_label' => '記者予想 当日フォーカス 2連単',
                        'reporter_today_focus_exacta_list' => [],
                        'reporter_today_focus_trifecta_label' => '記者予想 当日フォーカス 3連単',
                        'reporter_today_focus_trifecta_list' => ['1-6-23', '1-23-6'],
                    ],
                ],
            ],
        ];
    }

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
    public static function scrapeTimesProvider(): array
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
