<?php
/**
 * WPBBP functions and definitions
 *
 * @package WPBBP
 */


/**
 * Use the ‘Lead Topic’ uses the single topic part
 * allowing styling the lead topic separately from the main reply loop.
 */
add_filter( 'bbp_show_lead_topic', '__return_true' );

/**
 * Enqueue scripts and styles.
 *
 * Enqueue existing wordpress.org/support stylesheets
 * @link https://meta.trac.wordpress.org/browser/sites/trunk/wordpress.org/public_html/style
 */
function wporg_support_scripts() {

	wp_register_style(
		'bb-base',
		'//bbpress.org/wp-content/themes/bb-base/style.css',
		array(),
		'20160919'
	);

	wp_register_style(
		'forum-wp4-style',
		get_template_directory_uri() . '/style.css',
		array( 'bb-base' ),
		'20170303'
	);

	wp_style_add_data( 'forum-wp4-style', 'rtl', 'replace' );

	wp_enqueue_style( 'forum-wp4-style' );

	wp_enqueue_script( 'wporg-support-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151217', true );
}
add_action( 'wp_enqueue_scripts', 'wporg_support_scripts' );

/**
 * Customized breadcrumb arguments
 * Breadcrumb Root Text: "WordPress Support"
 * Custom separator: `«` and `»`
 *
 * @uses bbp_before_get_breadcrumb_parse_args() To parse the custom arguments
 */
function wporg_support_breadcrumb() {
	// Separator
	$args['sep']             = is_rtl() ? __( '&laquo;', 'wporg-forums' ) : __( '&raquo;', 'wporg-forums' );
	$args['pad_sep']         = 1;
	$args['sep_before']      = '<span class="bbp-breadcrumb-sep">' ;
	$args['sep_after']       = '</span>';

	// Crumbs
	$args['crumb_before']    = '';
	$args['crumb_after']     = '';

	// Home
	$args['include_home']    = true;
	$args['home_text']       = __( 'Support', 'wporg-forums' );

	// Forum root
	$args['include_root']    = false;

	// Current
	$args['include_current'] = true;
	$args['current_before']  = '<span class="bbp-breadcrumb-current">';
	$args['current_after']   = '</span>';

	return $args;
}
add_filter( 'bbp_before_get_breadcrumb_parse_args', 'wporg_support_breadcrumb' );

/**
 * Register these bbPress views:
 *  View: All topics
 *  View: Tagged modlook
 *
 * @uses bbp_register_view() To register the view
 */
function wporg_support_custom_views() {
	bbp_register_view( 'all-topics', __( 'All topics', 'wporg-forums' ), array( 'order' => 'DESC' ), false );
	if ( get_current_user_id() && current_user_can( 'moderate' ) ) {
		bbp_register_view( 'taggedmodlook', __( 'Tagged modlook', 'wporg-forums' ), array( 'topic-tag' => 'modlook' ) );
	}
}
add_action( 'bbp_register_views', 'wporg_support_custom_views' );

/**
 * Display an ordered list of bbPress views
 */
function wporg_support_get_views() {
	$all = bbp_get_views();
	$ordered = array(
		'all-topics',
		'no-replies',
		'support-forum-no',
		'taggedmodlook',
	);
	$found = array();
	foreach ( $ordered as $view ) {
		if ( array_key_exists( $view, $all ) ) {
			$found[] = $view;
		}
	}
	$view_iterator = 0;
	$view_count    = count( $found );

	foreach ( $found as $view ) : $view_iterator++; ?>

		<li class="view"><a href="<?php bbp_view_url( $view ); ?>"><?php bbp_view_title( $view ); ?></a></li>

		<?php if ( $view_iterator < $view_count ) : ?>|<?php endif; ?>

	<?php endforeach;

	// Unset variables
	unset( $view_count, $view_iterator, $view, $found, $all, $ordered );
}

/**
 * Custom Body Classes
 *
 * @uses get_body_class() To add the `wporg-support` class
 */
function wporg_support_body_class($classes) {
	$classes[] = 'wporg-responsive';
	$classes[] = 'wporg-support';
	return $classes;
}
add_filter( 'body_class', 'wporg_support_body_class' );

/**
 * The Header for our theme.
 *
 * @package WPBBP
 */
