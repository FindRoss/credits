<?php
/**
 * State pages: the `state` post type, its "top-up status" taxonomy, and helpers.
 *
 * Lives in the theme for now. If a second site needs different themes but the same
 * state content model (or content must survive a theme change), move this file into a
 * plugin. See README "Maybe move later".
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'state', [
		'labels'       => [
			'name'          => __( 'States', 'credits' ),
			'singular_name' => __( 'State', 'credits' ),
			'menu_name'     => __( 'States', 'credits' ),
			'all_items'     => __( 'All states', 'credits' ),
			'add_new_item'  => __( 'Add new state', 'credits' ),
			'edit_item'     => __( 'Edit state', 'credits' ),
			'search_items'  => __( 'Search states', 'credits' ),
			'not_found'     => __( 'No states found', 'credits' ),
		],
		'public'        => true,
		'has_archive'   => 'states',
		'rewrite'       => [ 'slug' => 'states', 'with_front' => false ],
		'show_in_rest'  => true, // Needed for the block editor.
		'supports'      => [ 'title', 'editor', 'excerpt', 'revisions' ],
		'menu_icon'     => 'dashicons-location-alt',
		'menu_position' => 21,
	] );

	register_taxonomy( 'topup_status', 'state', [
		'labels'            => [
			'name'          => __( 'Top-up statuses', 'credits' ),
			'singular_name' => __( 'Top-up status', 'credits' ),
		],
		'hierarchical'      => true, // Checkbox UI.
		'public'            => false,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => false,
	] );

	register_block_pattern_category( 'credits-states', [ 'label' => __( 'State pages', 'credits' ) ] );
} );

/** Rewrite rules for /states/ need flushing once when the theme is activated. */
add_action( 'after_switch_theme', function () {
	flush_rewrite_rules();
} );

/** The three status terms, in display order. Created once in the admin. */
function credits_status_definitions() {
	return [
		'allowed'             => [ 'label' => __( 'Top-ups allowed', 'credits' ), 'modifier' => '' ],
		'conditions'          => [ 'label' => __( 'Allowed with conditions', 'credits' ), 'modifier' => 'status-card--caution' ],
		'degree-must-qualify' => [ 'label' => __( 'Degree must already qualify', 'credits' ), 'modifier' => 'status-card--stop' ],
	];
}

add_action( 'admin_init', function () {
	if ( get_option( 'credits_status_terms_seeded' ) ) {
		return;
	}
	foreach ( credits_status_definitions() as $slug => $def ) {
		if ( ! term_exists( $slug, 'topup_status' ) ) {
			wp_insert_term( $def['label'], 'topup_status', [ 'slug' => $slug ] );
		}
	}
	update_option( 'credits_status_terms_seeded', 1 );
} );

/** Placeholder state names shown on the homepage until real state posts exist. */
function credits_fallback_states() {
	return [
		'allowed'             => [ 'Illinois', 'Texas', 'Minnesota', 'Tennessee', 'Indiana', 'Maryland', 'Oklahoma', 'Arizona', 'Oregon', 'Kentucky', 'Connecticut' ],
		'conditions'          => [ 'California', 'New York', 'Pennsylvania', 'Massachusetts', 'Michigan', 'Colorado' ],
		'degree-must-qualify' => [ 'Florida', 'North Carolina', 'Ohio', 'Alabama' ],
	];
}

/**
 * States grouped by status, for the homepage cards and the archive.
 * Each item is [ 'name' => string, 'url' => string ]. With $fallback, shows the
 * full planned list, linking only the names that have a published page.
 */
function credits_status_groups( $fallback = false ) {
	$groups = [];

	foreach ( credits_status_definitions() as $slug => $def ) {
		$posts = get_posts( [
			'post_type'      => 'state',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
			'no_found_rows'  => true,
			'tax_query'      => [ [ 'taxonomy' => 'topup_status', 'field' => 'slug', 'terms' => $slug ] ],
		] );

		$items = array_map(
			fn( $post ) => [ 'name' => get_the_title( $post ), 'url' => get_permalink( $post ) ],
			$posts
		);

		$groups[ $slug ] = [ 'title' => $def['label'], 'modifier' => $def['modifier'], 'items' => $items ];
	}

	return $fallback ? credits_merge_planned_states( $groups ) : $groups;
}

