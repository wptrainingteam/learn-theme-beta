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

	wp_enqueue_style( 'github-markdown', get_stylesheet_directory_uri() . '/github.css', 30 );
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

/**
 * Get the taxonomies associated to workshop
 *
 * @package WPBBP
 */
function wporg_get_tax_slugs_from_workshop() {
	$id = get_the_ID();
	$taxes = wp_get_post_terms( $id, 'lesson_group' );
	$tax_slugs = [];

	foreach ( $taxes as $tax ) {
		array_push( $tax_slugs, $tax->slug );
	}

	return $tax_slugs;
}

/**
 * Get the lesson plans associated to a taxonomy
 *
 * @package WPBBP
 */
function wporg_get_lesson_plans_by_tax_slugs_query( $slugs ) {
	$args = array(
		'post_type' => 'lesson-plan',
		'tax_query' => array(
			array(
				'taxonomy' => 'lesson_group',
				'field'    => 'slug',
				'terms'    => $slugs,
			),
		),
	);

	
	// Get all the lesson plans associated to 
	return new WP_Query( $args );
}

/**
 * Get the category from the query vars
 *
 * @package WPBBP
 */
function wporg_get_filter_category() {
	return get_query_var( 'category' );
}

/**
 * Returns a list of filter categories
 *
 * @return array
 */
function wporg_get_filter_categories() {
	return get_categories();
}

/**
 * Returns the default filter category key
 *
 * @return string
 */
function wporg_get_default_cat() {
	return wporg_get_filter_categories()[ 0 ];
}

/**
 * Returns the default category if category is not defined
 *
 * @return string
 */
function wporg_get_cat_or_default_slug() {
	$cat = wporg_get_filter_category();
	
	if( empty( $cat ) ) {
		return wporg_get_default_cat()->slug;
	}

	return $cat;
}

/**
 * Submit CTA button 
 *
 * @package WPBBP
 */
function wporg_submit_idea_cta() { ?> 

	<section class="submit-idea-cta">
		<h3><?php _e( 'Have an Idea for a Lesson or Workshop? Let us know!' ); ?></h3>
		<a class="button button-primary button-large" href="<?php echo esc_url( site_url( '/submit-an-idea/' ) ); ?>"><?php _e( 'Submit an Idea' ); ?></a>
	</section>

<?php } 
