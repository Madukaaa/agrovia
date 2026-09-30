<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up until <div id="content">.
 * Preserves the document shell and delegates visual header to Elementor Theme Builder
 * when available, with a modular fallback to template-parts/header/site.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<?php
	// Check if Elementor Theme Builder renders the header location.
	if ( function_exists( 'agrovia_elementor_do_location' ) && agrovia_elementor_do_location( 'header' ) ) {
		// Elementor rendered the header location.
	} else {
		get_template_part( 'template-parts/header/site' );
	}
	?>

	<div id="content" class="site-content">
