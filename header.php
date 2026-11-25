<?php defined( 'ABSPATH' ) || exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="container site-header__inner">
		<?php credits_logo(); ?>
		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Main', 'credits' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => 'credits_primary_menu_fallback',
			] );
			?>
			<a class="btn btn--sm" href="<?php echo esc_url( home_url( '/#check' ) ); ?>"><?php esc_html_e( 'Start free check', 'credits' ); ?></a>
		</nav>
	</div>
</header>
