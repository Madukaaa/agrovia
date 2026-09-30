# Professional WordPress + Elementor Commercial Theme — Master Build Specification

**Document purpose:** This is a master implementation specification for an AI coding agent (for example, Antigravity) to build a production-ready, commercially distributable WordPress theme without relying on GeneratePress or another parent theme.

**Primary goal:** Build a reusable, standalone WordPress classic theme that:

- works as a normal WordPress theme even when Elementor is not active;
- provides excellent Elementor editing support;
- supports Elementor Theme Builder locations where available;
- ships with an Elementor Website Kit containing the visual system, templates, pages, and demo content;
- optionally ships with a companion plugin containing custom post types, Elementor widgets, integrations, and non-design functionality;
- supports WooCommerce cleanly and upgrade-safely;
- is secure, accessible, responsive, performant, translatable, maintainable, and documented;
- is designed as a product that customers can customize without editing theme files;
- has a clean Git-based development and release workflow;
- can be reused to create multiple niche themes/demos from the same engineering foundation.

**Important architecture rule:** Do not use GeneratePress, Astra, Hello, Kadence, or any other parent theme as a runtime dependency for the final commercial theme. The theme must be a standalone theme. Elementor may be an optional/recommended integration dependency, but the theme itself must remain a valid WordPress theme.

**Current-source policy:** Implementation details must be checked against current official WordPress, Elementor, and WooCommerce developer documentation before release. Do not hard-code obsolete APIs merely because an old tutorial uses them.

---

## 1. Product Architecture

The product consists of three separate layers.

```text
COMMERCIAL PRODUCT
│
├── 1. THEME ZIP
│   ├── WordPress presentation layer
│   ├── Templates and fallbacks
│   ├── Navigation
│   ├── Branding
│   ├── Layout foundations
│   ├── Accessibility
│   ├── Performance
│   ├── Elementor compatibility
│   └── WooCommerce compatibility
│
├── 2. ELEMENTOR WEBSITE KIT
│   ├── Global colors
│   ├── Global fonts
│   ├── Theme Style
│   ├── Header template
│   ├── Footer template
│   ├── Single/Page templates
│   ├── Archive templates
│   ├── WooCommerce templates where applicable
│   ├── Reusable blocks/templates
│   ├── Demo pages
│   ├── Demo posts
│   └── Demo content/media where licensed
│
└── 3. COMPANION PLUGIN
    ├── Custom Elementor widgets
    ├── Custom post types (only when needed)
    ├── Taxonomies
    ├── Integrations
    ├── Small product-specific features
    └── Optional premium functionality
```

### Ownership rules

**Theme owns presentation infrastructure:**

- template hierarchy;
- semantic page shell;
- header/footer fallbacks;
- menu registration;
- site identity support;
- widget areas where required;
- asset loading;
- design-system fallbacks;
- WordPress compatibility;
- WooCommerce theme integration;
- Elementor theme-location integration;
- accessibility and performance foundations.

**Elementor Kit owns visual page composition:**

- hero sections;
- marketing sections;
- visual layouts;
- global colors and fonts;
- Elementor Theme Builder designs;
- page templates;
- archive/single visual designs;
- visual WooCommerce layouts where supported.

**Companion plugin owns functionality:**

- custom post types;
- custom taxonomies;
- custom Elementor widgets;
- product-specific integrations;
- non-presentation business logic.

Do not put functionality into the theme merely because the functionality is convenient to code there. A user should be able to change themes without losing their business content or data.

---

## 2. Target User Experience

The customer must be able to install the product and perform normal site-building tasks without opening PHP files.

### Required customer workflow

```text
Install WordPress
   ↓
Install theme
   ↓
Install Elementor (and Elementor Pro only if the kit/features require Pro)
   ↓
Install / activate companion plugin if used
   ↓
Import Website Kit
   ↓
Customize global colors and fonts
   ↓
Upload logo / favicon
   ↓
Create pages
   ↓
Edit pages with Elementor
   ↓
Create / edit navigation menus
   ↓
Publish
```

### The customer must be able to

- create a new page from WordPress;
- edit that page in Elementor;
- add/remove/reorder sections and containers;
- change text and images;
- change global colors;
- change global fonts;
- change the logo;
- change navigation items without code;
- create nested navigation;
- create a blog post;
- create categories/tags;
- customize header/footer through Elementor where the required Elementor features are licensed;
- manage WooCommerce products without editing templates;
- disable optional components without breaking the site.

---

# 3. Standalone Theme Requirements

## 3.1 Theme fundamentals

Build a standalone classic/hybrid-friendly WordPress theme.

Minimum baseline capabilities:

- valid `style.css` theme header;
- `functions.php` bootstrap;
- `index.php` fallback;
- template hierarchy support;
- proper enqueueing of CSS/JS;
- translation-ready strings;
- custom logo support;
- title-tag support;
- post thumbnails;
- HTML5 support where appropriate;
- navigation menu locations;
- editor styles as appropriate;
- Elementor integration hooks;
- WooCommerce support when enabled;
- clean template parts;
- no parent theme dependency.

### Avoid

- giant `functions.php` files;
- hardcoded navigation URLs;
- hardcoded page names;
- hardcoded demo content in PHP templates;
- inline `<script>`/`<style>` unless there is a specific justified reason;
- direct database queries when a WordPress API exists;
- editing WordPress core/plugin files;
- copying large amounts of third-party code without license review;
- unnecessary custom admin frameworks;
- theme-level business logic that should live in a plugin.

---

## 4. Recommended Theme File Architecture

Use a modular structure similar to the following and adapt it only when there is a justified reason.

```text
mytheme/
│
├── style.css
├── functions.php
├── index.php
├── front-page.php
├── home.php
├── page.php
├── singular.php
├── single.php
├── archive.php
├── search.php
├── 404.php
├── comments.php
├── header.php
├── footer.php
├── sidebar.php
├── screenshot.png
├── theme.json
├── README.md
├── CHANGELOG.md
├── LICENSE.md
├── .gitignore
├── package.json
├── phpcs.xml.dist
├── phpstan.neon.dist              # optional, if static analysis is used
│
├── inc/
│   ├── bootstrap.php
│   ├── setup.php
│   ├── enqueue.php
│   ├── menus.php
│   ├── widgets.php
│   ├── customizer.php             # only if theme-specific controls are needed
│   ├── template-functions.php
│   ├── template-tags.php
│   ├── elementor.php
│   ├── woocommerce.php
│   ├── accessibility.php
│   └── compatibility.php
│
├── template-parts/
│   ├── content.php
│   ├── content-page.php
│   ├── content-single.php
│   ├── content-search.php
│   ├── content-none.php
│   ├── post-meta.php
│   └── pagination.php
│
├── assets/
│   ├── css/
│   │   ├── base.css
│   │   ├── components.css
│   │   ├── utilities.css
│   │   └── editor.css
│   ├── js/
│   │   ├── main.js
│   │   ├── navigation.js
│   │   └── components.js
│   ├── images/
│   └── icons/
│
├── languages/
│
└── woocommerce/
    ├── archive-product.php        # only when really needed
    ├── single-product.php         # only when really needed
    └── ...                        # keep overrides minimal
```

### `functions.php` rule

Keep `functions.php` as a loader/orchestrator, not a dumping ground.

Example conceptual structure:

```php
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/menus.php';
require_once get_template_directory() . '/inc/elementor.php';
require_once get_template_directory() . '/inc/woocommerce.php';
```

Use a consistent namespace/prefix throughout the project.

Recommended placeholder prefix:

```text
mytheme_
MYTHEME_
```

For a final commercial product, replace this with a unique, product-specific prefix.

---

# 5. Template Hierarchy and Dynamic Content

The theme must respect the WordPress template hierarchy instead of treating each page as a custom hardcoded PHP document.

Key templates to understand and support:

```text
front-page.php     → site front page
home.php           → posts index
page.php           → standard page fallback
single.php         → standard post fallback
archive.php        → generic archive fallback
search.php         → search results
404.php            → not found
index.php          → final fallback
```

Use WordPress's template hierarchy and template tags rather than hardcoding page-specific HTML.

### Core rule

Pages should normally render stored WordPress/Elementor content through the standard content pipeline.

Example:

```php
<?php
while ( have_posts() ) :
    the_post();

    the_content();
endwhile;
```

Do not replace this with static page markup such as:

```php
<h1>About our company</h1>
<p>We started in 2020...</p>
```

### Why

This keeps page content editable in WordPress and Elementor while the theme controls the surrounding presentation and fallbacks.

---

# 6. Navigation System

Navigation must be fully managed by WordPress.

Register menu locations:

```php
function mytheme_register_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'mytheme' ),
            'footer'  => __( 'Footer Menu', 'mytheme' ),
        )
    );
}
add_action( 'after_setup_theme', 'mytheme_register_menus' );
```

Render menus dynamically:

