<?php
/**
 * Template Name: Workshop Ideas
 *
 * @package WPBBP
 */

get_header(); ?>

	<main id="main" class="site-main page-full-width" role="main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<div id="lesson-plans" class="ws-list">
				
				
				
				<div class="ws-item">
					<div class="ws-item-wrap">
						<h2><a href="#">Lesson Plan Title</a></h2>
						<div class="ws-details">
							<div class="left-items items">
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
								</ul>
							</div>
						</div>
						<div class="ws-excerpt">
							<p>The training team creates downloadable lesson plans and related materials for instructors to use in a live workshop environment. We are welcome you to join Training Team. The training team creates downloadable lesson plans and related materials for instructors to use in a live workshop environment. We are welcome you to join Training Team.</p>
						</div>
						<div class="ws-excerpt ws-excerpt-list">
							<ul>
								<li>General History of WordPress</li>
								<li>High Leve Overview</li>
								<li>On-Click Install in Bluehost</li>
								<li>Overview of the Dashboard</li>
								<li>General History of WordPress</li>
								<li>High Leve Overview</li>
								<li>On-Click Install in Bluehost</li>
								<li>Overview of the Dashboard</li>
								<li>General History of WordPress</li>
								<li>High Leve Overview</li>
								<li>On-Click Install in Bluehost</li>
								<li>Overview of the Dashboard</li>
								<li>High Leve Overview</li>
							</ul>
						</div>
						
						<div class="ws-more">
							<a href="#">View All 17 Lesson Plans</a>
						</div>
					</div>
				</div>



			</div>
			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
