<?php
  $args =[
    'post_type' => 'video',
    'posts_per_page' => 5,
    'orderby' => 'DATE',
    'nopaging' => false,
    'order'=>'DESC',
  ];
  $query = new WP_Query( $args );
  $posts = $query->posts;
  if (!empty($posts)) {
?>
<section class="video mt-100">
  <div class="wraper">
    <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Video</h2>
    <div class="tab_video mt-50 flexBox space">
      <div class="tab_main">
        <?php
          if ( $query->have_posts() ) {
            $video = get_field('video', $posts[0]->ID);
            $thumb = get_the_post_thumbnail_url($posts[0]->ID);
            $title = $posts[0]->post_title
        ?>
          <div class="tab_content current">
            <div class="video_production imgDrop">
              <div class="vid-container">
                <iframe id="vid_frame" width="100%" src="<?php echo $video[0]['url'] ?>" frameborder="0" allowfullscreen=""></iframe>
              </div>
              <div class="img_bg bg_fix">
              <?php if ($thumb != '') { ?>
                <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
              <?php } else { ?>
                <img src="<?php echo  NO_IMAGE ?>" alt="<?php echo  $title; ?>"/>
              <?php } ?>
              </div>
              <span class="icon"></span>
            </div>
            <h4 class="ttl text-up fnt-medium mt-10 fz-18">
              <?php echo $title ?>
            </h4>
            <div class="info flexBox fz-12 mt-5">
              <div class="name text-bold mr-15">
                <?php echo get_author_name($posts[0]->post_author) ?>
              </div>
              <div class="date color-gray">
                <?php echo get_the_date('M d, Y', $posts[0]->ID) ?>
              </div>
            </div>
            <div class="text mt-15">
            <?php echo $posts[0]->post_excerpt ?>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php
      if (!empty($posts)) {
    ?>
      <ul class="tab_nav">
        <?php 
          if ( $query->have_posts() ) { 
          $j = 0;
          while ( $query->have_posts() ) : $query->the_post();
            $thumb =  get_the_post_thumbnail_url($post->ID);
            $title = get_the_title();
            $excerpt = get_the_excerpt();
            $video = get_field('video');
            $j++;
        ?>
        <li class="nav_item<?php if( $j == 1) echo ' current' ?>">
          <div class="flexBox midle" onClick="document.getElementById('vid_frame').src='<?php echo $video[0]['url'];  ?>'" data-author = '<?php the_author(); ?>' data-excerpt='<?php the_excerpt(); ?>'>
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
              <h5 class="fnt-medium" data-title='<?php the_title(); ?>'><?php the_title(); ?> </h5>
              <div class="flexBox midle fz-12 mt-10">
                <div class="btn_view mr-10">View</div>
                <div class="date color-gray" data-date="<?php echo get_the_date('M d, yy');?>"><?php echo get_the_date('M d, yy');?></div>
              </div>
            </div>
          </div>
        </li>
        <?php endwhile; wp_reset_postdata(); } ?>
      </ul>
    <?php } ?>
    </div>
  </div>
</section>
<?php } ?>