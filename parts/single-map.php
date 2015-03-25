<article class="map">
  <div class="content">
    <h2><i class='fi-map'></i><?php the_title(); ?></h2>
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