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
      <header class="site-header">
        <div class="title row">
          <div class="large-12 columns">
            <h1><a href="<?php echo home_url() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/css/images/logo.gif"></a></h1>
          </div>
        </div>
        <div class="main-nav">
          <div class="row">
            <div class="menu-toggle"><span><i class="fi-align-justify"></i>MENY</span></div>
            <nav class="clearfix">
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
        <div class="large-12 columns">
          <?php if (function_exists('cgi_breadcrumbs')) cgi_breadcrumbs(); ?>
        </div>

