<?php 
   /* Template Name: News */
   get_header();
?>

<?php
  $args =[
    'post_type' => 'post',
    'posts_per_page' => 2,
    'orderby' => 'DATE',
    'nopaging' => false,
    'order'=>'DESC',
  ];
  $query = new WP_Query( $args );
  $posts = $query->posts;
  if (!empty($posts)) {
?>
<section class="news_post pt-50 pb-50">
   <div class="wraper">
      <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Tin tức nổi Bật</h2>
      <div class="parent mt-50 flexBox">
         <div class="column">
            <div class="imgDrop"><img src="<?php echo IMAGE_PATH; ?>common/images/img03.png" alt="" /></div>
            </div>
         <div class="column">
            <?php
               $i = 0;
               while ( $query->have_posts() ) : $query->the_post();
               $thumb =  get_the_post_thumbnail_url($post->ID);
               $title = get_the_title();
               $excerpt = get_the_excerpt();
               $i++;
            ?>
            <div class="item_post flexBox<?php if($i == 2) echo ' first_content reverse' ?>">
               <div class="content">
                  <h4 class="title text-bold color-black fz-18"><a href="<?php the_permalink() ?>"><?php the_title(); ?> </a></h4>
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
                  <div class="mt-15"><a class="btn_view" href="<?php the_permalink() ?>">Xem thêm</a></div>
               </div>
               <div class="images">
                  <div class="imgDrop">
                     <?php if ($thumb != '') { ?>
                        <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
                     <?php } else { ?>
                        <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
                     <?php } ?>
                  </div>
               </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
         </div>
         <?php
            $args =[
               'post_type' => 'post',
               'posts_per_page' => 1,
               'orderby' => 'DATE',
               'nopaging' => false,
               'order'=>'DESC',
               'offset' => 2,
            ];
            $query = new WP_Query( $args );
            $posts = $query->posts;
            if (!empty($posts)) {
               while ( $query->have_posts() ) : $query->the_post();
               $thumb =  get_the_post_thumbnail_url($post->ID);
               $title = get_the_title();
               $excerpt = get_the_excerpt();
         ?>
         <div class="column">
            <div class="item_post flexBox">
               <div class="images">
                  <div class="imgDrop">
                     <?php if ($thumb != '') { ?>
                        <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
                     <?php } else { ?>
                        <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
                     <?php } ?>
                  </div>
               </div>
               <div class="content">
                  <h4 class="title text-bold color-black fz-18"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h4>
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
         <div class="column">
         <div class="imgDrop"><img src="<?php echo IMAGE_PATH; ?>common/images/img07.png" alt="" /></div>
         </div>
         <?php endwhile; wp_reset_postdata(); } ?>
      </div>
   </div>
   </section>
<?php } ?>
<?php
	$args = array(
		'post_type' => 'post',
      'posts_per_page' => 3,
      'orderby' => 'DATE',
      'meta_query'    => array(
      'relation' => 'OR',
			array(
				 'key'       => 'trending_news',
				 'value'     => 'ttnb',
				 'compare'   => 'LIKE',
			),
		),
   );
   $query = new WP_Query( $args );
	$posts = $query->posts;
?>
<section class="news_blog pt-50 pb-50">
   <div class="wraper">
      <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Tin tức nổi bật</h2>
      <div class="blog_parent flexBox mt-50">
      <?php 
         if ( $query->have_posts() ) {  
            while ( $query->have_posts() ) : $query->the_post();
               $thumb =  get_the_post_thumbnail_url($post->ID);
               $title = get_the_title();
      ?>
         <div class="column">
            <div class="item">
               <a class="images" href="<?php the_permalink() ?>">
                  <div class="imgDrop">
                  <?php if ($thumb != '') { ?>
                     <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
                  <?php } else { ?>
                     <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
                  <?php } ?>
                  </div>
               </a>
               <div class="content shadow">
                  <h4 class="title text-bold color-black fz-18"> <a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                  <div class="text mt-10 color-black">
                  <?php
                     if ($excerpt != '') {
                        echo word_count($excerpt , $limit);
                     } else {
                        echo '';
                     }
                  ?>
                  </div>
                  <div class="mt-15"><a class="btn_view" href="<?php the_permalink() ?>">Xem thêm</a></div>
               </div>
            </div>
         </div>
      <?php endwhile; wp_reset_postdata(); } ?>
      </div>
   </div>
   </section>
   <?php
      $args = array(
         'post_type' => 'post',
         'posts_per_page' => 5,
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
   ?>
   <section class="donate pt-50 pb-50 text-center">
      <div class="wraper">
         <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Ưu đãi</h2>
         <div class="slider mt-50">
         <?php 
            if ( $query->have_posts() ) { 
               while ( $query->have_posts() ) : $query->the_post();
                 $thumb =  get_the_post_thumbnail_url($post->ID);
                 $title = get_the_title();
                 $excerpt = get_the_excerpt();
         ?>
            <div>
               <div class="flexBox">
                  <div class="column">
                     <a href="<?php the_permalink() ?>">
                        <div class="imgDrop">
                        <?php if ($thumb != '') { ?>
                           <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
                        <?php } else { ?>
                           <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
                        <?php } ?>
                     </a>
                     </div>
                  </div>
                  <div class="column flexBox center midle">
                     <div class="content fz-30 fnt-medium">
                        <a href="<?php the_permalink() ?>">
                           <?php echo  $title ?>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         <?php endwhile; wp_reset_postdata(); } ?>
         </div>
      </div>
   </section>
   <?php
      }
   ?>
<?php get_footer();?>