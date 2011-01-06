<?php
/**
 * MP3 player for audio uploads
 *
 * Adds shortcode: [mp3player] e.g. [mp3player mp3="path/url/to/file.mp3" class="custom_class_name"]
 * 
 * N.B. SHORTCODE IS USED IN attachment.php and should be removed if this library is not used
 * 
 * @package kitchenSinkTheme
 * @subpackage zui_wp_meta_data
 * @version 0.3.1
 * @since 0.1
 * @link http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * 
 * @param string mp3 required path/url/to/file.mp3
 * @param string class optional custom class
 */
 
function zui_shortcode_mp3_player($atts, $content = NULL) {
    extract(shortcode_atts(array(
        'mp3'    => '',
		'class'	 => 'mp3_player',
		'width'  => '300',
		'height' => '20'
	), $atts));

	if ( empty($mp3) )
	    return false; //nothing to do
	
	$player_uri = get_bloginfo('template_url') . '/_assets/swf/player_mp3_maxi.swf';
	
	$output = 
<<< EOD
    <object type="application/x-shockwave-flash" data="{$player_uri}" width="{$width}" height="{$height}" class="{$class}">
    <param name="movie" value="{$player_uri}" />
    <param name="bgcolor" value="#ffffff" />
    <param name="FlashVars" value="mp3={$mp3}&amp;width={$width}&amp;autoplay=0&amp;autoload=1&amp;showstop=1&amp;showinfo=1&amp;showvolume=1&amp;showloading=always&amp;buttonwidth=25&amp;sliderwidth=10&amp;volumewidth=35&amp;volumeheight=8&amp;loadingcolor=888888&amp;buttonovercolor=888888" />
</object>	
EOD;
    
    return $output;
}
add_shortcode('mp3player', 'zui_shortcode_mp3_player');
?>
