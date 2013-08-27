<?php
// Utitity functions
require_once( 'includes/theme-utilities.php' );

// Tiny MCE
require_once ('includes/theme-tinymce.php');

// Theme clean up
require_once( 'includes/theme-cleanup.php' );

// Register custom navigation walker - https://github.com/twittem/wp-bootstrap-navwalker
require_once( 'includes/theme-navigation.php' );

// Register custom post types
require_once( 'includes/theme-posttypes.php' );

// Contentblock functions
require_once( 'includes/cb-functions.php' );

// Theme setup
if ( ! function_exists( 'fs_setup' ) ) {
	function fs_setup() {
		// Make theme available for translation
		load_theme_textdomain( 'forstarters', get_template_directory() . '/language' );

		// Enable thumbnail support
		add_theme_support( 'post-thumbnails' );

		// Set thumbnail sizes
		add_image_size('image1170x780', 1170, 780, true);

		// Add excerpts to pages
		add_post_type_support( 'page', 'excerpt' );
	}
}

// Register menus
if ( ! function_exists( 'fs_register_menus' ) ) {
	function fs_register_menus(){
		register_nav_menu( 'top_menu', 'Bootstrap Top Menu' ); 
	}
}

// Register sidebar
if ( ! function_exists( 'fs_register_sidebars' ) ) {
	function fs_register_sidebars() {
		register_sidebar( array(
				'name' => __( 'Primary Sidebar', 'vast' ),
				'id'   => 'sidebar-primary',
				'description'   => 'These are widgets for the primary sidebar.',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			)
		);
	}
}

// Clean up the_excerpt()
if ( ! function_exists( 'fs_excerpt_length' ) ) {
	function fs_excerpt_length( $length ) {
		return 40;
	}
}

if ( ! function_exists( 'fs_excerpt_more' ) ) {
	function fs_excerpt_more( $more ) {
		return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'forstarters' ) . '</a>';
	}
}

// Add scripts via wp_head()
if ( ! function_exists( 'fs_script_enqueuer' ) ) {
	function fs_script_enqueuer() {
		if ( !is_admin() ) {
			wp_enqueue_style('fs_style', get_template_directory_uri() . '/assets/css/style.css', false, null);
			//wp_enqueue_style('fs_style', get_template_directory_uri() . '/assets/css/style.min.css', false, null);

			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', "http" . ( $_SERVER['SERVER_PORT'] == 443 ? "s" : "" ) . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
			wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.6.2.min.js' );
			wp_register_script( 'plugins', get_template_directory_uri() . '/assets/js/plugins.js', array( 'jquery' ), false, true );
			wp_register_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery', 'plugins' ), false, true );
			//wp_register_script( 'main', get_template_directory_uri() . '/assets/js/scripts.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'modernizr' );
			wp_enqueue_script( 'plugins' );
			wp_enqueue_script( 'main' );
		}
	}
}

/* ========================================================================================================================

	Comments

	======================================================================================================================== */

/**
 * Custom callback for outputting comments
 */
function fs_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?>
		<?php if ( $comment->comment_approved == '1' ): ?>
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
}



// Actions and filters
add_action( 'after_setup_theme', 'fs_setup' );

add_action( 'widgets_init', 'fs_register_sidebars' );

add_action( 'init', 'fs_register_menus' );

add_filter( 'excerpt_length', 'fs_excerpt_length' );

add_filter( 'excerpt_more', 'fs_excerpt_more' );

add_action( 'wp_enqueue_scripts', 'fs_script_enqueuer' );