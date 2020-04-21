<?php

/***************************************************************
 * Custom Post Types
 ***************************************************************/

/* Offers */
/*add_action('init', 'fb_register_cpt_site_settings');
function fb_register_cpt_site_settings() {
  $labels = array(
    'name' => __('Site Settings'),
    'menu_name' => __('Site Settings'),
    'singular_name' => __('Site Setting'),
    'add_new_item' => __('Add New Site Setting'),
    'edit_item' => __('Edit Site Setting'),
    'new_item' => __('New Site Setting'),
    'view_item' => __('View Site Setting'),
    'search_items' => __('Search Site Settings'),
    'not_found' => __('No Site Settings found'),
    'not_found_in_trash' => __('No Site Settings found in Trash'),
  );
  $args = array(
    'labels' => $labels,
    'supports' => array(
      'title',
      'revisions'
    ),
    'rewrite' => array(
      'slug' => 'site-settings',
      'with_front' => false
    ),
    'capability_type' => 'post',
    'menu_position' => 20, // after Pages
    'menu_icon' => 'dashicons-star-filled', // https://developer.wordpress.org/resource/dashicons/#tagcloud
    'hierarchical' => false,
    'public' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'can_export' => true,
    'taxonomies' => array(
      'category',
      'post_tag'
    )
  ); 
  register_post_type( 'fb__site_settings' , $args );
}*/
