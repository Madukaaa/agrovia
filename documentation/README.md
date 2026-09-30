# Agrovia Theme & Ecosystem Documentation

Welcome to the official developer and site builder documentation for **Agrovia** — a modern, standalone WordPress theme engineered for sustainable agriculture, regenerative farming, and agri-tech brands.

---

## Documentation Guide

| Document | Purpose |
| :--- | :--- |
| **[Installation & Setup](installation.md)** | Requirements, theme & companion plugin installation, and quick start guide. |
| **[Customization Guide](customization.md)** | Theme Customizer options, design tokens (`tokens.json`), and `theme.json` typography/colors. |
| **[Elementor Integration](elementor.md)** | Theme Builder locations, Global Colors/Fonts sync, and Website Kit import procedure. |
| **[Custom Widgets Reference](widgets.md)** | Comprehensive manual for all 6 companion Elementor widgets (`agrovia-core`). |
| **[WooCommerce Store Guide](woocommerce.md)** | Configuring product archives, gallery sliders, AJAX mini-cart, and store styling. |
| **[Troubleshooting & FAQ](troubleshooting.md)** | Solutions for common setup questions, memory limits, permalinks, and debugging. |
| **[Hooks & Developer API](hooks-reference.md)** | Exhaustive reference of theme actions, filters, and template override hooks. |
| **[QA Checklist & Sign-Off](qa-checklist.md)** | Full verification matrix and audit sign-off covering core, security, and a11y. |
| **[Third-Party Asset Inventory](third-party-licenses.md)** | Audited licenses and attribution details for typography, libraries, and graphics. |

---

## Product Architecture Summary

Agrovia operates in three distinct, decoupled layers:

1. **Theme Presentation Layer (`agrovia` theme):**
   - Standalone classic/hybrid WordPress theme (zero dependencies on parent themes like Astra or Hello).
   - Semantic HTML5 template hierarchy with accessible skip-links, ARIA landmarks, and `:focus-visible` styling.
   - Built-in Theme Builder location fallback routines when Elementor Pro is absent.
   - Zero-override native WooCommerce integration.

2. **Companion Functionality Layer (`agrovia-core` plugin):**
   - Retains durable business data: Custom Post Types (`agrovia_practice`, `agrovia_team`) and Taxonomies (`practice_category`, `team_department`).
   - Registers and enqueues custom Elementor widgets under the *Agrovia Elements* category.
   - Ensures customer content survives any future theme changes.

3. **Visual Experience Layer (Elementor Website Kit):**
   - Centralized Design System (Global Colors, Global Typography, Theme Style).
   - High-conversion narrative templates and pages designed specifically for sustainable agriculture storytelling.
