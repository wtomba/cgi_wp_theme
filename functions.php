<?php

function cgi_resources() {
  // Stylesheets
  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css');
  wp_enqueue_style('foundation', get_template_directory_uri() . '/css/foundation.min.css');

  // JavaScripts
  wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', '1.0.0', true);
  wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.9.0.js', '1.0.0', true);
  wp_enqueue_script('fastclick', get_template_directory_uri() . '/js/fastclick.js', '1.0.0', true);
  wp_enqueue_script('foundation', get_template_directory_uri() . '/js/foundation.min.js', '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'cgi_resources');

// Navigation menus
register_nav_menus(array(
  'main-menu' => __('Main Menu'),
));
?>
