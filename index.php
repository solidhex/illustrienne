<?php
	get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				} ?>
				<?php echo $count; ?>
				<?php echo get_post_meta( $post->ID, 'incr_number', true ); ?>
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

    <?php endwhile; ?>
		<?php posts_nav_link('','','&laquo; Previous Entries') ?>
		<?php posts_nav_link('','Next Entries &raquo;','') ?>
	<?php else : ?>

    	<!-- The very first "if" tested to see if there were any Posts to -->
    	<!-- display.  This "else" part tells what do if there weren't any. -->
    	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>


    	<!-- REALLY stop The Loop. -->
    <?php endif; ?>

	</div><!-- eof #main -->
	
	<aside role="complementary">
		
		<?php get_template_part( 'partials/social' ); ?>
				
		<?php if ( is_active_sidebar ('sidebar') ): ?>
			<?php dynamic_sidebar( 'sidebar' ); ?>
		<?php endif ?>
		
		<form action="<?php echo home_url( '/' ); ?>" method="get" class="search-form">
			<input type="search" name="s" value="<?php echo get_search_query() ?>" />
		</form>
		
		<?php if ( is_active_sidebar ('ads') ): ?>
			<?php dynamic_sidebar( 'ads' ); ?>
		<?php endif ?>
				
		<section class="favorites">
			<h2>gallery of favorites</h2>
		
			<div>
				
			<?php
			
				$args = array(
					'post_type' => 'post',
					'meta_query' => array(
						array(
							'key' => 'featured_post',
							'value' => '1'
						)
					)
				 );
				 
				 $posts = get_posts( $args );
				 
				 if ( $posts ) :
			?>
			
			<ul>
			
			<?php foreach ( $posts as $post ): ?>
				<li>
					<figure>
						<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
						<figcaption>
							<section>
								<div class="isbn">
									<span class="no">No</span> <span class="separator">/</span> <span class="issue"><?php echo get_post_meta( $post->ID, 'incr_number', true ); ?></span>
								</div>
							</section>
						</figcaption>
					</figure>
					<h3><?php echo wp_trim_words( $post->post_title, 7, '' ); ?></h3>
				</li>
			<?php endforeach ?>
			
			</ul>
			
			<?php endif; ?>
				
			</div>
		</section>
		
	</aside>
</div><!-- eof #container -->

<?php get_footer(); ?>