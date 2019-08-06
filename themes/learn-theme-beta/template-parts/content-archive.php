<?php
/**
 * Template part for displaying single posts in an archive list.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBBP
 */

?>

<div class="lp-item">
	<div class="lp-item-wrap">
		<h2><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h2>
		<p class="lp-excerpt"><?php the_excerpt(); ?></p>
		<div class="lp-details">
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
			<div class="right-items items">
				<ul>
					<li>
						<span class="dashicons dashicons-welcome-learn-more"></span>
						Type of Instruction: <strong>Presentation, Demostration</strong>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
