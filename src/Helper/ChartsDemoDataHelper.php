<?php

namespace Wexample\SymfonyChartsDemo\Helper;

use DateTimeImmutable;
use IntlDateFormatter;

/**
 * The figures the demo pages draw. Computed from fixed curves rather than
 * drawn at random, so that a page looks the same from one visit to the next
 * and a screenshot can be compared with the last one.
 */
class ChartsDemoDataHelper
{
    /**
     * `count` consecutive months, the last of them `after` months after this one, named in the
     * locale: the axis is translated with the page.
     *
     * @return list<string>
     */
    public static function months(
        string $locale,
        int $count,
        int $after = 0
    ): array {
        $formatter = new IntlDateFormatter($locale, IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'MMM yy');
        $first = new DateTimeImmutable('first day of this month')->modify(sprintf('-%d months', $count - 1 - $after));
        $months = [];

        for ($index = 0; $index < $count; ++$index) {
            $months[] = $formatter->format($first->modify(sprintf('+%d months', $index)));
        }

        return $months;
    }

    /**
     * A seasonal curve around `base`, rising by `trend` a step.
     *
     * @return list<float>
     */
    public static function curve(
        int $count,
        float $base,
        float $amplitude,
        float $trend = 0.0,
        float $phase = 0.0
    ): array {
        $values = [];

        for ($index = 0; $index < $count; ++$index) {
            $values[] = round($base + $trend * $index + $amplitude * sin($index / 1.9 + $phase), 1);
        }

        return $values;
    }

    /**
     * Samples spread around `center`, for a box plot or a histogram.
     *
     * @return list<float>
     */
    public static function samples(
        int $count,
        float $center,
        float $spread,
        int $seed = 1
    ): array {
        $samples = [];

        for ($index = 1; $index <= $count; ++$index) {
            // Three waves of unrelated periods: no pattern a reader would see.
            $noise = sin($index * 12.9898 + $seed) + sin($index * 4.1414 + 2 * $seed) / 2 + sin($index * 0.7 + $seed) / 3;
            $samples[] = round($center + $spread * $noise / 1.83, 1);
        }

        return $samples;
    }
}
