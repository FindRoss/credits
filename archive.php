<?php
/**
 * Category, tag, date and author archives. (States have their own archive-state.php.)
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main">
	<section class="hero">
		<div class="container container--narrow hero__stack hero__stack--tight">
			<p class="eyebrow eyebrow--accent"><a href="<?php echo esc_url( credits_guides_url() ); ?>"><?php esc_html_e( 'Guides', 'credits' ); ?></a></p>
			<h1 class="hero__title"><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
		</div>
	</section>
	<?php get_template_part( 'template-parts/post-list' ); ?>
</main>
<?php get_footer(); ?>
