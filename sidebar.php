<?php
/**
 * Default "blog" sidebar partial include
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 * 
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
?>

<div id="sb" class="wp_sidebar">
<ul class="widgets">
 
<?php
if ( is_home() ) {
    if ( ! dynamic_sidebar( 'sidebar_home' ) ) { ?>
    
        <li id="search" class="widget-container widget_search">
            <?php get_search_form(); ?>
        </li>
    
        <li id="archives" class="widget-container">
            <h3 class="widget-title"><?php _e( 'Archives', 'twentyten' ); ?></h3>
            <ul>
                <?php wp_get_archives( 'type=monthly' ); ?>
            </ul>
        </li>
    
        <li id="meta" class="widget-container">
            <h3 class="widget-title"><?php _e( 'Meta', 'twentyten' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </li>
<?php 
    }} else if ( is_page()  ) {
            if ( ! dynamic_sidebar( 'sidebar_pages' ) ) { ?>
            
                <li id="search" class="widget-container widget_search">
                    <?php get_search_form(); ?>
                </li>
            
                <li id="archives" class="widget-container">
                    <h3 class="widget-title"><?php _e( 'Archives', 'twentyten' ); ?></h3>
                    <ul>
                        <?php wp_get_archives( 'type=monthly' ); ?>
                    </ul>
                </li>
            
                <li id="meta" class="widget-container">
                    <h3 class="widget-title"><?php _e( 'Meta', 'twentyten' ); ?></h3>
                    <ul>
                        <?php wp_register(); ?>
                        <li><?php wp_loginout(); ?></li>
                        <?php wp_meta(); ?>
                    </ul>
                </li>
        <?php 
            }
} else {
    if ( ! dynamic_sidebar( 'sidebar_blog' ) ) { ?>
    
        <li id="search" class="widget-container widget_search">
            <?php get_search_form(); ?>
        </li>
    
        <li id="archives" class="widget-container">
            <h3 class="widget-title"><?php _e( 'Archives', 'twentyten' ); ?></h3>
            <ul>
                <?php wp_get_archives( 'type=monthly' ); ?>
            </ul>
        </li>
    
        <li id="meta" class="widget-container">
            <h3 class="widget-title"><?php _e( 'Meta', 'twentyten' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </li>
<?php 
    }
}
?>
    
</ul><!-- .widgets -->
</div><!-- #sb -->
