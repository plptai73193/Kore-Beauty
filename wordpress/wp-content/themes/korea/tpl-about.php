<?php 
	/* Template Name: About */ 
  get_header(); 
  $infos = get_field('about_us', 141);
  if(isset($infos) && !empty($infos)){
?>
<section class="about_main">
<div class="wraper">
  <div class="bg"><img class="imgAuto" src="<?php echo  IMAGE_PATH; ?>common/images/bg2.png" alt=""/></div>
  <div class="content pt-50 pb-80">
    <?php 
      foreach($infos as $info) {
        $title = $info['title'];
        $content = $info['content'];
    ?>
    <div class="item mt-30">
      <h4 class="title fnt-medium fz-20"><?php echo  $title ?></h4>
      <div class="text mt-10"><?php echo  $content ?></div>
    </div>
    <?php } ?>
  </div>
</div>
</section>
<?php } ?>

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
<section class="about_video pt-50 pb-50">
  <div class="wraper">
    <div class="slider mt-50" data-slick='{"autoplay": false}'>
      <?php 
        if ( $query->have_posts() ) { 
        while ( $query->have_posts() ) : $query->the_post();
          $thumb =  get_the_post_thumbnail_url($post->ID);
          $title = get_the_title();
          $excerpt = get_the_excerpt();
          $video = get_field('video');
      ?>
      <div> 
        <div class="flexBox space midle">
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
          <div class="column">
            <div class="imgDrop">
                <iframe src="<?php echo $video[0]['url'] ?>" frameborder="0"></iframe>
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
<?php
   $specialists = get_field('specialist', 141);
   if(isset($specialists) && !empty($specialists)){
?>
<section class="feedback pt-30 pb-50 text-center">
  <div class="wraper">
    <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Chuyên gia hàng đầu</h2>
    <div class="text-center mt-15 max-500">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</div>
    <div class="slider mt-50">
      <?php
        foreach($specialists as $specialist) {
          $thumb = $specialist['avatar']['url'];
          $content = $specialist['content'];
      ?>
      <div>
        <div class="wrap">
          <div class="images">
            <div class="imgDrop">
              <?php if ($thumb != '') { ?>
                <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
              <?php } else { ?>
                <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
              <?php } ?>
            </div>
          </div>
          <div class="text mt-15"><?php echo  $content ?></div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php } ?>

<?php get_footer(); ?>