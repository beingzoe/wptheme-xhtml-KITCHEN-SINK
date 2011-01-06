<?php
/**
 * Page template
 *  
 * @package WordPress
 * @subpackage kitchenSinkTheme
 * 
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
 
get_header();

?>

<div id="bd" class="hfeed">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    
        <div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
        
            <?php /* the_title(); not used for most cms style installs for SEO control */ ?>
            
            <div class="wp_entry">
                <?php the_content(); ?>
            </div><!-- .wp_entry -->
            
            <?php include ('include_wp_link_pages.php'); ?>
            
            <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="wp_entry_meta wp_entry_meta_edit">', '</span>' ); ?>
            
        </div><!-- .page -->
    
    <?php endwhile; ?>
    
</div><!-- close #bd -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