function wporg_get_global_header() {
	$GLOBALS['pagetitle'] = wp_title( '&laquo;', false, 'right' ) . ' ' . get_bloginfo( 'name' );
	require WPORGPATH . 'header.php';
}

/**
 * The Footer for our theme.
 *
 * @package WPBBP
 */
function wporg_get_global_footer() {
	require WPORGPATH . 'footer.php';
}

/**
 * Link user profiles to their global profiles.
 */
function wporg_support_profile_url( $user_id ) {
	$user = get_userdata( $user_id );

	return esc_url( 'https://profiles.wordpress.org/' . $user->user_nicename );
}
// Temporarily remove the redirect to `https://profiles.wordpress.org/`, see #meta1868.
// add_filter( 'bbp_pre_get_user_profile_url', 'wporg_support_profile_url' );

/**
 * Get user's WordPress.org profile link.
 *
 * @param int $user_id
 * @return string
 */
function wporg_support_get_wporg_profile_link( $user_id = 0 ) {
	$user_nicename = bbp_get_user_nicename( $user_id );

	return sprintf( '<a href="%s">@%s</a>',
		esc_url( 'https://profiles.wordpress.org/' . $user_nicename ),
		$user_nicename
	);
}

/**
 * Get user's Slack username.
 *
 * @param int $user_id
 * @return string The user's Slack username (without '@') if user has one.
 */
function wporg_support_get_slack_username( $user_id = 0 ) {
	global $wpdb;

	$user_id = bbp_get_user_id( $user_id );
	$slack_username = '';

	$data = $wpdb->get_var( $wpdb->prepare( "SELECT profiledata FROM slack_users WHERE user_id = %d", $user_id ) );
	if ( $data && ( $data = json_decode( $data, true ) ) ) {
		$slack_username = $data['name'];
	}

	return $slack_username;
}

/**
 * Get user's registration date.
 *
 * @param int $user_id
 * @return string
 */
function wporg_support_get_user_registered_date( $user_id = 0 ) {
	$user = get_userdata( bbp_get_user_id( $user_id ) );

	/* translators: registration date format, see https://secure.php.net/date */
	return mysql2date( __( 'F jS, Y', 'wporg-forums' ), $user->user_registered );
}

/**
 * Check if the current page is a single review.
 *
 * @return bool True if the current page is a single review, false otherwise.
 */
function wporg_support_is_single_review() {
	if ( ! class_exists( 'WordPressdotorg\Forums\Plugin' ) || ! bbp_is_single_topic() ) {
		return false;
	}

	return ( WordPressdotorg\Forums\Plugin::REVIEWS_FORUM_ID == bbp_get_topic_forum_id() );
}

/**
 * Get the list of plugin- and theme-specific views.
 *
 * @return array Array of compat views.
 */
function wporg_support_get_compat_views() {
	return array( 'theme', 'plugin', 'reviews', 'active', 'unresolved' );
}

/**
 * Check if the current page is a plugin- or theme-specific view.
 *
 * @param string $view_id View ID to check.
 * @return bool True if the current page is a compat view, false otherwise.
 */
function wporg_support_is_compat_view( $view_id = 0 ) {
	if ( ! bbp_is_single_view() ) {
		return false;
	}

	$view_id = bbp_get_view_id( $view_id );

	return in_array( $view_id, wporg_support_get_compat_views() );
}

/**
 * Display a notice for messages caught in the moderation queue.
 */
