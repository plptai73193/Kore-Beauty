<?php 
	get_header();
	wp_reset_postdata();
	$id = get_the_ID();
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
			      <?php the_content(); ?>
          </div>
        </div>
        <?php 
          get_template_part( 'template-part/sidebar', 'single' );  
        ?>
      </div>
    </div>
  </section>
<?php get_footer(); ?>