# Elementor Website Kit Manifest — Agrovia

This manifest records the technical specification and test parameters of the **Agrovia Sustainable Agriculture Demo Kit**.

---

## 1. Kit Metadata

- **Kit Name:** Agrovia Sustainable Agriculture Demo Kit
- **Kit Slug:** `agrovia-demo`
- **Kit Version:** 1.0.0
- **Theme Version:** Agrovia 1.0.0
- **Companion Plugin:** Agrovia Core 1.0.0
- **Elementor Tested:** 3.20.0+
- **Elementor Pro Tested:** 3.20.0+ (Optional; native PHP theme fallbacks render automatically if Pro is absent)
- **WooCommerce Tested:** 8.5.0+
- **WordPress Core:** 6.0 – 6.7
- **PHP Version:** 7.4 – 8.2
- **Specification Date:** 2026-10-01

---

## 2. Included Templates (Theme Builder)

1. **Header (`templates/header.json`):**
   - Translucent glassmorphism over hero, sticky navigation container, primary logo, accessible navigation walker, and "Visit Farm" CTA button.
2. **Footer (`templates/footer.json`):**
   - Four-column dark forest footer (`#18392B`) with brand mission, farming pillars menu, harvest links, contact details, newsletter signup, and copyright notice.
3. **Single Post (`templates/single-post.json`):**
   - Editorial reading width (860px max), category and read-time badges, featured image with zoom, author bio card, and comments block.
4. **Archive & Journal (`templates/archive.json`):**
   - 3-column responsive post loop with numeric pagination and category filter tags.
5. **404 Error (`templates/404.json`):**
   - Minimalist agricultural recovery page with recovery search form and home link.
6. **Single Product (`templates/single-product.json`):**
   - 2-column store layout (gallery slider + purchase card) with tabbed product data and related crops loop.

---

## 3. Included Pages & Content

1. **Home (`/home`):**
   - Full narrative flow: Hero &rarr; Impact Stats &rarr; 4 Pillars (Approach Cards) &rarr; Process Timeline &rarr; Produce Showcase &rarr; Farmer Profiles &rarr; Final CTA.
2. **About Our Mission (`/about`):**
   - Origin story, ecological philosophy, mission, vision, and core leadership.
3. **Our Farm & Ecosystem (`/our-farm`):**
   - Farmland zones, soil testing laboratory, solar power array, and biodiversity corridors.
4. **Sustainable Practices (`/sustainability`):**
   - Detailed modules covering the 5 pillars: Soil Health, Water Conservation, Renewable Energy, Biodiversity, and Circular Waste Reduction.
5. **Fresh Harvest & Produce (`/products`):**
   - Categorized crops (Heirloom Grains, Greens, Vegetables, Herbs) with seasonality status.
6. **Environmental Impact Report (`/impact`):**
   - Transparent metrics: topsoil organic carbon gain (+3.4%), water saved (12.8M Liters), clean solar energy.
7. **Farm Journal (`/journal`):**
   - WordPress CMS blog stream sharing farming breakthroughs and seasonal reports.
8. **Contact & Visit (`/contact`):**
   - Inquiry channels for farm tours, wholesale partnerships, and general contact.

---

## 4. Media & Licensing Notes

All demo assets conform to the commercial redistribution guidelines in `AI-THEME-SPEC.md`:
- Zero copyrighted third-party stock photos.
- All photography references open CC0/Unsplash agricultural collections or dynamic local SVG placeholders.
- Media items can be safely substituted via the WordPress Media Library upon import.

---

## 5. Import & Compatibility Notes

1. If Elementor Pro is inactive, the standalone theme automatically uses its built-in PHP templates (`header.php`, `footer.php`, `single.php`, `archive.php`, `404.php`) with 100% feature parity.
2. If WooCommerce is inactive, store templates and widgets gracefully stay dormant without producing errors.
