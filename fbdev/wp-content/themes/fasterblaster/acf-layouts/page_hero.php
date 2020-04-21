<?php

global $post;

$layoutnum = $data['layout_num'];

// Grab ACF field data
$hero_images  = get_sub_field( 'hero_images' ); // Repeater
$hero_heading = get_sub_field( 'hero_heading' ); // Text
$hero_button  = get_sub_field( 'buttons' ); // Clone

$section_class = 'page-layout-' . $layoutnum . ' page-hero';

if ( !empty( $hero_images ) ) {

?>

<section class="<?php echo esc_attr( $section_class ); ?>">
  <div class="page-hero__image-carousel-container<?php echo count( $hero_images ) > 1 ?  ' swiper-container' : ''; ?>">
    <div class="page-hero__image-carousel-wrapper<?php echo count( $hero_images ) > 1 ?  ' swiper-wrapper' : ''; ?>"><?php foreach ( $hero_images as $hero_image ) { ?>
      <picture class="page-hero__image-slide<?php echo count( $hero_images ) > 1 ?  ' swiper-slide' : ''; ?>">
        <source srcset="<?php echo $hero_image['hero_image']['sizes']['Full Size Hero']; ?>" media="(min-width: 1280px)">
        <img class="res-img" srcset="<?php echo esc_url( $hero_image['hero_image']['sizes']['Full Size Hero Mobile'] ); ?>" alt="<?php echo esc_attr( $hero_image['hero_image']['alt'] ); ?>">
      </picture>
      <?php } ?>
    </div>
  </div>
  <?php if ( count( $hero_images ) > 1 ) { ?>
  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  <?php } ?>
  <div class="image-shadow-overlay"></div>
  <div class="page-hero__content row no-gutters">
    <?php if ( $hero_heading !== '' ) { ?>
    <h1><?php echo $hero_heading; ?></h1>
    <?php } ?>
    <?php if ( !empty( $hero_button ) && function_exists( 'fb_buttons' ) ) { ?>
    <?php fb_buttons( $hero_button ) ?>
    <?php } ?>
  </div>
</section>

<?php } ?>
