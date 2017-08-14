<?php
	get_header();
?>
<main>
	<?php
		$categories = get_categories();
		foreach ($categories as $category) :
	?>
	<h2><?php echo $category->name; ?></h2>
	<ul>
		<?php
			$query = array(
				'cat' => $category->term_id,
				'orderby' => 'modified'
			);
			query_posts($query);
			while (have_posts()) :
			the_post();
			$status = '';
			$date = '';
			if (get_the_time('U') === get_the_modified_time('U')) {
				$status = '作成';
				$date = get_the_time(get_option('date_format'));
			} else {
				$status = '更新';
				$date = get_the_modified_date();
			}
		?>
		<li><?php echo $date; ?> - <?php echo $status; ?> - <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
		<?php endwhile; wp_reset_query(); ?>
	</ul>
	<?php endforeach; ?>
</main>
<?php get_footer(); ?>
