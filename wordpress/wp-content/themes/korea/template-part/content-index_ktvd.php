<?php
  $args =[
    'post_type' => 'knowled',
    'posts_per_page' => 5,
    'orderby' => 'ID',
    'nopaging' => false,
    'order'=>'DESC',
  ];
  $query = new WP_Query( $args );
  $posts = $query->posts;
  if (!empty($posts)) {
?>
<section class="blog pt-50">
  <div class="wraper">
    <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Kiến thức về da</h2>
    <div class="blog_parent flexBox mt-50">
      <?php 
        if ( $query->have_posts() ) { 
        while ( $query->have_posts() ) : $query->the_post();
          $thumb =  get_the_post_thumbnail_url($post->ID);
          $title = get_the_title();
          $excerpt = get_the_excerpt();
      ?>
      <div class="column">
        <div class="item">
          <a class="images" href="<?php the_permalink(); ?>">
            <div class="imgDrop">
              <?php if ($thumb != '') { ?>
              <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
              <?php } else { ?>
              <img src="<?php echo  NO_IMAGE ?>" alt="<?php echo  $title; ?>"/>
              <?php } ?>
            </div>
          </a>
          <div class="content shadow">
            <h4 class="title text-bold color-black fz-18"> 
              <a href="<?php the_permalink(); ?>"><?php echo  $title; ?></a>
            </h4>
            <div class="text mt-10 color-black">
              <?php
                if ($excerpt != '') {
                  $words = explode(' ', $excerpt);
	                echo implode(' ', array_slice($words, 0, 33)) . '...';
                } else {
                  echo '';
                }
              ?>
            </div>
            <div class="mt-15"><a class="btn_view" href="<?php the_permalink(); ?>">Xem thêm</a></div>
          </div>
        </div>
      </div>
      <?php 
        endwhile;
        wp_reset_postdata(); 
        } 
      ?>
    </div>
  </div>
</section>
<?php } ?>