```php
wp_nav_menu(
    array(
        'theme_location' => 'primary',
        'container'      => 'nav',
        'container_class'=> 'site-navigation',
        'menu_class'     => 'primary-menu',
        'fallback_cb'    => false,
    )
);
```

### Required navigation behaviors

- desktop navigation;
- mobile navigation;
- dropdown/submenu support;
- keyboard operation;
- visible focus state;
- current/ancestor item state;
- no hardcoded URLs;
- graceful no-menu state;
- optional Elementor header replacement;
- support long labels;
- no assumptions about menu item count.

### Important

A customer adding a new WordPress page must be able to add it to the site's menu from WordPress admin without modifying PHP.

---

# 7. Site Identity and Branding

Support WordPress site identity and custom logo APIs instead of hardcoded branding.

Required branding sources:

- custom logo;
- site title;
- site tagline where used;
- favicon/site icon through WordPress site identity;
- optional footer copyright text from a user-editable setting if needed.

Do not hardcode a company name into the theme runtime.

---

# 8. Elementor Compatibility Architecture

## 8.1 Elementor is an integration layer, not the theme itself

The theme must remain functional without Elementor.

When Elementor is active:

- allow Elementor to render page content through the normal content pipeline;
- register Elementor theme locations;
- detect Elementor safely;
- provide theme fallbacks when no Elementor template exists;
- avoid loading Elementor-specific classes before Elementor is initialized;
- avoid fatal errors when Elementor is absent or inactive.

## 8.2 Register Elementor Theme Locations

Use Elementor's current Theme Locations API.

Core locations to consider:

- header;
- footer;
- single;
- archive.

Typical registration pattern:

```php
function mytheme_register_elementor_locations( $manager ) {
    $manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'mytheme_register_elementor_locations' );
```

Alternatively register only the locations actually supported.

## 8.3 Render Elementor locations with safe fallbacks

Conceptual pattern:

```php
if (
    function_exists( 'elementor_theme_do_location' ) &&
    elementor_theme_do_location( 'header' )
) {
    // Elementor rendered the header.
} else {
    get_template_part( 'template-parts/header/site' );
}
```

Use the corresponding pattern for footer, single, and archive where appropriate.

### Expected behavior

```text
Request Header
   ↓
Does Elementor provide a matching header?
   ├─ YES → render Elementor header
   └─ NO  → render theme header fallback
```

Do not force Elementor to be present merely to display the site.

---

# 9. Elementor Free vs Elementor Pro

Document the product's dependency policy clearly.

### Tier A — Elementor-compatible theme

Works with Elementor core for page editing.

### Tier B — Elementor Pro-ready theme/kit

Uses Elementor Pro Theme Builder features such as global site-part templates where required.

If a demo kit depends on Elementor Pro-only features, the documentation must state that requirement clearly.

Never bundle or redistribute an Elementor Pro license as though it were your own product license.

### Recommended product wording

```text
Theme: standalone WordPress theme
Elementor: required/recommended for visual editing
Elementor Pro: required only for features/templates explicitly marked Pro
Companion Plugin: free/premium according to product package
```

---

# 10. Elementor Website Kit Architecture

The Website Kit is a separate deliverable from the theme.

Elementor's current import/export tooling can carry templates, content, site settings, and related configuration. Therefore treat the kit as a configured site package, not as a replacement for the theme's codebase.

## 10.1 Kit contents

At minimum, create:

### Site Settings

- global colors;
- global fonts;
- typography/theme style;
- global layout defaults;
- button styling;
- form styling;
- image styling;
- breakpoint decisions;
- lightbox/background settings only when necessary.

### Theme Builder templates

- Header;
- Footer;
- Single Page;
- Single Post;
- Archive;
- Search;
- 404;
- WooCommerce Product;
- WooCommerce Product Archive;
- additional templates only when useful.

### Pages

- Home;
- About;
- Services;
- Portfolio/Projects;
- Pricing if relevant;
- Contact;
- Blog;
- FAQ;
- optional legal pages.

### Reusable components

- buttons;
- cards;
- feature blocks;
- CTA blocks;
- testimonial cards;
- team cards;
- logo grid;
- breadcrumbs where required;
- pagination;
- announcement bar if part of the design.

## 10.2 Kit rules

- no copyrighted stock media unless the license allows redistribution;
- use replaceable demo content;
- avoid hardcoding a real customer's information;
- use global colors instead of manual color values everywhere;
- use global typography styles instead of one-off font settings;
- minimize absolute positioning;
- prefer responsive containers/flex/grid;
- keep sections reusable;
- use consistent spacing tokens.

---

# 11. Global Design System: Colors

Use a coordinated design token system.

### Canonical palette

Use a semantic palette instead of random values.

Example starter system:

| Token | Purpose | Example |
|---|---|---|
| Primary | brand / major CTA | `#111111` |
| Secondary | supporting brand tone | `#2B2B2B` |
| Accent | highlight / interactive | `#C6FF00` |
| Text | body text | `#4B5563` |
| Background | primary surface | `#FFFFFF` |
| Surface | cards / secondary surface | `#F5F5F5` |
| Border | dividers | `#E5E7EB` |
| Success | success states | `#16803C` |
| Warning | warnings | `#B7791F` |
| Error | errors | `#B42318` |
| Info | informational state | `#175CD3` |

These are starter values. The final niche theme may use a different palette.

### Color rules

- define semantic names;
- use the semantic token in Elementor Global Colors;
- mirror the same system in `theme.json` where appropriate for WordPress/block/editor fallback styling;
- use CSS custom properties for theme-owned styles;
- do not duplicate raw hex values throughout CSS;
- do not make each component invent its own color;
- ensure text/background contrast is acceptable;
- preserve visible hover/focus/active/disabled states.

### CSS variable convention

```css
:root {
    --mytheme-color-primary: #111111;
    --mytheme-color-secondary: #2b2b2b;
    --mytheme-color-accent: #c6ff00;
    --mytheme-color-text: #4b5563;
    --mytheme-color-background: #ffffff;
    --mytheme-color-surface: #f5f5f5;
    --mytheme-color-border: #e5e7eb;
}
```

The values should match the design token specification and the Elementor Kit.

---

# 12. Global Design System: Typography

Define semantic font roles.

Recommended role system:

| Token | Purpose | Example |
|---|---|---|
| Heading | H1–H6 / major display | Inter / 700 |
| Body | paragraphs and normal UI text | Inter / 400 |
| Label | small UI labels | Inter / 600 |
| Button | CTA typography | Inter / 600 |
| Display | optional large hero type | Inter / 700 or brand font |

### Typography rules

- define a finite type scale;
- avoid dozens of one-off font sizes;
- define desktop/tablet/mobile values deliberately;
- use a suitable line-height for each role;
- avoid excessive letter-spacing;
- use local/custom web fonts only when licensing allows;
- avoid remote font dependencies when self-hosting is appropriate and licensed;
- ensure fallback fonts exist.

Example type scale:

```text
Display XL  72 / 1.00 / 700
Display L   56 / 1.05 / 700
H1          48 / 1.10 / 700
H2          40 / 1.15 / 700
H3          32 / 1.20 / 700
H4          24 / 1.25 / 600
Body L      20 / 1.60 / 400
Body        16 / 1.60 / 400
Body S      14 / 1.50 / 400
Caption     12 / 1.40 / 500
```

Adjust these to the product UI.

### Elementor mapping

Configure Elementor Global Fonts so that:

- Primary = main heading/display font;
- Secondary = supporting heading font;
- Text = body font;
- Accent = label/button/special text font where useful.

Elementor's current Site Settings provide centralized Global Fonts and Global Colors. Use them as the primary editable design-system UI for Elementor users.

---

# 13. `theme.json` Design-System Strategy

Use `theme.json` as a modern WordPress global-settings/styles layer and fallback system.

It should:

- define a controlled color palette;
- define typography defaults where useful;
- define spacing/layout settings where useful;
- limit unwanted UI options if the product needs tighter consistency;
- provide good styling for non-Elementor WordPress content;
- not fight Elementor's Site Settings.

### One source-of-truth rule

The design token specification is the canonical design contract.

```text
DESIGN TOKENS
     ├── Elementor Global Colors / Fonts
     ├── Elementor Theme Style
     ├── CSS custom properties
     └── theme.json defaults
```

Do not create contradictory systems such as:

```text
Elementor says Accent = green
CSS says Accent = red
Theme.json says Accent = blue
```

When the product is intended primarily for Elementor users, Elementor Site Settings should be the main user-facing visual editor, while `theme.json` provides WordPress/editor defaults and fallback consistency.

---

# 14. Layout System

Define a consistent layout system before creating pages.

## Container

Starter specification:

```text
Max content width: 1200–1280px
Wide content width: 1440px where required
Desktop side padding: 32–48px
Tablet side padding: 24–32px
Mobile side padding: 16–20px
```

