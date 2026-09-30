# Customization Guide — Agrovia

Learn how to customize the visual appearance, branding, and design tokens of your Agrovia website.

---

## 1. Theme Customizer Options

Access the native WordPress Customizer via **Appearance &rarr; Customize**. Agrovia provides focused controls that do not conflict with Elementor Site Settings:

### 1.1 Site Identity
- **Logo:** Upload your company logo (`240x80px` recommended). Supports Retina scaling and SVG vectors (via safe SVG plugins).
- **Site Title & Tagline:** Fully integrated with selective refresh for instant live preview updates.
- **Site Icon (Favicon):** Upload a `512x512px` square icon used for browser tabs and mobile bookmarks.

### 1.2 Header Options
- **Show Header CTA Button:** Toggle the prominent top-right call-to-action button on or off.
- **Header CTA Label:** Customize the button copy (Default: *"Contact"* or *"Visit Farm"*).
- **Header CTA URL:** Set the destination URL (e.g. `/contact` or `#visit`).

### 1.3 Footer Settings
- **Footer Tagline / Copyright:** Edit the copyright disclaimer displayed in the bottom footer bar across all classic views.

---

## 2. Design Tokens (`design/tokens.json`)

Agrovia uses a centralized, machine-readable design specification located at:
`design/tokens.json`

### 2.1 Color Palette
| Token Slug | Color Name | Hex Code | Semantic Role |
| :--- | :--- | :--- | :--- |
| `primary` | Deep Forest Green | `#18392B` | Main headings, brand anchors, primary CTA buttons |
| `secondary` | Dark Moss | `#2C4A36` | Subheadings, card badges, dark container backgrounds |
| `accent` | Muted Sage | `#9DAF95` | Botanical highlights, pill borders, secondary badges |
| `cream` | Warm Cream | `#F3EEDF` | Contrast callout panels, badge highlights |
| `earth` | Earth Brown | `#7A6048` | Metric labels, step indices, category tags |
| `sand` | Soft Sand | `#D8CBB7` | Neutral image frames and delicate borders |
| `background` | Off White | `#F8F7F2` | Organic body canvas background |
| `surface` | Surface White | `#FFFFFF` | Card containers, modals, form inputs |
| `text` | Charcoal | `#242724` | WCAG AAA compliant body text |

### 2.2 Typography Scale
- **Display Headings (`--agrovia-font-heading`):** `Cormorant Garamond, Georgia, serif`
- **Body & Interface (`--agrovia-font-body`):** `Inter, sans-serif`
- **Monospace (`--agrovia-font-mono`):** `ui-monospace, Menlo, Monaco, Consolas`

---

## 3. WordPress Block Editor (`theme.json`)

Non-Elementor pages and standard blog posts utilize the version 3 `theme.json` specification. It provides:
- Custom color palette matching the brand hexes.
- Fluid typography clamp scaling for headings H1–H6.
- Standardized 1280px content layout container.
- Quote, pullquote, code, and table styling styled to natural agricultural aesthetics.

---

## 4. Child Themes

If you plan to write custom PHP templates or hooks, use a child theme to safeguard your customizations from theme updates:

```text
agrovia-child/
├── style.css
└── functions.php
```

Example `agrovia-child/style.css`:
```css
/*
Theme Name: Agrovia Child
Template: agrovia
Version: 1.0.0
*/
```
