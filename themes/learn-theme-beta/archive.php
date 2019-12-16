<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPressdotorg\Theme
 */

namespace WordPressdotorg\Theme;


/**
 * Gets the url for the next page
 * 
 * @return string
 */

function get_paging_url() {
	$big = 999999999;

	$url = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
	// Because of routing, we want to inject the first category if they are in the root.
	return preg_replace( '/(workshops|lesson-plans)\/page/', '$1/' . wporg_get_default_cat()->slug . '/page' , $url );
}


get_header();
?>
<?php get_template_part( 'template-parts/component', 'directory-nav' ); ?>

<main id="main" class="site-main page-full-width" role="main">
<?php 
	get_template_part( 'template-parts/component', 'filters' ); 

	$post_type = get_post_type();
	$paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;

	$args = array(
		'posts_per_page' => get_option( 'posts_per_page' ),
		'post_type' => $post_type,
		'category_name' => wporg_get_cat_or_default_slug(),
		'paged' => $paged,
	);

	$category_posts = new \WP_Query( $args );

	if ( $category_posts->have_posts() ) :
		echo '<div id="lesson-plans" class="lp-list">';
	
		while ( $category_posts->have_posts() ) :
			$category_posts->the_post();
			get_template_part( 'template-parts/content', 'archive' );
		endwhile;

		echo '</div>';

		echo paginate_links( array(
			'base' => get_paging_url(),
			'format' => '?page=%#%',
			'current' => max( 1, get_query_var('page') ),
			'total' => $category_posts->max_num_pages
		) );
	else :
		echo _e("We were unable to find any matches." , 'wporg-learn');

	endif;
?>

</main><!-- #main -->

<?php
get_footer();
