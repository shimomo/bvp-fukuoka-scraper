<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

/**
 * @author shimomo
 */
final class CommentScraperDataProvider
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
}
