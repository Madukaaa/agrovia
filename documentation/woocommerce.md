# WooCommerce Store Guide — Agrovia

Learn how Agrovia delivers an e-commerce experience for selling farm produce, organic grains, and CSA boxes without template bloat.

---

## 1. Architectural Philosophy: Hook-Based Integration

Agrovia complies with Section 21 of `AI-THEME-SPEC.md` by prioritizing **hooks and filters over template overrides**.

Instead of copying dozens of fragile WooCommerce template files into the theme:
1. Agrovia unhooks WooCommerce's default wrappers (`woocommerce_output_content_wrapper`).
2. Agrovia attaches semantic container hooks (`agrovia_woocommerce_wrapper_before` and `agrovia_woocommerce_wrapper_after`).
3. This guarantees that your store automatically adapts to future WooCommerce core updates without "outdated template" warnings.

---

## 2. Declared Features & Theme Supports

In `inc/woocommerce.php`, Agrovia registers:
- `add_theme_support( 'woocommerce' )`
- `add_theme_support( 'wc-product-gallery-zoom' )` — Interactive hover zoom on product images.
- `add_theme_support( 'wc-product-gallery-lightbox' )` — Fullscreen modal lightbox gallery.
- `add_theme_support( 'wc-product-gallery-slider' )` — Touch-friendly swipeable gallery thumbnail slider.
- Default image dimensions:
  - Catalog Thumbnail: `480x480px` (1:1 square crop).
  - Single Product Image: `800px` width.

---

## 3. Shop Loop Defaults

Agrovia calibrates the catalog grid for readability and visual balance:
- **Loop Columns:** 3 columns on desktop, 2 on tablets, 1 on mobile devices.
- **Products Per Page:** 9 products per page (balanced 3x3 layout).
- **Related Products:** 3 related items shown beneath single product descriptions.

---

## 4. AJAX Mini-Cart Count Fragment

Agrovia implements dynamic AJAX cart count updates via the `woocommerce_add_to_cart_fragments` filter:

```php
function agrovia_woocommerce_cart_link_fragment( $fragments ) {
    ob_start();
    agrovia_woocommerce_cart_link();
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
```

When a customer clicks "Add to Cart" on any page, the cart counter in the header updates instantly without requiring a full page refresh.

---

## 5. Performance Asset Isolation

To prevent non-store pages from loading heavy e-commerce styles, `assets/css/woocommerce.css` is enqueued conditionally in `inc/enqueue.php`:

```php
if ( function_exists( 'agrovia_is_woocommerce_active' ) && agrovia_is_woocommerce_active() ) {
    if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
        wp_enqueue_style( 'agrovia-woocommerce', ... );
    }
}
```

This guarantees **zero CSS bloat** on the homepage, blog, and informational pages.
