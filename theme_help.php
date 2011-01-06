<p>
    This help page explains any unique functionality in your theme.<br /> 
    WordPress is a powerful tool with many options not used in every theme. <br />
    Below are some topics on how to get the most out of your theme.
</p>
<p>
    <em>
        This page is not intended to explain how to use WordPress to manage your blog or website. <br />
        For help with using WordPress in general visit the 
        <a href="http://codex.wordpress.org/">WordPress Codex</a>.
    </em> 
</p>

<p><strong>Major Topics</strong></p>
<ol>
    <li><a href="#seo">SEO, meta tags, and Analytics</a></li>
    <li>
        <a href="#posts">Blog POSTS</a>
        <ol>
            <li><a href="#post_thumbnails_featured_image">Post thumbnails (featured image)</a></li>
            <li><a href="#excerpts_more">Excerpts and More teasers</a></li>
            <li><a href="#multiple_page_posts">Multiple page posts</a></li>
            <li><a href="#gallery_posts">Gallery posts (thumbnails)</a></li>
        </ol>
    </li>
    <li>
        <a href="#pages">Site PAGES</a>
        <ol>
            <li><a href="#page_titles">Page titles</a></li>
            <li><a href="#special_layouts">Special layouts</a></li>
        </ol>
    </li>
    <li>
        <a href="#custom_theme_notes">Custom theme notes</a>
        <ol>
            <li><a href="#custom_fields">About custom fields</a></li>
        </ol>
    </li>
    <li>
        <a href="#extras">Flashy features and extra functionality</a>
        <ol>
            <li><a href="#lib_lightbox">Image lightbox / galleries</a></li>
            <li><a href="#lib_cyclable">Cyclable (slider box) content</a></li>
            <li><a href="#lib_scrollable">Scrollable (slider box) content</a></li>
            <li><a href="#lib_jit_message">JIT (Just in time) message box</a></li>
        </ol>
    </li>
    <li>
        <a href="#plugins">Plugins</a>
        <ol>
            <li><a href="#sociable">Sociable <em>(Social Networking/Marketing)</em></a></li>
            <li><a href="#tinymce_advanced">TinyMCE Advanced <em>(Admin WYSIWYG)</em></a></li>
        </ol>
    </li>
</ol>

<br /><br />

<h2 id="seo">SEO, meta tags, and Analytics</h2>

<p>Your theme has built-in control over the page title and meta tags throughout your site. 
How to use these are explained in detail on the "Appearance &gt; Theme Options" page.</p>

<p>You may also enter your Google Analytics Tracking ID in the "Theme Options".</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br /><br />

<h2 id="posts">Blog POSTS</h2>
<p>The following features will help you use your blog like a pro by using advanced techniques while posting.</p>
<br />



<h3 id="post_thumbnails_featured_image">Post thumbnails (featured image)</h3>
<p>
    Each post can use an image as a "featured image" aka "post thumbnail" on the blog index and in archives.
</p>
<p>
    When reading a post (permalink) a larger version of the "featured image" appears at the top of the post.
</p>
<p>
    <strong>How to use a "featured image" on a post:</strong>
</p>
<p>
    Option 1: (you are uploading multiple pictures anyway)<br />
    Above the buttons above the editor you will see "Upload/Insert" and four icons representing the different media you can upload.
    Click the first button that looks like a photo. In the popup that appears on the first "tab" labeled "From your computer" 
    upload all the images for that post. 
    Click the link labeled "Show" next to the image you would like to use. A form will appear. 
    At the bottom of the form, click the link labeled "Use as featured image".
</p>
<p>
    Option 2: (you only need to upload the "featured image")<br />
    In the right sidebar of the post edit screen at the bottom click the link labeled "Set featured image". 
    A form will appear. 
    At the bottom of the form, click the link labeled "Use as featured image".
</p>


<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h3 id="excerpts_more">Excerpts and More teasers</h3>
<p>
    Your theme uses the excerpt field as well as the &lt;--more--&gt; tag giving 
    you many options for formatting your blog index. Many themes use either the 
    excerpt or the &lt;--more--&gt; tag to control what content appears on your 
    blog index.
</p>
<p>
    Posts are displayed on the index in one of these formats:
