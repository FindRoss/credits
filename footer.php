<?php defined( 'ABSPATH' ) || exit; ?>
<footer class="site-footer">
	<div class="container site-footer__inner">
		<div class="site-footer__top">
			<?php credits_logo(); ?>
			<nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'credits' ); ?>">
				<?php
				wp_nav_menu( [
					'theme_location' => 'footer',
					'container'      => false,
					'fallback_cb'    => 'credits_footer_menu_fallback',
				] );
				?>
			</nav>
		</div>
		<p class="site-footer__legal">
			<?php esc_html_e( 'CounselorCredits is an independent advisory service. State licensing boards make all licensing decisions. Partner University pays us for marketing and student support services; we are not paid per enrollment.', 'credits' ); ?>
		</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
