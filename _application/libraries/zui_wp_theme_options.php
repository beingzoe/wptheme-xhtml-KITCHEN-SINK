<?php
/**
 * Theme Options
 * Creates menu item and builds options page using theme_options array
 * 
 * @package kitchenSinkTheme
 * @subpackage zui_functions_theme_options
 * @version 0.3
 * @since 0.1
 * @param string $theme_name 
 * @param string $theme_id
 * @param array $theme_options Options used by theme. Also content for options menu/page.
 * @link http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * @todo convert to class
 * @todo finish adding size option to control input sizes (do it better)
 * 
 * Based on WP 2.7+ documentation
 * (http://codex.wordpress.org/Adding_Administration_Menus)
 * (http://codex.wordpress.org/Creating_Options_Pages)
 * And using code and concepts from the Biblioteca framework theme (http://wpshout.com/)
 */

/**
 * Create the theme options menu and page
 * if is_admin()
 * if $theme_options array exists
 * 
 * @since 0.1
 * @global $theme_options tests for existence as array
 * @uses add_action() WP function
 * @uses zui_theme_option_menu()
 */
if ( ( is_admin() ) && isset($theme_options) && is_array($theme_options) ) 
    add_action('admin_menu', 'zui_theme_option_menu');

/**
 * Add hooks to create theme options menu and page
 * 
 * @since 0.1
 * @global $theme_name used to create html title for options page
 * @global $theme_id used to give namespace for options
 * @uses add_theme_page() WP function
 * @uses add_action() WP function
 * @uses zui_theme_options()
 * @uses zui_register_theme_options()
 */
function zui_theme_option_menu() {
    
    global $theme_name, $theme_id;
    
    /* register settings for options */
    add_action( 'admin_init', 'zui_register_theme_options' );
    
    /* add new menu under Appearance */
    add_submenu_page('themes.php', "$theme_name Theme Options", 'Theme Options', 'manage_options', "{$theme_id}_options", 'zui_theme_options');
}

/**
 * Register the options with WP
 * 
 * @since 0.1
 * @global $theme_id used to give namespace for options 
 * @global $theme_options used to register option names with WP
 * @uses register_setting() WP function
 * 
 * NOTE: Creates option with theme_id prepended
 *       "option_1" is saved to the db as "{$theme_id}_option_1"
 */
function zui_register_theme_options() {
    
    global $theme_id, $theme_options;
    
	/**
	 * register our options with WP
	 * must register each option to be used in options form
	 */
	foreach ($theme_options as $value) {
	    if ( isset($value['id']) )
	        register_setting( "{$theme_id}_options_group", $theme_id . "_" . $value['id'] );
	}
}

/**
 * Get ZUI WP theme option
 * 
 * Replaces native get_option for convenience
 * So instead of get_option("{$theme_id}_admin_email");
 * you can get_zui_wp_theme_option("admin_email");
 *
 * get_zui_wp_theme_option("home_keywords", $default)
 * 
 * @since 0.2
 * @global $theme_id
 * @uses get_option
 * @param option    string
 * @param default   ANY     optional, defaults to NULL
 */
function get_zui_wp_theme_option($option, $default = NULL) {
    
    global $theme_id;
    
    return get_option("{$theme_id}_{$option}", $default);
}

/**
 * Test for existence of ZUI WP theme option
 *
 * Returns true if option exists regardless of trueness
 * WP get_option returns false if option does not exist 
 * AND if it does and is false
 *
 * N.B.: This is an entire query and obviously a speed hit so use wisely
 * 
 * @since 0.2
 * @global $wpdb, $theme_id
 * @param option string
 */ 
function zui_option_exists($option) {
    
    global $wpdb, $theme_id;
    
    $option = "{$theme_id}_{$option}";
    $row = $wpdb->get_row( "SELECT option_value FROM $wpdb->options WHERE option_name = '{$option}' LIMIT 1", OBJECT );
    
    if ( is_object( $row ) )
        return true;
    else 
        return false;
    
}

