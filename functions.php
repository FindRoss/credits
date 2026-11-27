<?php
/**
 * Credits parent theme.
 *
 * Shared setup only. Brand-specific values belong in child themes;
 * business logic (course access handoff, etc.) belongs in a plugin.
 */

defined( 'ABSPATH' ) || exit;

require_once get_template_directory() . '/inc/states.php';
require_once get_template_directory() . '/inc/editor.php';
require_once get_template_directory() . '/inc/guides.php';

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'custom-logo' );

	// WooCommerce.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( [
		'primary' => __( 'Primary menu', 'credits' ),
		'footer'  => __( 'Footer menu', 'credits' ),
	] );
} );

/**
 * Parent stylesheet. Child themes enqueue their own style with this as a dependency.
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'credits-style',
		get_template_directory_uri() . '/style.css',
		[],
		// File mtime busts the browser cache whenever style.css changes.
		filemtime( get_template_directory() . '/style.css' )
	);
} );

/**
 * Site logo: the uploaded custom logo if set, otherwise the site name as text.
 * A name of "CounselorCredits" renders the second word in the accent color.
 */
function credits_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	// Tolerate stray whitespace, any capitalization, and a space between the words:
	// "Counselor Credits " -> Counselor<span>Credits</span>.
	$name = trim( get_bloginfo( 'name' ) );
	if ( preg_match( '/^(.+?)\s*(Credits)$/i', $name, $m ) ) {
		$label = esc_html( $m[1] ) . '<span>' . esc_html( $m[2] ) . '</span>';
	} else {
		$label = esc_html( $name );
	}

	printf(
		'<a class="site-logo" href="%s">%s</a>',
		esc_url( home_url( '/' ) ),
		$label // Escaped above.
	);
}

/**
 * Menu fallbacks, shown until a menu is assigned to the location in Appearance > Menus.
 */
function credits_primary_menu_fallback() {
	$items = [
		__( 'Your situation', 'credits' ) => home_url( '/#situations' ),
		__( 'State rules', 'credits' )    => get_post_type_archive_link( 'state' ),
		__( 'Courses', 'credits' )        => home_url( '/#partner' ),
		__( 'How it works', 'credits' )   => home_url( '/#how' ),
		__( 'Guides', 'credits' )         => credits_guides_url(),
	];
	echo '<ul>';
	foreach ( $items as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

function credits_footer_menu_fallback() {
	$items = [
		__( 'All states', 'credits' ) => get_post_type_archive_link( 'state' ),
		__( 'Courses', 'credits' )    => home_url( '/#partner' ),
	];
	echo '<ul>';
	foreach ( $items as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}
