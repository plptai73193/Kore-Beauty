<?php
  $args =[
    'post_type' => 'service',
    'posts_per_page' => 20,
    'orderby' => 'DATE',
		'meta_query'    => array(
			'relation' => 'OR',
			array(
				 'key'       => 'trending',
				 'value'     => 'dvnb',
				 'compare'   => 'LIKE',
			),
		),
  ];
  $query = new WP_Query( $args );
  $posts = $query->posts;
  if (!empty($posts)) {
?>
<section class="service_hot pt-50 pb-150">
  <div class="bg"><img class="imgAuto" src="<?php echo IMAGE_PATH;?>common/images/bg.png" alt=""/></div>
  <div class="wraper">
    <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Dịch vụ nổi bật</h2>
    <div class="slider mt-50">
      <?php 
        if ( $query->have_posts() ) { 
          while ( $query->have_posts() ) : $query->the_post();
          $thumb =  get_the_post_thumbnail_url($post->ID);
          $title = get_the_title();
          $excerpt = get_the_excerpt();
      ?>
      <div> 
        <div class="flexBox space midle">
          <div class="column">
            <div class="imgDrop">
                <?php if ($thumb != '') { ?>
                  <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
                  <?php } else { ?>
                  <img src="<?php echo  NO_IMAGE ?>" alt="<?php echo  $title; ?>"/>
                <?php } ?>
            </div>
          </div>
          <div class="column pr-15">
            <h4 class="fz-16 text-up fnt-utm ttl_sub"><?php the_title(); ?></h4>
            <div class="mt-15">
              <?php
                if ($excerpt != '') {
                  echo word_count($excerpt , $limit);
                } else {
                  echo '';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; } ?>
    </div>
  </div>
</section>
<?php } ?>