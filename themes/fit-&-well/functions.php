<?php

function loadCSS() {
  wp_register_style('style', get_template_directory_uri() . '/css/style.css');
  wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'loadCSS');

function loadJS() {
  wp_register_script('custom-js', get_template_directory_uri() . '/js/scripts.js');
  wp_enqueue_script('custom-js');
}

add_action('wp_enqueue_scripts', 'loadJS');


function site_features() {
  // Create title for each page
  add_theme_support('title-tag');
  // Add header menu option in the admin bar
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
}

add_action('after_setup_theme', 'site_features');


function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


// Add the attribute type="module" to JS
function add_module_to_script($tag, $handle, $src) {
  if('custom-js' == $handle ) {
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
  } 
  return $tag;
}

add_filter('script_loader_tag', 'add_module_to_script', 10, 3);
