<?php
/**
 * Homepage. The content lives in the page set under Settings > Reading, built in the
 * block editor from the "Homepage" pattern, so this template only wraps it.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main" class="block-page">
	<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</main>
<?php get_footer(); ?>
