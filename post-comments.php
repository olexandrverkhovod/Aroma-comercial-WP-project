<div id="userCommentHolder" class="clearfix comment">
	<?php


    $sendBtnText = 'Send';
    $leaveReply = 'Send comments';
    $name = 'Name';
    $commentText = 'Comment';
    $commentNone = 'No comments';



    $postid = get_the_id();
    $paged1 = (get_query_var('paged')) ? get_query_var('paged') : 1;
    //Gather comments for a specific page/post
    $comments = get_comments(array(
        'post_id' => $postid,
        'number' => 1,
        'status' => 'approve' //Change this to the type of comments to be displayed
    ));

    if ( $comments ) { ?>
        

        <ul class="userCommentList">
            <?php

            //Display the list of comments
             wp_list_comments(array(
                'reverse_top_level' => false, //Show the latest comments at the top of the list
                'callback' => 'mytheme_comment2'
            ), $comments);  ?>

        </ul>


    <?php } else {
        echo '<h3 class="comments-counter-holder comments-none">'.$commentNone.'</h3>';
    }

    ?>
</div>

<div class="clear"></div>

<div id="commentForm_wrapper" class="cmt-form">
    <?php
	echo '<div class="row">';
	
		$args = array(
			'title_reply' => '',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'label_submit' => $sendBtnText,
			'fields' => apply_filters(
				'comment_form_default_fields', array(
					'author' =>'<label class="col-md-6 col-sm-12" for="author"><h3>'.$name.'</h3><p class="comment-form-author form-group"><input id="author" placeholder="'.$name.'" name="author" type="text" value="' .esc_attr( $commenter['comment_author'] ).'" size="30"'.$aria_req.' /></p></label>',
					'email'  => '<label class="col-md-6 col-sm-12" for="email"><h3>Email</h3><p class="comment-form-email form-group">' . '<input id="email" placeholder="'.__('name@gmail.com', 'va_layouts').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ).'" size="30"/></p></label>'
				)
			),
			'comment_field' => '<label class="col-xs-12" for="comment"><h3>'.$commentText.'</h3><p class="comment-form-comment form-group"><textarea id="comment" name="comment" placeholder="" aria-required="true"></textarea></p></label><div class="clear"></div>'
			);
	
		comment_form( $args, $postid );

     echo '</div>';
    ?>
</div>