<?php

/*COMMENT WALKER*/

class bruno_walker_comment extends Walker_Comment {
	public $tree_type = 'comment';
	public $db_fields = array ('parent' => 'comment_parent', 'id' => 'comment_ID');
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		switch ( $args['style'] ) {
			case 'div':
				break;
			case 'ol':
				$output .= '<ol class="children">' . "\n";
				break;
			case 'ul':
			default:
				$output .= '<ul class="children">' . "\n";
				break;
		}
	}
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		switch ( $args['style'] ) {
			case 'div':
				break;
			case 'ol':
				$output .= "</ol><!-- .children -->\n";
				break;
			case 'ul':
			default:
				$output .= "</ul><!-- .children -->\n";
				break;
		}
	}
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( !$element )
			return;
		$id_field = $this->db_fields['id'];
		$id = $element->$id_field;
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		/*
		 * If at the max depth, and the current element still has children, loop over those
		 * and display them at this level. This is to prevent them being orphaned to the end
		 * of the list.
		 */
		if ( $max_depth <= $depth + 1 && isset( $children_elements[$id]) ) {
			foreach ( $children_elements[ $id ] as $child )
				$this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );
			unset( $children_elements[ $id ] );
		}
	}
	public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		if ( !empty( $args['callback'] ) ) {
			ob_start();
			call_user_func( $args['callback'], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}
		if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
			ob_start();
			$this->ping( $comment, $depth, $args );
			$output .= ob_get_clean();
		} elseif ( 'html5' === $args['format'] ) {
			ob_start();
			$this->html5_comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		} else {
			ob_start();
			$this->comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		}
	}
	public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		if ( !empty( $args['end-callback'] ) ) {
			ob_start();
			call_user_func( $args['end-callback'], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}
		if ( 'div' == $args['style'] )
			$output .= "</div><!-- #comment-## -->\n";
		else
			$output .= "</li><!-- #comment-## -->\n";
	}
	protected function ping( $comment, $depth, $args ) {
		$tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
			<div class="comment-body">
				<?php _e( 'Pingback:' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
<?php
	}
	protected function comment( $comment, $depth, $args ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag; ?> <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php //if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link( $comment ) ); ?>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
			<?php
				/* translators: 1: comment date, 2: comment time */
				printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' );
			?>
		</div>

		<?php comment_text( $comment, array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		<?php
		comment_reply_link( array_merge( $args, array(
			'add_below' => $add_below,
			'depth'     => $depth,
			'max_depth' => $args['max_depth'],
			'before'    => '<div class="reply">',
			'after'     => '</div>'
		) ) );
		?>

		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
	}
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php //if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s' ), sprintf( '<span class="fn">%s</span>', get_comment_author_link( $comment ) ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">




<?php 
$user_id=$comment->user_id;
?>
<p class="commenter-bio"><?php the_author_meta('description',$user_id); ?></p>
<p class="commenter-url"><a href="<?php the_author_meta('user_url',$user_id); ?>" target="_blank"><?php the_author_meta('user_url',$user_id); ?></a></p>
						
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>'
				) ) );
				?>
			</article><!-- .comment-body -->
<?php
} }



/*COMMENT PAGINATION*/

if ( ! function_exists( 'twentyfifteen_comment_nav' ) ) :
	/**
	 * Display navigation to next/previous comments when applicable.
	 *
	 * @since Twenty Fifteen 1.0
	 */
	function twentyfifteen_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
		<div class="nav-links">
			<?php
			if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'twentyfifteen' ) ) ) :
				printf( '<div class="nav-previous"><i class="fas fa-chevron-left"></i> %s</div>', $prev_link );
				endif;

			if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'twentyfifteen' ) ) ) :
				printf( '<div class="nav-next">%s <i class="fas fa-chevron-right"></i></div>', $next_link );
				endif;
			?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
		endif;
	}
endif;

?>

<!--THEN USE THE FOLLOWING IN COMMENTS.PHP TEMPLATE AS A BASE-->

<section class="ac-2018 block__comments padding-tb-40 white-box">
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-push-1">
                <div class="block__title">
                    <h2>
                        <?php 
                            echo 'Comments on ' . get_the_title();
                        ?>
                    </h2>
                </div>
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-xs-12 col-md-10 col-md-push-1">

                <div id="comments" class="comments-area">

                    
                        <h2 class="comments-title">

                        </h2>

                        <ol class="comment-list">
                            <?php
                            
                            $have_comments = have_comments();
                            
                            if ($have_comments) {
                            
                            
                                wp_list_comments( array(
                                  'style'       => 'ol',
                                  'short_ping'  => true,
                                  'avatar_size' => 82,
                                  'walker' => new bruno_walker_comment
                                ) );
                                
                            } else {
                                echo '<p>Be the first to comment on this blog post.</p>';
                            }
                            ?>
                        </ol><!-- .comment-list -->

                        <?php twentyfifteen_comment_nav(); ?>

                    <?php
                        // If comments are closed and there are comments, let's leave a little note, shall we?
                    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
                    ?>
                    <p class="no-comments"><?php _e( 'Comments are closed.', 'twentyfifteen' ); ?></p>
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <?php comment_form(); ?>
                        </div>
                    </div>

                </div><!-- .comments-area -->
                
            </div>
            
        </div>

    </div>
    
</section>