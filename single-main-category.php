<?php get_header(); ?>

<?php 
  $category = get_category(get_query_var('cat'));
  $args = array(
      'parent' => $category->term_id,
      'hide_empty' => false,
    );
  $categories = get_categories($args);
?>
<div class="large-12 medium-12 columns main-category">
  <div class="large-8 large-centered columns header">
    <h1><?php echo $category->name ?></h1>
    <p><?php echo $category->category_description ?></p>
  </div>
  <div class="row" data-equalizer>
    <?php foreach ($categories as $category) {
        $args = array (
            'parent' => $category->term_id,
            'hide_empty' => false,
            'number' => 4,
          );
        $sub_categories = get_categories($args);
      ?>
      <div class="large-3 medium-4 columns" >
        <div class="child-category" data-equalizer-watch>
          <div class="image">
            <?php cfi_featured_image( array( 'size' => 'large', 'title' => 'This is a test...', 'class' => 'my-image', 'alt' => 'My image', 'cat_id' => $category->term_id ) ); ?>
          </div>
          <div class="info">
            <h1><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></h1>
            <?php if ($sub_categories): ?>
              <p>Underkategorier: </p>
              <ul>
                <?php foreach ($sub_categories as $sub_category) { ?>
                  <li><a href="<?php echo get_category_link($sub_category->term_id); ?>"><?php echo $sub_category->name; ?></a></li>
                <?php } ?>
              </ul>
            <?php endif ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php  get_footer(); ?>