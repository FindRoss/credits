<?php
/**
 * Guides: ordinary posts, listed on the posts page at /guides/.
 */

defined( 'ABSPATH' ) || exit;

/** URL of the posts page, falling back to /guides/ if none is set yet. */
function credits_guides_url() {
	$page = (int) get_option( 'page_for_posts' );
	return $page ? get_permalink( $page ) : home_url( '/guides/' );
}

/** The post's first real category (skips the default "Uncategorized"), or null. */
function credits_primary_category() {
	$default = (int) get_option( 'default_category' );
	foreach ( get_the_category() as $category ) {
		if ( $category->term_id !== $default ) {
			return $category;
		}
	}
	return null;
}

/** Editor option: a paragraph can be styled as a "Note box". */
add_action( 'init', function () {
	register_block_style( 'core/paragraph', [ 'name' => 'note', 'label' => __( 'Note box', 'credits' ) ] );
} );
