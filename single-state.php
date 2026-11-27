<?php
/**
 * Single state page. The whole page is built in the block editor
 * (insert the "State page" pattern), so the template only wraps it.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main" class="block-page">
	<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</main>
<?php get_footer(); ?>
