<?php 
	/* Template Name: Contact */ 
	get_header(); 
?>
<section class="book_now pb-50 pt-50">
<div class="wraper">
  <h2 class="title_main fz-36 text-bold text-center fnt-amazon">Đăng kí tư vấn</h2>
  <div class="flexBox mt-50">
    <div class="column">
      <div class="imgDrop"><img src="<?php echo  IMAGE_PATH; ?>common/images/img08.png" alt=""/></div>
    </div>
    <div class="column">
      <div class="form_book pt-50 pb-50">
          <?php echo do_shortcode('[contact-form-7 id="126" title="Book now"]'); ?>
        </div>
    </div>
  </div>
</div>
</section>
<?php get_footer(); ?>