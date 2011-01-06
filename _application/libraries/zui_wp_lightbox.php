<?php
/**
 * jquery Fancybox gallery stuff
 * 
 * Enqueues fancybox 1.3.4 and fixes [gallery] shortcode output 
 * 
 * You still need to call it in your javascript:
 * 
 * $("dt.gallery-icon a").fancybox({
            titlePosition: 'over'
    });
 * 
 * @package kitchenSinkTheme
 * @subpackage zui_functions_lightbox
 * @Version 0.2
 * @since 0.2
 * @link http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * @link http://fancybox.net/
 * @link http://www.viper007bond.com/wordpress-plugins/jquery-lightbox-for-native-galleries/ (thank you for making sense of the attachment link)
 * @link http://wordpress.org/support/topic/295401 (thank you)
 * @todo The WP filters seem like a kluge is there a better way? Perhaps adding rel with post id or something?
 * @todo Figure out a better way to deal with the stylesheet (merge all stylesheets into one and gzip on the fly?)
 */

 
/*
 * Load Fancybox via wphead();
 */
wp_enqueue_style('fancybox', get_template_directory_uri() . '/_assets/stylesheets/fancybox.1.3.4.css');
wp_enqueue_script('fancybox', get_bloginfo('template_url') . '/_assets/javascripts/jquery/jquery.fancybox-1.3.4.js' , array('jquery') , '1.3.4', false);

/*
 * Force gallery thumbnails to link to the fullsize image
 */
function fullsize_attachment_link( $link, $id ) {
    // The lightbox doesn't function inside feeds obviously, so don't modify anything
    if ( is_feed() || is_admin() )
        return $link;

    $post = get_post( $id );

    if ( 'image/' == substr( $post->post_mime_type, 0, 6 ) )
        return wp_get_attachment_url( $id );
    else
        return $link;
}
add_filter( 'attachment_link', 'fullsize_attachment_link', 10, 2 );

/*
 * Add rel="" to image attachment links for lightbox galleries
 * Deprecated in place of javascript solution
 */
/*
function add_lighbox_rel( $attachment_link ) {
	if( strpos( $attachment_link , 'href') != false && strpos( $attachment_link , '<img') != false )
		$attachment_link = str_replace( 'href' , 'rel="attachment_link" href' , $attachment_link );
	return $attachment_link;
}
add_filter( 'wp_get_attachment_link' , 'add_lighbox_rel' );
*/
?>
