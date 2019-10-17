<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBBP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">	
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div class="lp-content">
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wporg-forums' ),
					'after'  => '</div>',
				)
			);
			?>
			<div class="lp-details">
				<div class="items">
					<ul>
						<li>
							<span class="dashicons dashicons-clock"></span>
							Length: <strong>1 Hour</strong>
						</li>
						<li>
							<span class="dashicons dashicons-admin-users"></span>
							Audience: <strong>Developers</strong>
						</li>
						<li>
							<span class="dashicons dashicons-dashboard"></span>
							Level: <strong>Beginning</strong>
						</li>
						<li>
							<span class="dashicons dashicons-welcome-learn-more"></span>
							Type of Instruction: <strong>Presentation, Demostration</strong>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
