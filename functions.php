<?php
/**
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */


/**
 * Initialize Theme
 */ 
/* SETTINGS */
    $theme_name = "Kitchen Sink Demo"; //required; friendly name used by all widgets, libraries, and classes
    $theme_id = "kst_0_2"; //required; Prefix for namespacing libraries, classes, widgets
    $theme_options = array (
                        /* required if using zui_wp_theme_options.php or zui_wp_meta_data.php
                         * can be an empty array if only used for zui_wp_meta_data.php
                         * 
                         * For full usage see zui_wp_theme_options.php
                         * option id e.g. "my_option" -> "theme_id_my_option"
                         * <?php echo get_zui_wp_theme_option("my_option"); ?>
                         */
                            /* Page title settings */
                            array(  "desc"    => __("
                                                    <h3>Analytics</h3>
                                                "),
                                    "type"    => "section"),
                            
                            array(  "name"  => __('Google Analytics Tracking ID'),
                                        "desc"  => __('Leave blank if not used or using a Google Analytics plugin e.g. UA-XXXXXXX-X'),
                                        "id"    => "zui_google_analytics",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "15")
                        );
/* CONSTANTS */
    define("RELATIVEROOTINCLUDE", TEMPLATEPATH . '/../../../../'); //edit to be path to root of website; safely include files from root on any WP path
/* LIBRARIES */
    require_once TEMPLATEPATH  . '/_application/libraries/zui_wp_theme_options.php'; //Does nothing if $theme_options does not exist
    require_once TEMPLATEPATH  . '/_application/libraries/zui_wp_meta_data.php'; //Dependent on theme_options
    require_once TEMPLATEPATH  . '/_application/libraries/zui_wp_theme_help.php'; //Activates and includes admin help file theme_help.php 
    require_once TEMPLATEPATH  . '/_application/libraries/zui_zmail.php'; //send email abstraction functions
    require_once TEMPLATEPATH  . '/_application/libraries/zui_wp_mp3_player.php'; //mp3 player shortcode - used in attachment.php if exists
/* WIDGETS */
    require_once TEMPLATEPATH  . '/_application/widgets/ZUIWidgetNextPreviousPost.php'; //Widget: Post to post next/previous
    require_once TEMPLATEPATH  . '/_application/widgets/ZUIWidgetOlderNewerPosts.php'; //Widget: Posts older/newer
/* SHORTCODES */
    
/* init functions */
    init_html(); //build html externals etc... (wp_head/wp_footer)
    init_sidebars(); //initialize dynamic sidebars
    init_nav_menu(); //initialize registered menus and fallbacks
    init_post_thumbnails(); //setup post thumbnails


/**
 * init_html
 * Build the html head, footer, and css/js features. 
 * Handled here for WP plugin compatibility and ease of configuration
 * 
 * @uses is_admin() WP function
 * @uses wp_enqueue_style() WP function
 * @uses get_bloginfo() WP function
 * @uses get_template_directory_uri() WP function
 * @uses wp_deregister_script() WP function
 * @uses wp_register_script() WP function
 * @uses wp_enqueue_script() WP function
 * @uses remove_action() WP function
 * @uses add_theme_support() WP function
 */
function init_html() { 
    global $wp_styles;
    /* Load CSS with WordPress Compatibility */
    if ( !is_admin() ) {
        /* styles.css */
        wp_enqueue_style( 'style', get_bloginfo('stylesheet_url'), false, '0.1', 'all' );
        wp_enqueue_style('style_ie6-7', get_template_directory_uri() . '/style_ie6-7.css');
        $wp_styles->add_data( 'style_ie6-7', 'conditional', 'lte IE 7' ); //adds conditional comment
    }
    /* remove bad gallery inline css */
    add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );
    /* Load JAVASCRIPT with WordPress Compatibility */
    if ( !is_admin() ) {
        
        /* Load jQuery: Register jQuery from Google CDN; Avoid plugin conflicts; */
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', false, '1.4.2', true);
        wp_enqueue_script('jquery');
        
        /* Load jQuery: corner */
        //wp_enqueue_script('corner', get_bloginfo('template_url') . '/_assets/javascripts/jquery/jquery.corner.js' , array('jquery') , '2.11', true);
        /* Load jQuery: fancybox lightbox */
        require_once TEMPLATEPATH  . '/_application/libraries/zui_wp_lightbox.php'; //lightbox; includes hacks for [gallery] shortcode
        /* scrollabe/cyclable content - CHOOSE either scrollables or cycle */
            /* Load jQuery: tools: scrollable */
            require_once TEMPLATEPATH  . '/_application/libraries/zui_wp_scrollables.php'; //create scrollable and shortcode to use it
            /* Load jQuery: malsup cycle content */
            require_once TEMPLATEPATH  . '/_application/libraries/zui_wp_jquery_cycle.php'; //create scrollable and shortcode to use it
        /* Load jQuery: zui JIT message */
        require_once TEMPLATEPATH  . '/_application/libraries/zui_wp_jit_message.php'; //JIT (just in time) message box
        
        /* Theme Application JS */   
        wp_enqueue_script('application', get_bloginfo('template_url') . '/_assets/javascripts/application.js' , array('jquery') , '0.1', true);
        
        /* Load comment-reply (create comment form at reply link) */
        function load_js_comment_reply(){
            if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) ) )
                wp_enqueue_script( 'comment-reply' );
        }
        add_action('wp_print_scripts', 'load_js_comment_reply'); // added to the wp_print_scripts action as is_singular and comments_open are unknown during the init action
    }
    /* Remove junk from head */
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    
    /* Add junk to head */
    /* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );
}


/**
 * Initialize widgetized sidebars
 */
