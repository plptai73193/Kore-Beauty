<?php
	/* Template Name: Knowledge */ 
	get_header(); 
	$categories = get_terms( array(
		'taxonomy' => 'knowled-category',
		'hide_empty' => false,
		'order' => 'DESC',
		'parent' => 0,
	));
	$page_id = 260;
	$page_data = get_page( $page_id ); 
	$content = apply_filters('the_content', $page_data->post_content);
?>
<section class="blog_post pt-30 pb-50 text-center">
	<div class="wraper">
		<h2 class="title_main fz-36 text-bold text-center fnt-amazon">Các vấn đề về da</h2>
		<div class="text-center mt-15 max-800"><?php echo  $content?></div>
		<div class="parent mt-50 flexBox">
		<?php
			$i = 0;
			foreach ($categories as $category) {
				$cateName = $category->name;
				$cateDesc = $category->description;
				$cateID = $category ->term_id;
				$i++;
		?>
			<div class="column">
				<a href="<?php echo  get_term_link($cateID) ?>">
					<div class="images">
						<div class="imgDrop">
							<img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($cateID); ?>" alt=""/>
						</div>
					</div>
					<div class="content text-center pb-10">
						<div class="number fz-54 fnt-utm"><?php echo  $i ?></div>
						<div class="text-up fnt-light mt-5"><?php echo  $cateName ?></div>
					</div>
				</a>
			</div>
		<?php } ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>