</p>
<ol>
    <li>Title and excerpt (if you type anything in the excerpt field)</li>
    <li>Title and the post up to the &lt;--more--&gt; (if you insert &lt;--more--&gt; in the post)</li>
    <li>Title and the entire post (if you do not enter an excerpt or the &lt;--more--&gt; tag)</li>
</ol>
<p><em>i.e. If you enter an excerpt and include a &lt;--more--&gt; tag only the excerpt will display</em></p>
<p>
    <strong>How to use the "more" tag:</strong>
</p>
<p>
    In "Visual" mode:<br />
    Place the cursor <em>after</em> the content you would like to appear on the blog index for that post. 
    Click the button above the post editor that looks like 
    a rectangle cut in two pieces (a small rectangle on top and a longer rectangle on the button). 
    A line that says "more" will appear.
</p>
<p>
    In "html" mode:<br />
    Place the cursor <em>after</em> the content you would like to appear on the blog index for that post. 
    Type &lt;--more--&gt; on it's own line.
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h3 id="multiple_page_posts">Multiple page posts</h3>
<p>
    For long posts that you would like to break up into smaller chunks for readability 
    your theme uses the  &lt;--nextpage--&gt; tag.
</p>
<p>
    When the post is being read it will look for &lt;--nextpage--&gt; 
    and create a pager box (e.g. Pages: [1] [2] [3]) for as many &lt;--nextpage--&gt; 
    tags as you included in your post.
</p>
<p>
    <strong>How to use the "nextpage" tag:</strong>
</p>
<p>
    In "Visual" mode:<br />
    <em>This cannot be done in "visual" mode. You will need to go into "html" mode for this which makes you a real pro.</em>
<p>
    In "html" mode:<br />
    Place the cursor <em>after</em> the content that is the first "page" of your post. 
    Type &lt;--nextpage--&gt; on it's own line. Repeat for each "page" of your post. 
    <em>Note that you do not need to put &lt;--nextpage--&gt; at the end of the last "page" (end of post).</em>
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h3 id="gallery_posts">Gallery posts (thumbnails)</h3>
<p>
    If you want to share a lot of pictures in a post sometimes you don't want them 
    all to appear "full size" creating a <em>very</em> long post. Instead you can 
    turn the post into a gallery of thumbnails that will show all the pictures you 
    uploaded for that post in rows 3 thumbnails across. This is done with the [gallery] shortcode.
</p>
<p>
    <strong>How to use the "gallery" shortcode:</strong>
</p>
<p><em>Note that you can compose a normal post with text and images as well as use the [gallery] shortcode.</em></p>
<p>
    In "Visual" mode:<br />
    Place the cursor where you would like the gallery thumbnails to appear.  
    Above the buttons above the editor you will see "Upload/Insert" and four icons representing the different media you can upload.
    Click the first button that looks like a photo. In the popup that appears on the first "tab" labeled "From your computer" 
    upload all the images for that post. 
    When you are done  click the "tab" labeled "Gallery", scroll to the bottom and click the "Insert Gallery" button.
    The popup will close and a large image icon will appear in your post indicating where the thumbnails will appear.
</p>
<p>
    In "html" mode:<br />
    Place the cursor where you would like the gallery thumbnails to appear. 
    Type [gallery] on it's own line.
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br /><br />



<h2>Site PAGES</h2>

<br />

<h3 id="page_titles">Page titles</h3>
<p><em>
    Referring to the title that displays at the top of the content 
    NOT the "meta" title that appears in search engines and the title bar of your browser. 
    For information about the "meta" title please see SEO below and your "Appearance &gt; Theme Options" page.
</em></p>
<p>
    Creating and editing pages on your site is as easy as posting to the blog.<br />
    <em>HOWEVER</em>, where blog POSTS automatically show the title as entered 
    on the POST edit screen PAGES in your theme on the other hand require you to enter the title manually. 
    This is for a couple of practical reasons. Often you will want a longer title to display on the page 
    for visitors than you want to see in the PAGE list when editing. 
    SEO requires rewording the title that is displayed on the page 
    but you don't need your whole backend PAGE list organization to change with it.
</p>
<p>
    <strong>How to create the title of your PAGE:</strong>
