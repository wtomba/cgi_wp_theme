<?php 
  $contact = "";
  $category = get_category(cgi_get_top_ancestor_id());
  if ($category->slug === "kontakt") {
    $contact = "<i class='fi-telephone'></i>";
  } else if ($category->slug === "kartor") {
    $contact = "<i class='fi-map'></i>";
  } else {
    $contact = "<i class='fi-quote'></i>";
  }
?>
<article class="small-post clearfix">
  <?php if (has_post_thumbnail()) { ?>                
    <div class="large-4 medium-4 columns thumbnail">
      <?php the_post_thumbnail(); ?>
    </div>
    <div class="large-8 medium-8 columns content">
      <h4><a href="<?php the_permalink() ?>"><?php echo $contact; ?><?php the_title(); ?></a></h4>
      <?php the_excerpt(); ?>
    </div>
  <?php } else { ?>
    <div class="large-12 medium-12 columns content">
      <h4><a href="<?php the_permalink() ?>"><?php echo $contact; ?><?php the_title(); ?></a></h4>
      <?php the_excerpt(); ?>
    </div>
  <?php } ?>
</article>