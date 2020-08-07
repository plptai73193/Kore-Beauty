<?php 
	get_header();
	wp_reset_postdata();
	$id = get_the_ID();
	$categories = get_the_category($id);
?>
<section class="detail pt-50 pb-80">
    <div class="wraper">
      <div class="parent flexBox space top">
        <div class="detail_main">
          <h2 class="fz-26"><?php the_title(); ?></h2>
          <div class="content">
            <p>
            	<?php the_post_thumbnail(); ?>
            </p>
            <?php 
            	while ( have_posts() ) : the_post();
            ?>
			<?php the_content(); ?>
            <?php endwhile; ?>
          </div>
          <?php if(isset($categories) && !empty($categories)){ ?>
          <ul class="hastag flexBox mt-30">
          	<?php 
          		foreach ($categories as $category) {
          			$name = $category->name;
          			$cateId = $category->term_id
          	?>
            <li><a href="<?php echo  get_term_link($cateId) ?>">#<?php echo  $name ?></a></li>
    		<?php } ?>
          </ul>
		<?php } ?>
        </div>
        <?php 
          get_template_part( 'template-part/sidebar', 'single' );  
        ?>
      </div>
    </div>
</section>
<?php get_footer(); ?>