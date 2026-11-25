<?php
/**
 * Credits parent theme.
 *
 * Shared setup only. Brand-specific values belong in child themes;
 * business logic (course access handoff, etc.) belongs in a plugin.
 */

defined( 'ABSPATH' ) || exit;

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
		wp_get_theme( 'credits' )->get( 'Version' )
	);
} );
