# Elementor Integration Guide — Agrovia

Learn how Agrovia integrates with Elementor Core and Elementor Pro to deliver a visual editing workflow without compromising performance or clean code standards.

---

## 1. Architectural Philosophy

Agrovia approaches Elementor with strict separation of concerns:
- **Theme Responsibility:** The theme maintains the foundational HTML document skeleton (`<!doctype html>`, `<head>`, `<?php wp_head(); ?>`, `<body>`, `<div id="page">`, and `<?php wp_footer(); ?>`).
- **Elementor Responsibility:** Elementor renders the page contents or Theme Builder visual parts without disrupting the document lifecycle.
- **Fail-Safe Fallbacks:** If Elementor or Elementor Pro is deactivated, Agrovia automatically renders semantic, accessible PHP fallbacks for headers, footers, single posts, and archives.

---

## 2. Theme Builder Locations

Agrovia registers support for Elementor Pro Theme Builder locations:
- `header`
- `footer`
- `single`
- `archive`

The theme executes locations via `agrovia_elementor_do_location()`:
```php
if ( ! agrovia_elementor_do_location( 'header' ) ) {
    get_template_part( 'template-parts/header/site' );
}
```

If an Elementor Pro Header template is published with display condition `Entire Site`, Elementor renders that template. If no Elementor template matches the page, Agrovia renders `template-parts/header/site.php`.

---

## 3. Page Templates

When creating or editing a page in WordPress, you can select from three page layout templates:

1. **Default Template (`page.php`):**
   - Displays the theme header, a boxed content container (`1280px`), entry title, page content, and theme footer.
2. **Elementor Full Width (`elementor_header_footer`):**
   - Retains the site header and footer, but removes the boxed content container so you can build edge-to-edge, full-width sections in Elementor.
3. **Elementor Canvas (`elementor_canvas`):**
   - Removes both the header and footer for dedicated landing pages, squeeze funnels, or standalone campaign pages.

---

## 4. Global Site Settings & Token Sync

Agrovia automatically maps Elementor's Global CSS variables to the Agrovia design tokens:

```css
:root {
    --e-global-color-primary: var(--agrovia-color-primary);     /* #18392B */
    --e-global-color-secondary: var(--agrovia-color-secondary); /* #2C4A36 */
    --e-global-color-text: var(--agrovia-color-text);           /* #242724 */
    --e-global-color-accent: var(--agrovia-color-accent);       /* #9DAF95 */
    --e-global-typography-primary-font-family: var(--agrovia-font-heading);
    --e-global-typography-text-font-family: var(--agrovia-font-body);
}
```

This guarantees that any native Elementor widget (headings, text, buttons) matches the Agrovia design palette automatically upon placement.

---

## 5. Importing the Agrovia Website Kit

The theme ships with an Elementor Website Kit specification in:
`kits/agrovia-demo/`

### Import Procedure:
1. Ensure **Elementor** and **Agrovia Core** are active.
2. Navigate to **Elementor &rarr; Tools &rarr; Import / Export Kit**.
3. Click **Start Import** and upload the kit file or folder.
4. Select the templates, site settings, and pages you wish to import.
5. Click **Next** to finalize the import.
