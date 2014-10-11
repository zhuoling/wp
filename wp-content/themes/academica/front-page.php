<?php
/**
 * @package Academica
*/

get_header();
?>

<div id="content" class="clearfix">


	<div class="column column-title">
		<?php
		if ( is_page() && have_posts() ) :
			the_post();
			the_title( '<h1 class="title-header">', '</h1>' );
			rewind_posts();
		endif;
		?>
	</div>

	<div class="column column-narrow">
		<?php dynamic_sidebar( 'sidebar-6' ); ?>
	</div><!-- end .column-narrow -->

	<div id="column-content" class="column column-content posts">

		<?php
		if ( is_page() ) :

			if ( have_posts() )
				get_template_part( 'content', 'page' );

			dynamic_sidebar( 'sidebar-8' );

		elseif ( have_posts() ) :

			while ( have_posts() ) :
				the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;

			academica_content_nav();
		endif;  ?>

	</div><!-- end .column-double -->

	<div class="column column-narrow column-last">
		<?php dynamic_sidebar( 'sidebar-7' ); ?>
	</div><!-- end .column-narrow -->

</div><!-- end #content -->

<?php get_footer(); ?>