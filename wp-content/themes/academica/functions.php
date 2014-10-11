<?php
/**
 * @package Academica
 */

// wp.com theme colors
if ( ! isset( $themecolors ) ) {

	$themecolors = array(
		'bg'     => 'ffffff',
		'text'   => '333333',
		'link'   => '0c5390',
		'border' => 'f99734',
		'url'    => 'f99734',
	);
}

if ( ! isset( $content_width ) )
	$content_width = 500; // pixels

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Theme Setup
 */
function academica_setup() {

	// Custom Background
	add_theme_support( 'custom-background' );

	// Custom Menus
	register_nav_menus( array(
		'primary' => __( 'Top Menu', 'academica' ),
		'footer'  => __( 'Footer Menu', 'academica' ),
	) );

	// Featured Image
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 120, 80, true ); // Normal post thumbnails
	add_image_size( 'academica-featured-thumb', 960, 300, true );
	add_image_size( 'academica-gallery', 300, 225, true );

	// Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Theme Options
	require( get_template_directory() . '/inc/theme-options.php' );

	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'academica_get_featured_posts',
		'description'             => __( 'The featured content section displays on the front page above the first post in the content area.', 'academica' ),
		'max_posts'               => 10,
	) );

	add_theme_support( 'infinite-scroll', array(
		'footer_widgets' => 'sidebar-9',
		'container'      => 'column-content',
		'wrapper'        => false,
		'footer'         => 'footer',
	) );
}
add_action( 'after_setup_theme', 'academica_setup' );

/**
 * Enqueues scripts and styles
 */
function academica_enqueue_scripts() {
	wp_enqueue_style( 'academica-style', get_stylesheet_uri() );
	wp_enqueue_script( 'academica-menu', get_template_directory_uri() . '/js/menu.js', array( 'jquery' ), '20120921', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'academica_enqueue_scripts' );

/**
 * Initializes Widgetized Areas (Sidebars)
 */
function academica_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar: Left', 'academica' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar: Right', 'academica' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar: Homepage (Left)', 'academica' ),
		'id'            => 'sidebar-6',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar: Homepage (Right)', 'academica' ),
		'id'            => 'sidebar-7',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar: Homepage (Middle)', 'academica' ),
		'id'            => 'sidebar-8',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar: Archive Pages', 'academica' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar: Pages (Left)', 'academica' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar: Pages (Right)', 'academica' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'academica' ),
		'id'            => 'sidebar-9',
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	// Custom Theme Widget
	require_once get_template_directory() . '/inc/widgets.php';
}
add_action( 'widgets_init', 'academica_widgets_init' );

/**
 * Add some useful default widgets to the Academica sidebar
 */
function academica_default_widgets( $theme ) {
	if ( 'Academica' == $theme ) return;

	$sidebars = get_option( 'sidebars_widgets' );

	if ( empty( $sidebars['sidebar-1'] ) ) {
		$pages = get_option( 'widget_pages', array( '_multiwidget' => 1 ) );
		$pages[2] = array( 'title' => __( 'Start here', 'academica' ) );
		update_option( 'widget_pages', $pages );
		$sidebars['sidebar-1'] = array( 0 => 'pages-2' );
	}

	if ( empty( $sidebars['sidebar-6'] ) ) {
		$pages = get_option( 'widget_pages', array( '_multiwidget' => 1 ) );
		$pages[3] = array( 'title' => __( 'Start here', 'academica' ) );
		update_option( 'widget_pages', $pages );
		$sidebars['sidebar-6'] = array( 0 => 'pages-3' );
	}

	if ( empty( $sidebars['sidebar-2'] ) ) {
		$widget = get_option( 'widget_academica-featured-posts-gallery', array( '_multiwidget' => 1 ) );
		$widget[2] = array(
			'title' => __( 'Latest Posts', 'academica' ),
			'category' => 0,
			'display' => 'list',
			'amount' => 4,
		);
		update_option( 'widget_academica-featured-posts-gallery', $widget );
		$sidebars['sidebar-2'] = array( 0 => 'academica-featured-posts-gallery-2' );
	}

	if ( empty( $sidebars['sidebar-7'] ) ) {
		$widget = get_option( 'widget_academica-featured-posts-gallery', array( '_multiwidget' => 1 ) );
		$widget[3] = array(
			'title' => __( 'Latest Posts', 'academica' ),
			'category' => 0,
			'display' => 'list',
			'amount' => 4,
		);
		update_option( 'widget_academica-featured-posts-gallery', $widget );
		$sidebars['sidebar-7'] = array( 0 => 'academica-featured-posts-gallery-3' );
	}

	$sidebars['wp_inactive_widgets'] = array();
	$sidebars['array_version'] = 3;

	update_option( 'sidebars_widgets', $sidebars );
}
add_action( 'after_switch_theme', 'academica_default_widgets' );

/**
 * Get wp_page_menu() to show a home link.
 *
 * @param array $args
 * @return array
 */
function academica_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'academica_page_menu_args' );

