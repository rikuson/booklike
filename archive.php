<?php get_header(); ?>
<main>
	<?php if ( have_posts() ) : ?>
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
		<ol>
			<?php
				// TODO: 孫カテゴリまでは未対応
				$term_children = get_term_children($cat, 'category');
				$prev_term_id = null;
				query_posts( $query_string . '&orderby=menu_order&order=ASC&posts_per_page=-1' );
				while ( have_posts() ) :
				the_post();
				$categories = get_the_category();
				foreach ( $categories as $category ) {
					if ( $category->term_id !== $prev_term_id ) {
						if ( in_array( $prev_term_id, $term_children ) ) {
							echo '</ol>';
						}
						if ( in_array( $category->term_id, $term_children ) ) {
							echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
							echo '<ol>';
						}
						$prev_term_id = $category->term_id;
					}
				}
			?>
			<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
			<?php endwhile; wp_reset_query(); ?>
		</ol>
	</article>
	<?php endif; ?>
</main>
<?php get_footer(); ?>
