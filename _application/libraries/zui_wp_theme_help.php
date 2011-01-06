<?php 
/**
 * Theme Help
 * Creates menu item and includes <theme>/theme_help.php
 * 
 * @package kitchenSinkTheme
 * @subpackage zui_functions_theme_help
 * @version 0.1
 * @since 0.2
 * @param string $theme_name 
 * @param string $theme_id
 * @link http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * @todo convert to class
 */
if ( ( is_admin() ) && isset($theme_id) && isset($theme_name) ) 
    add_action('admin_menu', 'zui_theme_help_menu');

function zui_theme_help_menu() {
    
    global $theme_name, $theme_id;
   
    /* add new menu under Appearance */
    add_submenu_page("themes.php", "$theme_name Theme Help and Notes", "Theme Help", "publish_posts", "{$theme_id}_help", "zui_theme_help_page");
}

function zui_theme_help_page() {
  
    global $theme_name, $theme_id;
    
    if (!current_user_can('publish_posts'))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    
    /* OUTPUT the actual help page */
    echo "<div class='wrap'>"; //Standard WP Admin content class
    if ( function_exists('screen_icon') ) screen_icon();
    echo "<h2>$theme_name theme help</h2>";
    
    $help_file = TEMPLATEPATH . '/theme_help.php';
    
    if ( file_exists( $help_file ) ) 
        include( $help_file );
    else 
        echo "<p>No special help required for this theme</p>";

    echo "</div>"; //.wrap
}
?>
