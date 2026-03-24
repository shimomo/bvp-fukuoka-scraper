# Fukuoka Scraper for Boatrace Venture Project

[![security](https://github.com/shimomo/bvp-fukuoka-scraper/actions/workflows/security.yml/badge.svg)](https://github.com/shimomo/bvp-fukuoka-scraper/actions/workflows/security.yml)
[![test](https://github.com/shimomo/bvp-fukuoka-scraper/actions/workflows/test.yml/badge.svg)](https://github.com/shimomo/bvp-fukuoka-scraper/actions/workflows/test.yml)
[![codecov](https://codecov.io/gh/shimomo/bvp-fukuoka-scraper/graph/badge.svg?token=N52lcvZHGj)](https://codecov.io/gh/shimomo/bvp-fukuoka-scraper)
[![php](https://poser.pugx.org/bvp/fukuoka-scraper/require/php)](https://packagist.org/packages/bvp/fukuoka-scraper)
[![stable](https://poser.pugx.org/bvp/fukuoka-scraper/v/stable)](https://packagist.org/packages/bvp/fukuoka-scraper)
[![license](https://poser.pugx.org/bvp/fukuoka-scraper/license)](https://packagist.org/packages/bvp/fukuoka-scraper)

Fukuoka Scraper は、ボートレース福岡の公式サイトから選手コメント、記者予想、オリジナル展示タイムをスクレイピングするための PHP ライブラリです。

## 📦 Requirements

- PHP: ^8.2
- bvp/scraper-core: ^6.1
- nesbot/carbon: ^2.63 || ^3.0

## 💾 Installation

```bash
composer require bvp/fukuoka-scraper
```

## ⚡ Usage

### サポートメソッド一覧

| Method | Description |
|---|---|
| `Scraper::scrapeComments(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`CarbonInterface`&#124;`string`&#124;`null $date = null,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`int`&#124;`string`&#124;`array`&#124;`null $numbers = null`<br>`)` | 選手コメントを取得<br> `$date` : 対象日を Carbon インスタンスまたは Carbon 対応日付文字列で指定（省略時は本日）<br>`$numbers` : 対象レース番号を 1〜12 の整数・数値文字列・配列で指定（省略時は全レース番号） |
| `Scraper::scrapeForecasts(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`CarbonInterface`&#124;`string`&#124;`null $date = null,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`int`&#124;`string`&#124;`array`&#124;`null $numbers = null`<br>`)` | 記者予想を取得<br>同上 |
| `Scraper::scrapeTimes(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`CarbonInterface`&#124;`string`&#124;`null $date = null,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`int`&#124;`string`&#124;`array`&#124;`null $numbers = null`<br>`)` | オリジナル展示タイムを取得<br>同上 |

**$date の例**
- `'2025-01-01'`
- `'2025/01/01'`
- `'yesterday'`
- `Carbon::now()->subDay()`

**$numbers の例**
- `1`
- `'1'`
- `[1, 2, 3]`
- `['1', '2', '3']`

### 基本的な使い方

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BVP\FukuokaScraper\Scraper;

// 選手コメントを取得
$comments = Scraper::scrapeComments('2026-03-24', 1);

// 記者予想を取得
$forecasts = Scraper::scrapeForecasts('2026-03-24', 1);

// オリジナル展示タイムを取得
$times = Scraper::scrapeTimes('2026-03-24', 1);
```

### Scraper::scrapeComments()

```php
// 例: ボートレース福岡の公式サイトから2026年03月24日の1レースの選手コメントを取得
$comments = Scraper::scrapeComments('2026-03-24', 1);
print_r($comments);
```

<details>
<summary>取得結果</summary>

```php
Array
(
    [1] => Array
        (
            [boats] => Array
                (
                    [1] => Array
                        (
                            [racer_boat_number] => 1
                            [racer_name] => 長岡良也
                            [racer_yesterday_comment_label] => 前日コメント
                            [racer_yesterday_comment_text] => マシンは悪くない。また調整する。
                        )

                    [2] => Array
                        (
                            [racer_boat_number] => 2
                            [racer_name] => 田邉亮蔵
                            [racer_yesterday_comment_label] => 前日コメント
                            [racer_yesterday_comment_text] => 悪い足ではないけど、特徴がない。
                        )

                    [3] => Array
                        (
                            [racer_boat_number] => 3
                            [racer_name] => 福岡泉水
                            [racer_yesterday_comment_label] => 前日コメント
                            [racer_yesterday_comment_text] => ターン回りはいいけど、直線が微妙。
                        )

                    [4] => Array
                        (
                            [racer_boat_number] => 4
                            [racer_name] => 宮嵜隆太郎
                            [racer_yesterday_comment_label] => 前日コメント
                            [racer_yesterday_comment_text] => スリットは変わらないが、全体的に少し弱い。
                        )

                    [5] => Array
                        (
                            [racer_boat_number] => 5
                            [racer_name] => 吉田翔悟
                            [racer_yesterday_comment_label] => 前日コメント
                            [racer_yesterday_comment_text] => 出足や行き足が上向いた。伸びもいい状態。
                        )

                    [6] => Array
                        (
                            [racer_boat_number] => 6
                            [racer_name] => 龍田真白
                            [racer_yesterday_comment_label] => 前日コメント
                            [racer_yesterday_comment_text] => 足も乗り心地も全体的に良くなった。
                        )

                )

        )

)
```

</details>

### Scraper::scrapeForecasts()

```php
// 例: ボートレース福岡の公式サイトから2026年03月24日の1レースの記者予想を取得
$forecasts = Scraper::scrapeForecasts('2026-03-24', 1);
print_r($forecasts);
```

<details>
<summary>取得結果</summary>

```php
Array
(
    [1] => Array
        (
            [reporter_yesterday_comment_label] => 記者予想 前日コメント
            [reporter_yesterday_comment_text] => 出足関係はしっかりしている長岡を軸に推すが、スタートが鍵になる。パワー上位の吉田はもちろん、福岡や田邉、宮嵜も軽視はできない。
            [reporter_yesterday_reliability_label] => 記者予想 前日信頼度
            [reporter_yesterday_reliability_text] => 50%
            [reporter_yesterday_course_label] => 記者予想 前日コース
            [reporter_yesterday_course_text] => 123/456
            [reporter_today_comment_label] => 記者予想 当日コメント
            [reporter_today_comment_text] => 周回展示は吉田の動きが良く、長岡もターン回りは悪くない。F2の長岡を相手に行く気満々に映った田邉や宮嵜の一発警戒。
            [reporter_today_focus_label] => 記者予想 当日フォーカス
            [reporter_today_focus_list] => Array
                (
                    [0] => 1-5-23
                    [1] => 1-23-5
                    [2] => 2-5-34
                    [3] => 4-5-23
                )

            [reporter_today_focus_exacta_label] => 記者予想 当日フォーカス 2連単
            [reporter_today_focus_exacta_list] => Array
                (
                )

            [reporter_today_focus_trifecta_label] => 記者予想 当日フォーカス 3連単
            [reporter_today_focus_trifecta_list] => Array
                (
                    [0] => 1-5-23
                    [1] => 1-23-5
                    [2] => 2-5-34
                    [3] => 4-5-23
                )

        )

)
```

</details>

### Scraper::scrapeTimes()

```php
// 例: ボートレース福岡の公式サイトから2026年03月24日の1レースのオリジナル展示タイムを取得
$times = Scraper::scrapeTimes('2026-03-24', 1);
print_r($times);
```

<details>
<summary>取得結果</summary>

```php
Array
(
    [1] => Array
        (
            [boats] => Array
                (
                    [1] => Array
                        (
                            [racer_boat_number] => 1
                            [racer_name] => 長岡良也
                            [racer_exhibition_time] => 6.83
                            [racer_lap_time] => 37.13
                            [racer_turn_time] => 5.44
                            [racer_straight_time] => 7.67
                        )

                    [2] => Array
                        (
                            [racer_boat_number] => 2
                            [racer_name] => 田邉亮蔵
                            [racer_exhibition_time] => 6.81
                            [racer_lap_time] => 36.95
                            [racer_turn_time] => 5.57
                            [racer_straight_time] => 7.63
                        )

                    [3] => Array
                        (
                            [racer_boat_number] => 3
                            [racer_name] => 福岡泉水
                            [racer_exhibition_time] => 6.85
                            [racer_lap_time] => 37.4
                            [racer_turn_time] => 5.46
                            [racer_straight_time] => 7.7
                        )

                    [4] => Array
                        (
                            [racer_boat_number] => 4
                            [racer_name] => 宮嵜隆太郎
                            [racer_exhibition_time] => 6.88
                            [racer_lap_time] => 37.7
                            [racer_turn_time] => 5.67
                            [racer_straight_time] => 7.76
                        )

                    [5] => Array
                        (
                            [racer_boat_number] => 5
                            [racer_name] => 吉田翔悟
                            [racer_exhibition_time] => 6.8
                            [racer_lap_time] => 37.26
                            [racer_turn_time] => 5.52
                            [racer_straight_time] => 7.75
                        )

                    [6] => Array
                        (
                            [racer_boat_number] => 6
                            [racer_name] => 龍田真白
                            [racer_exhibition_time] => 6.83
                            [racer_lap_time] => 37.7
                            [racer_turn_time] => 5.89
                            [racer_straight_time] => 7.6
                        )

                )

        )

)
```

</details>

## ⚠️ Notes

- **スクレイピング対象の公式サイトの構造が変更された場合**、正しくデータを取得できなくなる可能性があります。
- 利用時は対象サイトの利用規約を遵守してください。

## 📄 License

Fukuoka Scraper は [MIT license](LICENSE) の元で公開されています。
