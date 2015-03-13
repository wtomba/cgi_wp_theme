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
        <div class="contain-to-grid sticky">
          <nav class="top-bar" data-topbar role="navigation">
            <ul class="title-area">
              <li class="name">
                <h1><a href="<?php echo home_url() ?>"><?php bloginfo('name'); ?></a></h1>
              </li>
              <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
            </ul>

            <section class="top-bar-section">
              <?php wp_nav_menu( array(
                'theme_location' => 'main-menu'
              ) ); ?>
            </section>
          </nav>
        </div>
      </header>
      <!-- /Site header -->
