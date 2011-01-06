<?php 
/**
 * jQuery jit_message (just-in-time message) box
 * using WordPress custom field for activation and content
 * 
 * Does nothing if not on a single post/page and custom field "jit_message" does not exist
 *
 * If viewing a post/page and custom field "jit_message" exists
 * Enqueues jit_message 0.1 plugin
 * Then creates the #jit_box by
 *      * finding a specific post by ID; jit_message = int;
 *      * finding a random post; jit_message = "random" or "?";
 *      * outputting explicit text/markup; jit_message = any other string
 *        May contain any markup if not then it is wrapped in h1
 * 
 * Inspired by the same feature at http://www.tutorial9.net/resources/free-download-dirty-spray-photoshop-brushes/
 * 
 * @package kitchenSinkTheme
 * @subpackage zui_functions_jit_message
 * @version 0.1
 * @since 0.2
 * @link http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * @todo turn the javascript into jQuery plugin
 * @todo add options
 * @todo add option for trigger_selector
 */

/**
 * Initialize
 */
add_action('wp', 'jit_test'); 

/**
 * Check for jit_message in current post
 * Wait until "wp" function to be sure we have the global $post variable to use
 */
function jit_test() {
    global $post;
    
    if ( is_single() || is_page() ) { 
        
        global $jit_message;
        
        $jit_message = get_post_meta($post->ID, 'jit_message', true);
        
        /* if we have a jit_message then set it up and do stuff */
        if ( $jit_message == true ) {
            wp_enqueue_style('jit_message', get_bloginfo('template_url') . '/_assets/stylesheets/jit_message.css');
            wp_enqueue_script('jit_message', get_bloginfo('template_url') . '/_assets/javascripts/jquery/jquery.zui_jit_message.js' , array('jquery') , '0.1', true);
            add_action('wp_footer', 'the_jit_box');
        }
        
    }
}


/**
 * Build and insert the jit box
 * 
 * Uses custom field "jit_message" to trigger:
 *      int = explicit post_id
 *      string = explicit message?
 * 
 * @param $jit_message required gotten from global space 
 * @todo for random try to get in the same category/tag combination first then just categories then tags then random
 */
function the_jit_box() {
    global $jit_message;
    
    /* Test what type of message it is */
    if ( is_numeric( $jit_message ) ) {
        /* specific post (by id) */
        $jit_posts = get_posts("numberposts=1&include={$jit_message}"); 
    } else if ( strtolower($jit_message) == 'random' || $jit_message == '?' ) {
        /* a random post */
        $jit_posts = get_posts("numberposts=1&orderby=rand");
    } else {
        /* explicit message: format it here */
        $output_jit_box_image = "";
        $output_jit_box_info = '<div class="jit_box_info">';
        if (preg_match("/([\<])([^\>]{1,})*([\>])/i", $string)) { //Is there markup?
            $output_jit_box_info .= $jit_message;
        } else { //guess not so format it
            $output_jit_box_info .= "<h1>{$jit_message}</h1>";
        }
        $output_jit_box_info .= '</div>';
    }
    
    /* Yay we found the post ($jit_posts) so format it */
    if ( isset( $jit_posts ) ) {
        
                $the_permalink = get_permalink($jit_posts[0]->ID); 
                $the_title = $jit_posts[0]->post_title;
                if ( has_post_thumbnail($jit_posts[0]->ID) ) {
                    $the_post_thumbnail = get_the_post_thumbnail($jit_posts[0]->ID); //get default size thumbnail
                } else {
                    $the_post_thumbnail = '<img src="http://beingzoedev/zui/wordpress/3_0/wp-content/uploads/2010/07/got_water_1-150x150.jpg" alt="" />'; //get default size thumbnail
                }
                $output_jit_box_image = 
<<<EOD
<div class="jit_box_image">
    <a href="{$the_permalink}">{$the_post_thumbnail}</a>
</div>
EOD;
                $output_jit_box_info =
<<<EOD
<div class="jit_box_info">
    <h1>
        You might also like...<br />
        <a href="{$the_permalink}">{$the_title}</a>
    </h1>
</div>
EOD;
    }
    
?>
    <div id="jit_box">
        <?php echo $output_jit_box_image; ?>
        <?php echo $output_jit_box_info; ?>
        <div class="jit_box_close"><a>Close</a></div>
    </div>
    <script type="text/javascript">
    /* <![CDATA[ */
        jQuery(document).ready(function($) { // noconflict wrapper to use shorthand $() for jQuery() inside of this function
            if(jQuery().jit_message) {
                $(this).jit_message();
            };
        });
    /* ]]> */
    </script>
<?php
}
?>
