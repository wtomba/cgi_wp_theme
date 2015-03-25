<?php
  
  // Action
  add_action('wp_enqueue_scripts', 'cgi_resources');  
  add_action('customize_register', 'cgi_customize_register' );
  add_action('wp_head', 'cgi_customize_css');
  add_action('pre_get_posts','cgi_search_filter');
  add_action('widgets_init', 'cgi_widgets_init');

  // Filter
  //add_filter( 'pre_get_posts', 'cgi_filter_child_cats' );
  add_filter( 'template_include', 'cgi_main_cat_template', 99 );  
  add_filter( 'excerpt_length', 'cgi_custom_excerpt_length', 999 );

  // Theme
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', array( 'search-form' ) );
  add_theme_support( 'custom-header' );
  add_theme_support( 'post-formats', array( 'link', 'image' ) );

  // Navigation menus
  register_nav_menus(array(
    'main-menu' => __('Huvudmeny'),
    'footer-menu' => __('Sidfotmeny'),
  ));

  function cgi_widgets_init() {
    register_sidebar( array (
      'name' => 'Left Sidebar',
      'id' => 'left_sidebar_1',
      'before_widget' => '',
      'after_widget' => '',
    ));

    register_sidebar( array (
      'name' => 'Right Sidebar 1',
      'id' => 'right_sidebar_1',
      'before_widget' => '',
      'after_widget' => '',
    ));
  }

  // Javascripts and StyleSheets
  function cgi_resources() {
    // Stylesheets
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css');
    wp_enqueue_style('foundation', get_template_directory_uri() . '/css/foundation.min.css');
    wp_enqueue_style('foundation-icons', get_template_directory_uri() . '/css/foundation-icons.css');

    // JavaScripts
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', '1.0.0', true);
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.9.0.js', '1.0.0', true);
    wp_enqueue_script('fastclick', get_template_directory_uri() . '/js/fastclick.js', '1.0.0', true);
    wp_enqueue_script('foundation', get_template_directory_uri() . '/js/foundation.min.js', '1.0.0', true);
  } // End cgi_resources

  // Theme customization
  function cgi_customize_register( $wp_customize ) {
    // Sections
    $wp_customize->add_section( 'cgi_main_menu' , array(
      'title'      => __( 'Huvudmeny', 'cgi' ),
      'priority'   => 1,
      'description' => 'Utseende på huvudmenyn och tillhörande sökfält',
    ) );
    
    $wp_customize->add_section( 'cgi_content' , array(
      'title'      => __( 'Innehåll', 'cgi' ),
      'priority'   => 2,
      'description' => 'Utseende på det innehåll som visas under huvudmenyn och över sidfoten',
    ) );

    // Settings
      // Main menu
        $wp_customize->add_setting( 'main_menu_background_color' , array(
          'default'     => '#D45D47',
          'transport'   => 'refresh',
        ) );
        
        $wp_customize->add_setting( 'main_menu_active_link_color' , array(
          'default'     => '#FFB800',
          'transport'   => 'refresh',
        ) );
        
        $wp_customize->add_setting( 'main_menu_hover_link_color' , array(
          'default'     => '#B54E3B',
          'transport'   => 'refresh',
        ) );
        
        $wp_customize->add_setting( 'main_menu_border_color' , array(
          'default'     => '#BB503C',
          'transport'   => 'refresh',
        ) );
        
        $wp_customize->add_setting( 'main_menu_search_button_color' , array(
          'default'     => '#44697d',
          'transport'   => 'refresh',
        ) );

      // Content
        $wp_customize->add_setting( 'content_border_color' , array(
          'default'     => '#D45D47',
          'transport'   => 'refresh',
        ) ); 

    // Controls
      // Main menu
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_menu_color', array(
          'label'        => __( 'Menyfärg', 'cgi' ),
          'section'    => 'cgi_main_menu',
          'settings'   => 'main_menu_background_color',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_active_link_color', array(
          'label'        => __( 'Färg på aktiv sida', 'cgi' ),
          'section'    => 'cgi_main_menu',
          'settings'   => 'main_menu_active_link_color',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_hover_link_color', array(
          'label'        => __( 'Hoverfärg', 'cgi' ),
          'section'    => 'cgi_main_menu',
          'settings'   => 'main_menu_hover_link_color',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_border_color', array(
          'label'        => __( 'Kantfärg mobilversion', 'cgi' ),
          'section'    => 'cgi_main_menu',
          'settings'   => 'main_menu_border_color',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_search_button_color', array(
          'label'        => __( 'Färg på sökknapp', 'cgi' ),
          'section'    => 'cgi_main_menu',
          'settings'   => 'main_menu_search_button_color',
        ) ) );

      // Content
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_border_color', array(
          'label'        => __( 'Kantfärg', 'cgi' ),
          'section'    => 'cgi_content',
          'settings'   => 'content_border_color',
        ) ) );
  } // End mytheme_customize_register()

  // Custom css outputted from admin-panel
  function cgi_customize_css() {
    ?>
      <style type="text/css">
        /* Main Menu */
          .site-header .form-container .search-form .search-submit {
            background-color: <?php echo get_theme_mod('main_menu_search_button_color'); ?> !important;
          }
          .site-header .search-container {
            height: 140px;
            background: url(<?php header_image(); ?>);
            border-color: <?php echo get_theme_mod('main_menu_background_color'); ?> !important;
          }
          .site-header .main-nav,
          .category-nav-container .category-menu-toggle { 
            background-color: <?php echo get_theme_mod('main_menu_background_color'); ?> !important;
          }
            .site-header .main-nav nav ul li,
            .site-header .main-nav .menu-toggle {
              border-color: <?php echo get_theme_mod('main_menu_border_color'); ?> !important;
            }
              .site-header .main-nav nav ul li a:hover {  
                background-color: <?php echo get_theme_mod('main_menu_hover_link_color'); ?> !important;
              }
              .site-header .main-nav nav ul li.current-menu-item a,
              .site-header .main-nav nav ul li.current-page-ancestor a,
              .site-header .main-nav nav ul li.current-category-ancestor a,
              .site-header .main-nav nav ul li.current-post-ancestor a {
                border-bottom: 2px solid <?php echo get_theme_mod('main_menu_active_link_color'); ?> !important;
              }

        /* End Main Menu */

        /* Content */
          .post-container,
          .post,
          .map,
          .contact,
          .search-result-container,
          .main-category .child-category,
          .category-related-posts {
            border-top-color: <?php echo get_theme_mod('content_border_color'); ?> !important;
          }
          .main-category .header {
            border-bottom-color: <?php echo get_theme_mod('content_border_color'); ?> !important;
          }

          .category-nav .border-top,
          .sidebar .border-top {
            background-color: <?php echo get_theme_mod('content_border_color'); ?> !important;
          }
        /* End Content*/
      </style>
    <?php
  } // End cgi_customize_css()

  // Gets the top most category ancestor of the current category or post
  function cgi_get_top_ancestor_id() {
    if (is_category()) {
      $current_category = get_category(get_query_var('cat'));

      if ($current_category->category_parent) {
        $ancestors = array_reverse(get_ancestors($current_category->term_id, 'category'));

        return $ancestors[0];
      }

      return $current_category->term_id;
    } else {
      global $post;
      $category = get_the_category($post->ID);
      if ($category[0]->category_parent) {
        // Få ut kategori från post.
        $ancestors = array_reverse(get_ancestors($category[0]->term_id, 'category'));

        return $ancestors[0];
      }
      return $category[0]->ID;
    }
  } // End cgi_get_top_ancestor_id()

  // Gets the top most category parent by id
  function cgi_get_top_category_parent_by_id( $id ) {
    $category = get_the_category($id); 

    if ($category[0]->category_parent) {
      // Få ut kategori från post.
      $ancestors = array_reverse(get_ancestors($category[0]->term_id, 'category'));

      return get_category($ancestors[0]);
    }
      
    return get_category($category[0]->ID);
  } // End cgi_get_top_category_parent_by_id()

  // Displays breadcrumbs
  function cgi_breadcrumbs() {  
    /* === OPTIONS === */  
    $text['home']   = 'Start'; // text for the 'Home' link  
    $text['category'] = '%s'; // text for a category page  
    $text['search']  = 'Resultat för: "%s"'; // text for a search results page  
    $text['tag']   = 'Posts Tagged "%s"'; // text for a tag page  
    $text['author']  = 'Articles Posted by %s'; // text for an author page  
    $text['404']   = 'Error 404'; // text for the 404 page  
    
    $show_current  = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show  
    $show_on_home  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show  
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show  
    $show_title   = 1; // 1 - show the title for the links, 0 - don't show  
    $delimiter   = ' / '; // delimiter between crumbs  
    $before     = '<span class="current">'; // tag before the current crumb  
    $after     = '</span>'; // tag after the current crumb  
    /* === END OF OPTIONS === */  
    
    global $post;  
    $home_link  = home_url('/');  
    $link_before = '<span typeof="v:Breadcrumb">';  
    $link_after  = '</span>';  
    $link_attr  = ' rel="v:url" property="v:title"';  
    $link     = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;  
    $parent_id  = $parent_id_2 = $post->post_parent;  
    $frontpage_id = get_option('page_on_front');  
    
    if (is_home() || is_front_page()) {  
    
      if ($show_on_home == 1) {
        echo '<div class="cgi-breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
      }  
    
    } else {  
    
      echo '<div class="cgi-breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
      echo '<span class="title">Här är du: </span>';
      if ($show_home_link == 1) { 
        echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';  
        
        if ($frontpage_id == 0 || $parent_id != $frontpage_id) {
          echo $delimiter;
        }
      }  
      
      if ( is_search() ) {  
        echo $before . sprintf($text['search'], get_search_query()) . $after;  
    
      }else if ( is_category() ) {  
        $this_cat = get_category(get_query_var('cat'), false);

        if ($this_cat->parent != 0) {  
          $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);

          if ($show_current == 0) {
            $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
          }  
          
          $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
          $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
          
          if ($show_title == 0) {
            $cats = preg_replace('/ title="(.*?)"/', '', $cats);
          }

          echo $cats;  
        }

        if ($show_current == 1) {
          echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;  
        }

      } elseif ( is_day() ) {  
        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
        echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;  
        echo $before . get_the_time('d') . $after;  
    
      } elseif ( is_month() ) {  
        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
        echo $before . get_the_time('F') . $after;  
    
      } elseif ( is_year() ) {  
        echo $before . get_the_time('Y') . $after;  
    
      } elseif ( is_single() && !is_attachment() ) {  
        if ( get_post_type() != 'post' ) {  
          $post_type = get_post_type_object(get_post_type());  
          $slug = $post_type->rewrite;  
          printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name);

          if ($show_current == 1) {
            echo $delimiter . $before . get_the_title() . $after;
          }

        } else {  
          $cat = get_the_category(); $cat = $cat[0];  
          $cats = get_category_parents($cat, TRUE, $delimiter);  
          
          if ($show_current == 0) { 
            $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
          }  
          
          $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
          $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
          
          if ($show_title == 0) {
            $cats = preg_replace('/ title="(.*?)"/', '', $cats);
          }  
          
          echo $cats;  
          
          if ($show_current == 1)  {
            echo $before . get_the_title() . $after;
          }  
        }  
    
      } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {  
        $post_type = get_post_type_object(get_post_type());  
        echo $before . $post_type->labels->singular_name . $after;  
    
      } elseif ( is_attachment() ) {  
        $parent = get_post($parent_id);  
        $cat = get_the_category($parent->ID); $cat = $cat[0];

        if ($cat) {  
          $cats = get_category_parents($cat, TRUE, $delimiter);  
          $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
          $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
          
          if ($show_title == 0) {
            $cats = preg_replace('/ title="(.*?)"/', '', $cats);
          }  
          
          echo $cats;  
        }  
        
        printf($link, get_permalink($parent), $parent->post_title);  
        
        if ($show_current == 1) {
          echo $delimiter . $before . get_the_title() . $after;
        }  
    
      } elseif ( is_page() && !$parent_id ) {  
        
        if ($show_current == 1) {
          echo $before . get_the_title() . $after;
        }  
    
      } elseif ( is_page() && $parent_id ) {  
        if ($parent_id != $frontpage_id) {  
          $breadcrumbs = array();  
          
          while ($parent_id) {  
            $page = get_page($parent_id);  
            if ($parent_id != $frontpage_id) {  
              $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));  
            }  
            $parent_id = $page->post_parent;  
          }  
          
          $breadcrumbs = array_reverse($breadcrumbs);  
          
          for ($i = 0; $i < count($breadcrumbs); $i++) {  
            echo $breadcrumbs[$i];  
            if ($i != count($breadcrumbs)-1) echo $delimiter;  
          }  
        }  
        
        if ($show_current == 1) {  
          if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) {
            echo $delimiter;
          }

          echo $before . get_the_title() . $after;  
        }  
    
      } elseif ( is_tag() ) {  
        echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;  
    
      } elseif ( is_author() ) {  
        global $author;  
        $userdata = get_userdata($author);  
        echo $before . sprintf($text['author'], $userdata->display_name) . $after;  
    
      } elseif ( is_404() ) {  
        echo $before . $text['404'] . $after;  
    
      } elseif ( has_post_format() && !is_singular() ) {  
        echo get_post_format_string( get_post_format() );  
      }  
    
      if ( get_query_var('paged') ) {  
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
          echo ' (';
        }  
        
        echo __('Page') . ' ' . get_query_var('paged');  
        
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
          echo ')';
        }  
      }  
    
      echo '</div><!-- .breadcrumbs -->';  
    
    }  
  } // End cgi_breadcrumbs()

  // Only display posts of current category, not child categorys
  function cgi_filter_child_cats( $query ) {
    if ( $query->is_category ) {
      $queried_object = get_queried_object();
      $child_cats = (array) get_term_children( $queried_object->term_id, 'category' );

      if ( ! $query->is_admin ) {
        //exclude the posts in child categories
        $query->set( 'category__not_in', array_merge( $child_cats ) );
      }
    }
    return $query;
  } // End cgi_filter_child_cats()

  // Displays a special template for categories with no parents(Main categories)
  function cgi_main_cat_template ( $template ) {
    $category = get_category(get_query_var('cat'));
    $new_template = locate_template( array( 'single-main-category.php' ) );
    if ($category->term_id && !$category->category_parent && $new_template != '' && $category->slug != "start" && $category->slug != "kartor") {
       return $new_template;
    }
    return $template;
  } // End cgi_main_cat_template()

  // Limit number of letters in excerpt
  function cgi_custom_excerpt_length( $length ) {
    return 20;
  } // End cgi_custom_excerpt_length()

  // Fix for using a category-page as search result page.
  function cgi_search_filter($query) {
    if ( !is_admin() && $query->is_main_query() ) {
      if ($query->is_search) {
        $query->set('category_name', '');
      }
    }
  } // End cgi_search_filter()
?>