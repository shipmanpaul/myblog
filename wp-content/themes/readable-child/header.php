<?php
/**
 * The Header for Readable Theme
 *
 * @package Readable
 */

$navbar_position = get_theme_mod( 'navbar_position', 'static' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
	<!-- <link href="assets/icomoon/style.css" rel="stylesheet"> -->
	<!-- W3TC-include-js-head -->
	<?php wp_head(); ?>
	<!-- W3TC-include-css -->
</head>

<body <?php body_class(); ?>>
<!-- W3TC-include-js-body-start -->

	<!-- Search - Open panel -->
	<div class="search-panel">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-panel__close  js--toggle-search-mode" title="<?php esc_html_e( 'Exit the search mode', 'readable' ); ?>"><i class="glyphicon glyphicon-remove"></i></a>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<form action="<?php echo home_url( '/' ); ?>">
						<input type="text" class="search-panel__form  js--search-panel-text" name="s" placeholder="<?php esc_html_e( 'Begin typing for search', 'readable' ); ?>">
						<p class="search-panel__text"><?php esc_html_e( 'Press enter to see results or esc to cancel.', 'readable' ); ?></p>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="page-content-container"><!-- ends in the footer.php -->
		<!-- header -->
		<header class="header <?php echo ( 'static' === $navbar_position ) ? '' : ' header--sticky '; ?> push-down-45">
			<div class="container">
				<div class="logo  pull-left">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php
							$logo   = get_theme_mod( 'logo_img', false );
							$logo2x = get_theme_mod( 'logo2x_img', false );

							if ( ! empty( $logo ) ) :
						?>
							<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" srcset="<?php echo esc_url( $logo ); ?><?php echo empty( $logo2x ) ? '' : ', ' . esc_url( $logo2x ) . ' 2x'; ?>" />
						<?php
							else :
						?>
							<h1 class="blog-name"><?php bloginfo( 'name' ); ?></h1>
						<?php
							endif;
						?>
					</a>
				</div>

				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#readable-navbar-collapse">
						<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'readable' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<nav class="navbar  navbar-default" role="navigation">

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse  navbar-collapse" id="readable-navbar-collapse">
						<?php
							if ( has_nav_menu( 'main-menu' ) ) {
								wp_nav_menu( array(
									'theme_location' => 'main-menu',
									'container'      => false,
									'menu_class'     => 'navigation'
								) );
							}
						?>
					</div><!-- /.navbar-collapse -->
				</nav>
				<a href="https://numnu.com" target="_blank" rel="noopener"class="visit-website-link hidden-sm hidden-xs"> Visit Numnu.com </a>
					</div><!-- /.navbar-collapse -->
				</nav>
			</div>
		</header>