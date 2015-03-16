<?php get_header(); ?>

<div class="large-12 columns">
  <div class="large-3 columns">
  <?php
    $args = array(
      'child_of' => cgi_get_top_ancestor_id(),
      'hide_empty' => false,
      'title_li' => $current_category->name,
    );
  ?>
    <?php wp_list_categories($args); ?>
  </div>
  <?php
    if (have_posts()) :
      while(have_posts()) : the_post(); ?>
        <div class="large-9 columns">
          <article class="post">
            <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
            <blockquote>
              <?php the_content(); ?>
              <cite><?php the_time( get_option( 'date_format' ) ); ?> - <?php the_time() ?> 
              			av <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
              			| Posted in 
              			<?php 
              				$categories = get_the_category(); 
              				$separator = ", ";
              				$output = '';

              				if ($categories) {
              						foreach ($categories as $category ) {
              							$output .= '<a href="'. get_category_link($category->term_id) .'">'.$category->cat_name.'</a>'.$separator;
              						}
              				}

              				echo trim($output, $separator);
              			?>
              </cite>
            </blockquote>
          </article>
        </div>
    <?php
      endwhile;
    else :
      echo '<p>No posts available</p>';
    endif; ?>
</div>

<?php  get_footer(); ?>
