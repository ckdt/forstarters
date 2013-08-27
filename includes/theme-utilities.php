<?php

/**
* Print array
* @param array $a "Array to print"
* */

function fs_print_a( $a ) {
	print( '<pre>' );
	print_r( $a );
	print( '</pre>' );
}

/**
* Include multiple template parts
* @param array $parts "Array with url to template part"
* */

function fs_get_template_parts( $parts = array() ) {
	foreach ( $parts as $part ) {
		get_template_part( $part );
	};
}

/**
* Get page ID from path
* @param string $path "URL to get ID from"
* */

function fs_get_page_id_from_path( $path ) {
	$page = get_page_by_path( $path );
	if ( $page ) {
		return $page->ID;
	} else {
		return null;
	};
}

/**
* Get category ID from name
* @param string $cat_name "Category name"
* */

function fs_get_category_id( $cat_name ) {
	$term = get_term_by( 'name', $cat_name, 'category' );
	return $term->term_id;
}

/**
* Check post type
* @param string $type "Post type"
* */

function fs_is_post_type( $type ) {
	global $wp_query;
	if ( $type == get_post_type( $wp_query->post->ID ) ) {
		return true;
	} else {
		return false;
	}
}

/**
* Get attached images.
*
* @param string $size "Thumbnail size"
* @param string $ID "Post ID"
* @param boolean $exclude "Exclude featured image"
* @param boolean $html "Return img tags"
*
* @return array $results
**/

function fs_get_image_attachments( $size = 'thumbail', $ID, $exclude = true, $html = true ) {
	$featured_image_id = get_post_thumbnail_id( $ID );
	$args = array(
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'numberposts' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_parent' => $ID,
		'exclude' => $exclude ? $featured_image_id : ''
		);
	$images = get_posts( $args );
	$results = array();
	if ( $images ) {
		foreach ( $images as $image ) {
			if ( $html ) {
				$results[] = wp_get_attachment_image( $image->ID, $size );
			} else {
				$results[] = wp_get_attachment_image_src( $image->ID, $size );
			}
		}
	}
	return $results;
}

/**
* Get featured image path
* @param string $size "Thumbnail size"
* */

function fs_get_featured_image_src( $size ) {
	global $post;
	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $size);
	return $featured_image[0];
}

/**
* Embed video
* @param string $url "Youtube or Vimeo URL" 
* */

function fs_video_embed( $url ){
	if (strpos($url, 'youtube') > 0) {
		return fs_embed_youtube( $url );	
	} elseif (strpos($url, 'vimeo') > 0) {
		return fs_embed_vimeo( $url );
	} else {
		return null;
	}
}

/**
* Return Youtube iframe
* @param string $url "Youtube URL" 
* */

function fs_embed_youtube( $url ){
	$id = fs_get_youtube_id( $url );
	$output = '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$id.'?rel=0" frameborder="0" allowfullscreen></iframe>'.PHP_EOL;
	return $output;
}

/**
* Return Youtube video ID
* @param string $url "Youtube URL" 
* */

function fs_get_youtube_id( $url ){
	preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches );
	return $matches[0];
}

/**
* Return Vimeo iframe
* @param string $url "Vimeo URL" 
* */

function fs_embed_vimeo( $url ){
	$id = fs_get_vimeo_id( $url );
	$output = '<iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'.PHP_EOL;
	return $output;
}

/**
* Return Vimeo video ID
* @param string $url "Vimeo URL" 
* */

function fs_get_vimeo_id( $url ){
	$regex = '~
		# Match Vimeo link and embed code
		(?:<iframe [^>]*src=")?         	# If iframe match up to first quote of src
		(?:                             	# Group vimeo url
				https?:\/\/             	# Either http or https
				(?:[\w]+\.)*            	# Optional subdomains
				vimeo\.com              	# Match vimeo.com
				(?:[\/\w]*\/videos?)?   	# Optional video sub directory this handles groups links also
				\/                      	# Slash before Id
				([0-9]+)                	# $1: VIDEO_ID is numeric
				[^\s]*                  	# Not a space
		)                               	# End group
		"?                              	# Match end quote if part of src
		(?:[^>]*></iframe>)?            	# Match the end of the iframe
		(?:<p>.*</p>)?                  	# Match any title information stuff
		~ix';
	preg_match( $regex, $url, $matches );
	return $matches[1];
}

/**
* Convert string to slug format
* @param string $string "String to convert" 
* */

function fs_to_slug($string){
	return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}


/**
 * Register additional oEmbed providers
 * 
 */
function register_additional_oembed_providers() {
	wp_oembed_add_provider( 'http://www.mixcloud.com/*', 'http://www.mixcloud.com/oembed' );
}
add_action( 'init', 'register_additional_oembed_providers' );

