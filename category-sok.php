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
  <div class="post-container">
    <?php
      if (have_posts()) :
        while(have_posts()) : the_post(); ?>
          <div class="row">
            <article class="small-post clearfix">
              <div class="large-4 columns thumbnail">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="large-8 columns content">
                <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <?php the_excerpt(); ?>
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