/**
 * Show the full planned list, linking the names that have a published page.
 * A state's ticked status wins over the planned group; a published page with no
 * status ticked is still linked where the planned list puts it.
 * Pages are matched to names by title, ignoring case.
 */
function credits_merge_planned_states( array $groups ) {
	$key = fn( $name ) => strtolower( trim( $name ) );

	$urls = [];
	foreach ( credits_state_options() as $page ) {
		$urls[ $key( $page['name'] ) ] = $page['url'];
	}

	$tagged = [];
	foreach ( $groups as $group ) {
		foreach ( $group['items'] as $item ) {
			$tagged[ $key( $item['name'] ) ] = true;
		}
	}

	foreach ( credits_fallback_states() as $slug => $names ) {
		$items = [];
		foreach ( $names as $name ) {
			$k = $key( $name );
			// Skip names tagged into a different group.
			$here = in_array( $k, array_map( fn( $i ) => $key( $i['name'] ), $groups[ $slug ]['items'] ), true );
			if ( $here || ! isset( $tagged[ $k ] ) ) {
				$items[ $k ] = [ 'name' => $name, 'url' => $urls[ $k ] ?? '' ];
			}
		}
		// Tagged pages replace their planned entry, or are appended if not planned here.
		foreach ( $groups[ $slug ]['items'] as $item ) {
			$items[ $key( $item['name'] ) ] = $item;
		}
		$groups[ $slug ]['items'] = array_values( $items );
	}

	return $groups;
}

/** Every published state for the homepage dropdown (placeholder names if none yet). */
function credits_state_options( $fallback = false ) {
	$posts = get_posts( [
		'post_type'      => 'state',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	] );

	if ( $posts ) {
		return array_map( fn( $post ) => [ 'name' => get_the_title( $post ), 'url' => get_permalink( $post ) ], $posts );
	}

	if ( ! $fallback ) {
		return [];
	}

	$names = array_merge( ...array_values( credits_fallback_states() ) );
	sort( $names );
	return array_map( fn( $n ) => [ 'name' => $n, 'url' => '' ], $names );
}

/** Render a list of state items as links (or plain names) separated by dots. */
function credits_state_links( array $items ) {
	$out = [];
	foreach ( $items as $item ) {
		$out[] = $item['url']
			? sprintf( '<a href="%s">%s</a>', esc_url( $item['url'] ), esc_html( $item['name'] ) )
			: esc_html( $item['name'] );
	}
	return implode( ' · ', $out ); // Each piece escaped above.
}

/** Homepage dropdown: jump to the chosen state's page. */
add_action( 'wp_enqueue_scripts', function () {
	if ( is_front_page() ) {
		wp_enqueue_script(
			'credits-state-select',
			get_template_directory_uri() . '/assets/js/state-select.js',
			[],
			filemtime( get_template_directory() . '/assets/js/state-select.js' ),
			true
		);
	}
} );

/** [credits_state_select]: the "Choose your state" dropdown. */
add_shortcode( 'credits_state_select', function () {
	$options = sprintf( '<option value="">%s</option>', esc_html__( 'Select a state', 'credits' ) );
	foreach ( credits_state_options( true ) as $option ) {
		$options .= sprintf( '<option value="%s">%s</option>', esc_url( $option['url'] ), esc_html( $option['name'] ) );
	}

	return sprintf(
		'<div class="field"><label for="state-select">%s</label><select id="state-select" data-state-select>%s</select></div>',
		esc_html__( 'Choose your state', 'credits' ),
		$options // Escaped above.
	);
} );

/** [credits_state_cards]: states grouped by top-up status, linked where a page exists. */
add_shortcode( 'credits_state_cards', function () {
	$cards = '';
	foreach ( credits_status_groups( true ) as $group ) {
		$cards .= sprintf(
			'<div class="status-card %s"><h3 class="status-card__title">%s</h3><p class="status-card__list">%s</p></div>',
			esc_attr( $group['modifier'] ),
			esc_html( $group['title'] ),
			credits_state_links( $group['items'] ) // Escaped in helper.
		);
	}

	return '<div class="card-row">' . $cards . '</div>';
} );
