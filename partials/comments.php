<div id="comments">

		
	<?php if ( have_comments() ): ?>
		<section>
			<h1>comments</h1>
			<ul>
				<?php wp_list_comments( array( 'callback' => 'illustrienne_comment' ) ); ?>
			</ul>
		</section>
	<?php endif ?>
	
	<?php 
	
		$comment_args = array(
		    'title_reply'       => __( 'leave a comment' ),
	        'comment_field' => '<p class="comment-form-comment">' . 
			'<textarea id="comment" name="comment" placeholder="Comment*" aria-required="true"></textarea></p>',
			'comment_notes_before' => '',
			'comment_notes_after' => '<p class="comment_notes_after">Required fields marked *</p>',
		    'label_submit'      => __( 'submit' ),
			'fields' => apply_filters( 'comment_form_default_fields', array(

			    'author' =>
			      '<p class="comment-form-author">' .
			      '<input id="author" name="author" placeholder="Name*" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			      '" size="30"' . $aria_req . ' /></p>',

			    'email' =>
			      '<p class="comment-form-email">' .
			      '<input id="email" name="email" type="text" placeholder="Email Address*" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			      '" size="30"' . $aria_req . ' /></p>',

			    'url' =>
			      '<p class="comment-form-url">' .
			      '<input id="url" name="url" placeholder="Website (optional)" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			      '" size="30" /></p>'
			    )
			  )
		);

		comment_form( $comment_args ); 
	?>
</div>