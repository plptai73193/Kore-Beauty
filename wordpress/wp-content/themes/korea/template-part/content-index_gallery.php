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