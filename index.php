<?php
	get_header();
?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content' ); ?>
    <?php endwhile; ?>
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
			<div class="post-nav">
				<?php previous_posts_link( '« previous' ) ?>
				<?php next_posts_link( 'next »' ); ?>
			</div>
		<?php endif; ?>
	<?php else : ?>

    	<!-- The very first "if" tested to see if there were any Posts to -->
    	<!-- display.  This "else" part tells what do if there weren't any. -->
    	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>


    	<!-- REALLY stop The Loop. -->
    <?php endif; ?>
	
	<?php get_sidebar(); ?>
</div><!-- eof #container -->

<?php get_footer(); ?>