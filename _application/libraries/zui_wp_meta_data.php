<?php
/**
 * META and SEO functions
 * These are basic functions. Because every project and client is different 
 * you should probably create your own per project. Or use a plugin of your choice.
 * 
 * This library is dependent on the zui_wp_theme_options library.
 * While zui_wp_meta_data will work without certain default options it looses it's utility
 * and is not recommended.
 * 
 * Every happens automatically if you include this function library.
 * In that sense it might as well be a plugin but for custom themes I find it 
 * more professional to have this functionality built-in.
 * 
 * zui_wp_meta_description() and zui_wp_meta_keywords() echo the entire meta tag
 * as part of the wp_head().
 * This is done for maximum compatibility with other SEO plugins and to minimize
 * the need for editing kitchenSink when you don't want to use this library.
 * 
 * zui_filter_wp_title() is filters the wp_title call also requiring no change to 
 * template files or functions.php if this library is not included.
 * 
 * zui_filter_body_class also looks for a custom field of body_class to allow for
 * flexible styling of page or section
 * 
 * @package kitchenSinkTheme
 * @subpackage zui_wp_meta_data
 * @version 0.3.1
 * @since 0.1
 * @link http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * @param zui_wp_theme_options.php function library (these functions look for defaults set in theme options)
 * @todo convert to class
 * @todo implement user friendly always present post custom fields form like this great tutorial http://sltaylor.co.uk/blog/control-your-own-wordpress-custom-fields/
 * @todo have this create it's own options page like a plugin to eliminate the dependency on zui_wp_theme_options.php
 * @todo attempt to build keyword list from post/page tags
 */

/**
 * Create the necessary theme options
 */