function wporg_support_add_moderation_notice() {
	$post_time       = mysql2date( 'U', get_post_field( 'post_date', get_the_ID() ) );
	$seconds_passed  = current_time( 'timestamp' ) - $post_time;
	$hours_passed    = (int) ( $seconds_passed / HOUR_IN_SECONDS );
	$post_status     = get_post_status();
	$is_moderator    = current_user_can( 'moderate' );
	$is_user_blocked = ! current_user_can( 'spectate' );
	$notice_class    = '';
	$notices         = array();

	if ( $is_moderator && in_array( $post_status, array( 'archived', 'pending', 'spam' ) ) ) :

		if ( 'spam' === $post_status ) {
			$notice_class = 'warning';

			$reporter = get_post_meta( get_the_ID(), '_bbp_akismet_user', true );

			if ( $reporter ) {
				/* translators: %s: reporter's username */
				$notices[] = sprintf( __( 'This post has been flagged as spam by %s.', 'wporg-forums' ), $reporter );
			} else {
				$notices[] = __( 'This post has been flagged as spam.', 'wporg-forums' );
			}
		} elseif ( 'archived' === $post_status ) {
			$moderator = get_post_meta( get_the_ID(), '_wporg_bbp_moderator', true );

			if ( $moderator ) {
				/* translators: %s: moderator's username */
				$notices[] = sprintf( __( 'This post has been archived by %s.', 'wporg-forums' ), $moderator );
			} else {
				$notices[] = __( 'This post is currently archived.', 'wporg-forums' );
			}
		} else {
			$moderator = get_post_meta( get_the_ID(), '_wporg_bbp_moderator', true );

			if ( $moderator ) {
				/* translators: %s: moderator's username */
				$notices[] = sprintf( __( 'This post has been unapproved by %s.', 'wporg-forums' ), $moderator );
			} else {
				$notices[] = __( 'This post is currently pending.', 'wporg-forums' );
			}
		}

		if ( class_exists( 'WordPressdotorg\Forums\User_Moderation\Plugin' ) ) :
			$is_user_flagged = WordPressdotorg\Forums\User_Moderation\Plugin::get_instance()->is_user_flagged( get_post()->post_author );
			$moderator       = get_user_meta( get_post()->post_author, WordPressdotorg\Forums\User_Moderation\Plugin::MODERATOR_META, true );

			if ( $is_user_flagged ) {
				if ( $moderator ) {
					$notices[] = sprintf(
						/* translators: %s: linked moderator's username */
						__( 'This user has been flagged by %s.', 'wporg-forums' ),
						sprintf( '<a href="%s">%s</a>', esc_url( home_url( "/users/$moderator/" ) ), $moderator )
					);
				} else {
					$notices[] = __( 'This user has been flagged.', 'wporg-forums' );
				}
			}
		endif;

	elseif ( in_array( $post_status, array( 'pending', 'spam' ) ) ) :

		if ( $is_user_blocked ) {
			// Blocked users get a generic message with no call to action or moderation timeframe.
			$notices[] = __( 'This post has been held for moderation by our automated system.', 'wporg-forums' );
		} elseif ( $hours_passed > 96 ) {
			$notice_class = 'warning';
			$notices[]    = sprintf(
				/* translators: %s: https://make.wordpress.org/chat/ */
				__( 'This post was held for moderation by our automated system but has taken longer than expected to get approved. Please come to the #forums channel on <a href="%s">WordPress Slack</a> and let us know. Provide a link to the post.', 'wporg-forums' ),
				'https://make.wordpress.org/chat/'
			);
		} else {
			$notices[] = sprintf(
				/* translators: %d: number of hours */
				_n( 'This post has been held for moderation by our automated system. It will be reviewed within %d hour.', 'This post has been held for moderation by our automated system. It will be reviewed within %d hours.', 72, 'wporg-forums' ),
				72
			);
		}

	endif;

	if ( $notices ) {
		printf(
			'<div class="bbp-template-notice %s"><p>%s</p></div>',
			esc_attr( $notice_class ),
			implode( '</p><p>', $notices )
		);
	}
}
add_action( 'bbp_theme_before_topic_content', 'wporg_support_add_moderation_notice' );
add_action( 'bbp_theme_before_reply_content', 'wporg_support_add_moderation_notice' );

/**
 * Change "Stick (to front)" link text to "Stick (to all forums)".
 */
function wporg_support_change_super_sticky_text( $links ) {
	if ( isset( $links['stick'] ) ) {
		$links['stick'] = bbp_get_topic_stick_link( array( 'super_text' => __( '(to all forums)', 'wporg-forums' ) ) );
	}

	return $links;
}
add_filter( 'bbp_topic_admin_links', 'wporg_support_change_super_sticky_text' );

/**
 * Check if the current user can stick a topic to a plugin or theme forum.
 *
 * @param int $topic_id Topic ID.
 * @return bool True if the user can stick the topic, false otherwise.
 */
