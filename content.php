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
				
				<footer>
					<div class="share">
						<h2 class="sub-title">Share</h2>
						<a class="fb" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID) ); ?>&amp;t=" target="_blank"></a><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $post->post_title ); ?>&amp;url=<?php echo urlencode( wp_get_shortlink() ); ?>" class="twitter"></a><a href="javascript: void((function()%7Bvar%20e=document.createElement('script'); e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="pinterest"></a><a href="http://www.tumblr.com/share/link?url=<?php echo urlencode( get_permalink( $post->ID) ); ?>&amp;name=<?php the_title(); ?>" class="tumblr" target="_blank"></a>
					</div>
				
					<div class="comments-link sub-title">
						<a href="<?php comments_link(); ?>">leave a comment  /  <?php comments_number( 'no comments', '1 comment', '% comments' ); ?></a>
					</div>
				
					<p class="posted">
						<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'F j, Y' ); ?></time>
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
				</footer>
				
			</article>