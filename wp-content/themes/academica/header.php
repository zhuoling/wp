<?php
/**
 * @package Academica
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrap">
		<div id="header" class="clearfix">

			<div id="main-nav">
				<?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'menuhead', 'theme_location' => 'primary' ) ); ?>
			</div><!-- end #main-nav -->

			<div id="logo">
				<h1 id="site-title">
					<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<p id="site-description"><?php bloginfo( 'description' ); ?></p>
			</div><!-- end #logo -->

			<div id="search">
				<?php get_search_form(); ?>
			</div><!-- end #search -->

			<?php get_template_part( 'social-icons' ); // calling social block ?>

		</div><!-- end #header -->

		<?php get_template_part( 'header-image' ); ?>