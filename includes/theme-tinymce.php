<?php

/**
* Apply styles to the visual editor
*/
add_filter('mce_css', 'fs_mcekit_editor_style');

function fs_mcekit_editor_style( $url ) {
	if ( !empty( $url ) )
		$url .= ',';
		// Retrieves the plugin directory URL
		// Change the path here if using different directories
		$url .= trailingslashit( get_bloginfo('template_directory') ) . '/assets/css/editor-style.css';
		return $url;
}

/**
* Add "Styles" drop-down
*/
add_filter( 'mce_buttons_2', 'fs_mce_editor_buttons' );

function fs_mce_editor_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

/**
* Add styles/classes to the "Styles" drop-down
*/
add_filter( 'tiny_mce_before_init', 'fs_mce_before_init' );

function fs_mce_before_init( $settings ) {

	$style_formats = array(
		array(
			'title' => 'Intro',
			'selector' => 'p',
			'classes' => 'lead'
		),
		array(
			'title' => 'Question',
			'inline' => 'p',
			'classes' => 'question'
		),
		array(
			'title' => 'Name',
			'inline' => 'span',
			'classes' => 'display-name label label-default'
		)
	);
	$settings['style_formats'] = json_encode( $style_formats );
	return $settings;
}

?>