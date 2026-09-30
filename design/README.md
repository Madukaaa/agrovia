# Agrovia Design Tokens & System Architecture

This directory contains the machine-readable design specification for the **Agrovia** theme, its companion plugin, and Elementor website kits.

In accordance with section 72 of `AI-THEME-SPEC.md`, `tokens.json` serves as the **single source of truth** across all theme layers.

---

## 1. Single Source of Truth Hierarchy

```text
tokens.json (Canonical Engineering Contract)
     │
     ├── theme.json (WordPress Gutenberg & Global Block Styles)
     ├── style.css & assets/css/*.css (CSS Custom Properties :root)
     ├── companion-plugin/agrovia-core/assets/css/widgets.css (Widget Design Tokens)
     └── Elementor Global Settings (--e-global-color-* / --e-global-typography-*)
```

---

## 2. Token Registry

### 2.1 Palette Summary
- **Deep Forest Green (`#18392B`)**: Primary brand color for hero titles, major buttons, and strong visual anchors.
- **Dark Moss (`#2C4A36`)**: Secondary brand accent for hover states, badges, and dark surfaces.
- **Muted Sage (`#9DAF95`)**: Subtle botanical accent for pill borders and delicate highlights.
- **Warm Cream (`#F3EEDF`)**: Warm organic backdrop for callouts and badges.
- **Earth Brown (`#7A6048`)**: Natural soil tone for step numbers, category badges, and metric labels.
- **Soft Sand (`#D8CBB7`)**: Neutral for image frames and separators.
- **Off White (`#F8F7F2`)**: Default page background ensuring pleasant readability.
- **Charcoal (`#242724`)**: High-contrast body text adhering to WCAG AAA contrast ratios.

### 2.2 Typography Roles
- **Display / Headings:** `Cormorant Garamond, Georgia, serif` (Editorial, timeless, agricultural gravitas).
- **Body / Interface:** `Inter, sans-serif` (Legible, modern, responsive).
- **Monospace:** `ui-monospace, Menlo, Monaco, Consolas` (For agricultural data metrics & codes).

---

## 3. Maintenance Policy

When updating design values (such as container widths, typography scale, or brand color hues):
1. Update `design/tokens.json`.
2. Sync the corresponding values in `style.css` (`:root` block) and `theme.json`.
3. Verify that Elementor Global Mappings (`--e-global-*`) in `assets/css/components.css` remain synchronized.
4. Verify companion plugin widgets in `companion-plugin/agrovia-core/assets/css/widgets.css`.
