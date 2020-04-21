<?php

global $post;

// $current_day = date('d-m-Y');
// $current_day = date("l",strtotime($current_day));

// Grab General Settings data
$phone_number  = get_field( 'phone_number', 'option' );
$instagram_url = get_field( 'instagram_url', 'option' );

?>
<!doctype html>
<!--[if IE 9 ]><html lang="en" class="ie9 lt-ie10 lt-ie11"> <![endif]-->
<!--[if IE 10 ]><html lang="en" class="ie10 lt-ie11"> <![endif]-->
<!--[if gt IE 10 ]><html lang="en" class="ie11"> <![endif]-->
<!--[if !(IE)]><!--><html id="front" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php wp_title('|', true, 'right'); ?></title>
	
	<?php wp_head(); ?>

	<link rel="apple-touch-icon" href="/content/themes/base/ios-icon.png">
  <!--[if IE]><link rel="shortcut icon" href="/content/themes/base/favicon.ico"><![endif]-->
  <link rel="shortcut icon" href="/content/themes/base/favicon.png?v3">

  <!-- <link rel="dns-prefetch" href="//www.googletagmanager.com"> -->
  <link rel="dns-prefetch" href="//cloud.typography.com">
  <!-- <link rel="dns-prefetch" href="//www.opentable.com"> -->
  <!-- <link rel="dns-prefetch" href="//www.tcgms.net"> -->

	<?php $aboveFoldCSS = dirname(__FILE__).'/css/above-fold.css'; ?>
	<?php if( file_exists($aboveFoldCSS) ) : ?>
		<?php $aboveFoldCSSContents = file_get_contents($aboveFoldCSS); ?>
		<style media="screen" type="text/css"><?php echo $aboveFoldCSSContents; ?></style>
	<?php endif; ?>
	
</head>
<body <?php body_class(); ?>>

	<a class="skip-to-link" href="#main-navigation">Skip to main navigation</a>
	<a class="skip-to-link" href="#main-content">Skip to main content</a>
			
	<header class="main-header" role="banner"></header>

	<div class="site-wrap">

			<header class="main-header" role="header">
				<div class="container">
					<div class="row middle-xs apart-xs">
					
						<div class="main-header__logo col-xs-6">
							<?php if ( $post->ID !== 2 ) { ?>
							<a href="/" title="Return to Homepage"><img class="res-img" src="<?php echo get_template_directory_uri() . '/img/obriens-faster-blaster-mobile-wash-halifax-dartmouth-nova-scotia.jpg'; ?>" alt="O'Brien's Faster Blaster Mobile Wash" /></a>
							<?php } else { ?>
							<img class="res-img" src="<?php echo get_template_directory_uri() . '/img/obriens-faster-blaster-mobile-wash-halifax-dartmouth-nova-scotia.jpg'; ?>" alt="O'Brien's Faster Blaster Mobile Wash" />
							<?php } ?>
						</div>
					
						<div class="mobile-nav-toggle col-xs-6 end-xs">
							<button type="button" aria-expanded="false" aria-controls="mobile-nav"><span>menu</span></button>
						</div>

						<div hidden id="mobile-nav" aria-expanded="false" class="main-header__mobile-nav col-xs-12">
							<?php wp_nav_menu( array( 'menu' => 'Main Navigation' ) ); ?>
							<ul class="mobile-utility">
								<?php if ( $phone_number !== "" ) { ?>
								<li><a aria-label="Contact us by phone" href="<?php echo 'tel:+1' . $phone_number; ?>" title="Contact Us by Phone"><span aria-hidden="true" class="icon icon--phone"></span><?php echo $phone_number; ?></a></li>
								<?php } ?>
								<?php if ( $instagram_url !== "" ) { ?>
								<li><a aria-label="Follow us on Instagram" href="<?php echo esc_url( $instagram_url ); ?>" title="Follow Us on Instagram"><span aria-hidden="true" class="icon icon--instagram"></span>Instagram</a></li>
								<?php } ?>
							</ul>
						</div>

						<div class="main-header__nav-wrap col-xs-6">
					
							<div class="main-header__main-nav">
								<?php wp_nav_menu( array( 'menu' => 'Main Navigation' ) ); ?>
							</div>
					
							<div class="main-header__utility-nav">
								<ul>
									<?php if ( $phone_number !== "" ) { ?>
									<li><a aria-label="Contact us by phone" href="<?php echo 'tel:+1' . $phone_number; ?>" title="Contact Us by Phone"><span aria-hidden="true" class="icon icon--phone"></span><?php echo $phone_number; ?></a></li>
									<?php } ?>
									<?php if ( $instagram_url !== "" ) { ?>
									<li><a aria-label="Follow us on Instagram" href="<?php echo esc_url( $instagram_url ); ?>" title="Follow Us on Instagram"><span aria-hidden="true" class="icon icon--instagram"></span>Instagram</a></li>
									<?php } ?>
								</ul>
							</div>
					
						</div>
					
					</div>
				</div>
			</header>
