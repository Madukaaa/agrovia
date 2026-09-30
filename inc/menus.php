<?php
/**
 * Agrovia Navigation Menus and Custom Walker
 *
 * Fully dynamic WordPress navigation with accessible dropdown toggles,
 * keyboard accessibility, and graceful no-menu fallbacks.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Register theme navigation menus.
 *
 * @return void
 */
function agrovia_register_menus() {
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Navigation', 'agrovia' ),
			'footer'  => esc_html__( 'Footer Navigation', 'agrovia' ),
		)
	);
}
add_action( 'after_setup_theme', 'agrovia_register_menus' );

/**
 * Custom Accessible Nav Walker for Agrovia.
 *
 * Adds accessible button toggles for items with submenus to allow
 * both touchscreen and keyboard navigation without breaking parent links.
 */
class Agrovia_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @param string   $output Used to append additional content.
	 * @param WP_Post  $data_object Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   Menu arguments.
	 * @param int      $current_object_id Optional current ID.
	 * @return void
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item = $data_object;

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$has_children = in_array( 'menu-item-has-children', $classes, true );

		$args = (object) $args;

		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';
		}
		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
		$atts['aria-current'] = $item->current ? 'page' : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before ?? '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );
		$item_output .= '</a>';

		// If the item has children, append an accessible toggle button for mobile/keyboard.
		if ( $has_children ) {
			$item_output .= sprintf(
				'<button class="dropdown-toggle" aria-expanded="false" aria-label="%s"><span class="dropdown-icon" aria-hidden="true"></span></button>',
				/* translators: %s: menu item title */
				esc_attr( sprintf( __( 'Toggle submenu for %s', 'agrovia' ), $title ) )
			);
		}

		$item_output .= $args->after ?? '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Fallback callback when no menu is assigned to the Primary location.
 *
 * Lists published pages gracefully using the same structure.
 *
 * @param array $args Nav menu args.
 * @return void
 */
function agrovia_default_menu( $args ) {
	?>
	<ul id="primary-menu" class="primary-menu nav-menu">
		<?php
		wp_list_pages(
			array(
				'title_li' => '',
				'depth'    => 2,
			)
		);
		?>
	</ul>
	<?php
}
