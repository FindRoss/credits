<?php
/**
 * "All states" index (/states/): all 50 states, linked where a page is published.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main">
	<section class="hero">
		<div class="container hero__stack hero__stack--tight">
			<p class="eyebrow eyebrow--accent"><?php esc_html_e( 'State rules', 'credits' ); ?></p>
			<h1 class="hero__title"><?php esc_html_e( 'Counseling license rules by state', 'credits' ); ?></h1>
			<p class="hero__lede"><?php esc_html_e( 'Choose your state to see its rules.', 'credits' ); ?></p>
		</div>
	</section>

	<section class="section" aria-label="<?php esc_attr_e( 'All states', 'credits' ); ?>">
		<div class="container">
			<ul class="state-grid">
				<?php foreach ( credits_state_directory() as $state ) : ?>
					<li>
						<?php if ( $state['url'] ) : ?>
							<a class="state-grid__item" href="<?php echo esc_url( $state['url'] ); ?>"><?php echo esc_html( $state['name'] ); ?></a>
						<?php else : ?>
							<span class="state-grid__item"><?php echo esc_html( $state['name'] ); ?></span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
</main>
<?php get_footer(); ?>
