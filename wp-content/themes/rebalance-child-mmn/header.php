<?php
/**
 * The Rebalance header
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rebalance
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<?php set_header_background(); ?>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'rebalance' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="col-width header-wrap">
			<?php $header_image = get_header_image();
				if ( ! empty( $header_image ) ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header-image-link" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" class="site-header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="" />
				</a>
			<?php } ?>
			<div class="site-heading">
				<div class="site-branding">
					<?php rebalance_site_logo(); ?>
					<?php custom_site_title(); ?>
				</div><!-- .site-branding -->
				<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location'  => 'social',
						'depth'           => 1,
						'container_class' => 'social-menu-wrap',
						'menu_class'      => 'social-menu',
						'link_before'     => '<span>',
						'link_after'      => '</span>'
					) ); ?>
				</nav><!-- #social-navigation -->
				<?php endif; ?>
			</div><!-- .site-heading -->
		</div>
		<div class="col-width sub-header-wrap">

			<?php $description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?>
					<br>
					<br>
					<a class="donate_style" href="/donate/">DONATE</a>
					<a class="donate_style" href="https://lahmacun.hu/shows/mmn-radio" target="_blank">RADIO</a>
					<br>
					<br>
					<a class="emguide_membership_logo_large_screen" href="https://emgui.de" target="_blank">
						<img src = "<?php echo get_stylesheet_directory_uri();?>/images/emguide_logo_member_text.png" alt="EM GUIDE" width="50%">
					</a>
					<a class="emguide_membership_logo_small_screen" href="https://emgui.de" target="_blank">
						<img src = "<?php echo get_stylesheet_directory_uri();?>/images/emguide_logo.png" alt="EM GUIDE" width="50%">
					</a>
				</p>
			<?php endif; ?>



			<?php if ( has_nav_menu( 'header' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="header-menu" aria-expanded="false" data-close-text="<?php esc_attr_e( 'Close', 'rebalance' ); ?>"><?php esc_html_e( 'Menu', 'rebalance' ); ?></button>
				<?php wp_nav_menu( array(
					'theme_location' => 'header',
					'menu_id'        => 'header-menu'
				) ); ?>
<!--				<div>
					<div class="menu-main-container">
						<ul id="header-menu" class="menu">
							<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="bla">hol</a></li>
						</ul>
					</div>
				</div> -->
			</nav><!-- #site-navigation -->
			<?php endif; ?>
		</div><!-- .col-width -->
	</header><!-- #masthead -->

	<div id="content" class="site-content clear">
		<div class="col-width">
