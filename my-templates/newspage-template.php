<?php 
/*
	Template Name: News Page
*/
?>

<?php get_header(); ?>

<div class="large-12 columns">
	<?php $args = array(
			'title_li' => '',
			'child_of' => cgi_get_top_ancestor_id(),
		);
	?>
	<div class="large-3 columns">
		<ul>
			<ul>
				<?php wp_list_pages($args); ?>
			</ul>
		</ul>
	</div>
	<div class="large-9 columns">
		<?php foreach (get_posts(array('category' => get_category_by_slug( $pagename )->term_id)) as $post):setup_postdata( $post ); ?>		
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
	            							$output .= '<a href="'. get_category_link($category->term_id) .'">'.$category->cat_name . $separator.'</a>';
	            						}
	            				}

	            				echo trim($output, $separator);
	            			?>
	            </cite>
	          </blockquote>
	        </article>
		<?php endforeach ?>
  	</div>
</div>

<?php  get_footer(); ?>
