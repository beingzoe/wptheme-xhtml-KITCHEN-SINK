<?php
/**
 * HTML head and top of body partial include
 *
 * Loads <DOCTYPE />, <head />, <body>, <div id="doc">, <div id="hd" />
 * All unclosed tags are closed in footer.php
 * 
 * @package WordPress
 * @subpackage kitchenSinkTheme
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11 http://microformats.org/profile/hatom http://microformats.org/profile/hcard">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title( "", true, 'right'); ?></title>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); /* Everything else: CSS, JS, feeds, meta tags etc... */ ?>

</head>
<body <?php body_class('wp'); ?>>

<div id="doc" class="">
<div id="hd">
    <h1 id="hd_logo">
        <a href="<?php bloginfo('url'); ?>/" title="Home"><img src="<?php bloginfo('template_url'); ?>/_assets/images/layouts/transparent.png" alt="<?php bloginfo('name'); ?>" /></a>
        <a href="<?php bloginfo('url'); ?>/" title="Home"><?php bloginfo('name'); ?></a>
    </h1>
    <div id="hd_tag"><?php bloginfo('description'); ?></div>
    <div id="hd_menu">
        <?php 
        wp_nav_menu( array( 
                    'theme_location' => 'hd_menu',
                    'sort_column' => 'menu_order',
                    'container' => false,
                    'depth' => '3'
                    ) );
        ?>
    </div>
</div>
<div id="pg">