/**
 * Sets a custom comment form title
 *
 * @param array $args
 * @return array
 */
function academica_comment_form_defaults( $args ) {
	$args['title_reply'] = __( 'Post a Comment', 'academica' );
	return $args;
}
add_filter( 'comment_form_defaults', 'academica_comment_form_defaults' );

if ( ! function_exists( 'academica_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
*/
function academica_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'academica' ) . '</a>';
}
endif; // academica_continue_reading_link

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an
 * ellipsis and academica_continue_reading_link().
 */
function academica_auto_excerpt_more( $more ) {
	return ' &hellip;' . academica_continue_reading_link();
}
add_filter( 'excerpt_more', 'academica_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function academica_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= academica_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'academica_custom_excerpt_more' );

/**
 * Adds layout classes to the <body> element
 *
 * @param array $classes
 * @return array
 */
function academica_body_class( $classes ) {
	return array_merge( $classes, academica_sidebar_classes() );
}
add_filter( 'body_class', 'academica_body_class' );

/**
 * Adjusts content width if there are less than two sidebars
 */
function academica_set_content_width() {
	global $content_width;

	$classes = academica_sidebar_classes();

	if ( in_array( 'column-double', $classes ) || is_page_template( 'template-sidebar-left.php' ) || is_page_template( 'template-sidebar-right.php' ) )
		$content_width = 730;

	elseif ( in_array( 'column-full', $classes ) || is_page_template( 'template-full-width.php' ) )
	$content_width = 960;
}
add_action( 'template_redirect', 'academica_set_content_width' );

/**
 * Displays a horizontal rule before the comment form, when there are no
 * comments yet
 */
function academica_comment_form_before() {
	if ( ! have_comments() )
		echo '<hr />';
}
add_action( 'comment_form_before', 'academica_comment_form_before' );

/**
 * Appends an infinity symbol as permalink to Aside posts
 *
 * @param string $content
 * @return string
 */
function academica_aside_infinity( $content ) {

	if ( has_post_format( 'aside' ) && ! is_singular() ) {
		$content .= sprintf( ' <a href="%1$s" title="%2$s" rel="bookmark">&#8734;</a>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( __( 'Permanent Link to %s', 'academica' ), the_title_attribute( 'echo=0' ) ) )
		);
	}

	return $content;
}
add_filter( 'the_content', 'academica_aside_infinity', 0 ); // run before wpautop

/**
 * Returns an array with classes, based on the number of active sidebars and the
 * page that is being viewed
 *
 * @return array
 */
function academica_sidebar_classes() {
	$classes = array();
	$sidebar_left = $sidebar_right = '';

	if ( is_front_page() ) {
		$sidebar_left = 'sidebar-6';
		$sidebar_right = 'sidebar-7';
	} elseif ( is_page() ) {
		$sidebar_left = 'sidebar-4';
		$sidebar_right = 'sidebar-5';
	} else{
		$sidebar_left = 'sidebar-1';
		$sidebar_right = 'sidebar-2';
	}

	if ( // Not an achive and no active sidebars
		( ! is_archive() && ! is_active_sidebar( $sidebar_left ) && ! is_active_sidebar( $sidebar_right ) )

		// Archive or Search and archive sidebar not active
		|| ( ( is_archive() || is_search() ) && ! is_active_sidebar( 'sidebar-3' ) )

		// Single post view and post set to full-width
		|| ( is_singular( 'post' ) && 'column-full' == get_post_meta( get_the_ID(), '_academica_post_layout', true ) ) )
		$classes[] = 'column-full';

	elseif (
		// Just one sidebar active
		! is_active_sidebar( $sidebar_left ) || ! is_active_sidebar( $sidebar_right ) || ( is_archive() || is_search() )

		// Single post view and post set to only left sidebar
		|| ( is_singular( 'post' ) && 'column-right' == get_post_meta( get_the_ID(), '_academica_post_layout', true ) ) )
		$classes[] = 'column-double';

	if ( // No active right sidebar or Archive or Search view with active sidebar
		! is_active_sidebar( $sidebar_right ) || ( ( is_archive() || is_search() ) && is_active_sidebar( 'sidebar-3' ) )

		// Single post view and post set to only left sidebar
		|| ( is_singular( 'post' ) && 'column-right' == get_post_meta( get_the_ID(), '_academica_post_layout', true ) ) )
		$classes[] = 'column-right';

	return $classes;
}

if ( ! function_exists( 'academica_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
*/
function academica_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'academica' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'academica' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is the author's name, 2 is category, and 3 is the date.
	if ( $categories_list ) {
		$utility_text = __( '<span class="by-author">By %1$s </span>in <span class="category">%2$s</span> on <span class="datetime">%3$s</span>.', 'academica' );
	} else {
		$utility_text = __( '<span class="by-author">By %1$s </span>on <span class="datetime">%3$s</span>.', 'academica' );
	}

	printf(
		$utility_text,
		$author,
		$categories_list,
		$date
	);
}

endif;

if ( ! function_exists( 'academica_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
*/
function academica_content_nav() {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>

<div class="navigation clearfix">
	<h3 class="assistive-text">
		<?php _e( 'Post navigation', 'academica' ); ?>
	</h3>
	<span class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'academica' ) ); ?>
	</span> <span class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'academica' ) ); ?>
	</span>
</div>
<!-- end .navigation -->
<?php endif;
}
endif;

