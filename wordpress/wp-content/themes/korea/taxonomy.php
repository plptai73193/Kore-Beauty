<?php
   get_header();
   $taxonomy = get_queried_object();
   $taxonomyName = $taxonomy->taxonomy;
   $postType = substr($taxonomyName, 0, 7); 
   $name = $taxonomy->name;
   $id = $taxonomy->term_id;
   $slug = $taxonomy->slug;
   $args = array(
      'post_type' => $postType,
      'posts_per_page' => 4,
      'orderby' => 'ID',
      'nopaging' => true,
      'order' => 'ASC',
      'tax_query' => array(
         array(
            'taxonomy' => $taxonomy->taxonomy,
            'field' => 'slug',
            'terms' => $slug,
         )
      )
   );
   $query = new WP_Query( $args );
   $posts = $query->posts;
   $totalPost = $query->found_posts;
   $j = 0;
?>
<section class="service_sub pt-30 pb-80">
      <div class="wraper">
        <div class="parent flexBox space">
         <?php get_template_part( 'sidebar') ?>
          <div class="content_main">
            <h2 class="title_main title_sub fz-36"><?php echo  $name ?></h2>
            <?php if ( $query->have_posts() ) {  ?>
            <div class="slider">
              <div>
                  <?php
                     while ( $query->have_posts() ) : $query->the_post();
                        $thumb =  get_the_post_thumbnail_url($post->ID);
                        $title = get_the_title();
                        $excerpt = get_the_excerpt();
                        $j++;
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
                        <h4 class="title color-black text-bold fz-14"><a href="<?php the_permalink() ?>"><?php echo  $title ?></a></h4>
                        <div class="text color-black mt-5">
                           <?php 
                              if ($excerpt != '') {
                                 echo word_count($excerpt , $limit);
                              } else {
                                 echo '';
                              }
                           ?>
                        </div>
                        <div class="mt-5"><a class="btn_view" href="<?php the_permalink() ?>">Xem thêm</a></div>
                     </div>
                  </div>
                  <?php 
                     if( $j % 4 == 0){ 
                  ?>
                     </div><div>
                  <?php } endwhile; wp_reset_query(); ?>
               </div>
            </div>
            <?php } ?>
          </div>
          <?php get_template_part( 'sidebar') ?>
        </div>
      </div>
    </section>
<?php get_footer(); ?>