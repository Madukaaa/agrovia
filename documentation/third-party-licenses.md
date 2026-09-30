# Third-Party Dependencies and License Inventory

**Project:** Agrovia WordPress Theme & Agrovia Core Companion Plugin  
**Version:** 1.0.0  
**License:** GNU General Public License v2.0 or later (GPL-2.0-or-later)  

Before commercial distribution, all third-party software, fonts, icons, and assets utilized in Agrovia have been audited for redistribution rights, license compatibility, and proper attribution.

---

## 1. Typography & Fonts

### Cormorant Garamond
- **Designer / Foundry:** Christian Thalmann (Catharsis Fonts)
- **License:** SIL Open Font License, Version 1.1 (OFL-1.1)
- **Source:** [Google Fonts - Cormorant Garamond](https://fonts.google.com/specimen/Cormorant+Garamond)
- **Modifications:** None. Enqueued dynamically from Google Fonts CDN with `preconnect` resource hints.
- **Redistribution Rights:** Free for commercial and non-commercial use, modification, and redistribution under OFL-1.1 terms.

### Inter
- **Designer / Foundry:** Rasmus Andersson
- **License:** SIL Open Font License, Version 1.1 (OFL-1.1)
- **Source:** [Google Fonts - Inter](https://fonts.google.com/specimen/Inter)
- **Modifications:** None. Enqueued dynamically from Google Fonts CDN with `preconnect` resource hints.
- **Redistribution Rights:** Free for commercial and non-commercial use, modification, and redistribution under OFL-1.1 terms.

---

## 2. Software Architecture & Frameworks

### WordPress Core
- **Author:** WordPress Foundation
- **License:** GNU General Public License v2.0 or later (GPL-2.0-or-later)
- **Usage:** Core CMS architecture, template hierarchy, Customizer API, Theme JSON API, and hooks.
- **Compatibility:** 100% compliant.

### Elementor Core & Pro APIs
- **Author:** Elementor Ltd.
- **License:** GNU General Public License v3.0 or later (GPL-3.0-or-later)
- **Usage:** Custom widget registration via `\Elementor\Widget_Base` and Theme Builder locations via `elementor/theme/register_locations`.
- **Compatibility:** GPL compatible; safe condition checks prevent runtime errors when Elementor is inactive.

### WooCommerce APIs
- **Author:** Automattic Inc.
- **License:** GNU General Public License v3.0 or later (GPL-3.0-or-later)
- **Usage:** Standard theme wrappers (`woocommerce_before_main_content`, `woocommerce_after_main_content`), loop filters, and mini-cart fragments.
- **Compatibility:** GPL compatible; safe condition checks prevent runtime errors when WooCommerce is inactive.

---

## 3. JavaScript & Styling Assets

### Vanilla Navigation Script (`assets/js/navigation.js`)
- **Author:** Maduka Karunathilake
- **License:** GPL-2.0-or-later
- **External Dependencies:** Zero (pure native DOM APIs).

### Theme Interactions Script (`assets/js/main.js`)
- **Author:** Maduka Karunathilake
- **License:** GPL-2.0-or-later
- **External Dependencies:** Zero (pure native DOM APIs, IntersectionObserver).

### Customizer Previewer (`assets/js/customizer.js`)
- **Author:** Maduka Karunathilake
- **License:** GPL-2.0-or-later
- **External Dependencies:** WordPress Customizer API (`wp.customize`).

---

## 4. Icons and Graphical Assets

### Agricultural SVG Icons
- **Author:** Maduka Karunathilake / Feather & Lucide Inspired
- **License:** MIT License / GPL-2.0-or-later
- **Usage:** Inline SVG vectors in Elementor widgets, search forms, and pagination arrows.
- **Redistribution Rights:** Completely free for commercial distribution.

### Theme Screenshot & Demo Media
- **Author:** Maduka Karunathilake / Unsplash (Unsplash License - Free commercial use)
- **Usage:** `screenshot.png` and demo kit preview references.
- **License:** Unsplash License / CC0 Public Domain.
- **Redistribution Rights:** Free commercial usage, no mandatory attribution required.
