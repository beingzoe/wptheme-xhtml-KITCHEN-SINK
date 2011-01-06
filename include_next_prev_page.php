<?php 
/**
 * Display navigation to next/previous pages when applicable
 * DRY include/partial
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
if ( $wp_query->max_num_pages > 1 ) {
?>

    <div class="nav_next_previous clearfix">
        <div class="nav_previous"><?php next_posts_link( __( '<strong><span>&larr;</span> Older posts:</strong>', 'twentyten' ) ); ?></div>
        <div class="nav_next"><?php previous_posts_link( __( '<strong>Newer posts:<span>&rarr;</span></strong>', 'twentyten' ) ); ?></div>
        <!--
        <div class="nav_previous"><br /><?php previous_post_link( '%link', '<strong><span>&larr;</span> Older posts:</strong><br />%title' ); ?></div>
        <div class="nav_next"><br /><?php next_post_link( '%link', '<strong>Newer posts:<span>&rarr;</span></strong><br />%title' ); ?></div>
        -->
        <h2 style="clear: both; margin-top: 18px;">Other recent posts...</h2>
        <ul style="clear: both;">
        <?php
            $next_post = get_adjacent_post(true,'',false);
            $previous_post = get_adjacent_post(true,'',true);
            if ( $next_post && $previous_post )
                $exclude = $next_post->ID . "," . $previous_post->ID;
            else if ( $next_post ) 
                $exclude = $next_post->ID;
            else 
                $exclude = $previous_post->ID;
            
            //echo "exclude = " . $exclude;
    
            
            $featured_posts = get_posts("numberposts=5&exclude=$exclude");
            foreach($featured_posts as $post) :
            setup_postdata($post);
            ?>
            
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <!--
                <div class="wel_featured_article clearfix">
                    <div class="wel_featured_thumb">
                        <a href="<?php the_permalink(); ?>"><img src="/images/icon_testim.gif" alt="" /></a>
                    </div>
                    <div class="wel_featured_title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
                </div>
                -->
            <?php endforeach; ?>
        </ul>
        <p>&nbsp;</p>
    </div>
    
<?php } ?>

