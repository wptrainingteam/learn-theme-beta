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

<main id="main" class="site-main page-full-width" role="main">
	<div id="lesson-plans" class="lp-list">
<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'archive' );
		endwhile;

		the_posts_pagination();

	else :
		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
