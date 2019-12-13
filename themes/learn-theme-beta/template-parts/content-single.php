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
			<div class="lp-content-inner">
				<?php
				the_content();
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wporg-forums' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
			<aside class="lp-sidebar">
				<div class="lp-details">
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

					<ul class="lp-links">
						<li>
							<a href="#" target="_blank"><span class="dashicons dashicons-admin-page"></span> <?php _e( 'View Lesson Plan Slides' ); ?></a>
						</li>
						<li>
							<a href="#" target="_blank"><span class="dashicons dashicons-download"></span> <?php _e( 'Download Lesson Slides' ); ?></a>
						</li>
						<li>
							<a href="#" target="_blank"><span class="dashicons dashicons-admin-post"></span> <?php _e( 'Print Lesson Plan' ); ?></a>
						</li>
					</ul>

					<div class="lp-suggestion">
						<h4><?php _e( 'Suggestions' ); ?></h4>
						<p><?php _e( 'Found a typo, grammar error,or outdated screenshot?' ); ?></p>
						<p><?php _e( 'Used this lesson plan in your event and have some suggestions?' ); ?></p>
						<a href="#"><?php _e( 'Let us know!' ); ?></a>
					</div>
				</div>
			</aside>
			</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
