<?php
/*
 * TODO: ログファイルに更新情報を記録するようにする
 */
?>
<?php global $translations; get_header(); ?>
<main>
	<?php
		// カテゴリをキーにして並び替える
		$posts_order_by_category = array();
		query_posts('posts_per_page=-1');
		$i = 0;
		while (have_posts()) : the_post(); if ( $i === 0 ) :
	?>
	<div class="latest-content">
		<h2><?php echo $translations['Latest Article']; ?></h2>
		<?php if ( has_post_thumbnail() ): ?>
		<figure class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('full'); ?></a>
		</figure>
		<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<div class="entry-excerpt"><?php the_excerpt(); ?></div>
		<?php endif; ?>
	</div>
	<h2><?php echo $translations['Category']; ?></h2>
	<?php
		endif;
		$categories = get_the_category();
		foreach ( $categories as $category ) {
			$formated_post = array(
				'link' => get_the_permalink(),
				'title' => get_the_title(),
				'status' => $translations['Create'],
				'date' => get_the_time(get_option('date_format')),
				'timestamp' => get_the_time('U')
			);
			if(count($posts_order_by_category[$category->term_id]) < 5){
				$posts_order_by_category[$category->term_id][] = $formated_post;
			}
			// 記事更新の場合は記事作成とは別にパースする
			if (get_the_time('U') !== get_the_modified_time('U')) {
				$formated_post['status'] = $translations['Update'];
				$formated_post['date'] = get_the_modified_time(get_option('date_format'));
				$formated_post['timestamp'] = get_the_modified_time('U');
				if(count($posts_order_by_category[$category->term_id]) < 5){
					$posts_order_by_category[$category->term_id][] = $formated_post;
				}
			}
		}
		$i++;
		endwhile;
		wp_reset_query();

		function sortByTimestamp($a, $b){
			return $b['timestamp'] - $a['timestamp'];
		}

		foreach ($posts_order_by_category as $cat_ID => $order_posts) :
	?>
	<h3 class="category-list-title">
<?php
			$cat_name = get_the_category_by_ID($cat_ID);
		$cat_link = get_category_link($cat_ID);
		echo '<a href="' . $cat_link . '">' . $cat_name . '</a>';
?>
	</h3>
	<ul class="category-list">
		<?php
			usort($order_posts, 'sortByTimestamp');
			foreach ($order_posts as $order_post) :
		?>
		<li><?php echo $order_post['date']; ?> <?php echo $order_post['status']; ?> <a href="<?php echo $order_post['link']; ?>" rel="bookmark"><?php echo $order_post['title']; ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php endforeach; ?>
</main>
<?php get_footer(); ?>
