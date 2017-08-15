<?php get_header(); ?>
<main>
	<?php if ( have_posts() ) : ?>
	<header class="page-header">
		<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header>
	<?php query_posts( $query_string . '&orderby=title&order=ASC' ); while ( have_posts() ): the_post(); ?>
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
		<div class="entry-meta">
			<span>作成日 : <time><?php the_time( get_option( 'date_format' ) ); ?></time></span>
			<span>更新日 : <time><?php the_modified_date(); ?></time></span>
			<?php if ( has_tag() ) : ?>
			<span>タグ : <?php echo '#'; the_tags( '', ' #' ); ?></span>
			<?php endif; ?>
			<span>投稿者 : <?php the_author(); ?></span>
		</div>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</article>
	<?php
		endwhile;
		wp_reset_query();
		endif;
	?>
</main>
<?php get_footer(); ?>
