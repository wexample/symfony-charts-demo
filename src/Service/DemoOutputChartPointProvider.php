<?php

namespace Wexample\SymfonyChartsDemo\Service;

use Symfony\Component\HttpFoundation\Request;
use Wexample\SymfonyCharts\Helper\ChartPointHelper;
use Wexample\SymfonyCharts\Interface\ChartPointProviderInterface;
use Wexample\SymfonyChartsDemo\Helper\ChartsDemoDataHelper;

/**
 * The chart the demo feeds from the api: a year of woven and finished
 * output, as the points of the `demo-output` chart.
 */
class DemoOutputChartPointProvider implements ChartPointProviderInterface
{
    // The names come translated with the points, as the months do.
    private const array NAMES = [
        'en' => ['woven' => 'Woven', 'finished' => 'Finished'],
        'fr' => ['woven' => 'Tissé', 'finished' => 'Fini'],
    ];

    public static function getChartName(): string
    {
        return 'demo-output';
    }

    public function getPoints(Request $request): iterable
    {
        $locale = $request->getLocale();
        $names = self::NAMES[substr($locale, 0, 2)] ?? self::NAMES['en'];
        $months = ChartsDemoDataHelper::months($locale, 12);

        return [
            ...ChartPointHelper::seriesFromList(self::getChartName(), 'woven', $months, ChartsDemoDataHelper::curve(12, 920, 110, 8), $names['woven']),
            ...ChartPointHelper::seriesFromList(self::getChartName(), 'finished', $months, ChartsDemoDataHelper::curve(12, 870, 100, 8, -0.5), $names['finished'], 'mint'),
        ];
    }
}
