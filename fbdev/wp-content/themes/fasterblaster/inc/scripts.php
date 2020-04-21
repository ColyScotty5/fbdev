<?php

/***************************************************************
 * Handle the custom scripts
 ***************************************************************/
function theme_scripts(){
  
  wp_deregister_script('jquery'); // removes jquery from the header (remove if causing issues, it was only moved to footer for page speed

  function prefix_add_footer_styles() {
    $belowFoldCSS = '/css/below-fold.css';
    if( file_exists(dirname(__FILE__) . '/../' . $belowFoldCSS) ) {
      $belowFoldCSSMtime = filemtime(dirname(__FILE__) . '/../' . $belowFoldCSS);
      wp_enqueue_style(
        'main-styles',
        get_template_directory_uri() . $belowFoldCSS,
        false,
        $belowFoldCSSMtime,
        'all'
      );
    }
  };
  add_action( 'get_footer', 'prefix_add_footer_styles' );

  // Google Fonts
  wp_enqueue_style( 'google-fonts', $src = 'https://fonts.googleapis.com/css2?family=Quando&display=swap', 'main-styles', $ver = false, $media = 'all' );

  $belowFoldJS = '/js/main.min.js';
  if( file_exists(dirname(__FILE__) . '/../' . $belowFoldJS) ) {
    $belowFoldJSMtime = filemtime(dirname(__FILE__) . '/../' . $belowFoldJS);
    wp_register_script(
      'main-js',
      get_template_directory_uri() . '/js/main.min.js',
      false,
      $belowFoldJSMtime,
      true
    );
    wp_enqueue_script('main-js');
  }
}
add_action('wp_enqueue_scripts', 'theme_scripts', 100);
