<?php

get_header();

$passthrough = array();
$passthrough['layout_num'] = 0;

// Check if ACF is installed and loop through custom flex layouts
if( function_exists('has_sub_field') ):
  while (has_sub_field('page_layouts')) : // Loop through Flexible Content
    ACF_Layout::render(get_row_layout(), $passthrough);
      $passthrough['layout_num']++;
  endwhile;
endif;

get_footer();
