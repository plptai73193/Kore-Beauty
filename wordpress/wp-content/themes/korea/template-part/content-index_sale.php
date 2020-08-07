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