<!-- Header -->
<?php get_header(); ?>

<!-- Left Sidebar -->
<?php 
  if (is_active_sidebar('left_sidebar_1')) {
    dynamic_sidebar('left_sidebar_1');
  } 
?>

<!-- Content -->
<?php
  $category = get_category(get_query_var('cat'));
  $posts = get_posts(array('category__in' => array($category->term_id), 'post_status'=>'publish', 'order'=>'ASC' ));
?>
<div class="large-6 medium-7 columns">
  <div class="post-container">
    <div class="row">
      <?php
        if ($posts)
        {
          foreach ($posts as $post) {
            setup_postdata($post);
            get_template_part('parts/small-post');
          }
        } else {
          echo '<p>Inget innehåll har publicerats under denna kategorin än.</p>';
        } 
      ?>
    </div>
  </div>
</div>
<?php wp_reset_query(); ?>

<!-- Right Sidebars -->
<?php
  if (is_active_sidebar('right_sidebar_1')) {
    dynamic_sidebar('right_sidebar_1');
  }
?>

<!-- Footer -->
<?php  get_footer(); ?>