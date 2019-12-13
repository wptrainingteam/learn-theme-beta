<?php
/**
 * Template part for displaying navigation in archive.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBBP
 */

?>

<nav id="site-navigation" class="directory-navigation" role="navigation">
    <ul id="menu-theme-directory" class="menu">
        <li class="<?php echo (get_post_type() == 'lesson-plan' ? "current" : "") ?>"><a href="<?php echo home_url( '/lesson-plans/' ); ?>"><?php _e( 'Lesson Plans', 'wporg-themes' ); ?></a></li>
        <li class="<?php echo (get_post_type() == 'workshop' ? "current" : "") ?>"><a href="<?php echo home_url( '/workshops/' ); ?>"><?php _e( 'Workshop Ideas', 'wporg-themes' ); ?></a></li>
    </ul>
</nav>