</p>
<p>
    In "Visual" mode:<br />
    Type the title of the page in the content edit box. 
    Select the text for the title like you would in your word processor. 
    In the edit buttons above the edit box choose the "format" drop down (select) box 
    (typically displays "paragraph" by default). Choose "HEADING 1".  
</p>
<p>
    In "html" mode:<br />
    Type the title of the page in the content edit box. 
    BEFORE the text type  &lt;h1&gt; and AFTER type &lt;/h1&gt; 
    e.g. My groovy title becomes &lt;h1&gt;My groovy title&lt;/h1&gt; 
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h3 id="special_layouts">Special layouts</h3>
<p><strong>Special layouts you can edit</strong></p>
<p>
    Your theme was designed to be as user friendly as possible 
    while giving you control over as much content as possible. 
    However, complex layouts on your site might have complex HTML markup 
    in the content you can edit in the WP-admin. Don't worry, you can still 
    edit the content but you need to be aware of it. 
</p>
<p>
    It will be obvious if you come across one of these pages
</p>
<p>
    We have left comments on any pages where this is true. Ideally you should use 
    "html mode" to edit those pages to be sure you aren't 
    accidentally deleting important &lt;html&gt;HTML tags&lt;/html&gt;. However, 
    unless the comment explicitly says to use "html mode" you are probably safe 
    to edit the text and images in "visual mode" so long as you don't delete the comments 
    e.g. &lt;--This is a comment and you shouldn't delete it--&gt;
</p>
<p><strong>Special layouts you can NOT edit</strong></p>
<p>
    These are typically contact forms or other layouts that require 
    functionality not feasible to be editable through the WP admin. 
    Contact your developer for assistance.
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br /><br />



<h2 id="custom_theme_notes">Custom theme notes</h2>

<br />

<h3 id="custom_fields">About custom fields</h3>
<p>
    Custom fields are used in your theme. These are unique pieces of information to tell your theme how to display. 
    In particular for controlling various SEO features such as the "title", "description", and "keywords" for nearly 
    all post/pages is done via custom fields. But you may have other functionality that is controlled via custom fields.
</p>
<p>
    Custom fields are found below the "edit field" of any post/page.
</p>



<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h2 id="extras">Flashy extra features and functionality</h2>

<br />

<h3 id="lib_lightbox">Image lightbox / galleries</h3>
<p>
    By default all images you upload and insert in your posts/pages or show using the [gallery] shortcode 
    will automatically lightbox.
</p>
<p>
    You may also lightbox content by adding the class ".lightbox" to any anchor.<br />
</p>
<p>
    <strong>Developer note:</strong> This is handled via a zui library in the _application directory, invoked in functions.php (init_html), and called from _assets/javascript/application.js
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h3 id="lib_cyclable">Cyclable (slider box) content</h3>

<h4>USAGE: (via shortcodes)</h4>

<p>
The shortcodes may be used in any order.<br />
The minimum setup is at least one [cycle_slide /] 
</p>

<p>
<strong>ADD SLIDE(s) (required)</strong><br />
[cycle_slide]any valid markup use absolute paths to be safe[/cycle_slide]
</p>

<p>
(optional) <strong>ADD CUSTOM CLASS</strong> for scrollables container <br />
[cycle_class]my_custom_class[/cycle_class]
</p>

<p>
(optional) <strong>ADD HEADER LAYOUT/CONTENT</strong> <br />
[cycle_header]Header content with markup okay[/cycle_header]
</p>

<p>
(optional) <strong>ADD FOOTER LAYOUT/CONTENT</strong> <br />
[cycle_header]Header content with markup okay[/cycle_header]
</p>

<p>
(optional) <strong>ADD PAGER NAV BAR</strong> (no content, just a flag) <br />
[cycle_pager]
</p>

<p>
    <strong>Developer note:</strong> This is handled via a zui library in the _application directory, invoked in functions.php (init_html), and called from _assets/javascript/application.js
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h3 id="scrollable">Scrollable (slider box) content</h3>

<h4>USAGE: (via shortcodes)</h4>

<p>
The shortcodes may be used in any order.<br />
The minimum setup is at least one [scrollable_slide /] 
</p>

<p>
<strong>ADD SLIDE(s) (required)</strong><br />
[scrollable_slide]any valid markup use absolute paths to be safe[/scrollable_slide]
</p>

