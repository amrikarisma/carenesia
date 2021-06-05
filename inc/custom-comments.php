<?php
/**
 * Comment layout
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add Bootstrap classes to comment form fields.
add_filter( 'comment_form_default_fields', 'understrap_bootstrap_comment_form_fields' );

if ( ! function_exists( 'understrap_bootstrap_comment_form_fields' ) ) {
	/**
	 * Add Bootstrap classes to WP's comment form default fields.
	 *
	 * @param array $fields {
	 *     Default comment fields.
	 *
	 *     @type string $author  Comment author field HTML.
	 *     @type string $email   Comment author email field HTML.
	 *     @type string $url     Comment author URL field HTML.
	 *     @type string $cookies Comment cookie opt-in field HTML.
	 * }
	 *
	 * @return array
	 */
	function understrap_bootstrap_comment_form_fields( $fields ) {

		$replace = array(
			'<p class="' => '<div class="form-group ',
			'<input'     => '<input class="form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $fields['author'] ) ) {
			$fields['author'] = strtr( $fields['author'], $replace );
		}
		if ( isset( $fields['email'] ) ) {
			$fields['email'] = strtr( $fields['email'], $replace );
		}
		if ( isset( $fields['url'] ) ) {
			$fields['url'] = strtr( $fields['url'], $replace );
		}

		$replace = array(
			'<p class="' => '<div class="form-group form-check ',
			'<input'     => '<input class="form-check-input" ',
			'<label'     => '<label class="form-check-label" ',
			'</p>'       => '</div>',
		);
		if ( isset( $fields['cookies'] ) ) {
			$fields['cookies'] = strtr( $fields['cookies'], $replace );
		}

		return $fields;
	}
} // End of if function_exists( 'understrap_bootstrap_comment_form_fields' )

// Add Bootstrap classes to comment form submit button and comment field.
add_filter( 'comment_form_defaults', 'understrap_bootstrap_comment_form' );

if ( ! function_exists( 'understrap_bootstrap_comment_form' ) ) {
	/**
	 * Adds Bootstrap classes to comment form submit button and comment field.
	 *
	 * @param string[] $args Comment form arguments and fields.
	 *
	 * @return string[]
	 */
	function understrap_bootstrap_comment_form( $args ) {
		$replace = array(
			'<p class="' => '<div class="form-group ',
			'<textarea'  => '<textarea class="form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $args['comment_field'] ) ) {
			$args['comment_field'] = strtr( $args['comment_field'], $replace );
		}

		if ( isset( $args['class_submit'] ) ) {
			$args['class_submit'] = 'btn btn-secondary';
		}

		return $args;
	}
} // End of if function_exists( 'understrap_bootstrap_comment_form' ).


// Add note if comments are closed.
add_action( 'comment_form_comments_closed', 'understrap_comment_form_comments_closed' );

if ( ! function_exists( 'understrap_comment_form_comments_closed' ) ) {
	/**
	 * Displays a note that comments are closed if comments are closed and there are comments.
	 */
	function understrap_comment_form_comments_closed() {
		if ( get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'understrap' ); ?></p>
			<?php
		}
	}
} // End of if function_exists( 'understrap_comment_form_comments_closed' ).


if( ! function_exists( 'custom_better_commets' ) ):
	function custom_better_commets($comment, $args, $depth) {
		?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="comment">
			<div class="wrap-image-comment  d-none d-sm-block">
				<div class="img-comment-thumbnail">
					<?php echo get_avatar($comment,$size='80',$default='http://0.gravatar.com/avatar/36c2a25e62935705c5565ec465c59a70?s=32&d=mm&r=g' ); ?>
				</div>
			</div>
			<div class="comment-block">
				<div class="comment-arrow"></div>
					<?php if ($comment->comment_approved == '0') : ?>
						<em><?php esc_html_e('Your comment is awaiting moderation.','5balloons_theme') ?></em>
						<br />
					<?php endif; ?>
					<span class="comment-by">
						<h4 class="comment-author"><?php echo get_comment_author() ?></h4>
						<span class="float-right">
							<span> <a href="#"><i class="fa fa-reply"></i> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a></span>
						</span>
					</span>
					<span class="date-comment"><?php printf(/* translators: 1: date and time(s). */ esc_html__('%1$s at %2$s' , '5balloons_theme'), get_comment_date(),  get_comment_time()) ?></span>

				<p> <?php comment_text() ?></p>
			</div>
			</div>
	
	<?php
			}
	endif;

	add_filter('comment_form_default_fields', 'unset_url_field');

	if( ! function_exists( 'unset_url_field' ) ):
		function unset_url_field($fields){
		if(isset($fields['url']))
		unset($fields['url']);
		return $fields;
		}
	endif;

	