## Spacing scale

Use a token scale rather than random margins.

Example:

```text
4   = xs
8   = sm
12  = sm-plus
16  = md
24  = lg
32  = xl
48  = 2xl
64  = 3xl
80  = 4xl
96  = 5xl
128 = 6xl
```

Use CSS variables for theme-owned spacing and equivalent Elementor spacing conventions.

## Border radius

Example:

```text
Small: 6px
Medium: 10px
Large: 16px
Pill: 999px
```

Use intentionally rather than applying a different radius to every element.

---

# 15. Responsive UI Specification

Build mobile-first or mobile-safe layouts.

Recommended baseline breakpoints for this product specification:

```text
Mobile: 0–767px
Tablet: 768–1023px
Desktop: 1024px+
Wide: 1440px+ when needed
```

Do not assume these are the only breakpoints supported by Elementor. Validate the actual Elementor breakpoint configuration used by the kit.

### Responsive rules

Every Elementor template and custom widget must be reviewed at:

- 375px;
- 390px;
- 430px;
- 768px;
- 1024px;
- 1280px;
- 1440px;
- larger desktop where applicable.

### Mobile requirements

- no horizontal scrolling;
- touch targets large enough for comfortable use;
- mobile navigation works with keyboard and screen readers where applicable;
- cards collapse gracefully;
- typography does not overflow;
- buttons wrap or stack when necessary;
- images preserve aspect ratio;
- decorative animation can be reduced/disabled.

---

# 16. UI/Visual Product Specification

The first reference UI should be a premium modern agency/creative/technology theme suitable for later niche adaptations.

## Visual direction

```text
Style:
Premium / modern / editorial / creative-tech

Base:
Clean neutral background
Strong contrast
Large typography
Large media
Generous whitespace
Subtle borders
Controlled rounded corners
Micro-interactions
Minimal visual noise
```

## Header UI

Desktop:

```text
┌────────────────────────────────────────────────────────────┐
│ LOGO        Work   Services   About   Journal       CTA    │
└────────────────────────────────────────────────────────────┘
```

Requirements:

- logo area;
- WordPress menu;
- optional CTA link;
- sticky behavior optional;
- mobile drawer/menu;
- visible focus states;
- optional transparent/overlay variant for hero pages.

## Hero

```text
┌────────────────────────────────────────────────────────────┐
│ Eyebrow                                                     │
│                                                            │
│ LARGE HEADLINE                                              │
│ Supporting paragraph                                       │
│ [Primary CTA] [Secondary CTA]                              │
│                                                            │
│ Large visual / video / image                               │
└────────────────────────────────────────────────────────────┘
```

## Standard section pattern

```text
Section label
Large H2
Short supporting copy

[Cards / media / content]
```

## Service cards

Each card:

```text
01
Service title
Short description
→ Explore
```

## Portfolio/project card

```text
Large image
Category
Project name
Short descriptor
```

## CTA section

```text
Strong statement
Short support copy
[CTA]
```

## Footer

```text
┌────────────────────────────────────────────────────────────┐
│ LOGO                                                       │
│ Large closing statement                                   │
│                                                           │
│ Sitemap       Social       Contact                        │
│                                                           │
│ © YEAR BRAND                              Legal / Privacy │
└────────────────────────────────────────────────────────────┘
```

### Visual quality rules

- use a consistent type hierarchy;
- do not overuse animations;
- avoid excessive shadows;
- use whitespace as a primary design tool;
- keep content widths controlled;
- use consistent image aspect ratios;
- use a deliberate hover state for interactive cards and buttons;
- maintain clear focus states even when the visual design is minimal.

---

# 17. Elementor Template Inventory

Create a complete starter kit where relevant.

## Global templates

```text
Header – Default
Header – Transparent
Footer – Default
Single Page – Default
Single Post – Default
Archive – Default
Search Results – Default
404 – Default
```

## WooCommerce templates

```text
Product Archive
Single Product
Cart-related template parts only if Elementor workflow requires them
Checkout-related styling only when supported and tested
My Account styling where applicable
```

Do not create templates merely to increase file count. Every template must have a clear reason.

## Page templates

```text
Home
About
Services
Work / Portfolio
Contact
Blog
FAQ
Pricing (optional)
```

---

# 18. Companion Plugin Architecture

Use a separate plugin for Elementor widgets and functionality that should survive theme changes.

Recommended structure:

```text
mytheme-elements/
│
├── mytheme-elements.php
├── uninstall.php                 # only when data cleanup is explicitly defined
├── readme.txt
├── README.md
├── CHANGELOG.md
│
├── includes/
│   ├── class-plugin.php
│   ├── class-compatibility.php
│   ├── class-loader.php
│   ├── post-types/
│   ├── taxonomies/
│   └── integrations/
│
├── widgets/
│   ├── class-hero-widget.php
│   ├── class-services-widget.php
│   ├── class-team-widget.php
│   ├── class-portfolio-widget.php
│   └── class-testimonial-widget.php
│
├── assets/
│   ├── css/
│   └── js/
│
└── languages/
```

### Plugin startup rules

- check required PHP version;
- check Elementor availability before registering Elementor-specific classes;
- check minimum Elementor version if required;
- fail gracefully with an admin notice rather than fatal-erroring;
- load components conditionally;
- do not load widget classes when Elementor is unavailable;
- do not load unnecessary assets globally.

Conceptual compatibility check:

```php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! did_action( 'elementor/loaded' ) ) {
    // Do not initialize Elementor integration yet.
}
```

Implement the final compatibility logic using current Elementor developer guidance.

---

# 19. Custom Elementor Widgets

Widgets should live in the companion plugin, not the theme, so they survive a theme change.

## Widget groups

Create a product-specific category such as:

```text
MyTheme Elements
```

Example widgets:

```text
Hero
Advanced Heading
Services Grid
Portfolio Grid
Team Grid
Testimonials
Pricing Table
Logo Grid
Stats / Counters
Timeline
Marquee
CTA Banner
```

Do not rebuild generic Elementor widgets merely for branding. Build widgets when they solve a real recurring design or functionality problem.

## Widget implementation requirements

Each widget must have:

- unique widget slug;
- class name with product prefix;
- control sections;
- content controls;
- style controls;
- responsive controls where necessary;
- sensible defaults;
- editor preview;
- front-end rendering;
- accessibility-conscious markup;
- escaped dynamic output;
- conditional asset loading where possible;
- no unnecessary JavaScript;
- translation-ready strings.

### Registration

Use Elementor's current widget registration hook:

```php
add_action( 'elementor/widgets/register', 'mytheme_elements_register_widgets' );
```

The registration function should load only the widget classes that are required.

### Widget markup rule

Prefer semantic output.

Bad:

```html
<div class="widget-1">
    <div class="title">...</div>
</div>
```

Better where semantically appropriate:

```html
<section class="mytheme-services" aria-labelledby="services-title">
    <h2 id="services-title">Services</h2>
    ...
</section>
```

### Widget security

Treat every control value as untrusted input. Escape output according to context.

Examples:

```php
echo esc_html( $title );
echo esc_url( $link['url'] );
echo esc_attr( $class_name );
```

Use `wp_kses_post()` only when HTML is intentionally allowed and the allowed markup is appropriate.

---

# 20. Widget Performance

A custom widget must not automatically enqueue a huge JavaScript bundle just because it exists.

Requirements:

- register assets properly;
- load scripts/styles only when needed where practical;
- prefer CSS over JS for simple visual behavior;
- avoid animation libraries unless required;
- avoid duplicate libraries that Elementor already provides;
- never enqueue jQuery merely out of habit;
- test editor and frontend behavior separately.

For Elementor-specific asset registration, use current Elementor APIs and best practices.

---

# 21. WooCommerce Integration

The theme must be WooCommerce-aware without becoming tightly coupled to its internals.

Declare theme support using the correct WordPress hook:

```php
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
```

## Store UI requirements

```text
Shop
Product archive
Single product
Product images
Gallery
Price
Sale badge
Stock state
Quantity
Add to cart
Variation selector
Cart
Checkout
My Account
```

## WooCommerce architecture rule

Prefer WooCommerce hooks and filters before template overrides.

Only create `/woocommerce/` overrides when a structural markup change is actually necessary.

### Upgrade-safe overrides

If a template must be overridden:

```text
wp-content/plugins/woocommerce/templates/...
           ↓ copy
wp-content/themes/mytheme/woocommerce/...
```

Then track the override version and test after WooCommerce updates.

### Important override rule

Avoid excessive overrides. Every override creates maintenance responsibility.

### Elementor + WooCommerce

Where the commercial package uses Elementor Pro WooCommerce templates, document the required Pro features and use Elementor templates for visual customization where possible.

---

# 22. WordPress Security Specification

Security is a release requirement, not a later enhancement.

## 22.1 Principle

