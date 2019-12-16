<?php
/**
 * Template part for displaying bbPress topics on the front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBBP
 */

?>

<li>
    <span class="dashicons dashicons-<?php echo $detail[ 'icon' ] ?>"></span>
    <?php _e( $detail[ 'label'] ); ?> <strong>
    <span><?php echo $detail[ 'values' ] ?></span></strong>
</li>