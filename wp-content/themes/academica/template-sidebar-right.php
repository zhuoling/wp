<?php
/**
 * Template Name: Sidebar Right
 *
 * @package Academica
 */

get_header(); ?>

<div id="content" class="clearfix">

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="column column-title">
		<?php get_template_part( 'breadcrumb' ); ?>
		<?php the_title( '<h1 class="title-header">', '</h1>' ); ?>
	</div><!-- end .column-title -->

	<div class="column column-double column-content single">

		<?php get_template_part( 'content', 'page' );
		comments_template(); ?>

	</div><!-- end .column-content -->

	<div class="column column-narrow column-last">
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div><!-- end .column-narrow -->

	<?php endwhile; ?>

</div><!-- end #content -->

<?php get_footer(); ?>