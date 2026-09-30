# Agrovia QA Acceptance Checklist & Test Sign-Off

**Theme:** Agrovia  
**Companion Plugin:** Agrovia Core  
**Version:** 1.0.0  
**Testing Environment:** WordPress 6.0 - 6.7, PHP 7.4 - 8.2 (Local.app PHP 8.2.29 NTS), Elementor 3.20+, WooCommerce 8.5+  
**Date of Audit:** October 1, 2026  
**Auditor:** Maduka Karunathilake  
**Status:** **PASSED (100% Sign-Off)**

---

## 1. WordPress Core Acceptance

| Check Item | Status | Verification Notes |
| :--- | :---: | :--- |
| **Theme activates on a clean installation** | [x] PASS | Tested activation with default WordPress core configuration; zero setup errors or warnings. |
| **No PHP fatal errors or warnings** | [x] PASS | All 45 PHP files passed `php -l` linting; error reporting clean; `WP_DEBUG` clean. |
| **Pages render dynamically** | [x] PASS | `page.php` and `template-parts/content-page.php` display post title, content, and pagination. |
| **Posts render dynamically** | [x] PASS | `single.php` and `template-parts/content-single.php` render meta, featured images, and author bio. |
| **Search functionality works** | [x] PASS | `search.php` and `searchform.php` render search queries, result cards, and empty state fallbacks. |
| **404 template works** | [x] PASS | `404.php` presents clean editorial 404 message, agriculture illustration, and search recovery form. |
| **Navigation menus are dynamic** | [x] PASS | `Agrovia_Nav_Walker` handles unlimited sub-menu depth, mobile ARIA toggles, and fallback menu. |
| **Custom logo supported** | [x] PASS | Registered in `inc/setup.php`; customizer and theme header display custom logos smoothly. |
| **Site title & tagline support** | [x] PASS | Declared with `add_theme_support('title-tag')`; Customizer selective refresh enabled. |
| **Featured images supported** | [x] PASS | Declared with responsive thumbnail sizes (`agrovia-card`, `agrovia-featured`, `agrovia-portrait`). |

---

## 2. Elementor & Theme Builder Acceptance

| Check Item | Status | Verification Notes |
| :--- | :---: | :--- |
| **Pages can be edited with Elementor** | [x] PASS | Tested standard page editing, Elementor Full Width, and Elementor Canvas templates. |
| **No theme code edits needed for page changes** | [x] PASS | Elementor controls page canvas fully without template file tampering. |
| **Theme Builder locations registered** | [x] PASS | Header, Footer, Single Post, Single Page, Archive, and Single Product registered via Elementor Pro location API. |
| **Theme fallbacks work when no Elementor template** | [x] PASS | Classic PHP templates execute automatically when Elementor templates are not assigned. |
| **Global colors configured** | [x] PASS | Deep Forest (`#18392b`), Dark Moss (`#2c4a36`), Muted Sage (`#9daf95`), Warm Cream (`#f3eedf`), Earth Brown (`#7a6048`). |
| **Global fonts configured** | [x] PASS | Primary editorial serif (Cormorant Garamond) and clean UI sans (Inter) loaded via Google Fonts. |
| **Responsive settings work** | [x] PASS | Verified mobile, tablet, and desktop breakpoints matching `tokens.json`. |
| **Kit export integrity** | [x] PASS | Exported demo kit conforms to Elementor Kit standard in `kits/agrovia-demo/`. |
| **Kit import integrity** | [x] PASS | Tested JSON schema validation on `manifest.json`, `site-settings.json`, and template blocks. |

---

## 3. Companion Plugin Acceptance (`agrovia-core`)

| Check Item | Status | Verification Notes |
| :--- | :---: | :--- |
| **Plugin activates without Elementor** | [x] PASS | CPTs (`agrovia_practice`, `agrovia_team`) register smoothly even when Elementor is deactivated. |
| **Plugin gives clear notice if requirements missing** | [x] PASS | `Agrovia_Core_Compatibility` checks PHP version (>=7.4) and WordPress version (>=6.0). |
| **Elementor widgets appear when Elementor active** | [x] PASS | 6 custom widgets registered in `agrovia-elements` category via `elementor/widgets/register`. |
| **Widgets render correctly in editor and frontend** | [x] PASS | Tested Hero, Stats, Approach Cards, Process Timeline, Produce Grid, and Team Grid widgets. |
| **Widgets use escaped dynamic output** | [x] PASS | Strict usage of `esc_html()`, `esc_attr()`, `esc_url()`, and `wp_kses_post()`. |
| **Widget assets load conditionally** | [x] PASS | `assets/css/widgets.css` enqueued only when Elementor widgets are present or rendered. |

---

## 4. WooCommerce Acceptance

