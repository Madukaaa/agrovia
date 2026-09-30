# Custom Elementor Widgets Reference — Agrovia

The **Agrovia Core** companion plugin registers 6 specialized widgets designed exclusively for sustainable agriculture, regenerative farming, and environmental storytelling. All widgets live under the **Agrovia Elements** category in the Elementor panel.

---

## 1. Agrovia Hero (`agrovia_hero`)

A cinematic hero section with glassmorphic badge, multiline headings, dual CTA buttons, and responsive background support.

### Controls:
- **Hero Content:**
  - `badge_text`: Upper pill text (e.g. `100% REGENERATIVE AGRICULTURE`).
  - `title`: Headline supporting multiline line-breaks (e.g. `Growing food.\nRestoring nature.`).
  - `title_tag`: Choose `H1`, `H2`, `H3`, or `div`.
  - `description`: Subordinate narrative copy explaining agricultural purpose.
- **Call to Action Buttons:**
  - `show_primary_btn`: Toggle filled primary button (Text, Link, Target, Nofollow).
  - `show_secondary_btn`: Toggle glassmorphic outline button.
- **Layout & Style:**
  - `min_height`: Responsive slider (`40vh` to `100vh`).
  - `content_align`: Left, Center, or Right.
  - `hero_background`: Background Image or Gradient.
  - `overlay_color`: Dark translucent overlay tint for text legibility.

---

## 2. Agrovia Impact Stats (`agrovia_stats`)

Grid of measurable sustainability metrics (e.g. acres farmed, water savings, trees planted, waste diverted).

### Controls:
- **Section Header:** Optional eyebrow badge and heading.
- **Stats Repeater:**
  - `number`: Metric figure (e.g. `2,500+`, `42%`, `18,000+`, `65%`).
  - `label`: Uppercase metric title (e.g. `ACRES FARMED`, `LESS WATER USED`).
  - `description`: Explanatory context for the metric.
- **Layout & Style:**
  - `columns`: Responsive grid selector (1 to 4 columns).
  - `gap`: Grid gap spacing.
  - `number_typography` & `number_color`: Deep forest or custom brand accent.
  - Card background & border styling.

---

## 3. Agrovia Approach Cards (`agrovia_approach_cards`)

Editorial showcase of the 4 sustainable agriculture pillars (Regenerative, Water Smart, Biodiversity, Circular).

### Controls:
- **Pillars Repeater:**
  - `card_number`: Index number (e.g. `01`, `02`, `03`, `04`).
  - `card_tag`: Category label (e.g. `SOIL HEALTH`, `WATER MANAGEMENT`).
  - `card_title`: Pillar title (e.g. `Regenerative`, `Water Smart`).
  - `card_desc`: Narrative paragraph describing the farming methodology.
  - `card_link`: URL and link label (`Explore Method →`).
- **Layout & Style:**
  - Responsive column selector (1 to 4 columns).
  - Subtle hover lift and border transition.

---

## 4. Agrovia Process Timeline (`agrovia_process_timeline`)

Visualizes the circular agricultural cycle: **Soil &rarr; Plant &rarr; Grow &rarr; Harvest &rarr; Restore**.

### Controls:
- **Timeline Steps Repeater:**
  - `step_number`: `01` through `05`.
  - `step_stage`: Stage badge (e.g. `SOIL`, `PLANT`, `GROW`, `HARVEST`, `RESTORE`).
  - `step_title`: Stage headline (e.g. `Healthy Soil`, `Precision Sowing`).
  - `step_desc`: Explanation of the stage's closed-loop role.
- **Layout & Style:**
  - Horizontal track on desktop transitioning to a clean vertical stack on mobile screens.
  - Custom badge background color, number accent, and card padding.

---

## 5. Agrovia Produce Grid (`agrovia_produce_grid`)

Editorial harvest showcase for farm produce with seasonality status and lazy-loaded image zoom effects.

### Controls:
- **Produce Repeater:**
  - `category`: Crop category (e.g. `HEIRLOOM GRAINS`, `LEAFY GREENS`, `VEGETABLES`, `HERBS`).
  - `title`: Product name (e.g. `Traditional Red Rice`, `Wild Agrovia Arugula`).
  - `season_badge`: Seasonality indicator (e.g. `Harvesting Now`, `Year-round`, `Summer Peak`).
  - `description`: Cultivation notes and flavor profile.
  - `image`: Produce photo.
  - `link`: Optional link to crop or shop details.
- **Layout & Style:**
  - Responsive grid columns (1 to 4).
  - 4:3 media container with smooth scale-up hover animation.

---

## 6. Agrovia Farmers & Team (`agrovia_team`)

Farmer, agronomist, and specialist showcase featuring **dual data sources**.

### Controls:
- **Data Source Selector:**
  - **Dynamic Query (CPT):** Automatically queries published profiles from the `agrovia_team` custom post type. Reads the member's photo, role, department taxonomy, and bio excerpt.
  - **Custom Repeater:** Allows manual drag-and-drop creation of team profiles with custom names, roles, departments, bios, and portraits.
- **Layout & Style:**
  - 1:1 square portrait aspect ratio with department pill overlay.
  - Responsive columns (1 to 4).
