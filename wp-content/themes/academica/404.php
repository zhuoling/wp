<?php
/**
 * @package Academica
*/

get_header();
?>

<div id="content" class="column-full clearfix">

	<div class="column column-title">

		<?php get_template_part( 'breadcrumb' ); ?>

		<div id="post-0" class="post error404 no-results not-found">
			<h1 class="title-header"><?php _e( 'Oops! That page can&rsquo;t be found.', 'academica' ); ?></h1>

			<div class="entry-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'academica' ); ?></p>

				<?php the_widget( 'WP_Widget_Search' ); ?>

				<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				<div class="widget">
					<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'academica' ); ?></h2>
					<ul>
					<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
					</ul>
				</div><!-- .widget -->

				<?php
				/* translators: %1$s: smilie */
				$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'academica' ), convert_smilies( ':)' ) ) . '</p>';
				the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

				the_widget( 'WP_Widget_Tag_Cloud' ); ?>

			</div><!-- .entry-content -->
		</div><!-- #post-0 -->
	</div><!-- end .column-title -->

</div><!-- end #content -->

<?php get_footer(); ?>