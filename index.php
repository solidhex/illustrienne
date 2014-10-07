<?php
	get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				} ?>
				
				<header class="entry-header">
					<?php if ( is_single() ) : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php else : ?>
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
					<?php endif; // is_single() ?>					
				</header>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				
			</article>
    <?php endwhile; else : ?>

    	<!-- The very first "if" tested to see if there were any Posts to -->
    	<!-- display.  This "else" part tells what do if there weren't any. -->
    	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>


    	<!-- REALLY stop The Loop. -->
    <?php endif; ?>

	</div><!-- eof #main -->
	<aside role="complementary">
		<?php if ( is_active_sidebar ('sidebar') ): ?>
			<?php dynamic_sidebar( 'sidebar' ); ?>
		<?php endif ?>
	</aside>
</div><!-- eof #container -->

<footer>
	<section>
		<span class="sosumi">
			&copy; <?php echo date( 'Y' ); ?> The Illustrienne. All Rights Reserved.
		</span>
	</section>
</footer>

<?php
   /* Always have wp_footer() just before the closing </body>
    * tag of your theme, or you will break many plugins, which
    * generally use this hook to reference JavaScript files.
    */
    wp_footer();
?>

</body>
</html>