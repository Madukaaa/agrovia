# Troubleshooting & FAQ — Agrovia

Quick solutions for common setup, hosting, and configuration questions.

---

## 1. 404 Errors on Custom Post Types (`/practices/` or `/team/`)

### Cause:
WordPress has not refreshed its internal rewrite rules since the companion plugin was activated.

### Solution:
1. Navigate to **Settings &rarr; Permalinks** in your WordPress dashboard.
2. Without changing any options, click the blue **Save Changes** button at the bottom.
3. This forces WordPress to regenerate its `.htaccess` or server rewrite rules.

---

## 2. Elementor Editor Stuck on Loading Screen

### Cause:
Insufficient PHP memory limit or a conflict with an aggressive caching plugin.

### Solution:
1. **Increase PHP Memory Limit:** Open your site's `wp-config.php` file and add:
   ```php
   define( 'WP_MEMORY_LIMIT', '256M' );
   define( 'WP_MAX_MEMORY_LIMIT', '512M' );
   ```
2. **Enable Elementor Safe Mode:** Go to **Elementor &rarr; Tools &rarr; Safe Mode** and enable it to determine if a third-party plugin is interfering.
3. **Regenerate CSS:** Go to **Elementor &rarr; Tools &rarr; General &rarr; Regenerate Files & Data**, click **Regenerate Files**, and clear your browser cache.

---

## 3. Custom Widgets Missing in Elementor Panel

### Cause:
The companion plugin **Agrovia Core** is either deactivated or has unmet environment dependencies.

### Solution:
1. Go to **Plugins &rarr; Installed Plugins** and verify that **Agrovia Core** is active.
2. Check your server's PHP version (Agrovia requires **PHP 7.4+**). If you are running PHP 7.3 or earlier, upgrade to PHP 8.1 or 8.2 via your web hosting panel.

---

## 4. Mobile Navigation Drawer Not Opening

### Cause:
A JavaScript minification plugin has deferred or concatenated `navigation.js` improperly, or a script error from another plugin halted execution.

### Solution:
1. Agrovia already loads scripts with native `defer` attributes. In your caching plugin (e.g. WP Rocket, Autoptimize), exclude `navigation.js` and `main.js` from JS combination/minification.
2. Open your browser's Developer Tools Console (`F12` &rarr; **Console**) and look for red errors originating from third-party plugins.

---

## 5. Google Fonts Not Displaying (Offline / Intranet)

### Cause:
The server or client network is blocking connections to `fonts.googleapis.com`.

### Solution:
Agrovia uses system font fallbacks (`Georgia, serif` for headings and `-apple-system, BlinkMacSystemFont, sans-serif` for body copy). For offline intranet installations, you can upload self-hosted WOFF2 font files and declare them via standard CSS `@font-face` in a child theme.

---

## 6. How to Enable Debug Logging

If you encounter an unexpected issue, enable WordPress debug logging in `wp-config.php`:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

Errors will be recorded safely in `wp-content/debug.log` without exposing sensitive server details to website visitors.
