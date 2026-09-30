# Hooks & Developer API Reference — Agrovia

A comprehensive guide to all action hooks, filters, and helper functions provided by the Agrovia theme and companion plugin for child theme developers.

---

## 1. Action Hooks

### Theme Builder Locations
- **`agrovia_elementor_do_location( string $location )`**
  - **Purpose:** Executes an Elementor Pro Theme Builder location (`header`, `footer`, `single`, `archive`).
  - **Returns:** `true` if an Elementor template was successfully rendered; `false` if the native PHP fallback should run.
  - **Example:**
    ```php
    if ( ! agrovia_elementor_do_location( 'header' ) ) {
        get_template_part( 'template-parts/header/site' );
    }
    ```

### WooCommerce Wrappers
- **`agrovia_woocommerce_wrapper_before`**
  - **Purpose:** Prints the semantic `<main id="primary" class="site-main site-main-woocommerce">` container before the WooCommerce catalog or product output.
- **`agrovia_woocommerce_wrapper_after`**
  - **Purpose:** Closes the `<main>` and container elements after WooCommerce content renders.

### Companion Plugin Extension
- **`agrovia_core/widgets_registered`**
  - **Parameters:** `\Elementor\Widgets_Manager $widgets_manager`
  - **Purpose:** Fires after Agrovia Core registers its 6 default Elementor widgets. Use this hook to register additional custom Elementor widgets in child themes or addons.

---

## 2. Filter Hooks

### Layout & Sizing
- **`agrovia_content_width`**
  - **Default:** `1280`
  - **Purpose:** Filter the maximum global content width in pixels.
  - **Example:**
    ```php
    add_filter( 'agrovia_content_width', function() {
        return 1440;
    } );
    ```

### Responsive Performance
- **`wp_calculate_image_sizes`**
  - **Handled by:** `agrovia_calculate_image_sizes( $sizes, $size )`
  - **Purpose:** Dynamically computes responsive image sizes for `agrovia-card`, `agrovia-featured`, and `agrovia-portrait`.

### Accessibility & Navigation
- **`nav_menu_link_attributes`**
  - **Handled by:** `agrovia_nav_menu_aria_current( $atts, $item, $args )`
  - **Purpose:** Appends `aria-current="page"` to active menu links for screen reader compliance.
- **`navigation_markup_template`**
  - **Handled by:** `agrovia_accessible_post_nav( $template, $class )`
  - **Purpose:** Injects `aria-label="Posts navigation"` into numeric and post navigation templates.
- **`get_the_archive_title`**
  - **Handled by:** `agrovia_accessible_archive_title( $title )`
  - **Purpose:** Cleans category and tag archive titles for visual and auditory clarity.

### E-Commerce Loop Filters
- **`loop_shop_columns`**
  - **Default:** `3`
  - **Purpose:** Filter the number of products displayed per row in the catalog loop.
- **`loop_shop_per_page`**
  - **Default:** `9`
  - **Purpose:** Filter the number of products displayed per catalog archive page.

---

## 3. Core Helper Functions

| Function Name | Return Type | Description |
| :--- | :--- | :--- |
| `agrovia_is_elementor_active()` | `bool` | Returns `true` if Elementor Core is loaded. |
| `agrovia_is_elementor_pro_active()` | `bool` | Returns `true` if Elementor Pro Theme Builder is available. |
| `agrovia_is_elementor_preview()` | `bool` | Returns `true` when currently inside the live Elementor editor preview. |
| `agrovia_is_built_with_elementor()` | `bool` | Checks if the current post/page was edited using Elementor. |
| `agrovia_is_woocommerce_active()` | `bool` | Returns `true` if WooCommerce is installed and active. |
| `agrovia_posted_on()` | `void` | Prints safe, localized publication and update dates. |
| `agrovia_posted_by()` | `void` | Prints safe, localized post author byline with vcard markup. |
| `agrovia_reading_time( $post_id )` | `string` | Calculates and returns estimated reading duration (e.g. `"4 min read"`). |
| `agrovia_post_thumbnail( $size )` | `void` | Renders lazy-loaded post thumbnail with `fetchpriority="high"` on singular posts. |
