<?php

global $post;

get_header();

$passthrough = array();
$passthrough['layout_num'] = 0;

// Fetch submitted form data (category ID)
$selectedCategorySlug = get_query_var('offer-category', '');
if ( $selectedCategorySlug == '' ) {
  $selectedCategorySlug = 'seasonal-packages';
} else if ( $selectedCategorySlug == '' ) {
  $selectedCategorySlug = 'all';
} else {
  $selectedCategorySlug = $selectedCategorySlug;
}

// Check if ACF is installed and loop through custom flex layouts
if( function_exists('has_sub_field') ):
  while (has_sub_field('page_layouts')) : // Loop through Flexible Content
    ACF_Layout::render(get_row_layout(), $passthrough);
      $passthrough['layout_num']++;
  endwhile;
endif;

?>

<div class="offer-filters bg--lighter_gray">
  <div class="container row no-gutters">
    <div class="offer-filters__filters col-xs-12 justify-content-md-start">
      <div class="offer-filters__filter-label">Filter Offers</div>
      <form action="/offers/" enctype="multipart/form-data" method="POST" name="offers-filter-form" id="offers-filter-form">
        <div class="row no-gutters align-items-xs-center">
          <div class="col-xs-12 justify-content-xs-center justify-content-md-start">
            <select name="offer-category" id="offer-category">
              <?php
              /* if ( !empty( $offers_cat_query ) ) {
                echo '<option value="view_all">View All</option>';
            
                foreach ( $offers_cat_query as $offer_cat ) {
                  $cat_value = strtolower( $offer_cat );
                  $cat_value = str_replace(' ', '-', $cat_value );
                  echo '<option value="' . $cat_value . '">' . $offer_cat . '</option>';
                }
              } */
              ?>
              <option<?php echo $selectedCategorySlug == 'seasonal-packages' ? ' selected' : '';?> value="seasonal-packages">Seasonal Packages</option>
              <option<?php echo $selectedCategorySlug == 'dining-packages' ? ' selected' : '';?> value="dining-packages">Dining Packages</option>
              <option<?php echo $selectedCategorySlug == 'discount-offers' ? ' selected' : '';?> value="discount-offers">Discount Offers</option>
              <option<?php echo $selectedCategorySlug == 'family-packages' ? ' selected' : '';?> value="family-packages">Family Packages</option>
              <option<?php echo $selectedCategorySlug == 'golf-packages' ? ' selected' : '';?> value="golf-packages">Golf Packages</option>
              <option<?php echo $selectedCategorySlug == 'romance-packages' ? ' selected' : '';?> value="romance-packages">Romance Packages</option>
              <option<?php echo $selectedCategorySlug == 'all' ? ' selected' : '';?> value="all">View All</option>
            </select>
          </div>
          <div class="btn--row col-xs-12 justify-content-xs-center justify-content-md-start">
            <input class="btn btn--solid-gold" value="Apply" type="submit" id="offer-filters__filter-submit" />
          </div>
        </div>
      </form>
    </div>
    <?php /*<div class="offer-filters__search col-xs-12 col-md-6 justify-content-md-end">
      <form class="pr" action="" method="" name="offers-search">
        <i class="icon icon--search-winter-green pa"></i>
        <input type="text" name="offer-search-term" placeholder="Offer Search" id="offer-search-term" />
      </form>
    </div>*/ ?>
  </div>
</div>

<section class="section-padding offers-grid">
  <div class="container">
    <?php

    // Get today's date
    $todays_date = getdate();
    $todays_date_timestamp = $todays_date[0];

    if ( $selectedCategorySlug != 'all' ) {
      $offer_args = array(
        'post_type'      => 'woodlands_offers',
        'post_status'    => 'publish',
        'order'          => 'ASC',
        'orderby'        => 'menu_order',
        'posts_per_page' => -1,
        'category_name'  => $selectedCategorySlug
      );
    } else {
      $offer_args = array(
        'post_type'      => 'woodlands_offers',
        'post_status'    => 'publish',
        'order'          => 'ASC',
        'orderby'        => 'menu_order',
        'posts_per_page' => -1
      );
    }

    $offer_query = new WP_Query( $offer_args );

    // The Loop
    if ( $offer_query->have_posts() ) {

      echo '<div class="row card-style-ctas justify-content-xs-center">';

      while ( $offer_query->have_posts() ) {

        $offer_query->the_post();

        // Fetch ACF field data
        $offer_img              = get_field( 'offer_image', $post->ID );
        $offer_cta_copy         = get_field( 'offer_cta_copy', $post->ID );
        $booking_link           = get_field( 'booking_link', $post->ID );
        $terms_copy             = get_field( 'terms_copy', $post->ID );
        $does_this_offer_expire = get_field( 'does_this_offer_expire', $post->ID );

        $offer_expiry_date;

        if ( $does_this_offer_expire == 1 ) {
          $offer_expiry_date = strtotime(get_field( 'offer_expiry_date', $post->ID ));
        }

        // only display offers if they've not expired
        if ( $does_this_offer_expire == 0 || (isset( $offer_expiry_date ) && $offer_expiry_date >= $todays_date_timestamp) ) {

        ?>
        <div<?php echo $selectedCategorySlug != '' ? ' data-catslug="' . $selectedCategorySlug . '"' : ''; ?> class="card-style-cta col-xs-12 col-md-6 col-lg-4">
          <div class="card-style-cta__image">
            <a href="<?php echo get_permalink( $post->ID ); ?>" title="View Offer <?php echo get_the_title(); ?>">
              <img src="<?php echo $offer_img['sizes']['Card Style CTAs']; ?>" alt="<?php echo $offer_img['alt']; ?>">
            </a>
          </div>
          <div class="card-style-cta__mask"></div>
          <div class="card-style-cta__content">
            <div class="card-style-cta__copy">
              <h4 class="h3">
                <a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
              </h4>
              <p><?php echo $offer_cta_copy ?></p>
            </div>
            <div class="card-style-cta__button btn--row">
              <a class="btn btn--text-only-gold" href="<?php echo get_permalink( $post->ID ); ?>" title="View Offer <?php echo get_the_title(); ?>">View Offer <i class="icon icon--chevron-right-gold"></i></a>
              <?php if ( $booking_link != '' ): ?>
              <a href="<?php echo esc_url( $booking_link ); ?>" class="btn btn--text-only-dark-gray all-caps" title="Book Now!">Book Now <i class="icon icon--chevron-right-dark_gray"></i></a>
              <?php endif ?>
            </div>
          </div>
        </div><?php } // END if: expired event
      } ?>
      </div>
      <?php
    } else {
      echo '<h3>No offers to show at this time</h3>';
    }
    wp_reset_postdata();

    ?>
  </div>
</section>

<!-- Flexible Content -->
<?php

get_footer();
