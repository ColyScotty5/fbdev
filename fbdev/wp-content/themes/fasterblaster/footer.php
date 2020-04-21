<?php

// Grab General Settings data
$phone_number    = get_field( 'phone_number', 'option' );
$email_address   = get_field( 'email_address', 'option' );
$address         = get_field( 'address', 'option' );
$google_maps_url = get_field( 'google_maps_url', 'option' );
$instagram_url   = get_field( 'instagram_url', 'option' );

?>

    <section class="quote-callout section-padding">
      <div class="container">
        <h3 class="h1">Want to Hire Us?</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi amet quam ipsum maxime repellendus.</p>
        <div class="btn--row btn--center">
          <button href="/contact-us/" class="btn btn--primary" title="Request a Quote from Us">Request a Quote</button>
        </div>
      </div>
    </section>

    <footer class="section-padding main-footer" role="footer">
      <div cass="container row no-gutters">
        <div class="main-footer__footer-nav col-xs-12">
          <?php wp_nav_menu( array( 'menu' => 'Footer Navigation' ) ); ?>
        </div>
        <div class="main-footer__contact-info col-xs-12">
          <div class="row">
            <?php if ( $phone_number ) { ?>
            <a href="<?php echo 'tel:+1' . $phone_number; ?>" title="Contact Us by Phone"><span class="icon icon--phone"></span><?php echo $phone_number ?></a>
            <?php } ?>
            <?php if ( $email_address ) { ?>
            <a href="<?php echo 'mailto:' . $email_address; ?>" title="Contact Us by Email"><span class="icon icon--email"></span>Email Us</a>
            <?php } ?>
            <?php if ( $instagram_url ) { ?>
            <a href="<?php echo $instagram_url; ?>" title="Follow Us on Instagram"><span class="icon icon--instagram"></span>Instagram</a>
            <?php } ?>
          </div>
          <div class="row">
            <?php if ( $address && $google_maps_url ) { ?>
            <a href="<?php echo $google_maps_url; ?>" target="_blank" title="View Our Location on Google Maps"><span class="icon icon--map"></span><?php echo $address ?></a>
            <?php } ?>
          </div>
        </div>
        <div class="main-footer__copyright col-xs-12">
          <p>&copy; Copyright <?php echo date('Y'); ?> O&rsquo;Brien&rsquo;s Faster Blaster Mobile Wash Ltd. All Rights Reserved</p>
        </div>
      </div>
		</footer>

		<?php wp_footer(); ?>

	</div><!-- END .site-wrap -->
</body>
</html>