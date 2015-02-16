<?php

/**
 * Remove Admin bar when Logged In
 */

add_filter('show_admin_bar', '__return_false');

/**
 * Remove WP Meta Generator
 */

remove_action('wp_head', 'wp_generator');

/**
 * Add Theme Support Items
 */

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

/**
 * Get Attached Images Plugin
 */

/**
 * Custom Image Sizes
 * http://codex.wordpress.org/Function_Reference/add_image_size
 */

// add_image_size( 'category-thumb', 300 ); // 300 pixels wide (and unlimited height)
// add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)

function get_attached_images( $args=null )
{
	
	/**
	 * Define the array of defaults
	 */
	
	$defaults = array(
		'pageID' => false,
		'size' => 'thumbnail',
		'single' => false,
		'prepend' => '<figure>',
		'append' => '</figure>',
		'orderby' => 'date',
		'order' => 'DESC',
		'echo' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args, EXTR_SKIP );
	
	$output = "";

	// first check if we've passed in a specific page ID
	if ($pageID != FALSE) {
		$id = $pageID;
	} else {
		global $post;
		$id = $post->ID;
	}
	
	// now, retrieve all the images
	$images = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ));

	// set the counter to prevent undefined variable warning
	$i = 0;
	
	if ($images) {
		if ($echo) {
			foreach ($images as $image) {
				$i++;

				if ($image->post_excerpt) {
					$caption = '<figcaption>' . $image->post_excerpt . '</figcaption>'; 
				} else {
					$caption = '';
				}
			
				$output .= $prepend . wp_get_attachment_image($image->ID, $size) . $caption . $append;
			
				if ($single == TRUE && $i == 1)  break;
			}

			return $output;
		} else {
			return $images;
		}
	} else {
		return false;
	}
}

/**
 * Pull featured image into feed
 */

add_filter( 'the_content', 'featured_image_in_feed' );
function featured_image_in_feed( $content ) {
    global $post;
    if( is_feed() ) {
        if ( has_post_thumbnail( $post->ID ) ){
            $output = get_the_post_thumbnail( $post->ID, 'medium');
            $content = $output . $content;
        }
    }
    return $content;
}

/**
 * Register Widgets
 */

function illustrienne_widgets()
{
	register_sidebar( array( 
		'name' => 'Blog sidebar',
		'id' => 'sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	) );
	
	register_sidebar( array(
		'name' => 'Ads',
		'id' => 'ads',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
}

add_action( 'widgets_init', 'illustrienne_widgets' );

add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="next-post"';
}
function posts_link_attributes_2() {
    return 'class="previous-post"';
}

function updateNumbers() {
    /* numbering the published posts, starting with 1 for oldest;
    / creates and updates custom field 'incr_number';
    / to show in post (within the loop) use <?php echo get_post_meta($post->ID,'incr_number',true); ?>
    / alchymyth 2010 
	/ http://wordpress.stackexchange.com/questions/13083/display-post-number-not-post-id-number
	*/
    global $wpdb;
    $querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts 
                 WHERE $wpdb->posts.post_status = 'publish' 
                 AND $wpdb->posts.post_type = 'post' 
                 ORDER BY $wpdb->posts.post_date ASC";
    $pageposts = $wpdb->get_results($querystr, OBJECT);
    $counts = 0 ;
    if ($pageposts):
    foreach ($pageposts as $post):
        $counts++;
        add_post_meta($post->ID, 'incr_number', $counts, true);
        update_post_meta($post->ID, 'incr_number', $counts);
    endforeach;
endif;
}  

add_action ( 'publish_post', 'updateNumbers', 11 );
add_action ( 'deleted_post', 'updateNumbers' );
add_action ( 'edit_post', 'updateNumbers' );


function illustrienne_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	// echo "<pre>";
	// var_dump($comment);
	// echo "</pre>";
?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<h2 class="author sub-title">
		<?php if ( empty( $comment->comment_author_url )): ?>
			<?php echo $comment->comment_author; ?> <span>said</span>
		<?php else: ?>
			<a href="<?php echo $comment->comment_author_url; ?>" target="_blank"><?php echo $comment->comment_author; ?></a> <span>said</span>
		<?php endif ?>
	</h2>
	<?php if ( $comment->comment_approved == '0' ): ?>
		<em>Your comment is awaiting moderation.</em>
	<?php endif; ?>
	<div class="comment">
		<?php echo $comment->comment_content; ?>
	</div>
	<time datetime="<?php echo date( 'Y-m-d', strtotime( $comment->comment_date ) ); ?>"><?php echo date( 'F n, Y', strtotime( $comment->comment_date ) ); ?></time>


<?php 

}

?>