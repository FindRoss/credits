<?php
/**
 * "All states" index (/states/): published states grouped by top-up status.
 */
defined( 'ABSPATH' ) || exit;
get_header();

$groups = array_filter( credits_status_groups(), fn( $g ) => ! empty( $g['items'] ) );
?>
<main id="main">
	<section class="hero">
		<div class="container hero__stack">
			<p class="eyebrow eyebrow--accent"><?php esc_html_e( 'State rules', 'credits' ); ?></p>
			<h1 class="hero__title"><?php esc_html_e( 'Counseling license rules by state', 'credits' ); ?></h1>
			<p class="hero__lede"><?php esc_html_e( 'Find out whether your state lets you top up a shorter degree with graduate courses.', 'credits' ); ?></p>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<?php if ( $groups ) : ?>
				<div class="card-row">
					<?php foreach ( $groups as $group ) : ?>
						<div class="status-card <?php echo esc_attr( $group['modifier'] ); ?>">
							<h2 class="status-card__title"><?php echo esc_html( $group['title'] ); ?></h2>
							<p class="status-card__list"><?php echo credits_state_links( $group['items'] ); // Escaped in helper. ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<p><?php esc_html_e( 'State pages are coming soon.', 'credits' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
