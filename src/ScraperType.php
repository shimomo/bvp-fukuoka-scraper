<?php

declare(strict_types=1);

namespace BVP\FukuokaScraper;

/**
 * @psalm-type ScrapedComments = array{
 *     boats?: array<int<1, 6>, array{
 *         racer_boat_number: int<1, 6>,
 *         racer_name: ?string,
 *         racer_yesterday_comment_label: ?string,
 *         racer_yesterday_comment_text: ?string,
 *     }>,
 * }
 *
 * @psalm-type ScrapedForecasts = array{
 *     reporter_yesterday_comment_label: ?string,
 *     reporter_yesterday_comment_text: ?string,
 *     reporter_yesterday_reliability_label: ?string,
 *     reporter_yesterday_reliability_text: ?string,
 *     reporter_yesterday_course_label: ?string,
 *     reporter_yesterday_course_text: ?string,
 *     reporter_today_comment_label: ?string,
 *     reporter_today_comment_text: ?string,
 *     reporter_today_focus_label: ?string,
 *     reporter_today_focus_list: ?list<mixed>,
 *     reporter_today_focus_exacta_label: ?string,
 *     reporter_today_focus_exacta_list: ?list<mixed>,
 *     reporter_today_focus_trifecta_label: ?string,
 *     reporter_today_focus_trifecta_list: ?list<mixed>,
 * }
 *
 * @psalm-type ScrapedTimes = array{
 *     boats?: array<int<1, 6>, array{
 *         racer_boat_number: int,
 *         racer_name: string,
 *         racer_exhibition_time: ?float,
 *         racer_lap_time: ?float,
 *         racer_turn_time: ?float,
 *         racer_straight_time: ?float,
 *     }>,
 * }
 *
 * @psalm-type ScrapedRaces = array<int<1, 12>, ScrapedComments|ScrapedForecasts|ScrapedTimes>
 *
 * @author shimomo
 */
final class ScraperType
{
    //
}
