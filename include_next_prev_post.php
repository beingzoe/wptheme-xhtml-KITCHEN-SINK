<?php 
/**
 * Display navigation to next/previous post when applicable
 * DRY include/partial
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
?>

<div class="nav_next_previous clearfix">
    <div class="nav_previous"><?php previous_post_link( '%link', '<strong><span>&larr;</span> PREVIOUS:</strong><br />%title' ); ?></div>
    <div class="nav_next"><?php next_post_link( '%link', '<strong>NEXT:<span>&rarr;</span></strong><br />%title' ); ?></div>
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
        
        global $post, $id;
        
        $tmp_post = $post; /* save the original loop */
        $tmp_id = $id; /* save the original loop */
        
        $featured_posts = get_posts("numberposts=5&exclude=$exclude");
        foreach($featured_posts as $post) :
            setup_postdata($post);
        ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php 
            $post = $tmp_post; /* restore the original loop */
            $id = $tmp_id; /* restore the original loop */
            endforeach; 
        ?>
    </ul>
    <p>&nbsp;</p>
</div>
