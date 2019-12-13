<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPressdotorg\Theme
 */

namespace WordPressdotorg\Theme;

get_header();
?>
<?php get_template_part( 'template-parts/component', 'directory-nav' ); ?>

<main id="main" class="site-main page-full-width" role="main">
	<?php get_template_part( 'template-parts/component', 'filters' ); ?>
	<div id="lesson-plans" class="lp-list">
	<?php

	$post_type = get_post_type();

	$args = array(
		'post_type' => $post_type,
		'category_name' => wporg_get_cat_or_default_slug()
	);

	$category_posts = new \WP_Query( $args );

	if ( $category_posts->have_posts() ) :
		while ( $category_posts->have_posts() ) :
			$category_posts->the_post();
			get_template_part( 'template-parts/content', 'archive' );
		endwhile;

//		the_posts_pagination();

	else :
		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main><!-- #main -->

<?php
get_footer();
