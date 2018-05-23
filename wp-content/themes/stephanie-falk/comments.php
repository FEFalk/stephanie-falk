<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

/* Custom Comments Callbacks */

$user = wp_get_current_user();
$user_identity = $user->exists() ? $user->display_name : '';

function better_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'article' == $args['style'] ) {
        $tag = 'article';
        $add_below = 'comment';
    } else {
        $tag = 'article';
        $add_below = 'comment';
    }

    ?>
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">

    <div class="comment-author-meta">
        <figure class="gravatar"><?php echo get_avatar( $comment, 40, '', 'Author\'s gravatar' ); ?></figure>
        <h5 class="comment-author">
            <span class="comment-author-link" itemprop="author"><?php comment_author(); ?></span>
        </h5>

        <div class="comment-meta" role="complementary">
            <time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time('g:i a'); ?></a></time>
            <?php /*echo get_option('time_format').' :: '.get_option('timezone_string'); */?>
            <?php edit_comment_link('<span class="comment-meta-item">(Edit)</span>','',''); ?>
            <?php if ($comment->comment_approved == '0') : ?>
                <p class="comment-meta-item moderation_msg">Your comment is awaiting moderation.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="comment-content post-content" itemprop="text">
        <?php comment_text() ?>
        <div class="comment-reply">
            <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    </div>
<?php }

// end of awesome semantic comment

function better_comment_close() {
    echo '</article>';
}













// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number();?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<div class="commentlist">
	<?php wp_list_comments( array( 'callback' => 'better_comment', 'end-callback' => 'better_comment_close' )); ?>
	</div>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e( 'Comments are closed.' ); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<h3><?php comment_form_title(); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<?php echo sprintf(
    /* translators: %s: login URL */
    __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
    wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
) ; ?>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>
<?php
echo sprintf(
    /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
    __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
    get_edit_user_link(),
    /* translators: %s: user name */
    esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
    $user_identity,
    wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
)
?>
<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
	<?php
	if(!is_user_logged_in()):
		do_action( 'comment_form_after_fields');
	else:
		do_action( 'comment_form_logged_in_after');
	endif;
	?>
<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e( 'Post Comment' ); ?>" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
