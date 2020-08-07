<?php /* Template Name: Feedback */ get_header(); ?>
<?php
	$page_id = 388;
	$page_data = get_page( $page_id ); 
	$content = apply_filters('the_content', $page_data->post_content);
  	$feedbacks = get_field('feedback', $page_id);
  if (isset($feedbacks) && !empty($feedbacks)) {
?>
<section class="feedback pt-30 pb-50 text-center">
<div class="wraper">
  <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Feedback</h2>
  <div class="text-center mt-15 max-500"><?php echo  $content ?></div>
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
<?php get_footer(); ?>