# symfony-charts-demo

Version: 2.0.0

## What this package holds

The demo pages of `symfony-charts-ds`, under `/{_locale}/charts/`, and the menu group `Wexample\SymfonyChartsDemo\Controller\Pages` an app adds to its layout with `menu_item_collapsible_from_controller()`.

- **Charts** (`charts_demo_index`): every type with its options — line, stacked area, bars in euros, horizontal stacked bars, donut, box plot, histogram — a chart fed by the api through `source`, and a chart with no data.
- **Steering** (`charts_demo_steering`): the charts of a production steering screen, on made-up figures — load against capacity per loom group, actual against forecast with today and the confidence band, a sparkline per table row.

The figures come from `Helper/ChartsDemoDataHelper`: fixed curves rather than random draws, so a page looks the same from one visit to the next. The months are worded in the request's locale.

`Service/DemoOutputChartPointProvider` serves the `demo-output` chart as `ChartPoint` entities: the model of a provider an application writes.

## Installing it

Register `WexampleSymfonyChartsBundle`, `WexampleSymfonyChartsDsBundle` and `WexampleSymfonyChartsDemoBundle`; add `echarts` to the app's `package.json`; add the `symfony-charts` generated repositories and schemas to the app's api client; regenerate the Encore manifest (`loader:generate-encore-manifest`) and restart the watcher.

## Table of Contents

- [What this package holds](#what-this-package-holds)
- [Installing it](#installing-it)
- [Integration in the Suite](#integration-in-the-suite)
- [Dependencies](#dependencies)
- [Versioning & Compatibility Policy](#versioning--compatibility-policy)
- [License](#license)
- [About us](#about-us)
- [Migration Notes](#migration-notes)

## Integration in the Suite

This package is part of the Wexample Suite — a collection of high-quality, modular tools designed to work seamlessly together across multiple languages and environments.

### Related Packages

The suite includes packages for configuration management, file handling, prompts, and more. Each package can be used independently or as part of the integrated suite.

Visit the [Wexample Suite documentation](https://docs.wexample.com) for the complete package ecosystem.

## Dependencies

- php: >=8.5
- wexample/symfony-charts: >=2.0.0
- wexample/symfony-charts-ds: >=2.0.0
- wexample/symfony-design-system: >=32.0.0
- wexample/symfony-helpers: >=15.0.0
- wexample/symfony-loader: >=22.0.0

## Versioning & Compatibility Policy

Wexample packages follow **Semantic Versioning** (SemVer):

- **MAJOR**: Breaking changes
- **MINOR**: New features, backward compatible
- **PATCH**: Bug fixes, backward compatible

We maintain backward compatibility within major versions and provide clear migration guides for breaking changes.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

Free to use in both personal and commercial projects.

## About us

[Wexample](https://wexample.com) stands as a cornerstone of the digital ecosystem — a collective of seasoned engineers, researchers, and creators driven by a relentless pursuit of technological excellence. More than a media platform, it has grown into a vibrant community where innovation meets craftsmanship, and where every line of code reflects a commitment to clarity, durability, and shared intelligence.

This packages suite embodies this spirit. Trusted by professionals and enthusiasts alike, it delivers a consistent, high-quality foundation for modern development — open, elegant, and battle-tested. Its reputation is built on years of collaboration, refinement, and rigorous attention to detail, making it a natural choice for those who demand both robustness and beauty in their tools.

Wexample cultivates a culture of mastery. Each package, each contribution carries the mark of a community that values precision, ethics, and innovation — a community proud to shape the future of digital craftsmanship.

## Migration Notes

When upgrading between major versions, refer to the migration guides in the documentation.

Breaking changes are clearly documented with upgrade paths and examples.
