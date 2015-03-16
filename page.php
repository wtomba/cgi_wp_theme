<?php get_header(); ?>

<div class="large-12 columns">

  <?php
    if (have_posts()) :
      while(have_posts()) : the_post(); ?>
        <article class="post page">
          <h4><?php the_title(); ?></h4>
          <blockquote>
            <?php the_content(); ?>
            <cite><?php the_time( get_option( 'date_format' ) ); ?> - <?php the_time() ?> av <?php the_author(); ?></cite>
          </blockquote>
        </article>
    <?php
      endwhile;
    else :
      echo '<p>No posts available</p>';
    endif; ?>

</div>

<?php  get_footer(); ?>