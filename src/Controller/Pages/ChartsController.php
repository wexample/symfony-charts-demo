<?php

namespace Wexample\SymfonyChartsDemo\Controller\Pages;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Wexample\SymfonyChartsDemo\Helper\ChartsDemoDataHelper;
use Wexample\SymfonyChartsDemo\Service\DemoOutputChartPointProvider;
use Wexample\SymfonyChartsDemo\Traits\SymfonyChartsDemoBundleClassTrait;
use Wexample\SymfonyHelpers\Helper\VariableHelper;
use Wexample\SymfonyLoader\Controller\AbstractPagesController;

/**
 * The charts of symfony-charts-ds: every type with its options, then the
 * charts a steering screen is made of — load against capacity, actual against
 * forecast, a sparkline per row.
 */
#[Route(path: '/charts/', name: 'charts_demo_')]
final class ChartsController extends AbstractPagesController
{
    use SymfonyChartsDemoBundleClassTrait;

    final public const string ROUTE_INDEX = VariableHelper::INDEX;

    final public const string ROUTE_STEERING = 'steering';

    #[Route(path: '', name: self::ROUTE_INDEX)]
    public function index(Request $request): Response
    {
        $months = ChartsDemoDataHelper::months($request->getLocale(), 12);

        return $this->renderPage(self::ROUTE_INDEX, [
            'months' => $months,
            'orders' => ChartsDemoDataHelper::curve(12, 420, 60, 6),
            'returns' => ChartsDemoDataHelper::curve(12, 140, 30, 2, 1.2),
            'revenue' => ChartsDemoDataHelper::curve(12, 18500, 4200, 350, 0.6),
            'durations' => [
                ChartsDemoDataHelper::samples(40, 5, 2.5, 1),
                ChartsDemoDataHelper::samples(40, 7.5, 3.5, 2),
                ChartsDemoDataHelper::samples(40, 4, 1.5, 3),
                ChartsDemoDataHelper::samples(40, 9, 4, 4),
            ],
            'yields' => ChartsDemoDataHelper::samples(300, 82, 9, 5),
            'output_chart' => DemoOutputChartPointProvider::getChartName(),
        ]);
    }

    #[Route(path: self::ROUTE_STEERING, name: self::ROUTE_STEERING)]
    public function steering(Request $request): Response
    {
        // A year behind, six months ahead: today is the twelfth month.
        $months = ChartsDemoDataHelper::months($request->getLocale(), 18, 6);
        $past = ChartsDemoDataHelper::curve(12, 1350, 160, 12);
        $ahead = ChartsDemoDataHelper::curve(18, 1350, 160, 12);
        $actual = $forecast = $low = $high = [];

        foreach ($ahead as $index => $value) {
            $isPast = $index < 12;
            $actual[] = $isPast ? $past[$index] : null;
            // The forecast starts on the last actual point, so the two lines join.
            $forecast[] = $index >= 11 ? round($value * 1.03, 1) : null;
            $margin = $index >= 11 ? 40 + 22 * ($index - 11) : null;
            $low[] = null === $margin ? null : round($value * 1.03 - $margin, 1);
            $high[] = null === $margin ? null : round($value * 1.03 + $margin, 1);
        }

        $items = [];
        foreach (['TAP-120-NAT', 'TAP-160-ANT', 'TAP-200-SAB', 'RUN-080-IVO', 'RUN-080-CHA', 'TAP-240-GRE'] as $index => $sku) {
            $orders = array_map(static fn (float $value) => max(0, round($value)), ChartsDemoDataHelper::curve(6, 40 + 14 * $index, 12 + 2 * $index, $index % 2 ? -2 : 3, $index));
            $items[] = [
                'sku' => $sku,
                'orders' => $orders,
                'average' => round(array_sum($orders) / count($orders), 1),
                'available' => [62, 12, 140, 8, 35, 0][$index],
            ];
        }

        return $this->renderPage(self::ROUTE_STEERING, [
            'groups' => ['Van de Wiele 1', 'Van de Wiele 2', 'Schönherr', 'Tufting A', 'Tufting B', 'Finishing'],
            'load' => [412, 505, 268, 377, 190, 610],
            'capacity' => [480, 480, 400, 400, 320, 560],
            'months' => $months,
            'actual' => $actual,
            'forecast' => $forecast,
            'low' => $low,
            'high' => $high,
            'today' => $months[11],
            'items' => $items,
        ]);
    }
}
