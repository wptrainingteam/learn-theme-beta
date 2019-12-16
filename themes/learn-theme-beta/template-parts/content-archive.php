<?php
/**
 * Template part for displaying single posts in an archive list.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBBP
 */

?>

<div class="lp-item <?php echo (wporg_post_type_is_workshop() ? "lp-item--full" : "") ?>">
	<div class="lp-item-wrap <?php echo (wporg_post_type_is_workshop() ? "lp-item-wrap--split" : "") ?>">
		<h2><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h2>
		<div class="lp-body">
			<p class="lp-excerpt"><?php echo esc_attr( get_the_excerpt() ); ?></p>
			<div class="lp-details">
				<ul>
					<?php 
						foreach( wporg_get_custom_taxonomies() as $detail ) {
							if( !empty( $detail[ 'values' ] ) ) {
								include( locate_template( 'template-parts/component-taxonomy-item.php' ) ); 
							}			
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
