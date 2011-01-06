<?php 
/**
 * Display the search form 
 * Default WP DRY include/partial
 * 
 * Typically appears in widgetized sidebar and the search page
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
?>
<form action="<?php site_url(); ?>" class="searchform" method="get">
	<div>
        <!--<label for="search" class="screen-reader-text">Search</label>-->
        <input type="text" id="search" name="s" value="" size="15" />
        <input type="submit" value="search" class="input_image_button sprite_button_search" />
	</div>
</form>