```text
Never trust data.
Validate where possible.
Sanitize stored input.
Escape output late.
Check capabilities.
Use nonces for state-changing requests.
Use WordPress APIs.
Avoid raw SQL when an API exists.
```

## 22.2 Output escaping

Choose the escape function based on output context.

```php
echo esc_html( $text );
echo esc_attr( $attribute );
echo esc_url( $url );
```

For intentionally supported HTML, use an appropriate allowlist/sanitization mechanism.

## 22.3 Input handling

For settings/forms/admin inputs:

- sanitize text;
- sanitize textarea content appropriately;
- validate enums against a known list;
- validate integers/ranges;
- validate URLs;
- reject invalid values where practical;
- never assume database values are safe merely because WordPress stored them.

## 22.4 Nonces

For AJAX/admin state changes:

```php
check_admin_referer( 'mytheme_action' );
```

For AJAX, use the correct current nonce pattern and verify it server-side.

A nonce is not a replacement for authorization.

## 22.5 Capability checks

Before administrative operations:

```php
if ( ! current_user_can( 'manage_options' ) ) {
    return;
}
```

Use the least-privilege capability that actually matches the action.

## 22.6 Direct access protection

For PHP files that can be directly loaded:

```php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
```

## 22.7 Database

Prefer:

- WordPress APIs;
- `WP_Query`;
- settings APIs;
- metadata APIs;
- REST APIs where appropriate.

When `$wpdb` is required, use prepared statements.

## 22.8 File uploads

Do not implement custom upload systems unless there is a strong reason.

Use WordPress media APIs and permissions.

## 22.9 Remote requests

For third-party requests:

- validate URLs/domains;
- use WordPress HTTP APIs;
- handle timeouts/errors;
- do not trust response content blindly;
- do not expose secrets in frontend code.

## 22.10 Secrets

Never commit:

```text
API keys
passwords
private tokens
production database credentials
license secrets
```

Use `.env` only for local tooling when the specific application actually supports it; never assume PHP runtime automatically reads `.env`.

## 22.11 Custom code execution

Do not create arbitrary PHP/code execution settings for customers as a convenience feature.

---

# 23. WordPress Coding Standards

Follow current WordPress PHP, HTML, CSS, JavaScript, and accessibility conventions wherever practical.

Requirements:

- meaningful names;
- consistent prefix/namespace;
- short functions with one responsibility;
- PHPDoc where useful;
- no dead code;
- no duplicated logic when a helper is justified;
- no global variables unless required by a WordPress API;
- use hooks/filters instead of editing core behavior directly;
- maintain backwards compatibility within declared support ranges.

---

# 24. Internationalization (i18n)

All user-facing strings in PHP/JS should be translation-ready.

Examples:

```php
e__( 'Read More', 'mytheme' );
esc_html__( 'Read More', 'mytheme' );
esc_attr__( 'Close menu', 'mytheme' );
```

Use the product's correct text domain consistently.

Do not hardcode customer-specific copy into theme code.

Elementor widget strings should also be translation-ready.

---

# 25. Accessibility Specification

Accessibility must be designed into the components.

## Required

- semantic HTML;
- logical heading hierarchy;
- keyboard navigation;
- visible focus states;
- accessible labels;
- alt text from WordPress media data where appropriate;
- buttons used for actions;
- links used for navigation;
- appropriate ARIA only when necessary;
- form error visibility;
- modal/menu focus handling when custom JS is required;
- respect reduced-motion preferences where animation is significant.

### Avoid

```text
Clickable divs
Missing button labels
Icon-only buttons without accessible names
Keyboard traps
Invisible focus
Low contrast text
Animation that cannot be reduced
```

Test with keyboard-only navigation and a screen reader where practical.

---

# 26. Performance Specification

Performance is part of theme quality.

## Theme rules

- enqueue assets correctly;
- avoid loading unnecessary CSS/JS on every page;
- keep bundles small;
- avoid duplicate libraries;
- use responsive images through WordPress;
- avoid giant unoptimized demo images;
- lazy-load non-critical images where appropriate;
- reserve dimensions to reduce layout shift;
- avoid render-blocking assets where practical;
- keep third-party scripts to a minimum;
- avoid autoplay video backgrounds unless carefully justified;
- keep DOM complexity reasonable.

## Elementor rules

- use containers efficiently;
- avoid deeply nested containers;
- avoid unnecessary motion effects;
- avoid placing huge inline custom CSS in every widget;
- use global styles;
- build reusable components;
- test frontend output after optimization.

## Measurement

Test with tools such as:

- Lighthouse;
- PageSpeed Insights;
- browser performance tools;
- WebPageTest where appropriate.

Do not claim a performance score in marketing material unless the test configuration is documented.

---

# 27. JavaScript Architecture

Use JavaScript only where the interaction requires it.

Typical theme JS:

```text
navigation.js
menu toggle
submenu interactions
focus management
sticky behavior where necessary
```

Typical plugin/widget JS:

```text
carousel
filters
interactive counters
custom widget interactions
```

Requirements:

- no inline event-handler attributes;
- defensive initialization;
- no console errors in production;
- support Elementor editor preview where the widget requires reinitialization;
- avoid duplicate initialization;
- destroy/reinitialize sliders or observers safely.

---

# 28. CSS Architecture

Recommended layers:

```text
assets/css/
│
├── base.css
├── components.css
├── utilities.css
└── editor.css
```

### Base

- reset/normalization only as required;
- body;
- typography;
- links;
- images;
- forms.

### Components

- buttons;
- cards;
- navigation;
- tables;
- alerts;
- pagination;
- comments.

### Utilities

Keep utilities minimal and purposeful.

### Naming

Choose one maintainable naming convention such as BEM-inspired classes or a consistent product prefix.

Do not create meaningless classes such as `.box1`, `.section2`, `.thing-blue`.

---

# 29. Elementor + Theme CSS Boundary

This distinction is critical.

### Theme CSS should handle

- WordPress fallback templates;
- navigation fallback;
- typography defaults;
- forms outside Elementor;
- comments;
- pagination;
- generic content;
- WooCommerce fallback styling;
- accessible focus states;
- foundational layout behavior.

### Elementor should handle

- page-specific layouts;
- marketing sections;
- global Elementor visual design;
- Elementor template-specific spacing;
- Elementor widget-specific styles.

Do not write massive CSS selectors intended to fight Elementor's generated markup.

Do not rely on brittle selectors such as:

```css
.elementor-element:nth-child(7) .elementor-widget-container { ... }
```

Prefer stable classes, global design settings, semantic structures, and widget-specific classes.

---

# 30. Customizer Strategy

Use the Customizer only for settings that genuinely belong to the theme.

Good candidates:

- simple theme branding settings;
- legacy/classic theme options;
- settings not already provided by Elementor or WordPress.

Do not build a giant customizer that duplicates Elementor Site Settings.

When Elementor is the main visual editor, let Elementor own detailed visual customization.

---

# 31. WordPress Widgets / Sidebars

Register widget areas only where they have a clear purpose.

Examples:

```text
Primary Sidebar
Footer Column 1
Footer Column 2
Footer Column 3
```

Use dynamic widget areas with `dynamic_sidebar()` rather than hardcoding their output.

If the design is entirely Elementor-based, keep legacy widget areas only for compatibility/fallback use.

---

# 32. Content Modeling

If the design includes repeated structured data, decide whether it should be:

1. normal WordPress content;
2. Elementor template data;
3. a custom post type in the companion plugin;
4. WooCommerce data;
5. a taxonomy/metadata structure.

Example:

```text
Portfolio projects → custom post type in plugin
Services → normal pages or structured Elementor sections unless querying/filtering is required
Products → WooCommerce
Team members → custom post type only if reusable/queryable
Testimonials → custom post type only if reused/queryable
```

Do not create custom post types merely because you can.

---

# 33. Theme and Plugin Dependency Matrix

Document the supported combinations.

Example:

| Component | Required | Notes |
|---|---|---|
| WordPress | Yes | Test against supported current releases |
| PHP | Yes | Declare and test minimum + current versions |
| Theme | Yes | Standalone |
| Elementor | Depends on package | Required for visual editing |
| Elementor Pro | Optional/feature-dependent | Required for Pro-only Theme Builder/advanced features |
| Companion Plugin | Optional/package-dependent | Required for custom widgets/data features |
| WooCommerce | Optional/package-dependent | Required for store features |

Never claim compatibility without testing it.

---

# 34. Version and Compatibility Strategy

Define minimum supported versions for your product.

Example product metadata:

```text
Theme Version: 1.0.0
Minimum WordPress: <set after testing>
Minimum PHP: <set after testing>
Minimum Elementor: <set after testing>
Minimum Elementor Pro: <only if needed>
Minimum WooCommerce: <set after testing>
```

Do not blindly copy outdated minimum versions from tutorials.

Before every release, verify the product against current supported environments.

---

