<?php

include_once('customizer/sections-register.php');
include_once('customizer/functions.php');
include_once('customizer/register.php');
include_once('customizer/styles.php');

// head cleanup
remove_action('wp_head', 'feed_links_extra');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'noindex');

// Remove admin bar on the front side
//add_filter( 'show_admin_bar', '__return_false' );

add_action('after_setup_theme', 'artsite_theme_features');
function artsite_theme_features(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-background', array('wp-head-callback' => '__return_false') );
}

add_action('wp_head', 'artsite_head', 0);
function artsite_head(){ 
?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title() ?></title>
    <meta name="viewport" content="width=device-width">
    
    <link rel="apple-touch-icon" type="image/png" href="<?php echo get_stylesheet_directory_uri() ?>/img/apple-touch-icon.png" />
    <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri() ?>/img/favicon.png" />
    <link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri() ?>/img/favicon.ico" />
<?php
}

add_action('wp_enqueue_scripts', 'artsite_print_assets');
function artsite_print_assets(){
    // To use this, define the THEME_ASSETS_VERSION constant in the wp-config.php (or wherever you want)
    $ver = defined('THEME_ASSETS_VERSION') ? THEME_ASSETS_VERSION : false;
        
    if(defined('SCRIPT_DEBUG') && SCRIPT_DEBUG){
        // unminified jquery for debug
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://code.jquery.com/jquery-1.8.3.js');
    }
    
    if( (defined('CSS_DEBUG') && !CSS_DEBUG) ) {
        // stylesheets (minified version)
        require(dirname(__FILE__).'/build/cssbuild.php');
        wp_enqueue_style('cssbuild', get_stylesheet_directory_uri().'/css/'.CSSBUILD.'.css', array(), null);
    } else {
        // stylesheets (follow SMACSS guidelines)
        wp_enqueue_style('base', get_stylesheet_directory_uri().'/css/base.css', array(), $ver);
        wp_enqueue_style('layout', get_stylesheet_directory_uri().'/css/layout.css', array('base'), $ver);
        wp_enqueue_style('module', get_stylesheet_directory_uri().'/css/module.css', array('base', 'layout'), $ver);
        wp_enqueue_style('state', get_stylesheet_directory_uri().'/css/state.css', array('base', 'layout', 'module'), $ver);
        wp_enqueue_style('theme', get_stylesheet_directory_uri().'/css/theme.css', array('base', 'layout', 'module', 'state'), $ver);
    }
    
    wp_enqueue_script('modernizr', get_template_directory_uri().'/js/libs/modernizr-2.6.2.min.js', array(), '2.6.2', false);
    wp_enqueue_script('history', get_template_directory_uri().'/js/libs/history.min.js', array(), '3.2.0', true);

    if(defined('SCRIPT_DEBUG') && !SCRIPT_DEBUG){
        // scripts (minified version)
        require(dirname(__FILE__).'/build/jsbuild.php');
        wp_enqueue_script('main', get_stylesheet_directory_uri().'/js/'.JSBUILD.'.min.js', array('jquery', 'history'), null, true);
    } else {
        wp_enqueue_script('plugins', get_template_directory_uri().'/js/plugins.js', array('jquery'), $ver, true);
        wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array('jquery', 'plugins', 'history'), $ver, true);
    }
}

?>
