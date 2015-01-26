	</div><!-- eof #main -->
	
	<aside role="complementary">
		
		<?php 
			get_template_part( 'partials/social' ); 
		?>
		
		<div class="rss">
			SUBSCRIBE VIA <a href="<?php bloginfo( 'rss2_url' ) ?>" target="_blank">RSS</a>
		</div>
				
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
					'posts_per_page' => 10,
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
		
		<section class="linkage">
			<h3 class="trigger categories">Categories</h3>
		
			<ul>
				<?php wp_list_categories( array( 'title_li' =>  '', 'depth' => -1 ) ); ?>
			</ul>
		
			<h3 class="trigger archives">the archives</h3>
		
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?>
			</ul>
		
			<h3 class="trigger daily-reads sub-title">Daily Reads</h3>
		
			<?php wp_nav_menu( array( 'menu' => 210, 'container' => false ) ); ?>
		</section>
		
	</aside>