<p>
(optional) <strong>ADD CUSTOM CLASS</strong> for scrollables container <br />
[scrollable_class]my_custom_class[/scrollable_class]
</p>

<p>
(optional) <strong>ADD SCROLLABLE HEADER LAYOUT/CONTENT</strong> <br />
[scrollable_header]Header content with markup okay[/scrollable_header]
</p>

<p>
(optional) <strong>ADD SCROLLABLE FOOTER LAYOUT/CONTENT</strong> <br />
[scrollable_header]Header content with markup okay[/scrollable_header]
</p>

<p>
(optional) <strong>ADD PAGER NAV BAR</strong> (no content, just a flag) <br />
[scrollable_nav]
</p>

<p>
    <strong>Developer note:</strong> This is handled via a zui library in the _application directory, invoked in functions.php (init_html), and called from _assets/javascript/application.js
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h3 id="lib_jit_message">JIT (Just in time) message box</h3>

<p>
    Have another page or a message you would like to share with them as they finish 
    reading a post or page? The JIT box will "slide out" from the right side of the 
    page when the visitor scrolls to the end of the article (where the comments would start).
</p>
<p>
    You can make this box appear on any post or page by adding a custom field 'jit_message' 
    to your post or page. You can include a specific post or page, a random post or page, 
    or just a text message (html is allowed).
</p>

<p><strong>JIT message link to a specific post or page</strong></p>
<ol>
    <li>Find the ID of the post/page you want to link to</li>
    <li>
        Edit the post/page you want to link from
        <ol>
            <li>
                Add a custom field
                <ol>
                    <li>Name: jit message</li>
                    <li>Value: # (e.g. 330)</li>
                </ol>
            </li>
        </ol>
    </li>
    <li>Update/publish the post</li>
</ol>

<p><strong>JIT message link to a random post or page</strong></p>
<ol>
    <li>
        Edit the post/page you want to link from
        <ol>
            <li>
                Add a custom field
                <ol>
                    <li>Name: jit message</li>
                    <li>Value: random</li>
                </ol>
            </li>
        </ol>
    </li>
    <li>Update/publish the post</li>
</ol>

<p><strong>JIT message a text message</strong></p>
<ol>
    <li>
        Edit the post/page you want to have the message
        <ol>
            <li>
                Add a custom field
                <ol>
                    <li>Name: jit message</li>
                    <li>Value: ANY TEXT OR VALID HTML</li>
                </ol>
            </li>
        </ol>
    </li>
    <li>Update/publish the post</li>
</ol>

<p>
    <strong>Developer note:</strong> This is handled via a zui library in the _application directory, invoked in functions.php (init_html), and called from _assets/javascript/application.js
</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br /><br />


<h2 id="plugins">Plugins</h2>

<br />

<h3 id="sociable">Sociable <em>(Social Networking/Marketing)</em></h3>
<p>
    To enhance your social networking/marketing your theme uses the plugin 
    <a href="http://blogplay.com/sociable-for-wordpress/">"Sociable" (http://blogplay.com/sociable-for-wordpress/)</a>.
</p>
<p>
    This adds social networking bookmarking links as well as print and email buttons in each post 
    in order to encourage people promoting your posts.
</p>
<h4>Editing your Sociable links</h4>
<p>
    Under "Settings > Sociable" you will find a list of available services.<br />
    Select/de-select the services you think your demographic uses or would be interested in.
</p>
<p><strong>N.B. Sociable is manually integrated into your theme and changing any other settings should only be done by your developer or with the understanding that your layout could be adversely affected.</strong></p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br />

<h3 id="tinymce_advanced">TinyMCE Advanced <em>(Admin WYSIWYG)</em></h3>
<p>
    TinyMCE is the WordPress Admin WYSIWYG editor for posts/pages.<br />
    This plugin makes it easy to add/remove buttons from the editor as well as control some advanced functionality of the editor.
</p>
<p>
    Developers and advanced users may edit this at "Settings > TinyMCE Advanced".
</p>
<p><strong>Note:</strong> This is not a necessary plugin but has proven useful in improving the editing experience for everyday users by adding/removing functionality as needed and included specific styles they may use in the editor.</p>

<br /><br />
<a href="#wphead">Top</a>
<br /><br />
