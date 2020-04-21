<?php

global $post;

$layoutnum = $data['layout_num'];

// Grab ACF field data
$image_cards = get_sub_field( 'image_cards' ); // Repeater

$section_class = 'page-layout-' . $layoutnum . ' image-cards';

if ( count( $image_cards ) == 2 ) {

?>

<section class="<?php echo esc_attr( $section_class ); ?>">
  <div class="container row">
    <?php foreach( $image_cards as $image_card ) { ?>
    <div class="image-cards__card col-xs-12 col-lg-6">
      <div class="image-cards__card-content">
        <?php if ( $image_card['card_heading'] ) { ?>
        <h3><?php echo $image_card['card_heading']; ?></h3>
        <?php } ?>
        <?php if ( !empty( $image_card['buttons'] ) && function_exists( 'fb_buttons' ) ) { ?>
        <?php fb_buttons( $image_card['buttons'] ) ?>
        <?php } ?>
      </div>
      <div class="image-shadow-overlay"></div>
      <picture>
        <source srcset="<?php echo $image_card['card_image']['sizes']['Image Card']; ?>" media="(min-width: 1180px)">
        <img class="res-img" srcset="<?php echo esc_url( $image_card['card_image']['sizes']['Image Card Mobile'] ); ?>" alt="<?php echo esc_attr( $image_card['card_image']['alt'] ); ?>">
      </picture>
    </div>
    <?php } ?>
  </div>
</section>

<?php

}
