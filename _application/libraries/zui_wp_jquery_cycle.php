<?php
/** 
 * N.B.: THIS LIBRARY IS NOT COMPLETE but functional
 * cyclables cycle slider box from shortcodes
 * 
 * jquery.cycle examples and documentation at: http://jquery.malsup.com/cycle/
 * WordPress zui_wp_jquery_cycle library implementation documentation http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * 
 * N.B.: You can only have one cyclable per post/page with the shortcodes
 *       If you need more you will have to place the cyclable code manually
 *       either in html mode or hardcoded in a template.
 * 
 * Note: This uses a similar markup structure as tools.scrollable for convenience
 *       Be sure if for some strange reason you are using both to not 
 *       call scrollables and cycle on the same containers
 * 
 * USAGE: (manually invoke)(must be manual if you need more than one per post/page)
 * 
 * Call print_cycle_scripts() found in this library to safely load javascript
 * Then just include your cycle markup the old fashioned way
 * 
 * 
 * USAGE: (from wp-admin in posts/pages via shortcodes)
 * 
 * The shortcodes may be used in any order.
 * The minimum setup is at least one [cycle_slide /] 
 * 
 * ADD SLIDE(s)
 * [cycle_slide]any valid markup use absolute paths to be safe[/cycle_slide]
 * 
 * ADD CUSTOM CLASS for cyclable container
 * [cycle_class]my_custom_class[/cycle_class]
 * 
 * ADD cyclable HEADER LAYOUT/CONTENT
 * [cycle_header]Header content with markup okay[/cycle_header]
 * 
 * ADD cyclable FOOTER LAYOUT/CONTENT
 * [cycle_header]Header content with markup okay[/cycle_header]
 * 
 * ADD PAGER NAV BAR (no content, just a flag)
 * [cycle_pager]
 * 
 * 
 * INTERNALS
 * 
 * When any of the shortcodes are invoked, a variable variable is created
 * this_set = cyclable_data_{$post->ID} which populates an array with
 * cyclable data for that post/page. Using shortcodes only one 
 * cyclable slider may be created per post/page.
 * 
 * this_set = array( 
                    [class]     => 'cyclables',
                    [header]    => NULL; string;
                    slides      => array( 'content', 'content', 'content')
                    [pager]       => NULL;
                    [footer]    => NULL; string;
                )
 * 
 * @version 0.1
 * @todo convert to class
 * @todo get rid of all the clumsy and duplicated bullshit
 * @todo figure out a way to only include the css if it is needed
 */
 
/**
 * Initialize cyclable
 */
/* Register tools so it may be invoked manually or by shortcodes */
//N.B.:shortcodes usage inject stylesheet with javascript since we don't know if it is needed until it is too late it enqueue it
//ACTUALY N.B.THIS: the injected stylesheet doesn't work correctly so we are just loading the styles all the time for now
wp_register_style('cyclables', get_bloginfo('template_url') . '/_assets/stylesheets/cyclables.css'); //
wp_enqueue_style('cyclables');
//wp_register_script('jquery-tools', get_bloginfo('template_url') . '/_assets/javascripts/jquery/jquery.tools.min.js' , array('jquery') , '1.2.3', true);
wp_register_script('jquery-cycle', get_bloginfo('template_url') . '/_assets/javascripts/jquery/jquery.cycle.all.min.js' , array('jquery') , '1.2.3', true);
/* Register shortcodes */
add_shortcode('cycle_class', 'shortcode_cycle_class'); //Add shortcode handler
add_shortcode('cycle_header', 'shortcode_cycle_header'); //Add shortcode handler
add_shortcode('cycle_footer', 'shortcode_cycle_footer'); //Add shortcode handler
add_shortcode('cycle_slide', 'shortcode_cycle_slide'); //Add shortcode handler
add_shortcode('cycle_pager', 'shortcode_cycle_pager'); //Add shortcode handler
/* Add filter to replace our shortcode placeholder with the cyclable output */
add_filter('the_content', 'the_cyclables', 11);


