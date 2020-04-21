<?php

/***************************************************************
 * Remove the main content from pages because we're using ACF
 ***************************************************************/
function remove_editor() {
  remove_post_type_support( 'page', 'editor' );
}
add_action('init', 'remove_editor');


/***************************************************************
 * Register Menus
 ***************************************************************/
if ( function_exists('register_nav_menus') ) {
  function register_theme_menus() {
    register_nav_menus(
      array(
        'primary_navigation' => __('Primary Navigation'),
        'footer_navigation'  => __('Footer Navigation')
      )
    );
  }
  add_action( 'init', 'register_theme_menus' );
}


// Custom styles for admin area
add_action('admin_head', '_customACFStyles');
function _customACFStyles() {
  if ( is_admin() ) {
    $outputHTML = '<style type="text/css">';
    $outputHTML .= '  .acf-flexible-content .layout:nth-child(even) {';
    $outputHTML .= '    background-color: #faf9f5;';
    $outputHTML .= '  }';
    $outputHTML .= '  .acf-flexible-content .layout .acf-fc-layout-handle {';
    $outputHTML .= '    color: #fff;';
    $outputHTML .= '    background-color: #444;';
    $outputHTML .= '    padding: 10px;';
    $outputHTML .= '  }';
    $outputHTML .= '  .acf-flexible-content .layout .acf-fc-layout-controls .acf-icon.-plus,';
    $outputHTML .= '  .acf-flexible-content .layout .acf-fc-layout-controls .acf-icon.-minus {';
    $outputHTML .= '    visibility: visible !important;';
    $outputHTML .= '  }';
    $outputHTML .= '</style>';
    echo $outputHTML;
  }
}


/***************************************************************
 * Remove width and height attributes from post thumbnails
 ***************************************************************/
add_filter( 'post_thumbnail_html', 'remove_thumbnail_width_height', 10, 5 ); 
function remove_thumbnail_width_height( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


/***************************************************************
 * Remove admin bar on live site to prevent being cached in cloudflare
 * This can be removed if you're not caching full html in cloudflare
 ***************************************************************/
// if( isset($_ENV) && isset($_ENV['VSRV_ENV']) && $_ENV['VSRV_ENV'] != 'DEV' ) {
  show_admin_bar(false);
// }



/***************************************************************
 * CUSTOM MCE SETTINGS - Custom Classes for Wordpress WYSIWYG
 ***************************************************************/
function wpb_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');
function mce_additional_formats( $init_array ) {
  $style_formats = array(
    array(
      'title' => 'Headings',
      'items' => array(
        array(
          'title' => 'Heading 1',
          'selector' => '',
          'classes' => 'h1',
        ),
        array(
          'title' => 'Heading 2',
          'selector' => '',
          'classes' => 'h2',
        ),
        array(
          'title' => 'Heading 3',
          'selector' => '',
          'classes' => 'h3',
        ),
        array(
          'title' => 'Heading 4',
          'selector' => '',
          'classes' => 'h4',
        ),
        array(
          'title' => 'Heading 5',
          'selector' => '',
          'classes' => 'h5',
        ),
        array(
          'title' => 'Heading 6',
          'selector' => '',
          'classes' => 'h6',
        ),
        array(
          'title' => 'Stylized Heading',
          'selector' => 'h1,h2,h3,h4,h5,h6',
          'classes' => 'styled-heading',
        ),
      ),
    ),
    // array(
    //   'title' => 'Lists',
    //   'items' => array(
    //     array(
    //       'title' => 'List (Basic)',
    //       'selector' => 'ul,ol',
    //       'classes' => 'list-basic',
    //     ),
    //   ),
    // ),
    array(
      'title' => 'Buttons',
      'items' => array(
        array(
          'title' => 'Orange Text Button',
          'selector' => 'a',
          'classes' => 'btn, btn--plain-text, btn--brand-orange',
        )
      ),
    ),
    array(
      'title' => 'Text Colors',
      'items' => array(
        array(
          'title' => 'Brand Orange',
          'inline' => 'span',
          'selector' => 'p, li',
          'classes' => 'text--brand_orange'
        ),
        array(
          'title' => 'Brand Blue',
          'inline' => 'span',
          'selector' => 'p, li',
          'classes' => 'text--brand_blue'
        ),
        array(
          'title' => 'Dark gray',
          'inline' => 'span',
          'selector' => 'p, li',
          'classes' => 'text--dark_gray'
        )
      ),
    ),
  );
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );
  return $init_array;
}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'mce_additional_formats' );


/***************************************************************
 * Removing unnecessary WP Head stuff
 * ref: https://bhoover.com/remove-unnecessary-code-from-your-wordpress-blog-header/
 ***************************************************************/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');


/***************************************************************
 * Removing emojis
 ***************************************************************/
function disable_wp_emojicons() {
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );

  // Remove the DNS prefetch by returning false on filter emoji_svg_url
  add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}


/***************************************************************
* Disable WordPress Update Notifications and Plugin Update Notifications
***************************************************************/
function remove_core_updates(){
  global $wp_version;
  return(object) array(
    'last_checked'=> time(),
    'version_checked'=> $wp_version
  );
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');


/***************************************************************
* General Settings page
***************************************************************/
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' => 'General Settings Page',
    'menu_title' => 'General Settings',
    'menu_slug' => 'general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}


/***************************************************************
* Editor Style Sheet
***************************************************************/
add_editor_style( 'css/editor.css' );


/***************************************************************
* Add Options page to Admin bar
***************************************************************/
/*function fb_settings_menu_admin_bar() {
  global $wp_admin_bar;
  $wp_admin_bar->add_node(array(
    'id' => 'general-settings-options',
    'title' => 'General Settings',
    'href' => admin_url().'/admin.php?page=general-settings'
  ));
}
add_action( 'wp_before_admin_bar_render', 'fb_settings_menu_admin_bar' );*/


/***************************************************************
* Remove Ancient Custom Fields metabox
* From : https://9seeds.com/2016/08/17/wordpress-admin-post-editor-performance/
***************************************************************/
function fb_remove_post_custom_fields_metabox() {
  foreach ( get_post_types( '', 'names' ) as $post_type ) {
    remove_meta_box( 'postcustom' , $post_type , 'normal' );
  }
}
add_action( 'admin_menu' , 'fb_remove_post_custom_fields_metabox' );
