<?php
/**
 * 404 (not found) template
 *  
 * @package WordPress
 * @subpackage kitchenSinkTheme
 * @todo create a dynamic page that includes recent content/featured/etc...
 * 
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
 
get_header();

?>

<div id="bd">
<div id="page-other" class="page error404 not-found">
<?php 
_e( '<h1>WOOPS! We can\'t find that page!</h1>', 'twentyten' ); 
_e( '<p>Try searching or check the menu!</p>', 'twentyten' );
get_search_form(); 
?>
</div><!-- #page-other -->
</div><!-- close #bd -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
