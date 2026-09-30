# Agrovia Demo Kit — Import & Deployment Guide

This package contains the **Elementor Website Kit** for the **Agrovia** Sustainable Agriculture WordPress Theme.

---

## 1. Prerequisites

Before importing this kit, ensure the following are installed and activated on your WordPress site:

1. **Agrovia WordPress Theme** (Active theme)
2. **Agrovia Core Companion Plugin** (Activated — registers `agrovia_practice`, `agrovia_team`, and custom Elementor widgets)
3. **Elementor** (v3.5.0 or higher)
4. *(Optional)* **Elementor Pro** (For Theme Builder location overrides; if absent, the theme's native semantic PHP fallbacks run automatically)
5. *(Optional)* **WooCommerce** (Required only if selling agricultural produce online)

---

## 2. Kit Directory Structure

```text
kits/agrovia-demo/
├── README.md               # This deployment guide
├── MANIFEST.md             # Complete build & environment manifest
├── manifest.json           # Machine-readable Elementor Kit schema
├── site-settings.json      # Global Colors, Global Fonts & Theme Style settings
├── demo-content.json       # Pages, sections, and widget configuration
└── templates/              # Theme Builder template specifications
    ├── header.json         # Global header
    ├── footer.json         # Global 4-column footer
    ├── single-post.json    # Journal article layout
    ├── archive.json        # Blog / category archive loop
    ├── 404.json            # Agricultural 404 error page
    └── single-product.json # WooCommerce crop details layout
```

---

## 3. How to Import via Elementor

1. In your WordPress admin dashboard, navigate to **Elementor &rarr; Tools &rarr; Import / Export Kit**.
2. Click **Start Import**.
3. Upload the packaged kit or select the `kits/agrovia-demo/` manifest.
4. Select the components you want to import:
   - **Site Settings** (Global Colors, Global Fonts, Theme Style)
   - **Templates** (Header, Footer, Single, Archive, 404)
   - **Content** (Home, About, Our Farm, Sustainability, Products, Impact, Journal, Contact)
5. Click **Next** and allow Elementor to complete the import routine.

---

## 4. Post-Import Verification Checklist

- [ ] **Front Page:** Check **Settings &rarr; Reading** and verify that "A static page" is selected with "Home" as the Homepage and "Journal" as the Posts page.
- [ ] **Permalinks:** Go to **Settings &rarr; Permalinks** and ensure "Post name" is selected. Click **Save Changes** to flush rewrite rules.
- [ ] **Menus:** Under **Appearance &rarr; Menus**, ensure the primary menu is assigned to the "Primary Navigation" theme location.
- [ ] **Customizer Identity:** In **Appearance &rarr; Customize &rarr; Site Identity**, verify site title and logo display.
