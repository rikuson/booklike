<?php
/*
 * project   : OD Base
 * file name : archive.php
 * created   : 2017/06/18
 */
?>
<?php get_header(); ?>
	<main id="primary" class="content-area">
		<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>
		<?php while ( have_posts() ): the_post(); ?>
		<?php
			// カテゴリー名をリンクなしで取得したい場合
			$cat = get_the_category();
			$cat = $cat[0];
			// 出力はline.30
		?>
		<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<div class="entry-meta">
				<span class="date">投稿日 : <?php the_time( get_option( 'date_format' ) ); ?></span>
				<span class="category">カテゴリー : <?php if ( $cat ) { echo esc_html( $cat->name ); } // カテゴリー名（リンクなし）を表示 ?></span>
				<span class="categori-links">カテゴリー : <?php the_category( '、' ); ?></span>
				<span class="tag-links">タグ : <?php the_tags( '', '、' ); ?></span>
				<span class="author">投稿者 : <?php the_author(); ?></span>
			</div>
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
			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
		</article>
		<?php
			endwhile;
			
			/*
			 * デフォルトのページ送りを出力
			 * wp-pagenaviなどページネーションプラグインを利用する場合には削除もしくは分岐
			 */
			the_posts_navigation();
			
			endif;
		?>
	</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>