# 35. Graceful Degradation

The site must fail gracefully.

### Elementor missing

- WordPress pages still render;
- theme fallback header/footer render;
- no fatal error;
- admin notice may explain how to enable Elementor if the product expects it.

### Companion plugin missing

- base theme remains functional;
- areas depending on custom post types/widgets show graceful fallbacks;
- no fatal errors;
- documentation explains the dependency.

### WooCommerce missing

- normal content pages work;
- WooCommerce-specific files/hooks do not execute unnecessarily;
- no fatal errors.

---

# 36. Error Handling and Debugging

During development, enable WordPress debugging in the local environment.

Recommended development configuration:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

Use the project's appropriate local/staging configuration rather than shipping development debugging settings into production.

Check:

```text
wp-content/debug.log
PHP errors
JavaScript console
network failures
404 assets
Elementor editor console
WooCommerce notices
```

No unresolved PHP warnings, notices, fatal errors, or browser-console errors should remain in a release candidate unless explicitly documented and harmless.

---

# 37. Theme Testing Matrix

Test a clean WordPress installation.

## Core WordPress

```text
✓ Activate theme
✓ No fatal errors
✓ Pages
✓ Posts
✓ Categories
✓ Tags
✓ Search
✓ 404
✓ Comments
✓ Featured images
✓ Menus
✓ Custom logo
✓ Site title
✓ Widgets where supported
```

## Elementor

```text
✓ Elementor active
✓ Edit page with Elementor
✓ Save/update page
✓ Responsive editing
✓ Global colors
✓ Global fonts
✓ Template library
✓ Theme Builder locations if supported
✓ Header fallback
✓ Footer fallback
✓ Single fallback
✓ Archive fallback
✓ No Elementor active → theme still functions
```

## WooCommerce

```text
✓ Plugin activation
✓ Shop
✓ Product
✓ Variable product
✓ Sale price
✓ Stock state
✓ Add to cart
✓ Cart
✓ Checkout
✓ My Account
✓ Product category
✓ Product search
✓ Responsive product grid
```

## Plugin

```text
✓ Companion plugin activation
✓ Widget registration
✓ Elementor editor preview
✓ Frontend rendering
✓ Plugin inactive
✓ Elementor inactive
✓ Invalid widget values
```

---

# 38. Browser and Device Testing

Required minimum browser checks:

```text
Chrome
Safari
Firefox
Edge
```

Required responsive checks:

```text
375px
390px
430px
768px
1024px
1280px
1440px
```

Check:

- navigation;
- dropdowns;
- sticky elements;
- forms;
- buttons;
- cards;
- typography;
- image cropping;
- horizontal overflow;
- Elementor editor behavior;
- WooCommerce interactions.

---

# 39. Automated / Static Checks

Use tooling where justified.

Recommended:

```text
PHP_CodeSniffer + WordPress Coding Standards
ESLint where JS is substantial
Stylelint where CSS is substantial
PHPStan where the codebase benefits from static analysis
Theme Check / current WordPress theme testing tooling
Lighthouse/PageSpeed
Accessibility checks such as axe/WAVE
```

Do not add tools solely for decoration. Add them when they enforce a real quality rule.

---

# 40. Git and Repository Strategy

Repository:

```text
mytheme/
```

Recommended branches:

```text
main
staging/develop
feature/header
feature/elementor
feature/woocommerce
feature/widgets
fix/mobile-nav
```

### Commit style

Use meaningful commits:

```text
feat: add dynamic primary navigation
feat: integrate Elementor theme locations
feat: add WooCommerce support
feat: add portfolio Elementor widget
fix: prevent mobile menu overflow
perf: conditionally load widget assets
docs: add installation guide
```

### Release tags

```text
v1.0.0
v1.0.1
v1.1.0
v2.0.0
```

Use semantic versioning conventions consistently.

---

# 41. Theme Packaging

The release package should be clean.

## Theme ZIP should not contain

```text
.git/
node_modules/
composer cache
local environment files
.env
private credentials
editor caches
unnecessary source exports
large unlicensed assets
```

## Theme ZIP should contain

```text
Theme code
Compiled/minified production assets as appropriate
License information
Documentation or documentation link
screenshot.png
Required theme metadata
```

## Plugin ZIP

Package separately unless your marketplace/product architecture explicitly supports another structure.

## Elementor Kit

Export from a correctly configured Elementor environment after final QA.

---

# 42. Licensing and Third-Party Asset Review

Before release, create a third-party dependency inventory.

Track:

```text
Package/library
Version
License
Source
Modification
Redistribution permission
Attribution requirement
```

Pay special attention to:

- fonts;
- icon libraries;
- images;
- JavaScript libraries;
- PHP libraries;
- animations;
- Elementor-related components.

Never ship an asset merely because it was downloadable.

---

# 43. Demo Content Rules

Demo content should demonstrate the product without creating licensing or data problems.

Use:

- original copy;
- properly licensed images;
- placeholder photography if necessary;
- fictional company names unless permission exists;
- clearly fictional customer/testimonial information;
- reusable media ratios.

Avoid copying another marketplace theme's demo content, layout, branding, screenshots, or proprietary assets.

---

# 44. Documentation Package

Every commercial release should include documentation.

Recommended docs:

```text
README.md
CHANGELOG.md
LICENSE.md
DOCUMENTATION.md
```

Customer documentation should cover:

### Installation

1. Install theme.
2. Activate theme.
3. Install required plugins.
4. Activate companion plugin if included.
5. Import Elementor Website Kit.
6. Verify Site Settings.
7. Configure menus.
8. Set site identity.

### Elementor setup

Explain:

- Free vs Pro requirements;
- how to edit pages;
- how to edit header/footer;
- how global colors work;
- how global fonts work;
- how to replace images;
- how to reset templates if needed.

### Navigation

Explain:

```text
Appearance → Menus / current WordPress navigation UI
```

Use the current WordPress admin wording at release time rather than assuming an old menu screen.

### WooCommerce

Explain:

- product creation;
- variable products;
- stock;
- shop page;
- product images;
- common setup issues.

### Troubleshooting

Document:

- Elementor not loading;
- missing styles;
- stale cache;
- widget not appearing;
- WooCommerce layout issues;
- import problems;
- plugin dependency notices.

---

# 45. Update Strategy

Design for updates from the beginning.

### Theme updates

Do not overwrite customer-created content because content should live in WordPress/Elementor rather than hardcoded PHP.

### Plugin updates

Preserve custom post data and settings.

### Elementor Kit updates

Document whether an updated kit is:

- full replacement;
- template-only;
- styles-only;
- optional migration.

Never instruct customers to overwrite an entire production site blindly.

---

# 46. Data Migration Rules

The customer should not lose:

- pages;
- posts;
- menus;
- WooCommerce products;
- custom post data;
- media;
- user content

just because they change theme.

Theme settings that are purely presentation-related may reset/change on a theme switch; document such behavior clearly.

---

# 47. Admin UX Specification

The admin experience should be clear, not cluttered.

Only create custom admin pages when necessary.

Recommended plugin admin UI:

```text
MyTheme Elements
│
├── Status
├── Requirements
├── Widgets
├── Tools
└── About / Support
```

Show:

- current plugin version;
- Elementor detected/not detected;
- required version status;
- WooCommerce detected/not detected;
- links to documentation;
- safe notices.

Do not add aggressive upsells, unnecessary admin nags, or intrusive notices.

---

# 48. Theme Settings UX

Use native WordPress/Elementor interfaces wherever possible.

Preferred user-facing controls:

```text
WordPress Site Identity
WordPress Menus / Navigation
WordPress Content
Elementor Site Settings
Elementor Theme Builder
WooCommerce Settings
```

Avoid creating duplicate settings for the same thing.

Example of bad UX:

```text
WordPress Logo
Theme Logo
Elementor Logo
Plugin Logo
```

unless there is a genuine architectural reason.

---

# 49. SEO-Friendly Structural Foundations

The theme should provide clean semantic structure.

Requirements:

- one clear primary content region;
- logical headings;
- meaningful link text;
- clean navigation markup;
- image alt handling;
- proper document landmarks;
- no forced SEO metadata system inside the theme unless necessary.

Avoid competing with dedicated SEO plugins. The theme should provide a clean HTML foundation rather than creating a second SEO engine.

---

# 50. Privacy-Friendly Architecture

Do not silently send unnecessary customer/site data to external servers.

For any external service:

- document what data is sent;
- get the user's consent when legally/technically required;
- provide a disable path where appropriate;
- do not include analytics/tracking merely because it is useful to the theme developer.

---

# 51. Elementor Design-System Rules

The Website Kit must use Elementor's centralized design system.

### Global colors

Configure:

```text
Primary
Secondary
Text
Accent
```

Plus additional semantic colors only when needed.

### Global fonts

Configure:

```text
Primary
Secondary
Text / Body
Accent
```

