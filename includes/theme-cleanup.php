<?php

/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 */
function fs_head_cleanup() {
	// Originally from http://wpengineer.com/1438/wordpress-header/
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );

	add_filter( 'use_default_gallery_style', '__return_null' );
}

add_action( 'init', 'fs_head_cleanup' );

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter( 'the_generator', '__return_false' );

/**
 * Clean up language_attributes() used in <html> tag
 *
 * Change lang="en-US" to lang="en"
 * Remove dir="ltr"
 */
function fs_language_attributes() {
	$attributes = array();
	$output = '';

	if ( function_exists( 'is_rtl' ) ) {
		if ( is_rtl() == 'rtl' ) {
			$attributes[] = 'dir="rtl"';
		}
	}

	$lang = get_bloginfo( 'language' );

	if ( $lang && $lang !== 'en-US' ) {
		$attributes[] = "lang=\"$lang\"";
	} else {
		$attributes[] = 'lang="en"';
	}

	$output = implode( ' ', $attributes );
	$output = apply_filters( 'fs_language_attributes', $output );

	return $output;
}

add_filter( 'language_attributes', 'fs_language_attributes' );

/**
 * Clean up output of stylesheet <link> tags
 */
function fs_clean_style_tag( $input ) {
	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	// Only display media if it's print
	$media = $matches[3][0] === 'print' ? ' media="print"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

add_filter( 'style_loader_tag', 'fs_clean_style_tag' );

/**
 * Add and remove body_class() classes
 */
function fs_body_class( $classes ) {
	// Add post/page slug
	if ( is_single() || is_page() && !is_front_page() ) {
		$classes[] = basename( get_permalink() );
	}

	// Remove unnecessary classes
	$home_id_class = 'page-id-' . get_option( 'page_on_front' );
	$remove_classes = array(
		'page-template-default',
		$home_id_class
	);
	$classes = array_diff( $classes, $remove_classes );

	return $classes;
}

add_filter( 'body_class', 'fs_body_class' );

/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 */
function fs_remove_default_description( $bloginfo ) {
	$default_tagline = 'Just another WordPress site';

	return ( $bloginfo === $default_tagline ) ? '' : $bloginfo;
}

add_filter( 'get_bloginfo_rss', 'fs_remove_default_description' );

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
function fs_nice_search_redirect() {
	if ( is_search() && strpos( $_SERVER['REQUEST_URI'], '/wp-admin/' ) === false && strpos( $_SERVER['REQUEST_URI'], '/search/' ) === false ) {
		wp_redirect( home_url( '/search/' . str_replace( array( ' ', '%20' ), array( '+', '+' ), urlencode( get_query_var( 's' ) ) ) ), 301 );
		exit();
	}
}

add_action( 'template_redirect', 'fs_nice_search_redirect' );

/**
 * Fix for get_search_query() returning +'s between search terms
 */
function fs_search_query( $escaped = true ) {
	$query = apply_filters( 'fs_search_query', get_query_var( 's' ) );

	if ( $escaped ) {
		$query = esc_attr( $query );
	}

	return urldecode( $query );
}

add_filter( 'get_search_query', 'fs_search_query' );

/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 */
function fs_request_filter( $query_vars ) {
	if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
		$query_vars['s'] = ' ';
	}

	return $query_vars;
}

add_filter( 'request', 'fs_request_filter' );

/**
 * Flush rewrite rules when activating theme to get permalinks to work with registered custom post types
 */
function fs_rewrite_flush() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'fs_rewrite_flush' );

?>
