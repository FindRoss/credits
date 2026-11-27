<?php
/**
 * List of post cards with pagination, shared by the Guides page and category archives.
 */
defined( 'ABSPATH' ) || exit;
?>
<section class="section section--posts">
	<div class="container container--narrow post-list">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'post-card' ); ?>>
					<p class="post-card__meta">
						<?php
						echo esc_html( get_the_date() );
						$category = credits_primary_category();
						if ( $category ) {
							echo ' · ' . esc_html( $category->name );
						}
						?>
					</p>
					<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-card__excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
					<a class="post-card__more" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read: %s', 'credits' ), wp_strip_all_tags( get_the_title() ) ) ); ?>"><?php esc_html_e( 'Read article', 'credits' ); ?></a>
				</article>
			<?php endwhile; ?>

			<?php
			$newer = get_previous_posts_link( __( '← Newer posts', 'credits' ) );
			$older = get_next_posts_link( __( 'Older posts →', 'credits' ) );
			if ( $newer || $older ) :
				?>
				<nav class="post-pages" aria-label="<?php esc_attr_e( 'Posts pages', 'credits' ); ?>">
					<span><?php echo wp_kses_post( (string) $newer ); ?></span>
					<span><?php echo wp_kses_post( (string) $older ); ?></span>
				</nav>
			<?php endif; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Guides are coming soon.', 'credits' ); ?></p>
		<?php endif; ?>
	</div>
</section>
