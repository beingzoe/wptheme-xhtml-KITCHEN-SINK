<?php 
/**
 * Display paged post/page pager bar/links
 * DRY include/partial
 * 
 * Rarely used but pretty cool feature
 * <!--nextpage-->
 *
 * @package WordPress
 * @subpackage kitchenSinkTheme
 *
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
global $numpages, $multipage;
if ( $multipage ) {
    echo '<div class="wp_paged_entry_pager">';
    wp_link_pages( array( 'pagelink' => '<span>%</span>', 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); 
    wp_link_pages( array( 'before' => '<span class="wp_paged_next_links">', 'after' => '</span>', 'next_or_number' => 'next', 'nextpagelink' => 'Next', 'previouspagelink' => 'Previous' ) );
    echo '</div>';
}
?>
