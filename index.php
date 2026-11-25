<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main class="site-main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?>>
			<?php if ( ! is_singular() ) : ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php else : ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
			<?php is_singular() ? the_content() : the_excerpt(); ?>
		</article>
	<?php endwhile; the_posts_pagination(); else : ?>
		<p><?php esc_html_e( 'Nothing found.', 'credits' ); ?></p>
	<?php endif; ?>
</main>
<?php get_footer(); ?>
