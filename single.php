<?php get_header(); ?>
<main id="primary" class="content-area">
	<?php while ( have_posts() ): the_post(); ?>
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( has_post_thumbnail() ): ?>
			<figure class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</figure>
			<?php 
				/* else:
				 * サムネイルがない場合に挿入する画像を指定
				 * その際にはfigureの位置を再考せよ
				*/
			?>
			<?php endif; ?>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<footer class="entry-footer">
			<div class="entry-meta">
				<span class="created-at">作成 : <time><?php the_time( get_option( 'date_format' ) ); ?></time></span>
				<span class="updated-at">更新 : <time><?php the_modified_time( get_option( 'date_format' ) ); ?></time></span>
				<span class="category-links">カテゴリー : <?php the_category( '、' ); ?></span>
				<span class="tag-links">タグ : <?php the_tags( '', '、' ); ?></span>
				<span class="author">投稿者 : <?php the_author(); ?></span>
			</div>
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
