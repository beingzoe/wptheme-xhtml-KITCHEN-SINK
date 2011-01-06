<?php
/**
 * Single post template
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div id="bd" class="hfeed">

<?php 
    if ( have_posts() ) while ( have_posts() ) { 
        the_post(); 
?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php include ('include_entry_header.php'); ?>
            
            <?php
                /* show featured image if exists, page 1 if paged, and we have not included a flag otherwise not to */
                if ( has_post_thumbnail() && $page == 1 && !get_post_meta($post->ID, 'hide_featured_image', true) ) {
                    echo "<div class='post-thumbnail-single'>"; 
                    the_post_thumbnail('post-thumbnail-single', array('class' => 'aligncenter post-thumbnail-single') );
                    echo "</div>";
                }
            ?>
            
            <?php include ('include_wp_link_pages.php'); ?>
            
            <div class="wp_entry">
                <?php the_content(); ?>
            </div><!-- .wp_entry -->
            
            <?php include ('include_wp_link_pages.php'); ?>
            
            <?php 
                if ( get_the_author_meta( 'description' ) ) { // Author has a bio  
            ?>
            <div id="wp_entry_author">
                <div id="wp_entry_author_avatar">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
                </div>
                <div id="wp_entry_author_info">
                    <h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
                    <?php the_author_meta( 'description' ); ?> 
                </div>
                <div id="wp_entry_author_links">
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                        <?php printf( __( '%s\'s posts', 'twentyten' ), get_the_author() ); ?>
                    </a>
                    | 
                    <a href="<?php the_author_meta( 'url' ); ?>">
                        <?php printf( __( '%s\'s website', 'twentyten' ), get_the_author() ); ?>
                    </a>
                </div>
            </div><!-- #wp_entry_author -->
            <?php } /* get_the_author_meta */ ?>
            
            <?php include ('include_entry_footer.php'); ?>
            
        </div><!-- #post-## -->
        
        <?php include ('include_next_prev_post.php'); ?>

        <?php comments_template( '', true ); ?>

<?php } /* end of if while loop */ ?>



</div><!-- #bd -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
