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
<nav class="page-nav">
	<?php if ( is_archive() ) : ?>
	<div class="breadcrumbs">
		<a href="<?php bloginfo('url'); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php
			$cats = get_the_category();
			foreach ( $cats as $cat ) {
				if ( $cat->category_parent ) {
					echo '&gt;&nbsp;';
					echo mb_substr( get_category_parents( $cat->parent, true, '&nbsp;&gt;&nbsp;' ), 0, -16 );
				}
			}
		?>
	</div>
	<?php elseif ( is_single() ) : $cats = get_the_category(); foreach ( $cats as $cat ) : ?>
	<div class="breadcrumbs">
		<a href="<?php bloginfo('url'); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php
			echo '&gt;&nbsp;';
			echo mb_substr( get_category_parents( $cat->term_id, true, '&nbsp;&gt;&nbsp;' ), 0, -16 );
		?>
	</div>
	<?php endforeach; endif; ?>
	<?php qtranxf_generateLanguageSelectCode(); ?>
</nav>
<header class="site-header">
	<?php if ( is_home() || is_front_page() ): ?>
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<!-- TODO: bloginfo('description')自体を変更すればもう少しスマートかも -->
	<?php
		if ( $desc = get_bloginfo( 'description' ) ){
			echo "<p class=\"site-description\">{$desc}</p>";
		}
	?>
	<div class="tag-cloud"><?php wp_tag_cloud(); ?></div>
	<?php
		elseif ( is_archive() ) :
		the_archive_title( '<h1 class="archive-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		elseif ( is_single() ) :
	?>
	<h1 class="post-title"><?php the_title(); ?></h1>
	<div class="tag-cloud"><?php the_tags('', ' ') ?></div>
	<?php endif; if ( get_header_image() ) : ?>
	<figure class="custom-header-image">
		<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
	</figure>
	<?php endif; ?>
</header>
<div class="site-content">