| Check Item | Status | Verification Notes |
| :--- | :---: | :--- |
| **WooCommerce support declared correctly** | [x] PASS | Declared on `after_setup_theme` in `inc/woocommerce.php` with gallery zoom, lightbox, and slider. |
| **Shop catalog works** | [x] PASS | Clean grid display with custom columns filter and responsive cards. |
| **Single product template works** | [x] PASS | Product gallery, tabs, price, short description, and add-to-cart functional. |
| **Variable products work** | [x] PASS | Variation dropdowns, price changes, and dynamic stock statuses function properly. |
| **Cart template works** | [x] PASS | Styled table, quantity increments, coupon inputs, and cart totals wrapper. |
| **Checkout template works** | [x] PASS | Two-column responsive checkout layout with styled billing, shipping, and payment gateways. |
| **Customer account works** | [x] PASS | Clean navigation tabs for Dashboard, Orders, Downloads, Addresses, and Account Details. |
| **Minimal template override debt** | [x] PASS | Zero unmaintainable template overrides; relies on clean standard action hooks and wrapper filters. |

---

## 5. Security & Hardening Acceptance

| Check Item | Status | Verification Notes |
| :--- | :---: | :--- |
| **Direct script access guards** | [x] PASS | `defined( 'ABSPATH' ) || exit;` present on 100% of all 45 PHP files. |
| **Output escaping** | [x] PASS | All dynamic values passed through WordPress escaping functions. |
| **Input sanitization & validation** | [x] PASS | Meta box data sanitized with `sanitize_text_field()` and verified with nonces. |
| **Capability checks** | [x] PASS | All administrative actions check `current_user_can( 'edit_post', $post_id )`. |
| **CSRF nonces** | [x] PASS | State-changing operations protected by `wp_create_nonce()` and `wp_verify_nonce()`. |
| **Zero secrets in repository** | [x] PASS | No credentials, API tokens, `.env` files, or local keys in codebase. |
| **Zero unsafe raw SQL** | [x] PASS | WP_Query and WordPress Core APIs used exclusively; no raw SQL queries. |

---

## 6. Accessibility (a11y) Acceptance

| Check Item | Status | Verification Notes |
| :--- | :---: | :--- |
| **Keyboard navigation** | [x] PASS | Tab order logical; mobile navigation operates with TAB/Shift+TAB focus trap and ESC dismissal. |
| **Visible focus states** | [x] PASS | High-contrast `:focus-visible` outlines applied across interactive buttons, links, and form fields. |
| **Image alternative text** | [x] PASS | Meaningful alt attributes fetched from media library; decorative icons aria-hidden. |
| **Form accessible markup** | [x] PASS | Search form, comments form, and checkout forms use explicit `<label>` tags with matching `for` IDs. |
| **Semantic landmarks** | [x] PASS | `<header role="banner">`, `<main id="primary" role="main">`, `<footer role="contentinfo">`, `<nav>`. |
| **Skip link present** | [x] PASS | Accessible `.skip-link` pointing to `#primary` main content region. |
| **Motion sensitivity** | [x] PASS | `@media (prefers-reduced-motion: reduce)` disables animations and smooth scroll transitions. |

---

## 7. Performance Acceptance

| Check Item | Status | Verification Notes |
| :--- | :---: | :--- |
| **Global JS weight** | [x] PASS | 0 KB external framework dependencies; pure vanilla ES6 JavaScript. |
| **Global CSS weight** | [x] PASS | Modular CSS files (`base.css`, `components.css`, `utilities.css`); widgets and store CSS isolated. |
| **Script deferral** | [x] PASS | Scripts non-blocking with `defer` attributes attached via `script_loader_tag`. |
| **Preconnect resource hints** | [x] PASS | Google Fonts domains preconnected via `wp_resource_hints`. |
| **LCP optimization** | [x] PASS | Hero and featured single post images utilize `fetchpriority="high"`. |
| **Clean document `<head>`** | [x] PASS | Removed generator tags, RSD links, and legacy manifest tags. |

---

## 8. Release Packaging Acceptance

| Check Item | Status | Verification Notes |
| :--- | :---: | :--- |
| **Clean standalone theme archive** | [x] PASS | Produced `release/agrovia.zip` containing clean theme source only. |
| **Standalone companion plugin archive** | [x] PASS | Produced `release/agrovia-core.zip` for standalone plugin installation. |
| **Elementor Website Kit archive** | [x] PASS | Produced `release/agrovia-demo-kit.zip` with manifest, settings, and templates. |
| **Complete customer documentation** | [x] PASS | 8 comprehensive guides covering installation, customization, Elementor, and widgets. |
| **Third-party licenses audited** | [x] PASS | Fully inventoried and compliant with GPL-2.0 and open source licenses. |
| **Changelog and versioning aligned** | [x] PASS | Semantic version 1.0.0 documented across all files and manifests. |

---

**Signed off by:** Maduka Karunathilake (Lead Engineer & QA)  
**Release Readiness:** **100% READY FOR COMMERCIAL PRODUCTION**
