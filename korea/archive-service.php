<?php
	/* Template Name: Service */ 
	get_header(); 
	$categories = get_terms( array(
		'taxonomy' => 'service-category',
		'hide_empty' => false,
		'order' => 'DESC',
		'parent' => 0,
	));
	$page_id = 247;
	$page_data = get_page( $page_id ); 
	$content = apply_filters('the_content', $page_data->post_content);
?>
<section class="service_main pt-30 pb-80">
	<div class="wraper">
		<h2 class="title_main fz-36 text-bold text-center fnt-amazon">Dịch vụ</h2>
		<div class="text-center mt-15 max-800">
			<?php echo  $content?>
		</div>
		<div class="tab_parents mt-50">
		<ul class="tab_nav flexBox text-up fz-12">
			<?php
				$i = 0;
				foreach ($categories as $category) {
					$cateName = $category->name;
					$cateDesc = $category->description;
					$cateID = $category ->term_id;
					$i++;
			?>
			<li class="<?php if($i == 1) echo 'current' ?>" data-tab="#tab0<?php echo  $i ?>"><a href="<?php echo  get_term_link($cateID) ?>"><?php echo  $cateName ?></a></li>
			<?php } ?>
		</ul>
		<div class="tab_main mt-30">
			<?php
				$i = 0;
				foreach ($categories as $category) {
					$cateName = $category->name;
					$cateID = $category ->term_id;
					$cateSlug = $category ->slug;
					$i++;
			?>
			<div class="tab_content <?php if($i == 1) echo 'current' ?>" id="tab0<?php echo  $i ?>">
				<div class="parents flexBox center">
					<?php
						$args = array(
							'post_type' => 'service',
							'posts_per_page' => 4,
							'orderby' => 'ID',
							'nopaging' => true,
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'service-category',
									'field' => 'slug',
									'terms' => $cateSlug,
								)
							)
						);
						$query = new WP_Query( $args );
						$posts = $query->posts;
						$totalPost = $query->found_posts;
						$j = 0;
						if ( $query->have_posts() ) { 
					?>
					<?php if($totalPost != '' && $totalPost <=8){ ?>
						<div class="column-2">
					<?php } else { ?>
						<div class="column-4">
					<?php } ?>
						<?php
								while ( $query->have_posts() ) : $query->the_post();
								$thumb =  get_the_post_thumbnail_url($post->ID);
								$title = get_the_title();
								$price = get_field('price');
								$j++;
						?>
						<a class="item flexBox space color-black midle mt-15" href="<?php echo  the_permalink(); ?>">
							<div class="images">
								<div class="imgDrop">
									<?php if ($thumb != '') { ?>
                              <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
									<?php } else { ?>
                              <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
									<?php } ?>
								</div>
							</div>
							<div class="content flexBox space midle">
								<div class="name fnt-medium text-up"><?php echo  $title ?></div>
								<?php if($price){ ?>
								<div class="price"><?php echo  $price ?>/buổi</div>
								<?php } ?>
							</div>
						</a>
					<?php
						if($j % 4 ==0){
					?>
					</div>
					<?php if($totalPost != '' && $totalPost <=8){ ?>
						<div class="column-2">
					<?php } else { ?>
						<div class="column-4">
					<?php } } ?>
						<?php endwhile; } wp_reset_query(); ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>