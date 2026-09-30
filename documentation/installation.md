# Installation & Setup Guide — Agrovia

This guide walks you through installing and configuring the **Agrovia** theme and its companion plugin.

---

## 1. System Requirements

Before installing Agrovia, ensure your hosting environment meets the following specifications:

- **WordPress:** 6.0 or higher (Tested up to WordPress 6.7)
- **PHP:** 7.4 to 8.2+ (Recommended: PHP 8.1 or 8.2)
- **Database:** MySQL 5.7+ or MariaDB 10.3+
- **PHP Memory Limit:** 256MB minimum (512MB recommended for Elementor editor performance)
- **Max Execution Time:** 120 seconds or higher
- **HTTPS:** SSL enabled (mandatory for modern browser performance and payment gateways)

---

## 2. Step 1: Install the Standalone Theme

1. Log into your WordPress admin dashboard (`/wp-admin`).
2. Go to **Appearance &rarr; Themes &rarr; Add New Theme**.
3. Click **Upload Theme** at the top of the page.
4. Select `agrovia.zip` and click **Install Now**.
5. Once uploaded, click **Activate**.

> [!NOTE]
> Agrovia is a 100% standalone theme. It does **not** require Astra, Hello Elementor, GeneratePress, or any child-theme parent.

---

## 3. Step 2: Install & Activate the Companion Plugin

To enable custom agricultural post types (Farm Practices, Farmers & Team) and custom Elementor widgets, activate the companion plugin:

1. Navigate to **Plugins &rarr; Add New Plugin &rarr; Upload Plugin**.
2. Select `agrovia-core.zip` (located in the `companion-plugin/` directory).
3. Click **Install Now** and then **Activate Plugin**.

*(If developing locally with LocalWP, the companion plugin in `wp-content/plugins/agrovia-core` is automatically linked and ready to activate under **Plugins**).*

---

## 4. Step 3: Install Recommended Plugins

- **Elementor:** (Required for visual page building and custom Agrovia widgets).
  - Go to **Plugins &rarr; Add New** &rarr; search for "Elementor" &rarr; install and activate.
- **WooCommerce:** (Optional — required only if selling produce, organic seeds, or farm boxes online).
  - Go to **Plugins &rarr; Add New** &rarr; search for "WooCommerce" &rarr; install and activate.

---

## 5. Step 4: Configure Permalinks

To ensure that custom post type URLs (`/practices/`, `/team/`) and pagination resolve smoothly:

1. Go to **Settings &rarr; Permalinks**.
2. Under **Common Settings**, select **Post name** (`/%postname%/`).
3. Click **Save Changes** (this flushes the WordPress rewrite rules).

---

## 6. Step 5: Assign Static Front Page

1. Create a new page titled **Home** and a page titled **Journal** under **Pages &rarr; Add New**.
2. Go to **Settings &rarr; Reading**.
3. Set **Your homepage displays** to **A static page**.
4. Choose **Home** as the Homepage and **Journal** as the Posts page.
5. Click **Save Changes**.
