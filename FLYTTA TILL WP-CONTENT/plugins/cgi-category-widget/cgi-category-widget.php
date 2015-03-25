<?php
/*
Plugin Name: CGI Category Widget
Plugin URI: http://cgi.cp,/
Description: Displays a nice navigation menu for categories.
Author: William Tombs
Version: 1
Author URI: http://my.global.logica.com/about.aspx?accountname=GROUPINFRA%5Ctombsw
*/

// Block direct requests
if ( !defined('ABSPATH') )
  die('-1');
  

add_action( 'widgets_init', function(){
     register_widget( 'CGI_Category_Widget' );
}); 

/**
 * Adds CGI_Category_Widget widget.
 */
class CGI_Category_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'CGI_Category_Widget', // Base ID
      __('CGI Category Widget', 'text_domain'), // Name
      array( 'description' => __( 'Displays a nice navigation menu for categories', 'text_domain' ), ) // Args
    );
    
    wp_enqueue_style( 'cgi-category-widget-css', plugins_url('cgi-category-widget.css', __FILE__) );
  }

  // Gets the top most category ancestor of the current category or post
  static function cgi_get_top_ancestor_id() {
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

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {  
      echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    } ?>


    <div class="large-3 medium-5 columns category-nav-container">
      <div class="category-menu-toggle"><span><i class="fi-align-justify"></i>UNDERMENY</span></div>
      <nav class="category-nav">
        <div class="border-top"></div>
        <h2>Kategorier</h2>
        <h3><a href="<?php echo get_category_link(CGI_Category_Widget::cgi_get_top_ancestor_id()) ?>"><?php echo mb_strtoupper(get_category(CGI_Category_Widget::cgi_get_top_ancestor_id())->name); ?></a></h3>
        <ul>
          <?php
            if (is_search()) {
              $category = get_category_by_slug('sok');
            } else if (is_category()) {
              global $cat;

              get_category($cat);
            } else {
              global $post;
              
              $category = get_the_category($post->ID);
              $category = $category[0];
            }

            $args = array(
              'child_of' => CGI_Category_Widget::cgi_get_top_ancestor_id(),
              'hide_empty' => false,
              'title_li' => '',
              'current_category' => $category->term_id,
            );
          ?>
          <?php wp_list_categories($args); ?>
        </ul>
      </nav>
    </div>


    <?php echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = __( 'New title', 'text_domain' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php 
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class CGI_Category_Widget