function wporg_support_current_user_can_stick( $topic_id ) {
	if ( ! class_exists( 'WordPressdotorg\Forums\Plugin' ) ) {
		return false;
	}

	$user_can_stick  = false;
	$stickies        = null;
	$plugin_instance = WordPressdotorg\Forums\Plugin::get_instance();

	if ( ! empty( $plugin_instance->plugins->stickies ) ) {
		$stickies = $plugin_instance->plugins->stickies;
	} elseif ( ! empty( $plugin_instance->themes->stickies ) ) {
		$stickies = $plugin_instance->themes->stickies;
	}

	if ( $stickies ) {
		$user_can_stick = $stickies->user_can_stick( get_current_user_id(), $stickies->term->term_id, $topic_id );
	}

	return $user_can_stick;
}
 
/**
 * Correct reply URLs for pending posts.
 *
 * bbPress appends '/edit/' even to ugly permalinks, which pending posts will
 * always have.
 *
 * @see https://meta.trac.wordpress.org/ticket/2478
 * @see https://bbpress.trac.wordpress.org/ticket/3054
 *
 * @param string $url     URL to edit the post.
 * @param int    $post_id Post ID.
 * @return string
 */
function wporg_support_fix_pending_posts_reply_url( $url, $post_id ) {
	if ( false !== strpos( $url, '?' ) ) {
		if ( false !== strpos( $url, '/edit/' ) ) {
			$url = str_replace( '/edit/', '', $url );
			$url = add_query_arg( 'edit', '1', $url );
		} elseif ( false !== strpos( $url, '%2Fedit%2F' ) ) {
			$url = str_replace( '%2Fedit%2F', '', $url );
			$url = add_query_arg( 'edit', '1', $url );
		}
	}

	return $url;
}
add_filter( 'bbp_get_topic_edit_url', 'wporg_support_fix_pending_posts_reply_url', 10, 2 );
add_filter( 'bbp_get_reply_edit_url', 'wporg_support_fix_pending_posts_reply_url', 10, 2 );


/** bb Base *******************************************************************/

function bb_base_search_form() {
?>

	<form role="search" method="get" id="searchform" action="https://wordpress.org/search/do-search.php">
		<div>
			<h3><?php _e( 'Forum Search', 'wporg-forums' ); ?></h3>
			<label class="screen-reader-text hidden" for="search"><?php _e( 'Search for:', 'wporg-forums' ); ?></label>
			<input name="search" class="text" id="forumsearchbox" value type="text" />
			<input name="go" class="button" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'wporg-forums' ); ?>" />
			<input value="1" name="forums" type="hidden">
		</div>
	</form>

<?php
}

function bb_base_topic_search_form() {
?>

	<form role="search" method="get" id="searchform" action="">
		<div>
			<h3><?php _e( 'Forum Search', 'wporg-forums' ); ?></h3>
			<label class="screen-reader-text hidden" for="ts"><?php _e( 'Search for:', 'wporg-forums' ); ?></label>
			<input type="text" value="<?php echo bb_base_topic_search_query(); ?>" name="ts" id="ts" />
			<input class="button" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'wporg-forums' ); ?>" />
		</div>
	</form>

<?php
}

function bb_base_reply_search_form() {
?>

	<form role="search" method="get" id="searchform" action="">
		<div>
			<h3><?php _e( 'Reply Search', 'wporg-forums' ); ?></h3>
			<label class="screen-reader-text hidden" for="rs"><?php _e( 'Search for:', 'wporg-forums' ); ?></label>
			<input type="text" value="<?php echo bb_base_reply_search_query(); ?>" name="rs" id="rs" />
			<input class="button" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'wporg-forums' ); ?>" />
		</div>
	</form>

<?php
}

function bb_base_plugin_search_form() {
?>

	<form role="search" method="get" id="searchform" action="">
		<div>
			<h3><?php _e( 'Plugin Search', 'wporg-forums' ); ?></h3>
			<label class="screen-reader-text hidden" for="ps"><?php _e( 'Search for:', 'wporg-forums' ); ?></label>
			<input type="text" value="<?php echo bb_base_plugin_search_query(); ?>" name="ps" id="ts" />
			<input class="button" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'wporg-forums' ); ?>" />
		</div>
	</form>

<?php
}

function bb_base_topic_search_query( $escaped = true ) {

	if ( empty( $_GET['ts'] ) ) {
		return false;
	}

	$query = apply_filters( 'bb_base_topic_search_query', $_GET['ts'] );
	if ( true === $escaped ) {
		$query = stripslashes( esc_attr( $query ) );
	}

	return $query;
}

