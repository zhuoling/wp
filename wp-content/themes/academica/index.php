<?php
/**
 * @package Academica
 */

get_header(); ?>

<div id="content" class="clearfix">

	<div class="column column-title">
		<?php get_template_part( 'breadcrumb' ); ?>
		<h1 class="title-header"><?php echo get_the_title( get_queried_object_id() ); ?></h1>
	</div><!-- end .column-title -->

	<div class="column column-narrow">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- end .column-narrow -->

	<div id="column-content" class="column column-content posts">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			academica_content_nav();
		else : ?>

			<h2><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'academica' ); ?></h2>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div><!-- end .column-content -->

	<div class="column column-narrow column-last">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- end .column-narrow -->

</div><!-- end #content -->

<?php get_footer(); ?>