<?php 
/**
 * Display post "entry" footer meta
 * DRY include/partial
 * 
 * Typically displays a share link, categories, tags, and an edit link for admins
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
?>
<?php
    if (function_exists('sociable_html')) {
        echo sociable_html();
    }  
?>
<div class="wp_entry_footer">
    <?php if ( count( get_the_category() ) ) { ?>
        <span class="wp_entry_meta wp_entry_meta_category">
            <?php printf( __( '<span class="%1$s">Categories:</span> %2$s', 'twentyten' ), '', get_the_category_list( ', ' ) ); ?>
        </span>
        | 
    <?php } ?>
    <?php
        $tags_list = get_the_tag_list( '', ', ' ); 
        if ( $tags_list ):
    ?>
        <span class="wp_entry_meta wp_entry_meta_tags">
            <?php printf( __( '<span class="%1$s">Tags:</span> %2$s', 'twentyten' ), '', $tags_list ); ?>
        </span>
        | 
    <?php endif; ?>
    <?php if ( !is_single() ) { ?>
        <span class="wp_entry_meta wp_entry_meta_comments"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span> 
        | 
    <?php } ?>
    <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="wp_entry_meta wp_entry_meta_edit">', '</span> |' ); ?>
</div><!-- .wp_entry_footer -->
