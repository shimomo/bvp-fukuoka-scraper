<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper\Tests\Scrapers;

/**
 * @author shimomo
 */
final class ForecastScraperDataProvider
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
}
