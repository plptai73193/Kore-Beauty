<?php
  $categories = get_terms( array(
    'taxonomy' => 'service-category',
    'hide_empty' => false,
    'order' => 'DESC',
    'parent' => 0,
  ));
  $i = 0;
?>
<section class="services text-center pt-50 pb-30">
  <div class="wraper">
    <div class="flexBox rows center">
      <?php 
        foreach ($categories as $key => $category) {
          $cateName = $category->name;
          $cateDesc = $category->description;
          $i++;
          if ($i > 5) {
            $i = 5;
          }
      ?>
      <div class="item">
        <div class="images m-auto">
          <img class="imgAuto" src="<?php echo IMAGE_PATH; ?>common/images/icon<?php echo  $i; ?>.png" alt=""/>
        </div>
        <h4 class="title fz-18 text-bold mt-15">
          <?php echo  $cateName ?>
        </h4>
        <div class="text mt-10">
          <?php echo  $cateDesc ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php
  $args =[
    'post_type' => 'service',
    'posts_per_page' => 4,
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
              <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
              <?php } ?>
            </div>
          </div>
          <div class="column pr-15">
            <h4 class="fz-16 text-up fnt-utm ttl_sub"><?php the_title(); ?></h4>
            <div class="mt-15">
              <?php
                if ($excerpt != '') {
                  the_excerpt();
                } else {
                  echo '';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    <?php 
      endwhile;
      wp_reset_postdata(); } 
    ?>
    </div>
  </div>
</section>
<?php } ?>
<section class="video mt-100">
  <div class="wraper">
    <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Video</h2>
    <div class="tab_video mt-50 flexBox space">
      <?php
        $video = get_field('video_field', 10);
        if (isset($video) && !empty($video)) {
      ?>
      <div class="tab_main">
        <div class="tab_content current">
          <div class="video_production imgDrop">
            <?php echo $video[0]['video_url'] ?>
            <div class="img_bg bg_fix"><img src="common/images/images_01.png" alt=""/></div><span class="icon"></span>
          </div>
          <h4 class="ttl text-up fnt-medium mt-10 fz-18">
            <?php echo $video[0]['video_title'] ?>
          </h4>
          <div class="info flexBox fz-12 mt-5">
            <div class="name text-bold mr-15">
              <?php the_author(); ?>
            </div>
            <div class="date color-gray">
              <?php echo get_the_date('M d, yy');?>
            </div>
          </div>
          <div class="text mt-15">
            <?php echo $video[0]['video_description'] ?>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php 
      $args =[
        'post_type' => 'post',
        'posts_per_page' => 5,
        'orderby' => 'ID',
        'nopaging' => false,
        'order'=>'DESC',
      ];
      $query = new WP_Query( $args );
      $posts = $query->posts;
      if (!empty($posts)) {
    ?>
      <div class="tab_nav">
        <?php 
          if ( $query->have_posts() ) { 
          while ( $query->have_posts() ) : $query->the_post();
            $thumb =  get_the_post_thumbnail_url($post->ID);
            $title = get_the_title();
            $excerpt = get_the_excerpt();
        ?>
        <a class="nav_item flexBox midle" href="<?php the_permalink(); ?>">
          <div class="images">
            <div class="imgDrop">
              <?php if ($thumb != '') { ?>
              <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
              <?php } else { ?>
              <img src="<?php echo  NO_IMAGE ?>" alt="<?php echo  $title; ?>"/>
              <?php } ?>
            </div>
          </div>
          <div class="content">
            <h5 class="fnt-medium"><?php the_title(); ?> </h5>
            <div class="flexBox midle fz-12 mt-10">
              <div class="btn_view mr-10">View</div>
              <div class="date color-gray"><?php echo get_the_date('M d, yy');?></div>
            </div>
          </div>
        </a>
      <?php endwhile;wp_reset_postdata(); } ?>
      </div>
    <?php } ?>
    </div>
  </div>
</section>
<?php
  $before_after_images = get_field('before_after_image', 10);
  if (isset($before_after_images) && !empty($before_after_images)) {
?>
<section class="images_before_after pt-50 pb-30">
  <div class="wraper">
    <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Hình ảnh trước và sau</h2>
    <div class="slider mt-50">
      <?php 
        foreach ($before_after_images as $key => $before_after_image) {
          $before = $before_after_image['before'];
          $after = $before_after_image['after'];
          $name = $before_after_image['service_name'];
      ?>
      <div class="item">
        <div class="wrap flexBox">
          <div class="images shadow">
            <div class="imgDrop">
              <img src="<?php echo  $before; ?>" alt=""/>
            </div>
            <div class="text-center text-up fz-12 text-bold mt-5 pb-5">before</div>
          </div>
          <div class="images shadow">
            <div class="imgDrop">
              <img src="<?php echo  $after; ?>" alt=""/>
            </div>
            <div class="text-center text-up fz-12 text-bold mt-5 pb-5">after</div>
          </div>
          <div class="title mt-10 text-up text-center">
            <?php echo  $name ?>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</section>
<?php } ?>

<?php
  $feedbacks = get_field('feedback', 388);
  if (isset($feedbacks) && !empty($feedbacks)) {
?>
<section class="feedback pt-30 pb-50 text-center">
  <div class="wraper">
    <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Feedback</h2>
    <div class="text-center mt-15 max-500">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</div>
    <div class="slider mt-50">
      <?php 
        foreach ($feedbacks as $key => $feedback) {
          $thumb = $feedback['thumbnail']['url'];
          $username = $feedback['user_name'];
          $content = $feedback['feedback_content'];
          $address = $feedback['address'];
      ?>
      <div>
        <div class="wrap">
          <div class="images">
            <div class="imgDrop">
              <?php if ($thumb != '') { ?>
              <img src="<?php echo  $thumb ?>" alt="<?php echo  $username; ?>"/>
              <?php } else { ?>
              <img src="<?php echo  NO_IMAGE ?>" alt="<?php echo  $username; ?>"/>
              <?php } ?>
            </div>
          </div>
          <div class="text mt-15"><?php echo  $content ?></div>
          <div class="info">
            <div class="name text-bold text-up color-black mt-15 fz-16"><?php echo  $username ?></div>
            <div class="fz-12 color-gray"><?php echo  $address ?></div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</section>
<?php } ?>

<?php 
  $saleBanner = get_field('sale_section', 10);
  $title = $saleBanner[0]['sale_title'];
  $excerpt = $saleBanner[0]['sale_excerpt'];
  $mainTitle = $saleBanner[0]['sale_main_title'];
  $content = $saleBanner[0]['sale_content'];
  $number = $saleBanner[0]['discount_percentage'];
  if (isset($saleBanner) && !empty($saleBanner)) { 
?>
<section class="sale_off pb-50">
  <div class="wraper">
    <div class="content">
      <div class="content_main text-center">
        <div class="icon"><img class="imgAuto" src="<?php echo IMAGE_PATH; ?>common/images/banner_logo.png" alt=""/></div>
        <?php 
          if (!empty($title)) {
        ?>
        <div class="mt-10 fz-30 text-up color-blue">
          <?php echo $title; ?>
        </div>
        <?php } if (!empty($excerpt)) { ?>
        <div class="fz-12 color-blue space-2">
          <?php echo $excerpt; ?>
        </div>
        <?php } if (!empty($mainTitle)) { ?>
        <h3 class="text-bold fz-26 color-black mt-10">
          <?php echo $mainTitle; ?>
        </h3>
        <?php } if (!empty($content)) { ?>
        <div class="text mt-5 color-black max-300 m-auto">
          <?php echo $content ?>
        </div>
        <?php } ?>
      </div>
      <div class="images"><img src="<?php echo IMAGE_PATH; ?>common/images/banner_images.png" alt=""/>
        <?php if (!empty($number)) { ?>
        <div class="number_sale fz-36 color-black">
          <?php echo $number . '%'; ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<?php } ?>

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
                  the_excerpt();
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
<?php
  $galleries = get_field('Gallery', 10);
  if (isset($galleries) && !empty($galleries)) {
?>
<section class="ablum_images pt-50">
  <h3 class="title_main fz-36 text-bold text-center fnt-amazon mt-50">Kho ảnh</h3>
  <div class="album_parent flexBox mt-50">
    <?php foreach ($galleries as $gallery) { ?>
    <div class="column">
      <div class="imgDrop">
        <?php if ($gallery['image'] != '') { ?>
        <img src="<?php echo $gallery['image'] ?>" alt=""/>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>
</section>
<?php } ?>
<section class="book_now pb-50 pt-50">
  <div class="wraper">
    <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Book now</h2>
    <div class="flexBox mt-50">
      <div class="column">
        <div class="imgDrop"><img src="<?php echo IMAGE_PATH; ?>common/images/img08.png" alt=""/></div>
      </div>
      <div class="column">
        <div class="form_book pt-50 pb-50">
          <?php echo do_shortcode('[contact-form-7 id="126" title="Book now"]'); ?>
        </div>
      </div>
    </div>
  </div>
</section>