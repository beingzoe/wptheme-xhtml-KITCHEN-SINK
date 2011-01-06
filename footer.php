<?php
/**
 * Footer partial include
 * 
 * Closes <div id="pg"><div id="doc">, <body>, <html>
 * 
 * @package WordPress
 * @subpackage kitchenSinkTheme
 * 
 * Based on kitchenSink theme Version 0.3 and ZUI by zoe somebody http://beingzoe.com/zui/
 */
?>
</div><!-- close #pg -->
<div id="ft">
    <div id="ft_menu" class="clearfix">
        <?php 
        wp_nav_menu( array( 
                    'theme_location' => 'ft_menu',
                    'sort_column' => 'menu_order',
                    'container' => false, 
                    'depth' => '1'
                    ) );
        ?>
    </div>
    <div id="ft_legal">
        Copyright &copy; 2010, Somebody All Rights Reserved
    </div>
</div>

</div><!-- close #doc -->

<address class="hmeta vcard">
    <a class="fn org url" href="http://beingzoe.com/">Company Name</a>
    <span class="adr">
        <span class="tel">
            <span class="type">Work</span> 619-123-4579
        </span>
        <span class="tel">
            <span class="type">Fax</span> 619-456-4579
        </span>
    </span>
</address>

<?php 
    wp_footer();
    
    /* zui built-in google analytics output */
    if ( function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("zui_google_analytics") ) {
?>
        <script type="text/javascript">
        //zui Google Analytics
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo get_zui_wp_theme_option("zui_google_analytics"); ?>']);
        _gaq.push(['_trackPageview']);
        
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
        })();
        </script>
    <?php } ?>



</body>
</html>
