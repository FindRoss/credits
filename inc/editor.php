<?php
/**
 * Block-built pages (the homepage and state pages): pattern categories and editor styling.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_block_pattern_category( 'credits-pages', [ 'label' => __( 'Site pages', 'credits' ) ] );
} );

/**
 * Style the block editor like the live page, for state posts and the static homepage.
 *
 * Reuses style.css. The editor has no `.block-page` wrapper, so that prefix is
 * stripped (WordPress scopes these rules to the editor canvas itself).
 */
add_filter( 'block_editor_settings_all', function ( $settings, $context ) {
	$post = $context->post ?? null;
	if ( ! $post ) {
		return $settings;
	}

	$is_front = 'page' === $post->post_type && (int) get_option( 'page_on_front' ) === $post->ID;
	if ( 'state' !== $post->post_type && ! $is_front ) {
		return $settings;
	}

	$css = file_get_contents( get_template_directory() . '/style.css' );
	$css = str_replace( '.block-page ', '', $css );

	// Editor only: sections run full width (theme.json would cap top-level blocks at 720px).
	$css .= '.is-root-container > .wp-block { max-width: none; margin-block: 0; }';

	$settings['styles'][] = [ 'css' => $css ];

	return $settings;
}, 10, 2 );
