<?php
/**
 * Category archive template
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 * Based on Twenty Ten category.php
 */

get_header(); 

?>

<div id="bd" class="hfeed">

    <h1><?php
        printf( __( '<span class="smaller quiet">Category:</span> %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
    ?></h1>
    <?php
        $category_description = category_description();
        if ( ! empty( $category_description ) )
            echo '<div class="archive-meta">' . $category_description . '</div>';

    /* Run the loop for the category page to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-category.php and that will be used instead.
     */
    get_template_part( 'loop', 'category' );
    ?>

</div><!-- #bd -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
