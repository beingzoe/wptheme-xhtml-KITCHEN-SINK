<?php
/**
 * Search results template
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 * Based on Twenty Ten search.php
 */

get_header(); 

?>

<div id="bd" class="hfeed">
<div id="page-other" class="page">
<?php if ( have_posts() ) : ?>
    
    <h1><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    <?php
    /* Run the loop for the search to output the results.
     * If you want to overload this in a child theme then include a file
     * called loop-search.php and that will be used instead.
     */
     get_template_part( 'loop', 'search' );
    ?>
    
<?php else : ?>
    <h1>Search</h1>
    <p><?php _e( 'Huh, nothing matched your search criteria.<br />Please try again with some different keywords.', 'twentyten' ); ?></p>
    <?php get_search_form(); ?>

<?php endif; ?>
</div><!-- #page-other -->
</div><!-- #bd -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
