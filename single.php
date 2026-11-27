<?php
/**
 * Single post (a guide).
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $category = credits_primary_category(); ?>
		<section class="hero hero--post">
			<div class="container container--narrow post-hero">
				<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'credits' ); ?>">
					<a href="<?php echo esc_url( credits_guides_url() ); ?>"><?php esc_html_e( 'Guides', 'credits' ); ?></a>
					<?php if ( $category ) : ?>
						/ <a href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
					<?php endif; ?>
				</nav>
				<h1 class="post-hero__title"><?php the_title(); ?></h1>
				<p class="post-hero__meta"><?php echo esc_html( get_the_date() . ' · ' . get_the_author() ); ?></p>
			</div>
		</section>

		<article <?php post_class( 'container container--narrow post' ); ?>>
			<div class="post-body">
				<?php the_content(); ?>
			</div>
			<p class="post-back"><a href="<?php echo esc_url( credits_guides_url() ); ?>"><?php esc_html_e( '← All posts', 'credits' ); ?></a></p>
		</article>

		<section class="post-cta" aria-label="<?php esc_attr_e( 'Free check', 'credits' ); ?>">
			<div class="container container--narrow">
				<div class="cta-band cta-band--compact">
					<div class="cta-band__copy">
						<h2 class="cta-band__title"><?php esc_html_e( 'Find out what you’re missing', 'credits' ); ?></h2>
						<p class="cta-band__text"><?php esc_html_e( 'Free, no transcript needed for the first check.', 'credits' ); ?></p>
					</div>
					<a class="btn" href="<?php echo esc_url( home_url( '/#check' ) ); ?>"><?php esc_html_e( 'Start my free check', 'credits' ); ?></a>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