Plus additional display styles only when justified.

### Theme Style

Configure consistent defaults for:

```text
Headings
Buttons
Images
Forms
Links where appropriate
```

Do not style every widget individually if the global system can do the job.

---

# 52. Elementor Container Strategy

Use Elementor Containers/Flexbox/Grid features supported by the target Elementor version.

Recommended hierarchy:

```text
Page
└── Full-width section/container
    └── Max-width content container
        ├── Column/row structure
        └── Content widgets
```

Avoid excessive nesting.

Each section should have a clear purpose.

---

# 53. Animation / Motion Specification

Use motion as enhancement, not as the core of functionality.

Allowed examples:

- hover transform;
- subtle fade/slide;
- image reveal;
- menu transition;
- scroll entrance where appropriate.

Requirements:

- short durations;
- avoid excessive simultaneous animations;
- respect reduced motion;
- avoid huge layout shifts;
- do not block content access.

---

# 54. Image System

For demo/UI design, define image ratios.

Example:

```text
Hero landscape: 16:9
Portfolio card: 4:3
Portrait card: 3:4
Square thumbnail: 1:1
Team member: 4:5
```

Use WordPress responsive image functions instead of always printing full-resolution media.

For Elementor media, choose appropriate image sizes and avoid uploading unnecessarily huge originals as the displayed size.

---

# 55. Accessibility + UI Component Contract

Every reusable component should document:

```text
Purpose
Markup
Keyboard behavior
Screen-reader behavior
Hover state
Focus state
Active state
Disabled state
Mobile behavior
Reduced-motion behavior
```

Example button contract:

```text
Primary CTA
- min-height target suitable for touch
- visible focus ring
- hover state
- active state
- disabled state if applicable
- icon receives aria-hidden when decorative
- link used when navigation occurs
- button used when an action occurs
```

---

# 56. Professional Folder Naming / Prefixing

Use predictable names.

Bad:

```text
coolwidget.php
helper.php
new.php
new2.php
final-header.php
final-header-new.php
```

Good:

```text
class-portfolio-widget.php
class-compatibility.php
template-tags.php
elementor.php
woocommerce.php
```

Keep names stable after release whenever possible.

---

# 57. WordPress Hooks and Filters Policy

Prefer WordPress hooks for extensibility.

Provide your own documented hooks where third-party developers may reasonably need them.

Example:

```php
do_action( 'mytheme_before_content' );
```

and:

```php
apply_filters( 'mytheme_container_width', '1200px' );
```

Do not add hooks everywhere. Add extension points intentionally.

Document every public hook you promise to maintain.

---

# 58. Extensibility Contract

The commercial theme should be friendly to child themes even though the core product itself should not depend on a parent theme.

Use:

- pluggable functions only when justified;
- filters for sensible overrides;
- actions for extension points;
- template parts;
- CSS custom properties;
- documented hooks.

Do not make customers edit core theme files for routine customization.

---

# 59. Do Not Hardcode These Things

Never hardcode into runtime templates unless explicitly intended as a fallback/default:

```text
Navigation URLs
Customer company name
Customer logo
Phone number
Email address
Physical address
Social URLs
Page IDs
WooCommerce product IDs
Specific page content
Specific post IDs
Theme-license secrets
API keys
Production URLs
```

Use WordPress settings/content or controlled theme settings instead.

---

# 60. Build Process

If using npm tooling, keep the build process understandable.

Example:

```text
npm install
npm run lint
npm run build
npm run release
```

Possible tools:

- `@wordpress/scripts` where useful;
- Sass only if it materially helps;
- PostCSS where useful;
- ESLint;
- Stylelint.

Do not introduce a complex frontend build stack merely because the developer already knows Vite/React.

The final WordPress theme does not need React to be professional.

---

# 61. Important Decision: Do Not Rebuild WordPress in React

The theme's frontend architecture should remain WordPress-native unless a specific interactive feature truly requires a JavaScript application.

Avoid:

```text
React SPA
   ↓
inside every WordPress page
```

Prefer:

```text
WordPress
   ↓
PHP templates
   ↓
Elementor
   ↓
small JS enhancements where required
```

Use React only for genuinely interactive/admin experiences that justify it.

---

# 62. Product Reusability Strategy

Build a reusable core so multiple niche themes can share engineering.

```text
MY CORE THEME FOUNDATION
│
├── Architecture
├── Accessibility
├── Security
├── WooCommerce layer
├── Elementor integration
├── Design token contract
└── Performance layer
       │
       ├── Agency Kit
       ├── Photography Kit
       ├── Dance Academy Kit
       ├── Restaurant Kit
       ├── Medical Shop Kit
       └── SaaS Kit
```

Do not duplicate core engineering for every niche.

Change the visual kit and content model where possible.

---

# 63. Recommended First Product

Build a flagship starter product called:

```text
MyTheme Base
```

Purpose:

- prove the architecture;
- become the base for future niche products;
- contain all production engineering patterns;
- ship with one polished agency/creative-tech Elementor Kit.

### First demo UI

Pages:

```text
Home
About
Services
Work
Contact
Blog
FAQ
```

Theme Builder:

```text
Header
Footer
Single Page
Single Post
Archive
Search
404
```

WooCommerce:

```text
Shop
Single Product
Product Archive
```

Widgets:

```text
Services Grid
Portfolio Grid
Team Grid
Testimonials
CTA
Logo Grid
```

---

# 64. Antigravity Master Build Prompt

Use this section as the implementation instruction for the AI coding agent.

---

## MASTER INSTRUCTION

You are building a production-ready, standalone commercial WordPress theme called `PROJECT_SLUG`.

### Non-negotiable architecture

1. Do not use GeneratePress, Astra, Hello, Kadence, or any other parent theme.
2. Do not make the theme depend on a parent theme.
3. Treat the theme as a standalone WordPress classic/hybrid-capable theme.
4. Use WordPress APIs and hooks instead of inventing parallel systems.
5. Keep theme presentation separate from plugin functionality.
6. Put custom Elementor widgets and durable business/data functionality in a companion plugin.
7. Do not hardcode navigation URLs or page content.
8. Ensure WordPress pages can be edited with Elementor through the normal content pipeline.
9. Register and safely render Elementor Theme Builder locations with theme fallbacks.
10. Support WooCommerce using upgrade-safe methods.
11. Use secure coding practices everywhere.
12. Make all user-facing strings translation-ready.
13. Make the UI responsive, accessible, and performant.
14. Keep code modular and maintainable.
15. Do not add unnecessary dependencies.

### Build sequence

Execute in this order:

```text
PHASE 1  Theme foundation
PHASE 2  Template hierarchy
PHASE 3  Dynamic navigation + branding
PHASE 4  Assets + CSS architecture
PHASE 5  theme.json
PHASE 6  Elementor compatibility
PHASE 7  WooCommerce compatibility
PHASE 8  Companion plugin foundation
PHASE 9  Custom Elementor widgets
PHASE 10 Design-system implementation
PHASE 11 Demo/Elementor Kit specification
PHASE 12 Accessibility + security hardening
PHASE 13 Performance optimization
PHASE 14 Documentation
PHASE 15 Automated/static checks
PHASE 16 Full QA and release packaging
```

Do not skip ahead to custom widgets before the theme foundation is working.

### Code requirements

For every PHP file:

- prevent unsafe direct access where appropriate;
- use the product prefix/namespace;
- escape dynamic output;
- sanitize/validate input;
- use capability checks for privileged operations;
- use nonces for state-changing requests;
- use WordPress APIs;
- avoid raw SQL unless justified;
- avoid hardcoded site content;
- provide useful comments for non-obvious logic.

### Elementor requirements

- detect Elementor safely;
- register appropriate Theme Builder locations;
- use current Elementor APIs;
- provide theme fallbacks;
- do not initialize Elementor-specific classes when Elementor is inactive;
- register companion widgets through the current widget registration API;
- provide editor-safe widget initialization;
- conditionally load assets where practical.

### WooCommerce requirements

- declare WooCommerce support on the correct hook;
- prefer hooks/filters before template overrides;
- keep overrides minimal;
- test variable products, shop, product, cart, checkout, and account pages;
- track custom overrides against WooCommerce template changes.

### Design-system requirements

Implement one canonical design-token contract covering:

- colors;
- typography;
- spacing;
- layout widths;
- radii;
- buttons;
- form fields;
- responsive rules;
- motion.

Use the same design-token values across:

```text
Elementor Global Colors
Elementor Global Fonts
Elementor Theme Style
theme.json
CSS variables
Elementor templates/widgets
```

Do not create conflicting values.

### UI direction

Build a premium modern agency/creative-tech design:

- large typography;
- bold hero;
- clean navigation;
- strong CTA;
- editorial media layout;
- portfolio cards;
- service grid;
- testimonials;
- final CTA;
- structured footer;
- subtle motion;
- strong mobile behavior.

