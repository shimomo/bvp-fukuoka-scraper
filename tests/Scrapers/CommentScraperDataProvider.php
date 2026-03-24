<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

/**
 * @author shimomo
 */
final class CommentScraperDataProvider
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
}
