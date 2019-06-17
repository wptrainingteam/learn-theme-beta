<?php
/**
 * Template Name: Submit an Idea
 *
 * @package WPBBP
 */

get_header(); ?>

	<main id="main" class="site-main page-full-width" role="main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
				<div class="bbp-breadcrumb">
					<p>
						<a href="https://wordpress.org/" class="bbp-breadcrumb-home">Learn Home</a>
						<span class="bbp-breadcrumb-sep">»</span>
						<span class="bbp-breadcrumb-current">Submit an Idea</span>
					</p>
				</div>

				<div id="submit-an-idea" class="type-page">
					<div class="entry-content">
						<section class="submit-idea-cta">
							<h4><?php _e( 'Is this a Workshop or Lesson Plan idea?' ); ?></h4>

							<div class="idea-type-lists">
								<div class="col">
									<span class="dashicons dashicons-welcome-learn-more"></span>
									<p>
									Workshops are a collection of leesions and a great way to get people hands-on with WordPress.
									</p>
									<a class="button button-primary" href="#"><?php _e( 'Workshop Idea' ); ?></a>
								</div>
								
								<div class="col">
									<span class="dashicons dashicons-lightbulb"></span>
									<p>
									Lesson plans are designed to guide and inspire others to deliver great content.
									</p>
									<a class="button button-primary" href="#"><?php _e( 'Lesson Idea' ); ?></a>
								</div>
							</div>

						</section>
				</div>

			</div>
			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
