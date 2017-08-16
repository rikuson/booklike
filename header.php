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
	<?php elseif ( is_archive() ) : ?>
	<div class="breadcrumbs">
		<a href="<?php bloginfo('url'); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php
			$cat = get_the_category();
			$cat = $cat[0];
			if ( $cat->category_parent ) {
				echo '&nbsp;&gt;&nbsp;';
				echo get_category_parents($cat->term_id, true, '&nbsp;&gt;&nbsp;');
			}
		?>
	</div>
	<?php
		the_archive_title('<h1 class="archive-title">', '</h1>');
		the_archive_description( '<div class="archive-description">', '</div>' );
	?>
	<?php elseif ( is_single() ) : ?>
	<?php $cats = get_the_category(); foreach ( $cats as $cat ) : ?>
	<div class="breadcrumbs">
		<a href="<?php bloginfo('url'); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php
			if ( $cat->category_parent ) {
				echo '&nbsp;&gt;&nbsp;';
				echo get_category_parents($cat->term_id, true, '&nbsp;&gt;&nbsp;');
			}
			echo '&nbsp;&gt;&nbsp;';
			echo '<a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>';
		?>
	</div>
	<?php endforeach; ?>
	<h1 class="post-title"><?php echo get_the_title(); ?></h1>
	<?php endif; ?>
	<?php if ( get_header_image() ): ?>
	<figure class="custom-header-image">
		<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
	</figure>
	<?php endif; ?>
</header>
<div class="site-content">
