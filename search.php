<!-- Header -->
<?php get_header(); ?>

<!-- Left Sidebar -->
<?php 
  if (is_active_sidebar('left_sidebar_1')) {
    dynamic_sidebar('left_sidebar_1');
  } 
?>

<!-- Content -->
<div class="large-9 medium-7 columns">
	<div class="search-result-container">
		<div class="search-result">
			<p><i class="fi-magnifying-glass"></i> Du sökte på: <span><?php echo get_search_query(); ?></span></p>
			<p><i class="fi-results"></i> Vilket gav: <span><?php echo $wp_query->found_posts; ?></span> resultat</p>
		</div>
		<h1>Sökresultat</h1>
		<?php
		  if (have_posts()) :
		    while(have_posts()) : the_post(); ?>
				<?php
					$category = cgi_get_top_category_parent_by_id($post->ID);

	                if ($category->slug === "kontakt") {
	                    $icon = "<i class='fi-telephone'></i>";
	                }  else if ($category->slug === "kartor") {
	                    $icon = "<i class='fi-map'></i>";
	                } else {
	                     $icon = "<i class='fi-page'></i>";
	                }
				?>
		      <div class="row">
		        <article class="small-post clearfix">
		          <div class="large-12 columns content">
		            <h4><?php echo $icon; ?><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
		            <?php the_excerpt(); ?>
		          </div>
		        </article>
		      </div>
		  <?php
		    endwhile;
		  else : ?>
		  	<p class="no-result"><i class="fi-x"></i> Din sökning på: <span>"<?php echo get_search_query(); ?>"</span> gav inga resultat.</p>
		  <?php endif; ?>
	</div>
</div>

<!-- Footer -->
<?php  get_footer(); ?>