/**
 * Shortcode handler: cycle_class
 * 
 * Add custom class for cyclables container wrapper
 */
function shortcode_cycle_class($atts, $content = null) {
	
	if ( !$content )
	    return false; //nothing to do
    
    global $post;
    
    $this_set = "cyclable_data_{$post->ID}"; //set this dynamic variable to stay sane; ${"$this_set"}
    
    global ${"$this_set"};
    
    if ( !isset(${"$this_set"}) ) {
	    ${"$this_set"}["class"][] = $content;
	    add_action('wp_footer', 'print_cycle_scripts');
	    return "cyclable_placeholder";
	}
	
	${"$this_set"}["class"][] = $content;
}

/**
 * Shortcode handler: cycle_header
 * 
 * Add header for cyclable
 */
function shortcode_cycle_header($atts, $content = null) {
	
	if ( !$content )
	    return false; //nothing to do
    
    global $post;
    
    $this_set = "cyclable_data_{$post->ID}"; //set this dynamic variable to stay sane; ${"$this_set"}
    
    global ${"$this_set"};
    
    if ( !isset(${"$this_set"}) ) {
	    ${"$this_set"}["header"][] = $content;
	    add_action('wp_footer', 'print_cycle_scripts');
	    return "cyclable_placeholder";
	}
	
	${"$this_set"}["header"][] = $content;
}

/**
 * Shortcode handler: cycle_footer
 * 
 * Add footer for cyclable
 */
function shortcode_cycle_footer($atts, $content = null) {
	
	if ( !$content )
	    return false; //nothing to do
    
    global $post;
    
    $this_set = "cyclable_data_{$post->ID}"; //set this dynamic variable to stay sane; ${"$this_set"}
    
    global ${"$this_set"};
    
    if ( !isset(${"$this_set"}) ) {
	    ${"$this_set"}["footer"][] = $content;
	    add_action('wp_footer', 'print_cycle_scripts');
	    return "cyclable_placeholder";
	}
	
	${"$this_set"}["footer"][] = $content;
}

/**
 * Shortcode handler: cycle_pager
 * 
 * Add pager nav elements for cyclable
 */
function shortcode_cycle_pager($atts, $content = null) {
    
    global $post;
    
    $this_set = "cyclable_data_{$post->ID}"; //set this dynamic variable to stay sane; ${"$this_set"}
    
    global ${"$this_set"};
    
    if ( !isset(${"$this_set"}) ) {
	    ${"$this_set"}["pager"][] = true;
	    add_action('wp_footer', 'print_cycle_scripts');
	    return "cyclable_placeholder";
	}
	
	${"$this_set"}["pager"][] = true;
}

/**
 * Shortcode handler: cycle_slide
 * 
 * Add content to current set of cyclable slides
 */
function shortcode_cycle_slide($atts, $content = null) {

	if ( !$content )
	    return false; //nothing to do

    global $post;
    
    $this_set = "cyclable_data_{$post->ID}"; //set this dynamic variable to stay sane; ${"$this_set"}
    
    global ${"$this_set"};
	
	if ( !isset(${"$this_set"}) ) {
	    ${"$this_set"}["slides"][] = $content; //add the content to the end of the array
	    add_action('wp_footer', 'print_cycle_scripts');
	    return "cyclable_placeholder";
	}
	
	${"$this_set"}["slides"][]  = $content; //add the content to the end of the array
	
	/* Repeat for each slide which will be output hooking onto "wp" */
}


/**
 * Output the scrollable with content
 */
