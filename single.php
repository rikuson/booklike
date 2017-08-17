<?php get_header(); ?>
<main class="content-area">
	<?php while ( have_posts() ): the_post(); ?>
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div class="entry-meta">
				<span class="created-at">作成 : <time><?php the_time( get_option( 'date_format' ) ); ?></time></span>
				<span class="updated-at">更新 : <time><?php the_modified_time( get_option( 'date_format' ) ); ?></time></span>
				<span class="author">投稿者 : <?php the_author(); ?></span>
			</div>
			<?php if ( has_post_thumbnail() ): ?>
			<figure class="entry-thumbnail">
				<?php the_post_thumbnail('full'); ?>
			</figure>
			<?php endif; ?>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<footer class="entry-footer">
			<?php
				the_post_navigation(array(
					'prev_text' => '&larr;&nbsp;%title',
					'next_text' => '%title&nbsp;&rarr;'
				));
			?>
		</footer>
	</article>
	<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		
		endwhile;
	
	?>
</main>
<?php get_footer(); ?>
