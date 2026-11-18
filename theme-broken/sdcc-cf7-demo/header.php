<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
	<div class="wrap">
		<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">Pixel<span>Forge</span></a>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => 'nav',
			'container_class' => 'main-nav',
		) );
		?>
	</div>
</header>
