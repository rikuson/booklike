<?php get_header(); ?>
<main>
	<?php if ( have_posts() ) : ?>
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<ol>
			<?php query_posts( $query_string . '&posts_per_page=-1' ); while ( have_posts() ): the_post(); ?>
			<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
			<?php endwhile; wp_reset_query(); ?>
		</ol>
	</article>
	<?php endif; ?>
</main>
<?php get_footer(); ?>
