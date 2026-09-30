=== Agrovia Core ===
Contributors: madukakarunathilake
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: agrovia, agriculture, elementor-widgets, custom-post-types, farming, sustainability

Companion plugin providing custom post types and Elementor widgets for the Agrovia WordPress Theme.

== Description ==

Agrovia Core provides essential agricultural functionality and Elementor page-builder widgets for the Agrovia WordPress Theme:

* **Agricultural Post Types**:
  - `agrovia_practice`: Regenerative and sustainable farm practices with department/category taxonomy.
  - `agrovia_team`: Agronomists, researchers, farm leads, and sustainability directors with role metadata and department taxonomy.

* **Custom Elementor Widgets**:
  1. **Agrovia Hero**: Editorial split hero with badges, metrics, and dual CTAs.
  2. **Agrovia Stats**: Animated stat counters with agricultural icons and context badges.
  3. **Agrovia Approach Cards**: 3-column sustainable agriculture methodology cards.
  4. **Agrovia Process Timeline**: 4-step farm-to-table seasonal harvest timeline.
  5. **Agrovia Produce Grid**: Seasonal crops, harvest indicators, and organic certifications.
  6. **Agrovia Team Grid**: Dual-source team presentation (dynamic CPT query or manual repeater).

== Installation ==

1. Upload the `agrovia-core` directory to the `/wp-content/plugins/` directory, or upload the `agrovia-core.zip` via **Plugins > Add New > Upload Plugin**.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Ensure the Agrovia WordPress theme is active for optimal visual styling.

== Frequently Asked Questions ==

= Does Agrovia Core work with other themes? =
Agrovia Core is built specifically to accompany the Agrovia theme, but the Custom Post Types (`agrovia_practice` and `agrovia_team`) and Elementor widgets can function independently with any modern theme.

= Are custom Elementor widgets available if Elementor is inactive? =
No. The Elementor widgets are conditionally loaded only when Elementor is active to prevent fatal errors and optimize system performance.

== Changelog ==

= 1.0.0 =
* Initial release of Agrovia Core companion plugin.
* Added Farm Practices and Team custom post types with taxonomies.
* Added 6 custom Elementor widgets in the 'agrovia-elements' category.
* Integrated secure Member Role meta box with nonce verification.
* Provided isolated widget styles and translation catalog.

== Copyright ==

Agrovia Core WordPress Plugin, Copyright 2026 Maduka Karunathilake.
Agrovia Core is distributed under the terms of the GNU GPL version 2 or later.