/**
 * Build the theme options menu
 * Loops the $theme_options array
 * Outputs form data for editing
 * 
 * @since 0.1
 * @global $theme_name displayed in page h1 header
 * @global $theme_id used to give namespace for options 
 * @global $theme_options used to build output for options page
 * @uses current_user_can() WP function
 * @uses wp_die() WP function
 * @uses screen_icon() WP function
 * @uses settings_fields() WP function (outputs required hidden fields based on zui_register_theme_options())
 * @uses __() WP function localize if language exists
 * @uses _e() WP function 
 */
function zui_theme_options() {
  
    global $theme_name, $theme_id, $theme_options;
    
    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    
    /* OUTPUT the actual options page */
    echo "<div class='wrap'>"; //Standard WP Admin content class
    if ( function_exists('screen_icon') ) screen_icon();
    echo "<h2>$theme_name theme options</h2>";
    
    /* Give response on action */
    if ( isset($_REQUEST['updated']) ) 
        echo "<div id='message' class='updated fade'><p><strong>$theme_name settings saved.</strong></p></div>";
    if ( isset($_REQUEST['reset']) ) 
        echo "<div id='message' class='updated fade'><p><strong>$theme_name settings reset.</strong></p></div>";
    
    echo "<form method='post' action='options.php'>";
    
        settings_fields( "{$theme_id}_options_group" );
        
        echo '<table class="form-table">';
        
        /**
         * @TODO replace old form-table with new meta-box
         */
        
        /* loop and output options form */
        foreach ($theme_options as $value) { 
        
            switch ( $value['type'] ) {
                
                case 'text':
                    if ( $value['size'] )
                        $size = $value['size'];
                    else
                        $size = 60;
                    ?>
                    <tr valign="top"> 
                        <th scope="row">
                            <label for="<?php echo "{$theme_id}_{$value['id']}"; ?>">
                                <?php echo __($value['name']); ?>
                            </label>
                        </th>
                        <td>
                            <input  name="<?php echo "{$theme_id}_{$value['id']}"; ?>" 
                                    id="<?php echo "{$theme_id}_{$value['id']}"; ?>" 
                                    type="<?php echo $value['type']; ?>" 
                                    size="<?php echo $size; ?>" 
                                    value="<?php 
                                            if ( get_zui_wp_theme_option( $value['id'] ) != "") { 
                                                echo get_zui_wp_theme_option( $value['id'] ); 
                                            } else { 
                                                echo $value['std']; 
                                            } ?>"
                                    /><br />
                            <?php echo __($value['desc']); ?>
            
                        </td>
                    </tr>
                    <?php
                break;
                
                case 'textarea':
                    $ta_options = $value['options'];
                    ?>
                    <tr valign="top"> 
                        <th scope="row">
                            <label for="<?php echo "{$theme_id}_{$value['id']}"; ?>">
                                <?php echo __($value['name']); ?>
                            </label>
                        </th>
                        <td>
                            <textarea   name="<?php echo "{$theme_id}_{$value['id']}"; ?>" 
                                        id="<?php echo "{$theme_id}_{$value['id']}"; ?>" 
                                        cols="<?php echo $ta_options['cols']; ?>" 
                                        rows="<?php echo $ta_options['rows']; ?>"
                                        ><?php 
                                        if( get_option($value['id']) != "") {
                                            echo __( stripslashes( get_zui_wp_theme_option( $value['id'] ) ) );
                                        }else{
                                            echo __( $value['std'] );
                                        }
                                        ?>
                            </textarea><br />
                            <?php echo __($value['desc']); ?>
                        </td>
                    </tr>
                    <?php
                break;
                
                case 'select':
                    ?>
                    <tr valign="top">
                        <th scope="row">
                            <label for="<?php echo "{$theme_id}_{$value['id']}"; ?>"><?php echo __($value['name']); ?></label>
                        </th>
                        <td>
                            <select name="<?php echo "{$theme_id}_{$value['id']}"; ?>" id="<?php echo "{$theme_id}_{$value['id']}"; ?>" >
                            <?php foreach ($value['options'] as $option) { ?>
                                <option
                                    <?php 
                                    if ( get_zui_wp_theme_option( $value['id'] ) == $option) { 
                                        echo ' selected="selected"'; 
                                    } elseif ($option == $value['std']) { 
                                        echo ' selected="selected"'; 
                                    } 
                                    ?>>
                                    <?php echo $option; ?>
                                </option>
                            <?php } ?>
                            </select><br />
                            <?php echo __($value['desc']); ?>
                        </td>
                    </tr>
                    <?php
                break;
                
                case 'radio':
                    ?>
                    <tr valign="top"> 
                        <th scope="row"><?php echo __($value['name']); ?></th>
                        <td>
                            <?php foreach ($value['options'] as $key=>$option) { 
                                $checked = "";
                                if( get_zui_wp_theme_option( $value['id'], NULL ) ){
                                    if ( $key == get_zui_wp_theme_option( $value['id'] ) ) {
                                        $checked = "checked=\"checked\"";
                                    }
                                }else{
                                    if($option == $value['std']){
                                        $checked = "checked=\"checked\"";
                                    }
                                }?>
                                <input  type="radio" 
                                        name="<?php echo "{$theme_id}_{$value['id']}"; ?>" 
                                        id="<?php echo "{$theme_id}_{$value['id']}" . $key; ?>" 
                                        value="<?php echo $option; ?>" <?php echo $checked; ?> 
                                        />
                                <label for="<?php echo "{$theme_id}_{$value['id']}" . $key; ?>">
                                    <?php echo $option; ?>
                                </label><br />
                            <?php } ?>
                            <?php echo __($value['desc']); ?>
                        </td>
                    </tr>
                    <?php
                break;
                
                case 'checkbox':
                    ?>
                    <tr valign="top"> 
                        <th scope="row"><?php echo __($value['name']); ?></th>
                        <td>
                            <?php
                                $checked = "";
                                
                                if( get_zui_wp_theme_option( $value['id'] ) == '1' ){
                                    $checked = "checked=\"checked\"";
                                }else if( !zui_option_exists( $value['id'] ) && $value['std']){
                                    $checked = "checked=\"checked\"";
                                }
                            ?>
                            <input  type="checkbox" 
                                    name="<?php echo "{$theme_id}_{$value['id']}"; ?>" 
                                    id="<?php echo "{$theme_id}_{$value['id']}"; ?>" 
                                    value="1" <?php echo $checked; ?> />
                            <label for="<?php echo "{$theme_id}_{$value['id']}"; ?>">
                                <?php echo __($value['desc']); ?>
                            </label>
                        </td>
                    </tr>
                    <?php
                break;
                
                case 'section':
                    ?>
                    <tr>
                        <th scope="row"colspan="2">
                            <?php echo __($value['desc']); ?>
                        </th>
                    </tr>
                    <?php
                break;
        
                default:
        
                break;
            }
        }
        
        echo "</table>";
        echo "<p class='submit'>";
        echo "<input type='submit' class='button-primary' value='" . __('Save Changes') . "' />";
        //        ?><?php __('Save Changes'); ?><?php
        //echo    '" />'; 
        echo "</p>";
    echo "</form>";
        /* provide reset */ 
        //echo "<form method='post' action=''>";
        //echo "<p class='submit'>";
        //echo "<input name='reset' type='submit' value='" . __('Reset') . "' />";
        //echo "<input type='hidden' name='action' value='reset' />";
        //echo "</p>";
        //echo "</form>";
    echo "</div>"; //end options page 'wrap'

}
?>
