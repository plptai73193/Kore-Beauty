<aside class="aside_detail">
    <?php
      $args = array(
         'post_type' => 'post',
         'posts_per_page' => 1,
         'orderby' => 'DATE',
         'nopaging' => false,
         'order'=>'DESC',
         'tax_query' => array(
            array(
               'taxonomy' => 'category',
               'field' => 'slug',
               'terms' => 'endow',
            )
         )
      );
      $query = new WP_Query( $args );
      $posts = $query->posts;
      if(!empty($posts)){
        if ( $query->have_posts() ) { 
          while ( $query->have_posts() ) : $query->the_post();
            $thumb =  get_the_post_thumbnail_url($post->ID);
            $title = get_the_title();
            $excerpt = get_the_excerpt();
   ?>
  <div class="banner_sale">
    <a href="<?php the_permalink() ?>">
      <?php if ($thumb != '') { ?>
          <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
      <?php } else { ?>
          <img src="<?php echo NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
      <?php } ?>
    </a>
  </div>
  <?php endwhile; wp_reset_postdata(); }} ?>
  <?php
    $args = array(
        'post_type' => 'service',
        'posts_per_page' => 5,
        'orderby' => 'ID',
        'tax_query' => array(
            array(
              'taxonomy' => 'service-category',
              'field' => 'slug',
              'terms' => 'other',
            )
        )
      );
      $query = new WP_Query( $args );
      $posts = $query->posts;
  ?>
  <h4 class="title_main title_sub fz-18 mt-30">Các gói dịch vụ khác</h4>
  <?php 
    if ( $query->have_posts() ) {  
      while ( $query->have_posts() ) : $query->the_post();
        $thumb =  get_the_post_thumbnail_url($post->ID);
        $title = get_the_title();
  ?>
  <div class="item flexBox mt-25">
    <a class="images" href="<?php the_permalink() ?>">
      <div class="imgDrop">
        <?php if ($thumb != '') { ?>
          <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
        <?php } else { ?>
          <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
        <?php } ?>
      </div>
    </a>
    <div class="content">
    <h4 class="title color-black"><a href="<?php the_permalink() ?>"><?php echo  $title ?></a></h4>
    <div class="mt-5"><a class="btn_view" href="<?php the_permalink() ?>">Xem thêm</a></div>
    </div>
  </div>
  <?php endwhile; } ?>
</aside>