</div>
<footer class="site-footer">
	<?php dynamic_sidebar( 'footer' ); ?>
	<div class="copyright">
		<p>©Copyright <a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'title' ); ?></a><?php if ( get_bloginfo( 'description' ) ): ?> | <?php bloginfo( 'description' ); endif; ?>. All Rights Reserved.</p>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