### Deliverables

Produce:

```text
1. Standalone WordPress theme source
2. Companion plugin source
3. Theme JSON
4. Elementor widget source
5. Elementor Kit configuration/specification
6. Demo content specification
7. Documentation
8. Changelog
9. License file
10. Test checklist
11. Release packaging instructions
```

### Build reporting

At the end of each phase, report:

```text
What was implemented
Files created/changed
Dependencies added
Known limitations
Tests performed
Next phase
```

Do not claim something is complete unless it was actually implemented and tested.

---

# 65. Acceptance Criteria

The theme is not complete until all of the following are true.

## WordPress

```text
[ ] Theme activates on a clean installation
[ ] No PHP fatal errors
[ ] Pages render dynamically
[ ] Posts render dynamically
[ ] Search works
[ ] 404 works
[ ] Menus are dynamic
[ ] Custom logo works
[ ] Site title works
[ ] Featured images work
```

## Elementor

```text
[ ] Pages can be edited with Elementor
[ ] Elementor does not require theme code edits for normal page changes
[ ] Theme Builder locations are registered
[ ] Theme fallbacks work when no Elementor template exists
[ ] Global colors are configured
[ ] Global fonts are configured
[ ] Responsive settings work
[ ] Kit can be exported from the configured demo site
[ ] Kit can be imported into a clean test site
```

## Companion plugin

```text
[ ] Plugin activates without Elementor
[ ] Plugin gives an understandable notice if requirements are missing
[ ] Elementor widgets appear when Elementor is active
[ ] Widgets render correctly in editor and frontend
[ ] Widgets use escaped output
[ ] Widget assets load efficiently
```

## WooCommerce

```text
[ ] WooCommerce support declared correctly
[ ] Shop works
[ ] Single product works
[ ] Variable product works
[ ] Cart works
[ ] Checkout works
[ ] Account works
[ ] Theme does not introduce avoidable template override debt
```

## Security

```text
[ ] Output escaped
[ ] Inputs sanitized/validated
[ ] Privileged actions check capabilities
[ ] State-changing actions use nonces
[ ] No secrets in repository
[ ] No unsafe raw SQL
[ ] Remote requests validated/handled safely
[ ] Direct PHP file access is considered
```

## Accessibility

```text
[ ] Keyboard navigation works
[ ] Focus states visible
[ ] Images have meaningful alt behavior
[ ] Forms have labels
[ ] Semantic landmarks present
[ ] No obvious keyboard traps
[ ] Motion respects reduced-motion preference where needed
```

## Performance

```text
[ ] No unnecessary global JS bundle
[ ] No unnecessary global CSS bundle
[ ] Images are optimized
[ ] Responsive image sizes used
[ ] No avoidable layout shifts
[ ] Elementor nesting is reasonable
[ ] Lighthouse/PageSpeed checked
```

## Release quality

```text
[ ] Documentation complete
[ ] Changelog updated
[ ] Version number updated
[ ] License reviewed
[ ] Third-party assets reviewed
[ ] Clean ZIP produced
[ ] Tested on clean installation
[ ] Tested without Elementor
[ ] Tested with Elementor
[ ] Tested with Elementor Pro if required
[ ] Tested with WooCommerce if supported
```

---

# 66. Definition of Done

A release candidate is considered professionally ready only when a user with no PHP knowledge can:

```text
Install theme
   ↓
Install required plugins
   ↓
Import kit
   ↓
Change logo
   ↓
Change global colors
   ↓
Change global fonts
   ↓
Create a new page
   ↓
Edit page with Elementor
   ↓
Add page to navigation
   ↓
Change header/footer if licensed feature is used
   ↓
Create a blog post
   ↓
Create WooCommerce product
   ↓
View on mobile
   ↓
Publish
```

without modifying PHP, CSS, or JS.

If the user needs code editing for any of those normal CMS tasks, identify why and redesign the architecture before calling the product complete.

---

# 67. Final Engineering Philosophy

Always ask:

> **Who should own this data or decision?**

Use this mapping:

```text
Content                 → WordPress / Elementor
Navigation              → WordPress
Branding                → WordPress / Elementor Site Settings
Global visual system    → Elementor Site Settings + theme.json fallback
Page composition        → Elementor
Theme fallback layout   → Theme
Business functionality  → Companion plugin
Products/orders         → WooCommerce
Custom Elementor UI     → Companion plugin
Security                → Theme/plugin implementation
Accessibility            → Theme/plugin/kit implementation
Performance              → Theme/plugin/kit implementation
Documentation           → Product package
```

The commercial product should feel like a **professional website system**, not a PHP-coded screenshot.

The theme should provide a robust foundation, Elementor should provide visual editing, WooCommerce should provide commerce, the companion plugin should provide durable functionality and custom widgets, and the Website Kit should provide the polished design/content experience.

---

# 68. Official Documentation References

Use these as the primary references when implementing or updating this project.

## WordPress

- WordPress Theme Handbook: https://developer.wordpress.org/themes/
- Theme Structure: https://developer.wordpress.org/themes/core-concepts/theme-structure/
- Template Hierarchy: https://developer.wordpress.org/themes/core-concepts/templates/ / https://developer.wordpress.org/themes/classic-themes/basics/template-hierarchy/
- Template Files: https://developer.wordpress.org/themes/classic-themes/basics/template-files/
- Theme JSON: https://developer.wordpress.org/themes/global-settings-and-styles/introduction-to-theme-json/
- Advanced Theme Topics: https://developer.wordpress.org/themes/advanced-topics/
- Theme Testing: https://developer.wordpress.org/themes/advanced-topics/testing/
- Security: https://developer.wordpress.org/apis/security/
- Internationalization: https://developer.wordpress.org/themes/advanced-topics/internationalization/

## Elementor

- Theme Integration: https://developers.elementor.com/docs/themes/
- Registering Locations: https://developers.elementor.com/docs/themes/registering-locations/
- Displaying Locations: https://developers.elementor.com/docs/themes/displaying-locations/
- Registering Widgets: https://developers.elementor.com/docs/managers/registering-widgets/
- Addon Compatibility: https://developers.elementor.com/docs/addons/compatibility/
- Developer Best Practices: https://developers.elementor.com/docs/getting-started/best-practices/
- Theme Builder: https://elementor.com/help/the-elementor-theme-builder/
- Site Settings: https://elementor.com/help/site-settings/
- Global Colors: https://elementor.com/help/view-and-edit-global-colors/
- Global Fonts: https://elementor.com/help/view-and-edit-global-fonts/
- Website Kit Import/Export: https://elementor.com/help/import-and-export-elementor-website-templates/

## WooCommerce

- Classic Theme Developer Handbook: https://developer.woocommerce.com/docs/theming/theme-development/classic-theme-developer-handbook
- Template Structure / Overrides: https://developer.woocommerce.com/docs/theming/theme-development/template-structure
- Theme Design Guidelines: https://developer.woocommerce.com/docs/theming/theme-design/

---

# 69. Agent Rules: What Not to Do

Never:

1. Reintroduce GeneratePress as a parent dependency.
2. Hardcode navigation URLs.
3. Hardcode normal page content.
4. Create a React application for the entire WordPress frontend without a compelling requirement.
5. Put custom post types only in the theme when they must survive theme changes.
6. Put custom Elementor widgets only in the theme when they need to survive theme changes.
7. Copy WooCommerce templates unnecessarily.
8. Dump every setting into the Customizer.
9. Duplicate Elementor Global Colors with unrelated hardcoded CSS colors.
10. Use random margins/paddings/font sizes throughout the design.
11. Ignore keyboard accessibility because the site “looks good.”
12. Ship API secrets in PHP/JS.
13. Trust user input without validation/sanitization/escaping.
14. Claim browser/plugin compatibility without testing.
15. Bundle third-party assets without checking their licenses.
16. Call old APIs without checking current official documentation.
17. Treat the Elementor Kit as if it were the theme source code.
18. Overwrite user content during theme updates.
19. Add unnecessary admin notices.
20. Mark the project complete while known fatal errors, broken editor states, or major accessibility/security issues remain.

---

# 70. End Goal

The completed system should behave like this:

```text
                   CUSTOMER
                      │
                      ↓
              WORDPRESS DASHBOARD
                      │
        ┌─────────────┼──────────────┐
        │             │              │
      Pages          Menus        WooCommerce
        │             │              │
        ↓             ↓              ↓
    Elementor      WordPress      Store Data
        │             │              │
        └─────────────┼──────────────┘
                      ↓
                STANDALONE THEME
                      │
          ┌───────────┼───────────┐
          │           │           │
      Templates    CSS/JS     Integrations
          │                       │
          │              ┌────────┴────────┐
          │              │                 │
          ↓          Elementor         WooCommerce
      FallBacks      locations          support
          │
          └──────────────┬────────────────┘
                         ↓
                 COMPANION PLUGIN
                         │
                   Custom Widgets
                   Custom Features
                         │
                         ↓
                 ELEMENTOR WEBSITE KIT
                         │
             Global Fonts / Colors / Templates
                         │
                         ↓
                   FINAL WEBSITE
```

