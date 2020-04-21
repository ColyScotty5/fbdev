<?php

/***************************************************************
 * Content width
 ***************************************************************/
 //$content_width is a global variable used by WordPress for max image upload sizes and media embeds (in pixels).
if (!isset($content_width)) {
  $content_width = 1280;
}


/***************************************************************
 * Print Formatted Arrays
 ***************************************************************/
function _pr( $sourceArray ){
  echo "<pre>";
  print_r( $sourceArray );
  echo "</pre>";
}


/***************************************************************
 * Print Basic Heading with Level
 ***************************************************************/
/*function _heading_with_level( $post_id, $heading_color = null, $layoutnum ){

  // Grab ACF Field Data
  $main_heading       = get_sub_field( 'heading', $post_id ); // Text
  $main_heading_level = get_sub_field( 'heading_level', $post_id ); // Clone

  // Check to see if the heading level has been set
  if ( $main_heading_level == "none" && $layoutnum == 0 ) {
    $heading_level = 'h1';
  } elseif ( $main_heading_level == "none" && $layoutnum >= 1 ) {
    $heading_level = 'h2';
  } else {
    $heading_level = $main_heading_level;
  }

  if ( $main_heading != '' ) { ?>
  <<?php echo $heading_level; ?> class="h1 text--<?php echo esc_attr( $heading_color ); ?>"><?php echo esc_html( $main_heading ); ?></<?php echo $heading_level; ?>><?php }
}*/


/***************************************************************
 * Print Social Icons Links
 ***************************************************************/
/*function _verb_social_links( $icon_color = null ){

  // Grab ACF field data
  $social_channel = get_field( 'social_channel', 'option' ); // Repeater

  if( $social_channel ){ ?>

  <ul class="social-links<?php echo $icon_color == "white" ? ' social-links--white' : ''; ?>">
    <?php foreach( $social_channel as $channel ){ ?>
    <li><a rel="noopener" class="social-links__<?php echo esc_attr(strtolower( $channel['social_channel_name'] )); ?>" href="<?php echo esc_url(strtolower( $channel['social_channel_url'] )); ?>" title="<?php echo esc_attr( $channel['social_channel_name'] ); ?>" target="_blank"><?php echo esc_html( $channel['social_channel_name'] ); ?></a></li>
    <?php } ?>
  </ul>

<?php
  }
}*/


/***************************************************************
 * Custom Buttons Function (ACF)
 ***************************************************************/
function fb_buttons( $button_data ){
  $buttons = $button_data;

  if ( $buttons ) {
    if ( count($buttons) > 1 ) {
      echo '<div class="btn--row">';
      $i = 0;

      foreach ($buttons as $button) {
        switch ( $button['link_type'] ) {
          case 'external':
            $button_link = $button['external_link'];
            $link_target = ' target="_blank"';
            break;
          case 'email':
            $button_link = $button['email_link'];
            $link_target = '';
            break;
          case 'phone':
            $button_link = $button['phone_link'];
            $button_link = str_replace('.', '', $button_link);
            $button_link = str_replace('-', '', $button_link);
            $button_link = 'tel:+' . $button_link;
            $link_target = '';
            break;
          default:
            $button_link = $button['internal_link'];
            $link_target = '';
            break;
        }

        $button_contents = $button['button_text'];

        $button_style_class = "btn btn--" . $buttons[$i]['button_style'];
        echo '<button class="' . $button_style_class . '" href="' . $button_link . '" title="' . $buttons[$i]['button_text'] . '"' . $link_target . '>' . $button_contents . '</button>';
        $i++;
      } // END foreach
      echo '</div>';
    } else {
      switch ( $buttons[0]['link_type'] ) {
        case 'external':
          $button_link = $buttons[0]['external_link'];
          $link_target = ' target="_blank"';
          break;
        case 'email':
          $button_link = $buttons[0]['email_link'];
          $link_target = '';
          break;
        case 'phone':
          $button_link = $buttons[0]['phone_link'];
          $button_link = str_replace('.', '', $button_link);
          $button_link = str_replace('-', '', $button_link);
          $button_link = 'tel:+' . $button_link;
          $link_target = '';
          break;
        default:
          $button_link = $buttons[0]['internal_link'];
          $link_target = '';
          break;
      }

      $button_contents = $buttons[0]['button_text'];

      $button_style_class = "btn btn--" . $buttons[0]['button_style'];
      echo '<div class="btn--row"><button class="' . $button_style_class . '" href="' . $button_link . '" title="' . $buttons[0]['button_text'] . '"' . $link_target . '>' . $button_contents . '</button></div>';
    }
  }
}
