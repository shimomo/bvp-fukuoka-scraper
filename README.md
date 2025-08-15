# BVP Fukuoka Scraper

[![tests](https://github.com/shimomo/bvp-fukuoka-scraper/actions/workflows/tests.yml/badge.svg)](https://github.com/shimomo/bvp-fukuoka-scraper/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/shimomo/bvp-fukuoka-scraper/graph/badge.svg?token=N52lcvZHGj)](https://codecov.io/gh/shimomo/bvp-fukuoka-scraper)
[![php](https://poser.pugx.org/bvp/fukuoka-scraper/require/php)](https://packagist.org/packages/bvp/fukuoka-scraper)
[![stable](https://poser.pugx.org/bvp/fukuoka-scraper/v/stable)](https://packagist.org/packages/bvp/fukuoka-scraper)
[![unstable](https://poser.pugx.org/bvp/fukuoka-scraper/v/unstable)](https://packagist.org/packages/bvp/fukuoka-scraper)
[![license](https://poser.pugx.org/bvp/fukuoka-scraper/license)](https://packagist.org/packages/bvp/fukuoka-scraper)

BVP Fukuoka Scraper は、ボートレース福岡の公式サイトから選手コメント、記者予想、オリジナル展示タイムをスクレイピングして取得できる PHP ライブラリです。

## 📦 Requirements
- PHP ^8.2
- Composer
- Carbon

## 💾 Installation
```bash
composer require bvp/fukuoka-scraper
```

## ⚡ Usage

### サポートメソッド一覧

| メソッド | 説明 | 引数 |
|---|---|---|
| `Scraper::scrapeComments($raceNumber, $raceDate = null)` | 選手コメントを取得 | `$raceNumber` : 1〜12<br>`$raceDate` : Carbon対応日付文字列またはCarbonインスタンス（省略時は当日） |
| `Scraper::scrapeForecasts($raceNumber, $raceDate = null)` | 記者予想を取得 | 同上 |
| `Scraper::scrapeTimes($raceNumber, $raceDate = null)` | オリジナル展示タイムを取得 | 同上 |

**$raceDate の例**
- `'2025-01-01'`
- `'2025/01/01'`
- `'yesterday'`
- `Carbon::now()->subDay()`

### 基本的な使い方

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BVP\FukuokaScraper\Scraper;

// 選手コメントを取得
$comments = Scraper::scrapeComments(1, '2025-01-03');

// 記者予想を取得
$forecasts = Scraper::scrapeForecasts(1, '2025-01-03');

// オリジナル展示タイムを取得
$times = Scraper::scrapeTimes(1, '2025-01-03');

print_r($comments);
print_r($forecasts);
print_r($times);
```

### Scraper::scrapeComments()
```php
// 例: ボートレース福岡の公式サイトから2025年01月03日の1レースの選手コメントを取得
$comments = Scraper::scrapeComments(1, '2025-01-03');
print_r($comments);
```

<details>
<summary>取得結果</summary>

```php
/*
Array
(
    [boat_number_1_racer_name] => 渡辺浩司
    [boat_number_1_racer_yesterday_comment_label] => 前日コメント
    [boat_number_1_racer_yesterday_comment] => 乗った感じは悪くないし、直線も悪くない。
    [boat_number_2_racer_name] => 藤丸光一
    [boat_number_2_racer_yesterday_comment_label] => 前日コメント
    [boat_number_2_racer_yesterday_comment] => 起こしに違和感はない。足は普通くらい。
    [boat_number_3_racer_name] => 松本真広
    [boat_number_3_racer_yesterday_comment_label] => 前日コメント
    [boat_number_3_racer_yesterday_comment] => 直線で下がることはない。ただ、回転不足。
    [boat_number_4_racer_name] => 土井歩夢
    [boat_number_4_racer_yesterday_comment_label] => 前日コメント
    [boat_number_4_racer_yesterday_comment] => 手前の感じがあまり良くなかった。
    [boat_number_5_racer_name] => 國弘翔平
    [boat_number_5_racer_yesterday_comment_label] => 前日コメント
    [boat_number_5_racer_yesterday_comment] => 出足や行き足は良さそう。伸びることはない。
    [boat_number_6_racer_name] => 出畑孝成
    [boat_number_6_racer_yesterday_comment_label] => 前日コメント
    [boat_number_6_racer_yesterday_comment] => エンジン自体は問題ないと思う。
)
*/
```
</details>

### Scraper::scrapeForecasts()

```php
// 例: ボートレース福岡の公式サイトから2025年01月03日の1レースの記者予想を取得
$forecasts = Scraper::scrapeForecasts(1, '2025-01-03');
print_r($forecasts);
```

<details>
<summary>取得結果</summary>

```php
/*
Array
(
    [reporter_yesterday_comment_label] => 記者予想 前日コメント
    [reporter_yesterday_comment] => 実力断然の渡辺がイン速攻で決着をつける。藤丸が的確に運んで追走一番手。土井、國弘はセンター連動で浮上したい。松本の先攻め一考。
    [reporter_yesterday_reliability_label] => 記者予想 前日信頼度
    [reporter_yesterday_reliability] => 60%
    [reporter_yesterday_course_label] => 記者予想 前日コース
    [reporter_yesterday_course] => 123/456
    [reporter_today_comment_label] => 記者予想 当日コメント
    [reporter_today_comment] => 周回展示は國弘のターン回りが良さそうだった。そのほかに目立つ足はない。渡辺がイン速攻で他艇完封へ。気配重視で國弘を2、3着で狙いたい。
    [reporter_today_focus_label] => 記者予想 当日フォーカス
    [reporter_today_focus] => Array
        (
            [0] => 1-5-24
            [1] => 1-24-5
        )

    [reporter_today_focus_exacta_label] => 記者予想 当日フォーカス 2連単
    [reporter_today_focus_exacta] => Array
        (
        )

    [reporter_today_focus_trifecta_label] => 記者予想 当日フォーカス 3連単
    [reporter_today_focus_trifecta] => Array
        (
            [0] => 1-5-24
            [1] => 1-24-5
        )

)
*/
```

</details>

### Scraper::scrapeTimes()

```php
// 例: ボートレース福岡の公式サイトから2025年01月03日の1レースのオリジナル展示タイムを取得
$times = Scraper::scrapeTimes(1, '2025-01-03');
print_r($times);
```

<details>
<summary>取得結果</summary>

```php
/*
Array
(
    [boat_number_1_racer_name] => 渡辺浩司
    [boat_number_1_racer_exhibition_time] => 6.84
    [boat_number_1_racer_lap_time] => 37.18
    [boat_number_1_racer_turn_time] => 5.48
    [boat_number_1_racer_straight_time] => 7.67
    [boat_number_2_racer_name] => 藤丸光一
    [boat_number_2_racer_exhibition_time] => 6.84
    [boat_number_2_racer_lap_time] => 38.12
    [boat_number_2_racer_turn_time] => 5.44
    [boat_number_2_racer_straight_time] => 7.63
    [boat_number_3_racer_name] => 松本真広
    [boat_number_3_racer_exhibition_time] => 6.89
    [boat_number_3_racer_lap_time] => 37.86
    [boat_number_3_racer_turn_time] => 5.72
    [boat_number_3_racer_straight_time] => 7.71
    [boat_number_4_racer_name] => 土井歩夢
    [boat_number_4_racer_exhibition_time] => 6.88
    [boat_number_4_racer_lap_time] => 38.57
    [boat_number_4_racer_turn_time] => 5.67
    [boat_number_4_racer_straight_time] => 7.63
    [boat_number_5_racer_name] => 國弘翔平
    [boat_number_5_racer_exhibition_time] => 6.84
    [boat_number_5_racer_lap_time] => 38.2
    [boat_number_5_racer_turn_time] => 5.97
    [boat_number_5_racer_straight_time] => 7.6
    [boat_number_6_racer_name] => 出畑孝成
    [boat_number_6_racer_exhibition_time] => 6.93
    [boat_number_6_racer_lap_time] => 37.77
    [boat_number_6_racer_turn_time] => 6.07
    [boat_number_6_racer_straight_time] => 7.57
)
*/
```

</details>

## ⚠️ Notes
- **スクレイピング対象の公式サイトの構造が変更された場合**、正しくデータを取得できなくなる可能性があります。
- 利用時は対象サイトの利用規約を遵守してください。

## 📄 License
BVP Fukuoka Scraper は [MIT license](LICENSE) の元で公開されています。