function bb_base_reply_search_query( $escaped = true ) {

	if ( empty( $_GET['rs'] ) ) {
		return false;
	}

	$query = apply_filters( 'bb_base_reply_search_query', $_GET['rs'] );
	if ( true === $escaped ) {
		$query = stripslashes( esc_attr( $query ) );
	}

	return $query;
}

function bb_base_plugin_search_query( $escaped = true ) {

	if ( empty( $_GET['ps'] ) ) {
		return false;
	}

	$query = apply_filters( 'bb_base_plugin_search_query', $_GET['ps'] );
	if ( true === $escaped ) {
		$query = stripslashes( esc_attr( $query ) );
	}

	return $query;
}

function bb_base_single_topic_description() {

	// Validate topic_id
	$topic_id = bbp_get_topic_id();

	// Unhook the 'view all' query var adder
	remove_filter( 'bbp_get_topic_permalink', 'bbp_add_view_all' );

	// Build the topic description
	$voice_count = bbp_get_topic_voice_count   ( $topic_id, true );
	$reply_count = bbp_get_topic_replies_link  ( $topic_id );
	$time_since  = bbp_get_topic_freshness_link( $topic_id );

	// Singular/Plural
	$voice_count = sprintf( _n( '%s participant', '%s participants', $voice_count, 'wporg-forums' ), bbp_number_format( $voice_count ) );
	$last_reply  = bbp_get_topic_last_active_id( $topic_id );

	// WP version
	$wp_version = '';
	if ( function_exists( 'WordPressdotorg\Forums\Version_Dropdown\get_topic_version' ) ) {
		$wp_version = WordPressdotorg\Forums\Version_Dropdown\get_topic_version( $topic_id );
	}

	?>

	<li class="topic-forum"><?php
		/* translators: %s: forum title */
		printf( __( 'In: %s', 'wporg-forums' ),
			sprintf( '<a href="%s">%s</a>',
				esc_url( bbp_get_forum_permalink( bbp_get_topic_forum_id() ) ),
				bbp_get_topic_forum_title()
			)
		);
	?></li>
	<?php if ( !empty( $reply_count ) ) : ?>
		<li class="reply-count"><?php echo $reply_count; ?></li>
	<?php endif; ?>
	<?php if ( !empty( $voice_count ) ) : ?>
		<li class="voice-count"><?php echo $voice_count; ?></li>
	<?php endif; ?>
	<?php if ( !empty( $last_reply  ) ) : ?>
		<li class="topic-freshness-author"><?php
			/* translators: %s: reply author link */
			printf( __( 'Last reply from: %s', 'wporg-forums' ),
				bbp_get_author_link( array( 'type' => 'name', 'post_id' => $last_reply, 'size' => '15' ) )
			);
		?></li>
	<?php endif; ?>
	<?php if ( !empty( $time_since  ) ) : ?>
		<li class="topic-freshness-time"><?php
			/* translators: %s: date/time link to the latest post */
			printf( __( 'Last activity: %s', 'wporg-forums' ), $time_since );
		?></li>
	<?php endif; ?>
	<?php if ( ! empty( $wp_version ) ) : ?>
		<li class="wp-version"><?php echo esc_html( $wp_version ); ?></li>
	<?php endif; ?>
	<?php if ( function_exists( 'WordPressdotorg\Forums\Topic_Resolution\get_topic_resolution_form' ) ) : ?>
		<?php if ( WordPressdotorg\Forums\Topic_Resolution\Plugin::get_instance()->is_enabled_on_forum() && ( bbp_is_single_topic() || bbp_is_topic_edit() ) ) : ?>
			<li class="topic-resolved"><?php WordPressdotorg\Forums\Topic_Resolution\get_topic_resolution_form( $topic_id ); ?></li>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( bbp_current_user_can_access_create_reply_form() /*bbp_is_topic_open( $_topic_id )*/ ) : ?>
		<li class="create-reply"><a href="#new-post"><?php
			if ( wporg_support_is_single_review() ) {
				_e( 'Reply to Review', 'wporg-forums' );
			} else {
				_e( 'Reply to Topic', 'wporg-forums' );
			}
		?></a></li>
	<?php endif; ?>
	<?php if ( is_user_logged_in() ) : ?>
		<?php $_topic_id = bbp_is_reply_edit() ? bbp_get_reply_topic_id() : $topic_id; ?>
		<li class="topic-subscribe"><?php bbp_topic_subscription_link( array( 'before' => '', 'topic_id' => $_topic_id ) ); ?></li>
		<li class="topic-favorite"><?php bbp_topic_favorite_link( array( 'topic_id' => $_topic_id ) ); ?></li>
	<?php endif; ?>

	<?php
}