if ( function_exists('zui_theme_option_menu') )  {
    if ( get_zui_wp_theme_option( 'zui_meta_page_title_separator' ) )
        $zui_meta_page_title_separator = get_zui_wp_theme_option( 'zui_meta_page_title_separator' );
    else
        $zui_meta_page_title_separator = "&laquo;";
    $meta_theme_options = array (
                                /* Page title settings */
                                array(  "desc"    => __("
                                                        <h3>SEO</h3>
                                                        <p>
                                                            Your theme has basic control over page meta data built-in for SEO purposes.<br />
                                                            Set default title settings and default description/keywords below for general site control.
                                                        </p>
                                                        <p>
                                                            See <a href=\"#seo_post_page_custom_fields\">SEO: Post/Page custom fields</a>) 
                                                            for specifics on how to further customize your SEO per individual post/page.
                                                        </p>    
                                                        <h3>SEO: Meta Title defaults</h3>
                                                    "),
                                        "type"    => "section"),
                                
                                array(  "name"    => __('Always add "Blog Name" to end of title'),
                                        "desc"    => __("Helps add consistency and usability to browser title bar / tab and for SEO purposes."),
                                        "id"      => "zui_meta_page_title_do_add_blog_name",
                                        "std"     => "pickle",
                                        "type"    => "checkbox"),
                                
                                array(  "name"  => __('Separator'),
                                        "desc"  => __("Defaults to &laquo;<br />Character or symbol used to separate title parts e.g. My groovy post {$zui_meta_page_title_separator} Page 2 {$zui_meta_page_title_separator} MyBlog.com"),
                                        "id"    => "zui_meta_page_title_separator",
                                        "std"   => "&laquo;",
                                        "type"  => "text",
                                        "size"  => "8"),
                                
                                /* Meta tag defaults */
                                array(  "desc"  => __("
                                                    <h3>SEO: Meta tag defaults</h3>
                                                    "),
                                        "type"  => "section"),
                                
                                /* Meta tag defaults: General */
                                array(  "name"  => __('Global meta keywords'),
                                        "desc"  => __('Default keywords for meta name="keywords".<br />Used for all WP "Posts/Pages" where custom field "meta_page_keywords" is not set and defaults below are blank (where applicable).'),
                                        "id"    => "zui_meta_page_keywords_global",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "100"),
                                
                                array(  "name"  => __('Global meta description'),
                                        "desc"  => __('Default description for meta name="description".<br />Used for all WP "Posts/Pages" where custom field "meta_page_description" is not set, description cannot be dynamically created, and/or defaults below are blank (where applicable).'),
                                        "id"    => "zui_meta_page_description_global",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "100"),
                                
                                /* Meta tag defaults: Home (if home is not blog index) */
                                array(  "name"  => __('Home meta keywords'),
                                        "desc"  => __('Default keywords for meta name="keywords" on home page<br />Used if custom field "meta_page_keywords" is not set on the home/front page if not the blog index.<br />If blank defaults to "General Meta Keywords" above.'),
                                        "id"    => "zui_meta_page_keywords_home",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "100"),
                                
                                array(  "name"  => __('Home meta description'),
                                        "desc"  => __('Default description for meta name="description" on home page<br />Used if custom field "meta_page_description" is not set on the home/front page if not the blog index and cannot be dynamically created.<br />If blank defaults to "General Meta Description" above.'),
                                        "id"    => "zui_meta_page_description_home",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "100"),
                                
                                /* Meta tag defaults: Single post */
                                array(  "name"  => __('Post meta keywords'),
                                        "desc"  => __('Default keywords for meta name="keywords" on single posts view<br />Used if custom field "meta_page_keywords" is not set for that Post.<br />If blank defaults to "General Meta Keywords" above.'),
                                        "id"    => "zui_meta_page_keywords_single_post",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "100"),
                                
                                array(  "name"  => __('Post meta description'),
                                        "desc"  => __('Default description for meta name="description" on single post view<br />Used if custom field "meta_page_description" is not set for that Post and cannot be dynamically created.<br />If blank defaults to "General Meta Description" above.'),
                                        "id"    => "zui_meta_page_description_single_post",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "100"),
                                
                                /* Meta tag defaults: Page */
                                array(  "name"  => __('Page meta keywords'),
                                        "desc"  => __('Default keywords for meta name="keywords" on pages<br />Used if custom field "meta_page_keywords" is not set for that Page.<br />If blank defaults to "General Meta Keywords" above.'),
                                        "id"    => "zui_meta_page_keywords_page",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "100"),
                                
                                array(  "name"  => __('Page meta description'),
                                        "desc"  => __('Default description for meta name="description" on pages<br />Used if custom field "meta_page_description" is not set for that Page and cannot be dynamically created.<br />If blank defaults to "General Meta Description" above.'),
                                        "id"    => "zui_meta_page_description_page",
                                        "std"   => "",
                                        "type"  => "text",
                                        "size"  => "100"),
                                
                                
                                /* Help/Documentation */
                                array(  "desc" => __("
                                                    <h4 id=\"seo_post_page_custom_fields\">SEO: Post/Page custom fields</h4>
                                                    <p>
                                                        You may customize the page TITLE, DESCRIPTION, and KEYWORDS by adding custom fields 
                                                        to the page. 
                                                    </p>
                                                    <p><strong>Custom fields for SEO</strong></p>
                                                    <ul>
                                                        <li>meta_page_title</li>
                                                        <li>meta_page_description</li>
                                                        <li>meta_page_keywords</li>
                                                    </ul>
                                                    <p><strong>How the the page title is created</strong></p>
                                                    <ol>
                                                        <li>
                                                            Uses custom field \"meta_page_title\" if it exists for all posts and pages 
                                                            (except the blog index, archives, search, and 404) appending \"Blog Name\" (Settings &gt; General) depending on your setting above.
                                                        </li>
                                                        <li>
                                                            Otherwise the page title is created dynamically depending on the type of page being viewed 
                                                            using the post/page title where available in conjunction with relevant criteria (e.g. paged, archive, tag) 
                                                             appending \"Blog Name\" (Settings &gt; General) depending on your setting above
                                                        </li> 
                                                    </ol>
                                                    <p><strong>How meta keywords/description is created</strong></p>
                                                    <ol>
                                                        <li>
                                                            Uses custom field \"meta_page_keywords\" or \"meta_page_description\" if it exists for all posts and pages 
                                                            (except the blog index, archives, search, and 404).
                                                        </li>
                                                        <li>
                                                            If no custom field exists the theme attempts to use the appropriate page specifc defaults entered in the theme options.
                                                        </li>
                                                        <li>
                                                            If no page specific default exists the theme attempts to use the global defaults entered in the theme options.
                                                        </li>
                                                        <li>
                                                            If no global default exists then the theme uses \"Blog Name\" and \"Tagline\" under SETTINGS &gt; GENERAL for the description and the keywords are left blank.
                                                        </li>
                                                    </ol>
                                                    <p>
                                                        The Blog index, Archives, Search, and 404 pages cannot use the custom fields for the meta and are created dynamically in conjunction with your global defaults.
                                                    </p>
                                                    "),
                                        "type" => "section")
                                );
                                
    if ( !isset( $theme_options ) ) {
        $theme_options = $meta_theme_options;
    } else {
        //array_unshift( $theme_options, $meta_theme_options );
        $theme_options = array_merge($meta_theme_options, $theme_options);
    }
}
 
 
/**
 * Gets meta description for head
 * 
 * Uses post_meta (custom field) "meta_page_description" if exists
 * If not looks up specific default option
 * If not looks up global default option
 * If none exists it uses "Tagline" (Settings > General) 
 * 
 * @since 0.1
 * @uses get_post_meta()
 * @uses get_bloginfo()
 * @uses get_zui_wp_theme_option()
 */
function zui_wp_meta_description() {
    
    global $post;
    
	$post_custom_field = get_post_meta($post->ID, 'meta_page_description', true); //get post custom field

    if ( $post_custom_field ) { /* Use post_custom_field custom field if exists */
        $description = $post_custom_field;
    } else if ( is_front_page() && function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("zui_meta_page_description_home") ) { /* home page is set to custom page */
        $description = get_zui_wp_theme_option("zui_meta_page_description_home"); // default set in theme options
    } else if ( is_single() && function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("single_post_description") ) { /* single article */
        $description = get_zui_wp_theme_option("single_post_description"); // default set in theme options
    } else if ( is_page() && function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("zui_meta_page_description_page") ) { /* page */
        $description = get_zui_wp_theme_option("zui_meta_page_description_page"); // default set in theme options
    } else if ( function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("zui_meta_page_description_global") ) { /* global default description in theme options */
        $description = get_zui_wp_theme_option("zui_meta_page_description_global");
    } else { /* As a last resort use blog description/tagline in SETTINGS > GENERAL */
        $description = get_bloginfo( 'description' );
    }
    
    echo "<meta name=\"description\" content=\"{$description}\" />\n";
}
add_action('wp_head', 'zui_wp_meta_description');

/**
 * Gets meta keywords for head
 * 
 * Uses post_meta (custom field) "meta_page_keywords" if exists
 * If not it uses a default keywords as an argument
 * (set as variable on templates and passed as argument in header)
 * If none exists then keywords are blank
 * 
 * @uses get_post_meta()
 * @uses get_bloginfo()
 * @uses get_zui_wp_theme_option()
 */
function zui_wp_meta_keywords() {
    
    global $post;
    
	$post_custom_field = get_post_meta($post->ID, 'meta_page_keywords', true);
	
    if ( $post_custom_field ) { /* Use meta_page_keywords custom field if exists */
        $keywords = $post_custom_field;
    } else if ( is_front_page() && function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("zui_meta_page_keywords_home") ) { /* home page is set to custom page */
        $keywords = get_zui_wp_theme_option("zui_meta_page_keywords_home"); // default set in theme options
    } else if ( is_single() && function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("zui_meta_page_keywords_single_post") ) { /* single article */
        $keywords = get_zui_wp_theme_option("zui_meta_page_keywords_single_post"); // default set in theme options
    } else if ( is_page() && function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("zui_meta_page_keywords_page") ) { /* page */
        $keywords = get_zui_wp_theme_option("zui_meta_page_keywords_page"); // default set in theme options
    } else if ( function_exists('get_zui_wp_theme_option') && get_zui_wp_theme_option("zui_meta_page_keywords_global") ) { /* global default description in theme options */
        $keywords = get_zui_wp_theme_option("zui_meta_page_keywords_global");
    } else {
        $keywords = '';
    }
    
    echo "<meta name=\"keywords\" content=\"{$keywords}\" />\n";
}
add_action('wp_head', 'zui_wp_meta_keywords');


/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 * Based on twentyten_filter_wp_title() Twenty Ten 1.0
 * Tweaked to accomodate existing SEO in scope for theme
 * 
 * Uses post_meta (custom field) "meta_page_title" if exists
 * Except feeds which use title from wp_title()
 * 
 * Uses "Site Title" (Settings > General) on 'search' and 
 * if post_meta (custom field) "meta_page_title" DOES NOT exist
 * NOTE: tagline is used for the description zui_meta_description()
 *
 * @uses get_post_meta() get 'meta_page_title' if exists
 * @uses is_feed()
 * @uses is_search()
 * @uses is_home()
 * @uses is_front_page()
 * @uses get_search_query()
 * @uses get_bloginfo()
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). 
 * @param boolean  $is_single_title_as_wp_title format title for services like addthis
 * @return string The new title, ready for the <title> tag.
 */
function zui_filter_wp_title( $title, $separator, $is_single_title_as_wp_title = false ) {
    
    if ( function_exists('get_zui_wp_theme_option') ) 
        $separator = get_zui_wp_theme_option("zui_meta_page_title_separator", "&laquo;"); // override wp_title($separator)
	
    /* Feeds  */ 
	if ( is_feed() && get_zui_wp_theme_option("zui_meta_page_title_do_add_blog_name", 1) )
		return $title . " $separator " . get_bloginfo('name'); // if do_add_blog_name EQ true
	else if ( is_feed() ) 
	    return $title;
 
	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page, $post;

	if ( is_search() && !$is_single_title_as_wp_title  ) { //only if for the <title> not for services like addthis
		// If we're a search, let's start over:
		$title = sprintf( 'Search results for %s', '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( 'Page %s', $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}
	
	/* Use meta_page_title custom field if exists */ 
	$meta_page_title = get_post_meta($post->ID, 'meta_page_title', true);
	if ( $meta_page_title ) {
	    
	    $title = $meta_page_title;
	    
	    // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 ) 
            $title .= " $separator " . sprintf( __( ' Page %s ', 'twentyten' ), max( $paged, $page ) );
        
	    if ( get_zui_wp_theme_option("zui_meta_page_title_do_add_blog_name", 1) )
	        $title .= " $separator " . get_bloginfo('name'); // if do_add_blog_name EQ true
	    
        return $title;
	}
	
	/* Otherwise try to make something... */ 
	
	// Lazy or smart?
	$do_display_next_separator = "";
	
	
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) && !$is_single_title_as_wp_title ) { // If we have a site description and we're on the home/front page OR we are filtering a post title for things like addthis, add the description
		$title .= " $do_display_next_separator " . $site_description;
		$do_display_next_separator = $separator;
	} else if ( is_single() || is_page() ) { // Else if we are reading and article or page with an actual title
        $do_display_next_separator = $separator;
	}
	
	// If is the blog index AND NOT the front page i.e. probably cms style w/blog AND NOT formatted for services like addthis
	if ( $site_description && ( is_home() && !is_front_page() ) && !$is_single_title_as_wp_title ) {
        $title .= " $do_display_next_separator Blog ";
        $do_display_next_separator = $separator;
    }
    
    if ( $is_single_title_as_wp_title ) //only if for services like addthis not for the <title>
        $do_display_next_separator = $separator;
	
	// Add a page number if necessary: posts paged AND NOT for services like addthis OR is_single with pages 
	if ( $paged >= 2 && !$is_single_title_as_wp_title || $page >= 2 ) {
		$title .= " $do_display_next_separator " . sprintf( __( ' Page %s ', 'twentyten' ), max( $paged, $page ) );
		$do_display_next_separator = $separator;
	}
	    
	
	//add the site name to the end:
	if ( get_zui_wp_theme_option("zui_meta_page_title_do_add_blog_name", 1) )
	    $title .= " $separator " . get_bloginfo('name'); // if do_add_blog_name EQ true

	// Return the new title to wp_title():
	return trim($title);
}
add_filter( 'wp_title', 'zui_filter_wp_title', 10, 2 ); // filter and improve page title if this file is included


/**
 * Add custom classes from posts and pages to WP body_class()
 * 
 * @since 0.2
 */
function zui_filter_body_class($classes, $class) {
    if ( is_single() || is_page() ) {
        global $post;
        $classes[] = get_post_meta($post->ID, 'meta_page_class', true);
    }
    return $classes;
}
add_filter('body_class','zui_filter_body_class', 10, 2);


?>
