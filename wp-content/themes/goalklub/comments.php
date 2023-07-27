<?php
/**
 * The template for displaying Comment form
 */
 
	global $cs_theme_options;
	if ( comments_open() ) {
		if ( post_password_required() ) return;
	}
?>
<?php if ( have_comments() ) : ?>
<div class="col-md-12">
	<div id="cs-comments">
        
        <div class="cs-section-title"><h2><?php echo comments_number(__('No Comments', 'goalklub'), __('1 Comment', 'goalklub'), __('% Comments', 'goalklub') );?></h2></div>
        <ul>
            <?php wp_list_comments( array( 'callback' => 'cs_comment' ) );	?>
        </ul>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'goalklub') ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'goalklub') ); ?></div>
            </div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'goalklub') ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'goalklub') ); ?></div>
            </div><!-- .navigation -->
        <?php endif; ?>
    </div>
</div>
<?php endif; // end have_comments() ?>
<div class="col-md-12">
	
    <div id="Form" class="cs-classic-form cs_form_styling <?php echo is_user_logged_in() ?'logged_in':'';?>">
		<?php 
        global $post_id;
        $you_may_use = __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'goalklub');
        $must_login = __( 'You must be <a href="%s">logged in</a> to post a comment.', 'goalklub');
        $logged_in_as = __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'goalklub');
        $required_fields_mark = ' ' . __('Required fields are marked %s', 'goalklub');
        $required_text = sprintf($required_fields_mark , '<span class="required">*</span>' );

        $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', 
            array(
                'notes' => '',
                
                'author' => '<p class="comment-form-author">'.
                '<label><i class="icon-profile-male"></i></label>' . __( '', 'goalklub').
                ''.( $req ? __( '', 'goalklub') : '' ) .'<input placeholder="Full Name" id="author"  name="author" class="nameinput" type="text" value=""' .
                esc_attr( $commenter['comment_author'] ) . ' tabindex="1">' .
                '</p><!-- #form-section-author .form-section -->',
                
                'email'  => '<p class="comment-form-email">' .
                '<label><i class=" icon-envelope3"></i></label>'. __( '', 'goalklub').
                ''.( $req ? __( '', 'goalklub') : '' ) .''.
                '<input id="email"  name="email" placeholder="Email Address" class="emailinput" type="text"  value=""' . 
                esc_attr(  $commenter['comment_author_email'] ) . ' size="30" tabindex="2">' .
                '</p><!-- #form-section-email .form-section -->',
                
                'url'    => '<p class="comment-form-Website">' .
                '<label><i class=" icon-laptop2"></i></label>' . __( '', 'goalklub') . '' .
                '<input id="url" name="url" type="text" placeholder="Website" class="websiteinput"  value="" size="30" tabindex="3">' .
                '</p><!-- #<span class="hiddenSpellError" pre="">form-section-url</span> .form-section -->' ) ),
                
                'comment_field' => '<p class="comment-form-comment">'.
                ''.__( '', 'goalklub'). ''.( $req ? __( '', 'goalklub') : '' ) .'' .
                '<label><i class="icon-quote3"></i></label><textarea placeholder="Message" id="comment_mes" name="comment"  class="commenttextarea" rows="4" cols="39"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->',
                
                'must_log_in' => '<p>' .  sprintf( $must_login,	wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
                'logged_in_as' => '<p>' . sprintf( $logged_in_as, admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ),
                'comment_notes_before' => '',
                'comment_notes_after' =>  '',
                'class_form' => 'form-style cs-classic-form cs_form_styling',
                'id_form' => 'form-style',
				'class_submit' => '',
                'id_submit' => 'cs-bg-color',
                'title_reply' => __( '<div class="cs-section-title"><h2>Leave us a reply</h2></div>', 'goalklub' ),
                'title_reply_to' => __( '<div class="cs-section-title"><h2>Leave a Reply to %s </h2</div>>', 'goalklub' ),
                'cancel_reply_link' => __( 'Cancel reply', 'goalklub' ),
                'label_submit' => __( 'Submit', 'goalklub' ),);
                comment_form($defaults, $post_id);
            ?>
    </div>
</div>

<!-- Col Start -->