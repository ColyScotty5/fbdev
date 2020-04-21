<?php

global $post;

$layoutnum = $data['layout_num'];

// Grab ACF field data
$heading = get_sub_field( 'heading' ); // Text
$copy    = get_sub_field( 'copy' ); // WYSIWYG
$image   = get_sub_field( 'image' ); // Image
$buttons = get_sub_field( 'buttons' ); // Clone

$section_class = 'page-layout-' . $layoutnum . ' content-round-image section-padding';

if ( $heading !== '' && $copy !== '' ) {

?>

<section class="<?php echo esc_attr( $section_class ); ?>">
  <div class="container row">
    <div class="content-round-image__content col-xs-12 col-lg-6">
      <?php if ( $heading ) { ?>
      <h2><?php echo $heading; ?></h2>
      <?php } ?>
      <?php if ( $copy ) { ?>
      <?php echo $copy; ?>
      <?php } ?>
      <?php if ( !empty( $buttons ) && function_exists( 'fb_buttons' ) ) { ?>
      <?php fb_buttons( $buttons ) ?>
      <?php } ?>
    </div>
    <?php if ( $image ) { ?>
    <div class="content-round-image__image col-xs-12 col-lg-6">
      <picture>
        <img class="res-img" srcset="<?php echo esc_url( $image['sizes']['Circle Content Image'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
      </picture>
    </div>
    <?php } ?>
  </div>
</section>

<?php

}
