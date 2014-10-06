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
}

add_action( 'widgets_init', 'illustrienne_widgets' );

?>