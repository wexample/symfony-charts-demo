<?php

namespace Wexample\SymfonyChartsDemo\Traits;

use Wexample\SymfonyChartsDemo\WexampleSymfonyChartsDemoBundle;
use Wexample\SymfonyHelpers\Traits\BundleClassTrait;

trait SymfonyChartsDemoBundleClassTrait
{
    use BundleClassTrait;

    public static function getBundleClassName(): string
    {
        return WexampleSymfonyChartsDemoBundle::class;
    }
}
