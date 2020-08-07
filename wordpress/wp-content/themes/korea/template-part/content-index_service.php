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