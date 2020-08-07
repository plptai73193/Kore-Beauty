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