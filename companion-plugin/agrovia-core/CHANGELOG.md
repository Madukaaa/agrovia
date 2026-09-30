# Changelog — Agrovia Core

All notable changes to the **Agrovia Core** companion plugin will be documented in this file.

## [1.0.0] - 2026-10-01

### Added
- **Phase 8: Companion Plugin Foundation**
  - Modular plugin architecture with Singleton lifecycle coordinator (`Agrovia_Core`).
  - System requirement checks in `Agrovia_Core_Compatibility` (PHP 7.4+, WP 6.0+).
  - Sustainable Farm Practice CPT (`agrovia_practice`) with `practice_category` taxonomy.
  - Farmers & Team CPT (`agrovia_team`) with `team_department` taxonomy.
  - Custom Elementor widget category `agrovia-elements` with leaf icon.
  - Activation and deactivation rewrite rule flush handlers.
  - Translatable text domain `agrovia-core`.
- **Phase 9: Custom Elementor Widgets**
  - Implemented `Agrovia_Hero_Widget` (`agrovia_hero`): High-conversion agricultural hero with multiline headlines, backdrop blur badges, and dual primary/secondary action buttons.
  - Implemented `Agrovia_Stats_Widget` (`agrovia_stats`): Impact statistics counter grid (Acres Farmed, Less Water Used, Trees Planted, Less Agri Waste) with responsive layout controls.
  - Implemented `Agrovia_Approach_Cards_Widget` (`agrovia_approach_cards`): Four-pillar regenerative farming framework with subtle hover lifts and link arrows.
  - Implemented `Agrovia_Process_Timeline_Widget` (`agrovia_process_timeline`): 5-stage closed-loop agriculture cycle (Soil, Plant, Grow, Harvest, Restore).
  - Implemented `Agrovia_Produce_Grid_Widget` (`agrovia_produce_grid`): Editorial crops showcase with seasonality badges and image zoom effects.
  - Implemented `Agrovia_Team_Widget` (`agrovia_team`): Farmers & agronomists showcase with dual source mode (dynamic query from `agrovia_team` CPT or manual repeater).
  - Wired modern Elementor widget registration in `Agrovia_Core_Elementor_Manager::register_widgets()`.
- **Phase 12: Accessibility + Security Hardening**
  - Added secure Member Role meta box to `Agrovia_Team_CPT` (`class-team-cpt.php`) with CSRF nonce verification (`agrovia_team_meta_save`), autosave checking, capability checks (`edit_post`), and input sanitization (`sanitize_text_field`).
  - Audited late output escaping in all 6 Elementor widgets and verified strict type casting on repeater loop indices.

