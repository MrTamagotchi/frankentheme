<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<?php // Favicons start here ?>
			<?php // Generate Favicons + HTML at https://realfavicongenerator.net/ ?>
		<?php // Favicons end here ?>

		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
		
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<?php // the update notice is shown if the browser is IE9 or below ?>
		<?php echo get_template_part( 'modules/update-notice' ); ?>

		<div class="wrapper" class="hfeed">
			<header class="header" role="banner">
				<section class="header__branding">
					
				</section>

				<nav class="main-nav" role="navigation">
					<?php bem_menu( 'main-menu', 'main-menu' ); ?>
				</nav>
			</header>