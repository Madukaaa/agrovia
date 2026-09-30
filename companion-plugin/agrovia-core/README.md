# Agrovia Core — Companion Plugin

**Agrovia Core** is the companion functionality plugin for the **Agrovia** Sustainable Agriculture WordPress Theme.

In accordance with WordPress product engineering principles and the Commercial Theme Specification (`AI-THEME-SPEC.md`), all durable business functionality, custom post types, and custom Elementor widgets live in this companion plugin rather than the theme. This guarantees that customer data (such as Farm Practices and Farmer Profiles) survives any future theme changes.

---

## Features

- **Custom Post Types:**
  - `agrovia_practice`: Sustainable agricultural methods (Soil Health, Water Conservation, Renewable Energy, Biodiversity, Waste Reduction).
  - `agrovia_team`: Farmers, agronomists, soil specialists, and operations managers.
- **Taxonomies:**
  - `practice_category`: Categorizes sustainable farming methods.
  - `team_department`: Categorizes farmer and staff roles.
- **Elementor Integration:**
  - Registers the custom `agrovia-elements` category in Elementor (*"Agrovia Elements"*).
  - Ships 6 high-conversion, responsive Elementor widgets:
    1. **Agrovia Hero (`agrovia_hero`):** Cinematic agricultural banner with backdrop blur badges, multiline heading, supporting copy, and dual CTA buttons.
    2. **Agrovia Impact Stats (`agrovia_stats`):** Grid of measurable sustainability metrics (acres farmed, water saved, trees planted, waste reduction) with responsive columns.
    3. **Agrovia Approach Cards (`agrovia_approach_cards`):** Editorial 4-pillar showcase (Regenerative, Water Smart, Biodiversity, Circular) with hover lifts.
    4. **Agrovia Process Timeline (`agrovia_process_timeline`):** Visual closed-loop agricultural cycle from Soil to Harvest and Renewal.
    5. **Agrovia Produce Grid (`agrovia_produce_grid`):** Editorial harvest showcase with category badges, seasonality pills, and lazy-loaded imagery.
    6. **Agrovia Farmers & Team (`agrovia_team`):** Dynamic team showcase supporting both dynamic querying from `agrovia_team` CPT and manual repeater mode.
- **Dedicated Asset Enqueueing:**
  - Encapsulated `assets/css/widgets.css` loaded strictly when Elementor is active on the frontend or within the live editor.
- **Graceful Degradation:**
  - Runs cleanly without errors if Elementor is absent or deactivated.

---

## Requirements

- **PHP:** 7.4+
- **WordPress:** 6.0+
- **Elementor:** 3.5+ (Recommended for visual editing)
