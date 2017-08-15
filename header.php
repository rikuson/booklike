<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="page">
<header class="site-header">
	<?php if ( is_home() || is_front_page() ): ?>
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<p class="site-description"><?php bloginfo( 'description' ); ?></p>
	<?php
		elseif ( is_archive() ) :
		the_archive_title( '<h1 class="archive-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
	?>
	<?php
		elseif ( is_single() ) :
		echo '<h1 class="post-title">' . get_the_title() . '</h1>';
	?>
	<?php endif; ?>
	<?php if ( get_header_image() ): ?>
	<figure class="custom-header-image">
		<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
	</figure>
	<?php endif; ?>
</header>
<div class="site-content">
