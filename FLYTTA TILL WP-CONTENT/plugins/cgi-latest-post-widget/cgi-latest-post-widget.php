<?php
/*
Plugin Name: CGI Latest Post Widget
Plugin URI: http://cgi.cp,/
Description: Displays a latest posts in a category.
Author: William Tombs
Version: 1
Author URI: http://my.global.logica.com/about.aspx?accountname=GROUPINFRA%5Ctombsw
*/

// Block direct requests
if ( !defined('ABSPATH') )
  die('-1');
  

add_action( 'widgets_init', function(){
     register_widget( 'CGI_Latest_Post_Widget' );
}); 

/**
 * Adds CGI_Latest_Post_Widget widget.
 */
class CGI_Latest_Post_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'CGI_Latest_Post_Widget', // Base ID
      __('CGI Latest Post Widget', 'text_domain'), // Name
      array( 'description' => __( 'Displays a nice navigation menu for latest posts in category', 'text_domain' ), ) // Args
    );
    
    wp_enqueue_style( 'cgi-latest-post-widget-css', plugins_url('cgi-latest-post-widget.css', __FILE__) );
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

    <?php	    
      global $post;
      $original_post = $post;
      $main_category = get_category(CGI_Latest_Post_Widget::cgi_get_top_ancestor_id());

      if (is_category()) {
        $args = array(
            'posts_per_page' => 5,
            'category' => $main_category->term_id,
            'orderby' => 'modified',
            'order'=> 'DESC',
          );
      } else {        
        $args = array(
            'post__not_in' => array($post->ID),
            'posts_per_page' => 5,
            'category' => $main_category->term_id,
            'orderby' => 'modified',
            'order'=> 'DESC',
          );
      }

    	$latest_posts = get_posts( $args );
  	?>

    <?php if ($latest_posts) { ?>

      <div class="large-3 medium-12 columns">
        <div class="sidebar">
          <div class="border-top"></div>
            <div class="latest-posts">
                <h2>Aktuellt</h2>  
            	<ul>
    	        	<?php foreach ($latest_posts as $post) { setup_postdata($post); ?>
    	        		<li>
    	        			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    	        			<p><?php the_excerpt(); ?></p>
    	        		</li>
    	        	<?php } ?>
            	</ul>
            </div>
        </div>
      </div>
    <?php } ?>

    <?php echo $args['after_widget'];
    wp_reset_postdata();
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

} // class CGI_Latest_Post_Widget