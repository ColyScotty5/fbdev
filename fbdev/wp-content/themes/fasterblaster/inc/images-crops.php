<?php

/***************************************************************
 * Setup featured images and custom image sizes
 ***************************************************************/
function fb_image_crops() {
  add_theme_support( 'post-thumbnails' );

  set_post_thumbnail_size( 250, 200, true );

  add_image_size( "Full Size Hero", 1920, 736, true );
  add_image_size( "Full Size Hero Mobile", 360, 555, true );
  add_image_size( "Circle Content Image", 412, 412, true );
  add_image_size( "Image Card", 628, 510, true );
  add_image_size( "Image Card Mobile", 312, 290, true );
}
add_action( 'after_setup_theme', 'fb_image_crops' );

/***************************************************************
 * Set default JPG image compression
 ***************************************************************/
function custom_jpg_compression($args) { return 80; }
add_filter('jpeg_quality', 'custom_jpg_compression');
