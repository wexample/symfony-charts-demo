## What this package holds

The demo pages of `symfony-charts-ds`, under `/{_locale}/charts/`, and the menu group `Wexample\SymfonyChartsDemo\Controller\Pages` an app adds to its layout with `menu_item_collapsible_from_controller()`.

- **Charts** (`charts_demo_index`): every type with its options — line, stacked area, bars in euros, horizontal stacked bars, donut, box plot, histogram — a chart fed by the api through `source`, and a chart with no data.
- **Steering** (`charts_demo_steering`): the charts of a production steering screen, on made-up figures — load against capacity per loom group, actual against forecast with today and the confidence band, a sparkline per table row.

The figures come from `Helper/ChartsDemoDataHelper`: fixed curves rather than random draws, so a page looks the same from one visit to the next. The months are worded in the request's locale.

`Service/DemoOutputChartPointProvider` serves the `demo-output` chart as `ChartPoint` entities: the model of a provider an application writes.

## Installing it

Register `WexampleSymfonyChartsBundle`, `WexampleSymfonyChartsDsBundle` and `WexampleSymfonyChartsDemoBundle`; add `echarts` to the app's `package.json`; add the `symfony-charts` generated repositories and schemas to the app's api client; regenerate the Encore manifest (`loader:generate-encore-manifest`) and restart the watcher.
