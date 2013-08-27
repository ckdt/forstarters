<?php

function fs_register_customposts() {
  $labels = array(
    'name' => 'People',
    'singular_name' => 'Person',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Person',
    'edit_item' => 'Edit Person',
    'new_item' => 'New Person',
    'all_items' => 'All People',
    'view_item' => 'View Person',
    'search_items' => 'Search People',
    'not_found' =>  'No People found',
    'not_found_in_trash' => 'No People found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'People'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'people' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 

  register_post_type( 'people', $args );
}
add_action( 'init', 'fs_register_customposts' );

?>