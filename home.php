<?php
/**
 * The Guides listing: the page set as "Posts page" under Settings > Reading.
 * (WordPress names this template home.php; the homepage is front-page.php.)
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main">
	<section class="hero">
		<div class="container container--narrow hero__stack hero__stack--tight">
			<p class="eyebrow eyebrow--accent"><?php esc_html_e( 'Guides', 'credits' ); ?></p>
			<h1 class="hero__title"><?php esc_html_e( 'Counseling licensure guides', 'credits' ); ?></h1>
			<p class="hero__lede"><?php esc_html_e( 'Plain-language guides to hours, coursework and state rules.', 'credits' ); ?></p>
		</div>
	</section>
	<?php get_template_part( 'template-parts/post-list' ); ?>
</main>
<?php get_footer(); ?>
