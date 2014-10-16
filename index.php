<?php
	get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				} ?>

				<header class="entry-header">
					
					<div class="isbn">
						<span class="no">No.</span> <span class="separator">/</span> <span class="issue"><?php echo get_post_meta( $post->ID, 'incr_number', true ); ?></span>
					</div>
					
					<?php if ( is_single() ) : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php else : ?>
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
					<?php endif; // is_single() ?>
					<?php
						$parent_id = '';
						foreach ( get_the_category() as $cat ) {
							if ( $cat->category_parent == 0 ) {
								$parent_id = $cat->cat_ID;
					?>
								<h2 class="main-cat"><a href="<?php echo get_category_link( $parent_id ); ?>"><?php echo $cat->name; ?></a></h2>
					<?php 
								break;
							}
						}
					?>
					
				</header>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				
				<?php if ( has_block('Shop The Post' ) ): ?>
					<div class="shop-the-post">
						<h2 class="sub-title">Shop the Post</h2>
						<?php the_block( 'Shop The Post' ); ?>
					</div>
				<?php endif ?>
				
				<div class="share">
					<h2 class="sub-title">Share</h2>
					<a href="#" class="fb"></a><a href="#" class="twitter"></a><a href="#" class="pinterest"></a><a href="#" class="tumblr"></a>
				</div>
				
				<div class="comments-link">
					<a href="<?php comments_link(); ?>">leave a comment  /  <?php comments_number( 'no comments', '1 comment', '% comments' ); ?></a>
				</div>
				
				<p class="posted">
					<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'F n, Y' ); ?></time>
					<span class="post-cats">
					<?php
						$cats = get_the_category();
						$subcats = array();
						$i = 0;
						
						// filter our sub categories
						foreach ( $cats as $cat ) {
							if ( cat_is_ancestor_of( $parent_id, $cat->cat_ID )) {
								array_push( $subcats, $cat->cat_ID );
							}
						}
						
						foreach ( $subcats as $subcat_id ) {
							$separator = ( count( $subcats ) - 1 == $i) ? '' : ', ' ;
							echo '<a href="' . get_category_link( $subcat_id) .'">' . get_cat_name( $subcat_id ) .'</a>' . $separator;
							$i++;
						}
						
					?>
					</span>
				</p>
				
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
					<a href="<?php echo get_permalink( $post->ID ); ?>">
						<figure>
							<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
								<figcaption>
									<section>
										<div class="isbn">
											<span class="no">No.</span> <span class="separator">/</span> <span class="issue"><?php echo get_post_meta( $post->ID, 'incr_number', true ); ?></span>
										</div>
									</section>
								</figcaption>
							</figure>
					<h3><?php echo wp_trim_words( $post->post_title, 7, '' ); ?></h3></a>
				</li>
			
			<?php endforeach ?>
			
			</ul>
			
			<?php endif; ?>
				
			</div>
		</section>
		
	</aside>
</div><!-- eof #container -->

<?php get_footer(); ?>