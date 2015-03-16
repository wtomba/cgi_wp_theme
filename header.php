<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until after the header tag.
 *
 * @package WordPress
 * @subpackage CGI
 * @since CGI 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
  <head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php bloginfo('name'); ?></title>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <div class="container">

      <!-- Site header -->
      <header class="site-header clearfix">
        <div class="title row">
          <div class="large-12 columns">
            <h1><a href="<?php echo home_url() ?>"><?php bloginfo('name'); ?></a></h1>
          </div>
        </div>
        <?php if (is_page("startpage")): ?>
          <div class="slider">
            <?php echo do_shortcode('[wonderplugin_slider id="1"]'); ?>
          </div>
        <?php endif ?>
        <div class="main-nav">
          <div class="row">
            <nav class="clearfix large-12 columns">
              <?php wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container' => false,
              ) ); ?>
            </nav>
          </div>
        </div>
      </header>
      <!-- /Site header -->
      <div class="row">
      <?php if (function_exists('cgi_breadcrumbs')) cgi_breadcrumbs(); ?>