function init_sidebars() {
    register_sidebar( array(
        'name' => 'Blog Sidebar',
        'id' => 'sidebar_blog',
        'description' => 'Sidebar content for blog articles',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => 'Pages Sidebar',
        'id' => 'sidebar_pages',
        'description' => 'Sidebar content for pages',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => 'Home Sidebar',
        'id' => 'sidebar_home',
        'description' => 'Sidebar content for home',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}


/**
 * Register theme menus with built-in WP menus
 * Also set default fallback menu functions
 */
function init_nav_menu() {
    register_nav_menu('hd_menu', 'Masthead Menu'); //primary site nav
    register_nav_menu('ft_menu', 'Footer Menu'); //footer nav
}
    

/**
 * Theme uses featured image post/page thumbnails
 */
function init_post_thumbnails() { 
    add_theme_support( 'post-thumbnails' );
    /*
    NOTE:   I no longer use the WP post-thumbnail due to problems with it not being included
            in edits to images using the WP admin image editor (i.e. cropping)
            -Theme support for "featured image / post thumbnails" is turned on
            -I use the built-in WP 'thumbnail' image size for the thumbnails
            -If I need a 'post' size featured image I install the plugin "Additional Image Sizes"
                I always install this plugin and create the image size:
                "single-post-max-width" (full content width image for layout)
                
    Otherwise if you want to use the new featured image functionality this is it:
    set_post_thumbnail_size( 150, 150, false ); // Normal post thumbnails; the_post_thumbnail();
    add_image_size( 'post-thumbnail-single', 700, 9999, false ); // Full content width; the_post_thumbnail('post-thumbnails-single');
    */
}

/**
 * Added functionality
 */
            
    /**
     *  ADMIN: TinyMCE 
     */
    if ( is_admin() ) {
        /* TinyMCE "Format" dropdown - reorder/add block level elements */
        function fb_change_mce_buttons( $initArray ) {
            //@see http://wiki.moxiecode.com/index.php/TinyMCE:Control_reference
            $initArray['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4,h5,h6,address,pre,code,div';
            $initArray['theme_advanced_disable'] = 'forecolor';
             
            return $initArray;
        }
        add_filter('tiny_mce_before_init', 'fb_change_mce_buttons');
        
        /** 
         * Style the TinyMCE editor a little bit editor-style.css
         * WP built-in function 
         */
        add_editor_style();
    }

/**
 * Custom output and override existing functionality 
 */

    /**
     * Remove inline styles printed when the gallery shortcode is used.
     */
    function twentyten_remove_gallery_css( $css ) {
        return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
    }
    
    
    /** 
     * wp_list_comments();
     * Callback function to filter/replace the default WP comments markup
     * 
     * This is stupid. I refuse to use the default markup that function spits out.
     * Hopefully that doesn't come back to haunt me with plugins later ;)
     * The Codex shows you how to do this and then says "don't do it".
     * We'll see.
     *
     * @name $comment
     * @global $GLOBALS['comment']
     * @uses comment_class()
     * @uses comment_ID()
     * @uses get_avatar()
     * @uses __()
     * @uses get_comment_link()
     * @uses edit_comment_link()
     * @uses get_comment_author_link()
     * @uses get_comment_date()
     * @uses get_comment_time()
     * @uses comment_text()
     * @uses comment_reply_link()
     */
    function zui_format_wp_list_comments_comment($comment, $args, $depth) {
        
        $GLOBALS['comment'] = $comment; ?>
        
        <?php if ($comment->comment_approved == '0') : ?>
            <li class="comment-moderate"><?php _e('Your comment is awaiting moderation.') ?></li>
        <?php endif; ?>
        
        <li id="li-comment-<?php comment_ID() ?>" <?php comment_class('clearfix'); ?>>
            
            <?php if ( get_option('show_avatars') ) : ?>
                <div class="comment_avatar">
                    <?php echo get_avatar($comment, $size='48' ); ?>
                </div>
            <?php endif; ?>
            
            <div id="comment-<?php comment_ID(); ?>" <?php comment_class('clearfix'); ?>>
                <div class="comment-author vcard">
                    <?php 
                        //printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link())
                        printf(__('<cite class="fn">%s</cite>'), get_comment_author_link())
                    ?>
                </div>
            
                <div class="comment-meta commentmetadata">
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"
                    ><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
                </div>
                
                <div class="comment-comment">
                    <?php comment_text(); ?>
                </div>
                
                <div class="reply">
                    <?php 
                        comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
                        edit_comment_link(__('Edit'),'  ',''); 
                    ?>
                </div>
            </div>
    <?php
            }
    
            
    /*
     * zui_caption_shortcode_overload 
     * 
     * Outputs 'insert media'>[caption] 'better'
     * This output is identical to the layout in attachment.php
     * 
     * Output
        <div class="wp_attachment">
            <a><img>
            <div class="wp_caption">
        </div>
     * 
     * @since 0.2
     * @Thanks wpengineer for having dealt with this already
     * @link http://wpengineer.com/filter-caption-shortcode-in-wordpress/
     */
    function zui_caption_shortcode_overload($attr, $content = null) {
     
        // Allow plugins/themes to override the default caption template.
        $output = apply_filters('img_caption_shortcode', '', $attr, $content);
        if ( $output != '' )
            return $output;
     
        extract(shortcode_atts(array(
            'id'	=> '',
            'align'	=> '',
            'width'	=> '',
            'caption' => ''
        ), $attr));
    
        if ( $id ) 
            $id = 'id="' . $id . '" ';
        
        if (!empty($width) )
            
        $width = ( !empty($width) ) 
            ? ' style="width: ' . ((int) $width) . 'px" '
            : '';
        
        $better = '<div ' . $id . $width . 'class="wp_attachment">';
        $better .= do_shortcode( $content );
        if ( !empty($caption) )
            $better .= '<div class="wp_caption">' . $caption .'</div>';
        $better .= '</div>';
        
        return $better;
    }
    add_shortcode('wp_caption', 'zui_caption_shortcode_overload');
    add_shortcode('caption', 'zui_caption_shortcode_overload');

?>
