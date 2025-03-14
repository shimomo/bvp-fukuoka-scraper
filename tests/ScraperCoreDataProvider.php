<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests;

/**
 * @author shimomo
 */
final class ScraperCoreDataProvider
{
    /**
     * @return array
     */
    public static function scrapeCommentsProvider(): array
    {
        return [
            [
                'arguments' => [1, '2025-01-03'],
                'expected' => [
                    'boat_number_1_racer_name' => '渡辺浩司',
                    'boat_number_1_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_1_racer_yesterday_comment' => '乗った感じは悪くないし、直線も悪くない。',
                    'boat_number_2_racer_name' => '藤丸光一',
                    'boat_number_2_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_2_racer_yesterday_comment' => '起こしに違和感はない。足は普通くらい。',
                    'boat_number_3_racer_name' => '松本真広',
                    'boat_number_3_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_3_racer_yesterday_comment' => '直線で下がることはない。ただ、回転不足。',
                    'boat_number_4_racer_name' => '土井歩夢',
                    'boat_number_4_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_4_racer_yesterday_comment' => '手前の感じがあまり良くなかった。',
                    'boat_number_5_racer_name' => '國弘翔平',
                    'boat_number_5_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_5_racer_yesterday_comment' => '出足や行き足は良さそう。伸びることはない。',
                    'boat_number_6_racer_name' => '出畑孝成',
                    'boat_number_6_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_6_racer_yesterday_comment' => 'エンジン自体は問題ないと思う。',
                ],
            ],
            [
                'arguments' => [9, '2025-01-03'],
                'expected' => [
                    'boat_number_1_racer_name' => '竹下大樹',
                    'boat_number_1_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_1_racer_yesterday_comment' => '全体的にいいところがない感じだった。',
                    'boat_number_2_racer_name' => '加倉侑征',
                    'boat_number_2_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_2_racer_yesterday_comment' => '反応が出ているので上積みできそう。',
                    'boat_number_3_racer_name' => '鶴田勇雄',
                    'boat_number_3_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_3_racer_yesterday_comment' => 'スタートは届いていた。比較も悪くない。',
                    'boat_number_4_racer_name' => '上野俊樹',
                    'boat_number_4_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_4_racer_yesterday_comment' => '回転が上がっていたし、起こしも悪くない。',
                    'boat_number_5_racer_name' => '小川晃司',
                    'boat_number_5_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_5_racer_yesterday_comment' => '体感が良かった。下がることもない。',
                    'boat_number_6_racer_name' => '江夏満',
                    'boat_number_6_racer_yesterday_comment_label' => '前日コメント',
                    'boat_number_6_racer_yesterday_comment' => '変なところはない。行き足は悪くない。',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public static function scrapeForecastsProvider(): array
    {
        return [
            [
                'arguments' => [1, '2025-01-03'],
                'expected' => [
                    'reporter_yesterday_comment_label' => '記者予想 前日コメント',
                    'reporter_yesterday_comment' => '実力断然の渡辺がイン速攻で決着をつける。藤丸が的確に運んで追走一番手。土井、國弘はセンター連動で浮上したい。松本の先攻め一考。',
                    'reporter_yesterday_reliability_label' => '記者予想 前日信頼度',
                    'reporter_yesterday_reliability' => '60%',
                    'reporter_yesterday_course_label' => '記者予想 前日コース',
                    'reporter_yesterday_course' => '123/456',
                    'reporter_today_comment_label' => '記者予想 当日コメント',
                    'reporter_today_comment' => '周回展示は國弘のターン回りが良さそうだった。そのほかに目立つ足はない。渡辺がイン速攻で他艇完封へ。気配重視で國弘を2、3着で狙いたい。',
                    'reporter_today_focus_label' => '記者予想 当日フォーカス',
                    'reporter_today_focus' => ['1-5-24', '1-24-5'],
                    'reporter_today_focus_exacta_label' => '記者予想 当日フォーカス 2連単',
                    'reporter_today_focus_exacta' => [],
                    'reporter_today_focus_trifecta_label' => '記者予想 当日フォーカス 3連単',
                    'reporter_today_focus_trifecta' => ['1-5-24', '1-24-5'],
                ],
            ],
            [
                'arguments' => [9, '2025-01-03'],
                'expected' => [
                    'reporter_yesterday_comment_label' => '記者予想 前日コメント',
                    'reporter_yesterday_comment' => 'イン戦は目下7連勝中の竹下を中心に推す。鶴田が外マイから2マーク勝負に持ち込む。江夏、小川はターン勝負で追い上げを図る。',
                    'reporter_yesterday_reliability_label' => '記者予想 前日信頼度',
                    'reporter_yesterday_reliability' => '60%',
                    'reporter_yesterday_course_label' => '記者予想 前日コース',
                    'reporter_yesterday_course' => '123/465',
                    'reporter_today_comment_label' => '記者予想 当日コメント',
                    'reporter_today_comment' => '周回展示で目立つ動きの選手はいなかったが、悪い選手も見当たらなかった。竹下がスタートに集中して先マイへ。さばき的確な江夏が次位争いをリード。',
                    'reporter_today_focus_label' => '記者予想 当日フォーカス',
                    'reporter_today_focus' => ['1-6-23', '1-23-6'],
                    'reporter_today_focus_exacta_label' => '記者予想 当日フォーカス 2連単',
                    'reporter_today_focus_exacta' => [],
                    'reporter_today_focus_trifecta_label' => '記者予想 当日フォーカス 3連単',
                    'reporter_today_focus_trifecta' => ['1-6-23', '1-23-6'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public static function scrapeTimesProvider(): array
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
