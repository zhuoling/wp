<?php
/**
 * @package Academica
 */

$provider_name = array(
	'twitter'  => __( 'Twitter', 'academica' ),
	'flickr'   => __( 'Flickr', 'academica' ),
	'facebook' => __( 'Facebook', 'academica' ),
	'linkedin' => __( 'LinkedIn', 'academica' ),
	'youtube'  => __( 'YouTube', 'academica' ),
);
?>

<div id="social">
	<ul>
		<?php
		foreach ( get_object_vars( academica_get_theme_options() ) as $provider => $url ) :
			if ( ! empty( $url ) ) : ?>
		<li>
			<a class="<?php echo sanitize_html_class( $provider ); ?>" href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $provider_name[ $provider ] ); ?>" rel="external,nofollow">
				<?php echo esc_attr( $provider_name[ $provider ] ); ?>
			</a>
		</li>
		<?php endif;
		endforeach; ?>
	</ul>
</div>