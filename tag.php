<?php
/**
 * Tag archive template
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 * Based on Twenty Ten tag.php
 */

get_header(); 

?>

<div id="bd" class="hfeed">
    
    <h1><?php
        printf( __( '<span class="smaller quiet">Content Tagged:</span> %s', 'twentyten' ), '<span>' . single_tag_title( '', false ) . '</span>' );
    ?></h1>

    <?php
    /* Run the loop for the tag archive to output the posts
     * If you want to overload this in a child theme then include a file
     * called loop-tag.php and that will be used instead.
     */
     get_template_part( 'loop', 'tag' );
    ?>

</div><!-- #bd -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