function the_cyclables($content) {
    
    global $post;
    
    $this_set = "cyclable_data_{$post->ID}"; //set this dynamic variable to stay sane
    //echo $this_set;
    $this_parent_id = "cyclable_{$post->ID}";
    //echo $this_parent_id;
    
    global ${"$this_set"};
    
    /* make sure we have a set and it contains at least one slide */
    if ( !${"$this_set"} || !isset( ${"$this_set"}["slides"] ) ) { 
        $content = str_replace( 'cyclable_placeholder' , '' , $content ); //no slides so cleanup the placeholder
        return $content;
    }
    
    /* Use their custom class if it exists */
    isset( ${"$this_set"}["class"] )
        ? $class = ${"$this_set"}["class"][0]
        : $class = 'cyclable_default';
        
    /* Add pager class trigger - cycle pager won't work if there is more than one instance so force paper off for blog index and archive listings */
    isset( ${"$this_set"}["pager"] ) && !is_home() && !is_archive() 
        ? $with_pager = 'with_pager'
        : $with_pager = '';
        
    /* Start the cyclables wrapper container */
    //<div id="{$class}_{$post->ID}" class="cyclables {$with_pager} {$class}">
    
    /*
$ha = "<div id='{$this_parent_id}'";
    $ha .= " class='cyclables {$with_pager} {$class} fuckme'>";
    /*
    */
    $ha =
<<< EOD
<div id="cyclable_{$post->ID}" class="cyclables {$with_pager} {$class}">
EOD;

    /* If we have a header then include it */
    if ( isset( ${"$this_set"}["header"] ) ) {
    $ha .=
<<< EOD
    <div class="cycle_header">{${"$this_set"}["header"][0]}</div>
EOD;
    }
    
    /* cycle_items cycle_item */
    $ha .=
<<< EOD

    <div class="cycle_items"> 
EOD;

    /* Output each slide */
    foreach (${"$this_set"}["slides"] as $slide) {
        $ha .= "<div class='cycle_item'>{$slide}</div>";
    }

    /* Close .cycle_items */
    $ha .= 
<<< EOD
    </div>
EOD;

    /* If a pager nav was requested - cycle pager won't work if there is more than one instance so force paper off for blog index and archive listings */
    if ( isset( ${"$this_set"}["pager"] ) && !is_home() && !is_archive() ) {
    $ha .= 
<<< EOD
    <div class="cycle_pager"></div>
EOD;
    }
    
    /* next/previous containers must exist (hide via css if necessary */
    $ha .= 
<<< EOD
    <div class="cycle_next" title="Show next">&raquo;</div>
    <div class="cycle_previous" title="Show previous">&laquo;</div>
EOD;


    /* If we have a footer then include it */
     if ( isset( ${"$this_set"}["footer"] ) ) {
    $ha .= 
<<< EOD
    <div class="cycle_footer">{${"$this_set"}["footer"][0]}</div>
EOD;
    }
    
    /* close the cyclables wrapper container */
    $ha .= '</div>';
    
    /* replace our placeholder string with the final output */
    $content = str_replace( 'cyclable_placeholder' , $ha , $content );
    
    /* Ah, done */
    return $content;
}


/**
 * Print styles and scripts only if we need them
 * 
 * We must register and print them ourselves because we can't enqueue by the time shortcodes are executing
 * Use add_action('wp_footer', 'print_cycle_scripts'); to safely load stylesheet and javascript for manual cyclables usage
 */
function print_cycle_scripts() {
    
        /* Load jQuery tools plugin and external stylesheet */
        /* 
        stylesheet cannot be enqueued because we missed the call and not printed because <link> not permitted outside head 
        this is a big clustfuck of stupidity
        Without creating my own custom wp_head type call I cannot load the css only when it is needed
        If I load the stylesheet when it is needed by javascript (see below) it isn't loaded by the browser in time 
        to show the right slide to start (starts on the last slide). So for the time being I am just loading the css 
        all the time and/or considering putting it back into style.css so that way at least it is less trips to the server

            jQuery(document).ready(function($) { // noconflict wrapper to use shorthand $() for jQuery() inside of this function
                $('head').prepend($('<link>').attr({
                    rel: 'stylesheet',
                    type: 'text/css',
                    media: 'screen',
                    href: '<?php echo get_bloginfo('template_url') . '/_assets/stylesheets/cyclables.css' ?>'
                }));
            });
        */
        /* just print the script directly to the page with wp_footer */
        wp_print_scripts('jquery-cycle');
}

//wp_enqueue_script('jquery-cycle');

?>
