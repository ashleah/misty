<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans|Kaushan+Script' rel='stylesheet' type='text/css'>
  <?php if ( get_header_image() ) : ?>
    <style type="text/css">
      #masthead {
        background-image: url('<?php header_image(); ?>');
      }
    </style>
  <?php endif; // End header image check. ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-71746033-1', 'auto');
    ga('send', 'pageview');

  </script>
  <script type="text/javascript" src="//wow.zamimg.com/widgets/power.js"></script><script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>
</head>

<body <?php body_class(); ?> data-whatinput-formtyping>
<div class="off-canvas-wrapper">
	<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<div class="off-canvas position-left" id="offCanvas" data-off-canvas>

			<?php if( has_nav_menu('primary') ) :

					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-menu',
					 ) );

			endif;	?>

		</div>
		<div class="off-canvas-content" data-off-canvas-content>

<div id="page" class="site">
	<div class="site-inner">

    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header" role="banner">

			<div class="site-header-main">

				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

			</div><!-- .site-header-main -->
		</header><!-- .site-header -->

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<button id="off-canvas-toggle" data-toggle="offCanvas"><?php _e( 'Menu', 'twentysixteen' ); ?></button>

			<div id="site-header-menu" class="site-header-menu">
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Primary Menu', 'twentysixteen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
							 ) );
						?>
					</nav><!-- .main-navigation -->
				<?php endif; ?>

			</div><!-- .site-header-menu -->
		<?php endif; ?>

		<div id="content" class="site-content">
			<?php if( is_front_page() && is_home() && is_twitch_online() ) : ?>
				<div class="stream-video">
					<iframe
							src="http://player.twitch.tv/?channel=<?php echo get_theme_mod('twitch_profile'); ?>&autoplay=false"
							frameborder="0"
							scrolling="no"
							height="720"
							width="100%"
							autoplay="0"
							allowfullscreen>
					</iframe>
				</div>
			<?php endif; ?>
