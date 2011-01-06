<?php
/**
 * The Infamous WP loop that displays posts and post content.
 * Based on Twenty Ten loop.php
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 */
?>

<?php 
/* If there are no posts to display, such as an empty archive page */ 
if ( ! have_posts() ) { ?>
	<div id="page-other" class="page no_results">
		<div class="wp_entry_header">
		    <h1><?php _e( 'No posts or pages found', 'twentyten' ); ?></h1>
        </div>
		<div class="wp_entry">
			<p><?php _e( 'Try searching or check the menu!', 'twentyten' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php 
} //end if !have_posts

/* 
 * Start the Loop.
 * Based on Twenty Ten
 */ 
while ( have_posts() ) : the_post();

    the_date('', '<h1 class="wp_loop_date">', '</h1>'); 
    
    /* Gallery posts */  
    if ( in_category( _x('gallery', 'gallery category slug', 'twentyten') ) ) { 
?>
		<div id="<?php echo get_post_type() . '-' . $post->ID; ?>" <?php post_class(); ?>>
		    
		    <?php include ('include_entry_header.php'); ?>

			<div class="wp_entry clearfix">
                <?php if ( post_password_required() ) : ?>
                    <?php the_content(); ?>
                <?php else : ?>
                    <div class="gallery-thumb">
                    <?php
                        $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
                        $total_images = count( $images );
                        $image = array_shift( $images );
                        $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
                    ?>
                        <a class="size-thumbnail" href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $image_img_tag; ?></a>
                    </div><!-- .gallery-thumb -->
                    <p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'twentyten' ),
                            'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
                            $total_images
                        ); ?></em></p>
    
                    <?php the_excerpt(); ?>
                <?php endif; ?>
			</div><!-- .wp_entry -->

			<div class="wp_entry_footer">
				<a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', 'twentyten'), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'twentyten' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .wp_entry_footer -->
		</div><!-- #post-## -->

<?php 
    /* All other posts */ 
    } else { 
?>
		<div id="<?php echo get_post_type() . '-' . $post->ID; ?>" <?php post_class(); ?>>
            <div class="wp_entry">
<?php 
                include ('include_entry_header.php');  //top of post content
                
                /* show post thumbnail with container for more flexible formatting but not in asides (or whatever) */
                if ( has_post_thumbnail() ) {
                    echo "<div class='post-thumbnail'><a href='" . get_permalink() . "'>"; 
                    the_post_thumbnail('thumbnail', array('class' => 'aligncenter post-thumbnail') );
                    echo "</a></div>";
                }
                
                /* always show a forced excerpt when not on blog index or if an excerpt exists */
                if ( is_archive() || is_search() || has_excerpt() ) { 
                    the_excerpt();
                } else {
                    the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) );
                }
?>
            </div><!-- .wp_entry -->
<?php
                include ('include_wp_link_pages.php'); // next/previous post links
                include ('include_entry_footer.php'); // end of post content
?>
		</div><!-- #post-## -->

<?php 
        comments_template( '', true ); 
    } // END main loop IF  
endwhile; // End the loop. Whew. 
?>

<?php include ('include_next_prev_page.php'); ?>
