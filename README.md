# Agrovia — Sustainable Agriculture WordPress Theme

**Agrovia** is a modern, standalone WordPress theme engineered specifically for sustainable agriculture, regenerative farming, soil health stewardship, water conservation, and agricultural technology enterprises.

Designed and developed to adhere strictly to the **Commercial WordPress + Elementor Theme Specification** (`AI-THEME-SPEC.md`), Agrovia functions independently as a classic/hybrid-ready WordPress theme while providing deep integration hooks for Elementor and WooCommerce.

---

## 1. Brand Identity & Purpose

- **Brand Name:** Agrovia
- **Tagline:** *Growing food. Restoring nature.*
- **Core Pillars:**
  - Regenerative Soil Management
  - Precision Water Conservation
  - Biodiversity & Native Habitats
  - Clean Renewable Energy
  - Agricultural Technology & IoT Monitoring
  - Circular Economy & Waste Reduction

---

## 2. Technical Architecture

Agrovia is engineered in distinct, clean layers:

1. **Theme Presentation Layer (Agrovia Theme):**
   - Pure standalone theme (zero parent-theme dependencies).
   - Semantic HTML5 template hierarchy and dynamic WordPress content loops.
   - Clean accessibility foundations (skip link, keyboard focus, ARIA navigation).
   - Elementor Theme Builder location registration with graceful native fallbacks.
   - Native WooCommerce integration with zero fragile template overrides.
   - Strict WordPress security standards (escaping, sanitization, nonces, capability checks).

2. **Visual Kit Layer (Elementor Website Kit):**
   - Global typography tokens and HSL/Hex natural color palette.
   - Editorial homepage, about, farm practices, products, impact report, and contact layouts.

3. **Companion Functionality Layer (Companion Plugin):**
   - Custom Elementor widgets and optional post types kept decoupled from presentation code.

---

## 3. Directory Layout

```text
agrovia/
├── style.css               # Theme headers and baseline styling
├── functions.php           # Modular orchestrator
├── index.php               # Ultimate fallback template
├── header.php              # Header shell with Elementor fallback
├── footer.php              # Footer shell with Elementor fallback
├── screenshot.png          # Visual preview
├── README.md               # Theme documentation
├── CHANGELOG.md            # Release log
├── LICENSE.md              # GPL-2.0-or-later license
├── .gitignore              # VCS ignore rules
├── inc/                    # Modular theme logic
│   ├── setup.php           # Theme supports, image sizes, content width
│   ├── enqueue.php         # Styles, scripts, and font loading
│   ├── template-functions.php # Body classes, helpers
│   ├── template-tags.php   # Dynamic metadata, author, date, thumbnails
│   ├── menus.php           # Menu registration and walk handlers
│   ├── widgets.php         # Widget area registration
│   ├── elementor.php       # Theme Builder locations & compatibility
│   ├── woocommerce.php     # WC theme support & wrapper hooks
│   ├── accessibility.php   # Skip links & a11y utilities
│   └── compatibility.php   # WordPress/PHP version safeguards
├── template-parts/         # Modular template parts
│   ├── content.php         # Standard article card fallback
│   ├── content-none.php    # Empty state / 404 message
│   └── pagination.php      # Accessible numeric pagination
└── assets/                 # Enqueued assets
    ├── css/                # Base, components, utilities, editor
    ├── js/                 # Navigation and micro-interactions
    └── images/             # Theme graphical assets
```

---

## 4. Requirements

- **WordPress:** 6.0+ (Tested up to 6.7)
- **PHP:** 7.4+ (Tested on PHP 8.2)
- **Optional Integrations:** Elementor, Elementor Pro, WooCommerce

---

## 5. Documentation Suite

Exhaustive guides and manuals are provided in the `documentation/` folder:

- **[Installation Guide](documentation/installation.md):** Setup instructions and hosting environment verification.
- **[Customization Guide](documentation/customization.md):** Theme Customizer, design tokens, and `theme.json` configuration.
- **[Elementor Guide](documentation/elementor.md):** Theme Builder locations and Website Kit import.
- **[Widgets Reference](documentation/widgets.md):** Complete guide to all 6 companion Elementor widgets.
- **[WooCommerce Guide](documentation/woocommerce.md):** Store integration and performance isolation.
- **[Troubleshooting & FAQ](documentation/troubleshooting.md):** Solutions for common setup and hosting queries.
- **[Hooks & API Reference](documentation/hooks-reference.md):** Action hooks, filter hooks, and helper functions.
- **[QA Acceptance Checklist](documentation/qa-checklist.md):** Full testing sign-off matrix.
- **[Third-Party Asset Inventory](documentation/third-party-licenses.md):** Redistribution licenses for fonts and graphics.

---

## 6. Release Packages

Production-ready release archives are generated in the `release/` directory:

- **`agrovia.zip`**: Clean standalone theme archive (install via **Appearance > Themes > Upload Theme**).
- **`agrovia-core.zip`**: Standalone companion plugin (install via **Plugins > Add New > Upload Plugin**).
- **`agrovia-demo-kit.zip`**: Elementor Website Kit package with 8 narrative pages and Theme Builder templates.
- **`agrovia-complete-package-v1.0.0.zip`**: Master distribution archive containing all packages and documentation.

To run automated checks and build releases:
```bash
npm test                  # Run 59 automated static checks across 8 suites
npm run package:release   # Build and verify all 4 production release archives
```

---

## 7. License

Agrovia is licensed under the [GNU General Public License v2 or later](LICENSE.md).

