<?php get_header(); ?>

<div class="large-3 medium-5 columns category-nav-container">
  <div class="category-menu-toggle"><span><i class="fi-align-justify"></i>UNDERMENY</span></div>
  <nav class="category-nav">
    <div class="border-top"></div>
    <h2>KATEGORIER</h2>
    <h3><a href="<?php echo get_category_link(cgi_get_top_ancestor_id()) ?>"><?php echo mb_strtoupper(get_category(cgi_get_top_ancestor_id())->name); ?></a></h3>
    <ul>
      <?php
        $args = array(
          'child_of' => cgi_get_top_ancestor_id(),
          'hide_empty' => false,
          'title_li' => '',
        );
      ?>
      <?php wp_list_categories($args); ?>
    </ul>
  </nav>
</div>
<div class="large-6 medium-7 columns">
  <div class="post-container">
    <?php
      if (have_posts()) :
        while(have_posts()) : the_post(); ?>
          <div class="row">
            <article class="small-post">
              <div class="large-3 columns thumbnail">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="large-9 columns content">
                <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <?php the_content(); ?>
              </div>
              <div class="large-12 columns" style="display:none;">
                <?php the_time( get_option( 'date_format' ) ); ?> - <?php the_time() ?> 
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
              </div>
            </article>
          </div>
      <?php
        endwhile;
      else :
        echo '<p>Inget innehåll har publicerats under denna kategorin än.</p>';
      endif; ?>
  </div>
</div>
<div class="large-3 medium-12 columns">
  <div class="right-nav">
    <div class="border-top"></div>
    
  </div>
</div>

<?php  get_footer(); ?>