/**
 * Adds the post layout meta box
 */
function academica_add_meta_box() {
	add_meta_box( 'academica_post_layout', __( 'Post Layout', 'academica' ), 'academica_meta_box_post_layout', 'post', 'side', 'low' );
}
add_action( 'add_meta_boxes', 'academica_add_meta_box' );

/**
 * Displays the post layout dropdown field
 */
function academica_meta_box_post_layout() {
	global $post;

	$selected = get_post_meta( $post->ID, '_academica_post_layout', true );
	wp_nonce_field( 'academica_post_layout', 'academica_post_layout_nonce' ); ?>

<p>
	<label for="academica_post_layout"><?php _e( 'Choose layout for this post:', 'academica' ); ?>
	</label><br /> <select name="academica_post_layout"
		id="academica_post_layout">
		<option value="">
			<?php _e( 'Default', 'academica' ); ?>
		</option>
		<option value="column-right"
		<?php selected( $selected, 'column-right' ); ?>>
			<?php _e( 'Only Left Sidebar', 'academica' ); ?>
		</option>
		<option value="column-full"
		<?php selected( $selected, 'column-full' ); ?>>
			<?php _e( 'Full Width (no sidebars)', 'academica' ); ?>
		</option>
	</select>
</p>
<?php
}

/**
 * Updates or deletes post meta with the post layout selection
 *
 * @param int $post_id
 * @return int
 */
function academica_save_post( $post_id ){
	if ( ( ! defined( 'DOING_AUTOSAVE' ) || ! DOING_AUTOSAVE )
		&& current_user_can( 'edit_post', $post_id )
		&& isset( $_POST['academica_post_layout'] )
		&& check_admin_referer( 'academica_post_layout', 'academica_post_layout_nonce' ) ) {

		if ( in_array( $_POST['academica_post_layout'], array( 'column-right', 'column-full' ) ) )
			update_post_meta( $post_id, '_academica_post_layout', $_POST['academica_post_layout'] );
		else
			delete_post_meta( $post_id, '_academica_post_layout' );
	}
	return $post_id;
}
add_action( 'save_post', 'academica_save_post' );

/**
 * Returns whether there are featured posts available
 *
 * @return bool
 */
function academica_has_featured_posts() {
	return (bool) apply_filters( 'academica_get_featured_posts', false );
}

/**
 * Returns an array with post objects
 *
 * @return array
 */
function academica_get_featured_posts() {
	return apply_filters( 'academica_get_featured_posts', array() );
}

if ( ! function_exists( 'academica_breadcrumbs' ) ) :
/**
 * Displays a breadcrumb navigation
*/
function academica_breadcrumbs() {

	if ( !is_home() && !is_front_page() ) {

		$sep = ' &raquo; ';
		$before = '<span class="current">';
		$after = '</span>';

		echo '<a href="' . esc_url( home_url() ) . '">' . __( 'Home', 'academica' ) . '</a>' . $sep;

		if ( is_category() ) {
			global $wp_query;
			$cat = get_category( $wp_query->get_queried_object()->term_id );
			if ( 0 < $cat->parent )
				echo get_category_parents( get_category( $cat->parent ), true, $sep );
			echo $before . single_cat_title() . $after;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $sep;
			echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $sep;
			echo $before . get_the_time( 'd' ) . $after;

		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link( get_the_time('Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $sep;
			echo $before . get_the_time( 'F' ) . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time( 'Y' ) . $after;

		} elseif ( is_single() ) {
			if ( is_attachment() ) {
				global $post;
				echo '<a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a>' . $sep . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents( $cat, true, $sep ) . $before . get_the_title() . $after;
			}

		} elseif ( is_page() ) {
			global $post;
			if ( $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$parent_links = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$parent_links[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
					$parent_id  = $page->post_parent;
				}
				echo implode( $sep, array_reverse( $parent_links ) ) . $sep;
			}
			echo $before . get_the_title() . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf( __( 'Search results for &#39;%s&#39;', 'academica' ), get_search_query() ) . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf( __( 'Posts tagged &#39;%s&#39;', 'academica' ), single_tag_title( '', false ) ) . $after;

		} elseif ( is_author() ) {
			global $author;
			echo $before . sprintf( __( 'Articles posted by %s', 'academica' ), get_userdata( $author )->display_name ) . $after;

		} elseif ( is_404() ) {
			echo $before . __( 'Error 404', 'academica' ) . $after;
		}

		if ( get_query_var( 'paged' ) ) {
			echo ' (' . sprintf( __( 'Page %s', 'academica' ), get_query_var( 'paged' ) ) . ')';
		}
	}
}
endif;