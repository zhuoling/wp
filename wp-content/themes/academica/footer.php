<?php
/**
 * @package Academica
 */
?>
			<div id="footer" class="clearfix">
				<?php if ( is_active_sidebar( 'sidebar-9' ) ) : ?>
				<div id="footer-column"><?php dynamic_sidebar( 'sidebar-9' ); ?></div>
				<?php endif; ?>

				<?php wp_nav_menu( array( 'container' => false, 'depth' => 1, 'theme_location' => 'footer', 'fallback_cb' => false ) ); ?>
				<p class="copy">
					<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a><span class="sep"> / </span>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'academica' ), 'Academica', '<a href="http://www.wpzoom.com/" rel="designer">WPZOOM</a>' ); ?>
				</p>
			</div><!-- end #footer -->
		</div><!-- end #wrap -->

		<?php wp_footer(); ?>
	</body>
</html>