function bb_base_single_forum_description() {

	// Validate forum_id
	$forum_id = bbp_get_forum_id();

	// Unhook the 'view all' query var adder
	remove_filter( 'bbp_get_forum_permalink', 'bbp_add_view_all' );

	// Get some forum data
	$topic_count = bbp_get_forum_topic_count( $forum_id, true, true );
	$reply_count = bbp_get_forum_reply_count( $forum_id, true, true );
	$last_active = bbp_get_forum_last_active_id( $forum_id );

	// Has replies
	if ( !empty( $reply_count ) ) {
		$reply_text = sprintf( _n( '%s reply', '%s replies', $reply_count, 'wporg-forums' ), bbp_number_format( $reply_count ) );
	} else {
		$reply_text = '';
	}

	// Forum has active data
	if ( !empty( $last_active ) ) {
		$topic_text      = bbp_get_forum_topics_link( $forum_id );
		$time_since      = bbp_get_forum_freshness_link( $forum_id );

	// Forum has no last active data
	} else {
		$topic_text      = sprintf( _n( '%s topic', '%s topics', $topic_count, 'wporg-forums' ), bbp_number_format( $topic_count ) );
	}
	?>

	<?php if ( bbp_get_forum_parent_id() ) : ?>
		<li class="topic-parent"><?php
			/* translators: %s: forum title */
			printf( __( 'In: %s', 'wporg-forums' ),
				sprintf( '<a href="%s">%s</a>',
					esc_url( bbp_get_forum_permalink( bbp_get_forum_parent_id() ) ),
					bbp_get_forum_title( bbp_get_forum_parent_id() )
				)
			);
		?></li>
	<?php endif; ?>
	<?php //if ( !empty( $topic_count ) ) : ?>
		<!-- <li class="topic-count"><?php echo $topic_text; ?></li> -->
	<?php //endif; ?>
	<?php //if ( !empty( $reply_count ) ) : ?>
		<!-- <li class="reply-count"><?php echo $reply_text; ?></li> -->
	<?php //endif; ?>
	<?php //if ( !empty( $last_active  ) ) : ?>
		<!-- <li class="forum-freshness-author"> --><?php
			/* translators: %s: post author link */
			//printf( __( 'Last post by: %s', 'wporg-forums' ),
			//	bbp_get_author_link( array( 'type' => 'name', 'post_id' => $last_active ) )
			//);
		?><!-- </li> -->
	<?php //endif; ?>
	<?php if ( !empty( $time_since  ) ) : ?>
		<li class="forum-freshness-time"><?php
			/* translators: %s: date/time link to the latest post */
			printf( __( 'Last activity: %s', 'wporg-forums' ), $time_since );
		?></li>
	<?php endif;
}

function bb_base_before_topics_loop() {
	do_action( 'bbp_template_notices' );

	if ( ! is_tax( 'topic-tag' ) ) {
		return;
	}

	bbp_breadcrumb();
	?>
	<header id="topic-tag" class="page-header bbp-topic-tag">
		<h1 class="page-title"><?php printf( esc_html__( 'Topic Tag: %s', 'bbpress' ), '<span>' . bbp_get_topic_tag_name() . '</span>' ); ?></h1>
	</header>
	<?php bbp_get_template_part( 'pagination', 'topics' ); ?>
		<div class="entry-content">
	<?php
}
add_action( 'bbp_template_before_topics_loop', 'bb_base_before_topics_loop' );

function bb_base_after_topics_loop() {
	if ( ! is_tax( 'topic-tag' ) ) {
		return;
	}
	?>
		</div>
	<?php
}
add_action( 'bbp_template_after_topics_loop', 'bb_base_after_topics_loop' );

function bb_is_intl_forum() {
	return get_locale() != 'en_US';
}

