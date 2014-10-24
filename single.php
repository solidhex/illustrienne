<?php
/**
 * The Template for displaying all single posts
 */

get_header(); ?>

	<?php
		// start the loop
		while ( have_posts() ) : the_post();
		
		get_template_part( 'content' );
		
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template( '/partials/comments.php' );
		}
	?>
		
		<div class="post-nav">
			<?php previous_post_link( '%link', '« previous' ); ?>
			<?php next_post_link( '%link', 'next »' );  ?>
		</div>
		
	<?php 	
		endwhile;
	?>

	<?php get_sidebar(); ?>

</div><!-- eof #container -->

<?php get_footer(); ?>