<?php get_header(); ?>
<main>
	<?php if ( have_posts() ) : ?>
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<?php
			the_archive_title( '<h1 class="headline-large">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
		?>
		<ol class="list-disc">
			<?php query_posts( $query_string . '&orderby=title&order=ASC' ); while ( have_posts() ): the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				- <span>作成日 : <time><?php the_time( get_option( 'date_format' ) ); ?></time></span>
				- <span>更新日 : <time><?php the_modified_date(); ?></time></span>
				- <span>投稿者 : <?php the_author(); ?></span>
			</li>
			<?php endwhile; wp_reset_query(); ?>
		</ol>
	</article>
	<?php endif; ?>
</main>
<?php get_footer(); ?>
