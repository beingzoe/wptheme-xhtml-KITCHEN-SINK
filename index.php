<?php
/**
 * Blog index main template
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */

get_header(); 

?>

<div id="bd" class="hfeed">

<?php get_template_part( 'loop', 'index' ); ?>

</div><!-- #bd -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
