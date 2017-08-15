<?php
/*
 * TODO: ログファイルに更新情報を記録するようにする
 */
?>
<?php get_header(); ?>
<main>
	<?php
		// カテゴリをキーにして並び替える
		$posts_order_by_category = array();
		while (have_posts()) {
			the_post();
			$formated_post = array(
				'link' => get_the_permalink(),
				'title' => get_the_title(),
				'status' => '作成',
				'date' => get_the_time(get_option('date_format')),
				'timestamp' => get_the_time('U')
			);
			$categories = get_the_category();
			foreach ($categories as $category) {
				$posts_order_by_category[$category->term_id][] = $formated_post;
				// 記事更新の場合は記事作成とは別にパースする
				if (get_the_time('U') !== get_the_modified_time('U')) {
					$formated_post['status'] = '更新';
					$formated_post['date'] = get_the_modified_date();
					$formated_post['timestamp'] = get_the_modified_time('U');
					$posts_order_by_category[$category->term_id][] = $formated_post;
				}
			}
		}
		wp_reset_query();

		function sortByTimestamp($a, $b){
			return $b['timestamp'] - $a['timestamp'];
		}

		foreach ($posts_order_by_category as $cat_ID => $posts) :
	?>
	<h2>
		<?php
			$cat_name = get_the_category_by_ID($cat_ID);
			$cat_link = get_category_link($cat_ID);
			echo '<a href="' . $cat_link . '">' . $cat_name . '</a>';
		?>
	</h2>
	<ul>
		<?php
			usort($posts, 'sortByTimestamp');
			foreach ($posts as $post) :
		?>
		<li><?php echo $post['date']; ?> - <?php echo $post['status']; ?> - <a href="<?php echo $post['link']; ?>" rel="bookmark"><?php echo $post['title']; ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php endforeach; ?>
</main>
<?php get_footer(); ?>