The target is not simply to produce a beautiful theme demo. The target is to produce a **maintainable WordPress product whose visual quality and customer-editability are both first-class features**.

---

# 71. Project Configuration Manifest

Before generating code, the agent must create or complete a small project configuration section. Do not scatter these values throughout the codebase.

Example:

```text
THEME_NAME            = MyTheme Base
THEME_SLUG            = mytheme-base
TEXT_DOMAIN           = mytheme-base
PHP_PREFIX            = mytheme_base_
JS_NAMESPACE          = MyThemeBase
PLUGIN_NAME           = MyTheme Elements
PLUGIN_SLUG           = mytheme-elements
PLUGIN_PREFIX         = mytheme_elements_
AUTHOR_NAME           = <author/company>
AUTHOR_URI            = <author URL>
THEME_URI             = <product URL>
SUPPORT_URL           = <documentation/support URL>
MIN_WORDPRESS         = <tested minimum>
MIN_PHP               = <tested minimum>
MIN_ELEMENTOR         = <tested minimum>
MIN_ELEMENTOR_PRO     = <only if required>
MIN_WOOCOMMERCE       = <tested minimum>
```

All generated files must use the configured values consistently.

Never leave placeholders such as `PROJECT_SLUG` in a production ZIP.

---

# 72. Design Tokens as a Build Artifact

Although this document is the master specification, the implementation should create a machine-readable design-token file so the design system can be maintained consistently.

Recommended file:

```text
design/
└── tokens.json
```

Example structure:

```json
{
  "colors": {
    "primary": "#111111",
    "secondary": "#2B2B2B",
    "accent": "#C6FF00",
    "text": "#4B5563",
    "background": "#FFFFFF",
    "surface": "#F5F5F5",
    "border": "#E5E7EB",
    "success": "#16803C",
    "warning": "#B7791F",
    "error": "#B42318",
    "info": "#175CD3"
  },
  "typography": {
    "font_family": {
      "heading": "Inter",
      "body": "Inter",
      "label": "Inter",
      "button": "Inter"
    },
    "scale": {
      "display_xl": "72px",
      "display_l": "56px",
      "h1": "48px",
      "h2": "40px",
      "h3": "32px",
      "h4": "24px",
      "body_l": "20px",
      "body": "16px",
      "body_s": "14px",
      "caption": "12px"
    }
  },
  "layout": {
    "container": "1200px",
    "wide_container": "1440px",
    "mobile_padding": "20px",
    "tablet_padding": "32px",
    "desktop_padding": "48px"
  },
  "radius": {
    "small": "6px",
    "medium": "10px",
    "large": "16px",
    "pill": "999px"
  }
}
```

This token file is not itself the Elementor Kit. It is the engineering source used to keep the theme CSS, `theme.json`, Elementor Site Settings, and Elementor widgets visually aligned.

When a token changes, update all required downstream artifacts and re-test the kit.

---

# 73. Elementor Kit Production Procedure

The Elementor Kit must be produced from an actual configured WordPress + Elementor development site.

Do not pretend that copying PHP/CSS into a folder automatically creates an Elementor Website Kit.

### Procedure

```text
1. Create a clean LocalWP WordPress site
2. Install the standalone theme
3. Install Elementor
4. Install Elementor Pro if the kit uses Pro features
5. Install/activate companion plugin
6. Configure Elementor Site Settings
7. Configure Global Fonts
8. Configure Global Colors
9. Configure Theme Style
10. Build Theme Builder templates
11. Build pages
12. Add reusable templates/components
13. Add licensed demo media
14. Configure menus
15. Configure WordPress site identity
16. Configure WooCommerce if the kit includes commerce
17. Test the full site
18. Export the Website Kit using the current Elementor export workflow
19. Import that Kit into a separate clean test site
20. Re-test the imported site
21. Store the final export as a release artifact
```

### Kit release structure

Keep a small manifest with the export:

```text
kits/
└── agency-demo/
    ├── README.md
    ├── MANIFEST.md
    ├── design-tokens.json
    └── mytheme-agency-kit.zip
```

The actual ZIP may be stored outside Git if repository size becomes a problem. The manifest should record:

```text
Kit name
Kit version
Theme version
Plugin version
Elementor version tested
Elementor Pro version tested
WooCommerce version tested
Export date
Included templates
Included content
Licensed media notes
Import notes
Known limitations
```

---

# 74. Website Kit Import/Export Expectations

The kit package must be tested as a migration artifact.

The test import must prove that:

- templates import;
- Global Fonts import;
- Global Colors import;
- Theme Style settings import;
- pages import when included;
- menus/content import when included by the selected export options;
- custom widgets render when the companion plugin is installed;
- missing optional plugins produce understandable behavior;
- referenced media behaves as documented;
- the final frontend visually matches the source site within reasonable tolerance.

Do not assume every installation has the same active plugins or settings as the development machine.

---

# 75. Commercial Release Package

A final product release should look like this:

```text
release-v1.0.0/
│
├── theme/
│   └── mytheme-base.zip
│
├── plugin/
│   └── mytheme-elements.zip
│
├── kit/
│   └── mytheme-agency-kit.zip
│
├── documentation/
│   ├── installation.md
│   ├── customization.md
│   ├── elementor.md
│   ├── woocommerce.md
│   ├── widgets.md
│   ├── troubleshooting.md
│   └── changelog.md
│
└── release-notes.md
```

The exact customer-facing package can be simplified later, but the engineering release should preserve these artifacts.

---

# 76. Marketplace-Agnostic Commercial Readiness

Before selling through any marketplace or directly:

- verify the marketplace's current technical requirements;
- verify its license rules;
- verify its dependency-disclosure requirements;
- verify its update/distribution mechanism;
- verify its rules for bundled plugins;
- verify its rules for external services;
- verify image/font/icon licensing;
- verify demo-content licensing;
- verify customer support requirements.

Do not assume rules from WordPress.org, Envato, Creative Market, Gumroad, or a direct-sales website are interchangeable.

This document intentionally avoids declaring a single marketplace's rules as universal.

---

# 77. Recommended Architecture for a Future Theme Family

Once `MyTheme Base` is stable, do not fork it carelessly for every new product.

Prefer:

```text
mytheme-base-core
        │
        ├── Agency Kit
        ├── Photography Kit
        ├── Dance Academy Kit
        ├── Restaurant Kit
        ├── Medical Shop Kit
        └── SaaS Kit
```

Possible variants:

```text
Theme foundation
→ common code

Kit
→ niche visual system and page templates

Companion plugin
→ widgets/data features reused by several kits
```

When a feature is truly theme-specific, keep it in that product. Do not create an enormous universal theme containing every niche feature.

---

# 78. Final Agent Operating Mode

When this Markdown is provided to the coding agent, the agent must behave as a WordPress product engineer, not as a static HTML generator.

Before writing code, the agent must conceptually answer:

```text
What belongs to WordPress?
What belongs to the theme?
What belongs to Elementor?
What belongs to the companion plugin?
What belongs to WooCommerce?
What belongs to the design-token system?
```

For every new feature, classify it before implementing it.

### Feature classification example

```text
"Customer can add a new page to navigation"
→ WordPress menu system

"Customer can redesign Hero"
→ Elementor

"Customer can change brand colors"
→ Elementor Global Colors + design tokens

"Customer can change body font"
→ Elementor Global Fonts + design tokens

"Portfolio project database"
→ companion plugin

"Portfolio grid Elementor component"
→ companion plugin widget

"Product catalog"
→ WooCommerce

"Fallback blog template"
→ theme

"Header Theme Builder template"
→ Elementor Pro kit

"Security validation"
→ theme/plugin engineering
```

The agent must not solve a WordPress CMS problem by adding more hardcoded PHP.

The agent must not solve a product-data problem by adding theme-only storage.

The agent must not solve a visual-editing problem by forcing users to modify CSS.

The agent must use the correct system for the correct responsibility.

---

# 79. Project Success Test

At the end of development, create a completely new LocalWP site using the release artifacts rather than the development site's database.

A fresh tester should be able to:

```text
Install WordPress
↓
Install theme
↓
Install required plugins
↓
Import Elementor Kit
↓
Configure site identity
↓
Change Global Colors
↓
Change Global Fonts
↓
Create "About Us"
↓
Edit it with Elementor
↓
Add "About Us" to the primary navigation
↓
Create a blog post
↓
Create a WooCommerce product when ecommerce is included
↓
Open site on phone
↓
Publish
```

No PHP editing should be required for normal content management.

That fresh-site test is the final proof that the project has moved beyond the original child-theme workflow into a real commercial WordPress product architecture.
