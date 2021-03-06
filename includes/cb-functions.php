<?php
function fs_register_toolbar( $toolbars ) {
	// Uncomment to view format of $toolbars
	$toolbars['Minimal' ] = array();
	$toolbars['Minimal' ][1] = array('bold' , 'italic' , 'underline', 'link', 'unlink' );
	
	/*if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}*/
	// remove the 'Basic' toolbar completely
	//unset( $toolbars['Basic' ] );
	return $toolbars;
}

function fs_chapter_index(){
	global $post;
	$chapters = array();

	$cb = get_field('content_blocks');
	foreach ($cb as $block) {
		if($block['acf_fc_layout'] == 'chapter'){
			array_push($chapters, $block['chapter_title']);
		}
	}

	$output = '<ol class="chapter-index">';
	foreach ($chapters as $chapter) {
		$output .= '<li><a href="#'.fs_to_slug($chapter).'">'.$chapter.'</a></li>';
	}
	$output .= '</ol>';

	echo $output;
}

add_filter( 'acf/fields/wysiwyg/toolbars', 'fs_register_toolbar' );


/*
function custom_field_excerpt() {
	global $post;
	$text = get_field('summary');
	return apply_filters('the_excerpt', $text);
}



function yoast_add_description( $str ) {

	global $post;
	$text = get_field('summary');

  return $text;
}
add_filter( 'wpseo_metadesc', 'yoast_add_description', 10, 1 );
*/

?>