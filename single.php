<?php get_header(); ?>

<div class="large-3 medium-5 columns category-nav-container">
  <div class="category-menu-toggle"><span><i class="fi-align-justify"></i>UNDERMENY</span></div>
  <nav class="category-nav">
    <div class="border-top"></div>
    <h2>KATEGORIER</h2>
    <h3><a href="<?php echo get_category_link(cgi_get_top_ancestor_id()) ?>"><?php echo mb_strtoupper(get_category(cgi_get_top_ancestor_id())->name); ?></a></h3>
    <ul>
      <?php
        $category = get_the_category($post->ID);
        $args = array(
          'child_of' => cgi_get_top_ancestor_id(),
          'hide_empty' => false,
          'title_li' => '',
          'current_category' => $category[0]->term_id,
        );
      ?>
      <?php wp_list_categories($args); ?>
    </ul>
  </nav>
</div>
<div class="large-6 medium-7 columns">
  <?php
    if (have_posts()) :
      while(have_posts()) : the_post(); ?>
        <article class="post">
          <div class="content">            
            <?php the_post_thumbnail(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </div>
          <div class="meta">
            <p>Datum för publicering: <span>Ändrad: <?php the_modified_time( get_option( 'date_format' ) ); ?> | Skapad: <?php the_time( get_option( 'date_format' ) ); ?></span></p>
            <p>Redaktör: <span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span></p>
            <p>Kategori: <span>
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
                          </span>
            </p>
      			
          </div>
        </article>
    <?php
      endwhile;
    else :
      echo '<p>Inget innehåll har publicerats under denna kategorin än.</p>';
    endif; ?>
</div>
<div class="large-3 medium-12 columns">
  <div class="right-nav">
    <div class="border-top"></div>
    
  </div>
</div>

<?php  get_footer(); ?>

