<?php
/**
 * Featured Content Slider.
 *
 * @package Academica
 */

/**
 * Begin the featured posts section.
 *
 * See if we have any featured posts and use them to create our slider
 */
$featured = academica_get_featured_posts();

foreach ( $featured as $key => $_featured ) :
	if ( ! has_post_thumbnail( $_featured->ID ) )
		unset( $featured[ $key ] );
endforeach;

if ( is_front_page() && academica_has_featured_posts() ) :
	
	wp_enqueue_script( 'nivo-slider',         get_template_directory_uri() . '/js/nivo-slider/jquery.nivo.slider.pack.js', array( 'jquery' ),              '3.1',      true );
	wp_enqueue_script( 'academica-slider',    get_template_directory_uri() . '/js/nivo-slider/nivo.slider.js',             array( 'nivo-slider' ),         '20120927', true );
	wp_enqueue_style(  'nivo-slider-default', get_template_directory_uri() . '/js/nivo-slider/default.css',                array(),                        '1.3'            );
	wp_enqueue_style(  'nivo-slider',         get_template_directory_uri() . '/js/nivo-slider/nivo-slider.css',            array( 'nivo-slider-default' ), '3.1'            );
	?>
	<div id="slider-wrap">
		<div id="featured-slider" class="featured-slider theme-default">

			<?php foreach ( $featured as $post ) : setup_postdata( $post ); ?>

			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'academica' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_post_thumbnail( 'academica-featured-thumb' ); ?>
			</a>

			<?php endforeach; wp_reset_postdata(); ?>

		</div><!-- end #featured-slider -->
	</div><!-- end #slider-wrap -->
	<?php
	return;
endif;

$header_image = get_header_image();
if ( ! empty( $header_image ) ) : ?>
	<div id="slider-wrap">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php echo $header_image; ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	</div><!-- end #slider-wrap -->
	<?php
else:
	echo '<hr class="sepinside" />';
endif; // if ( ! empty( $header_image ) )