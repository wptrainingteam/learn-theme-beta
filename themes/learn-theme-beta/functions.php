<?php
/**
 * WPBBP functions and definitions
 *
 * @package WPBBP
 */

/**
 * Enqueue scripts and styles.
 *
 * Enqueue existing wordpress.org/support stylesheets
 * @link https://meta.trac.wordpress.org/browser/sites/trunk/wordpress.org/public_html/style
 */
function wporg_support_scripts() {

	wp_enqueue_style( 'forum-wp4-style', get_stylesheet_uri(), [], '20190311' );
	wp_style_add_data( 'forum-wp4-style', 'rtl', 'replace' );

	wp_enqueue_style( 'learn-site', get_stylesheet_directory_uri() . '/learn-site.css', 30 );

}
add_action( 'wp_enqueue_scripts', 'wporg_support_scripts' );

/**
 * The Header for our theme.
 *
 * @package WPBBP
 */
function wporg_get_global_header() {
	$GLOBALS['pagetitle'] = wp_title( '&#124;', false, 'right' ) . __( 'WordPress.org', 'wporg-learn' );
	require WPORGPATH . 'header.php';
}
