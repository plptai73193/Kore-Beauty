<?php
	/* Template Name: Service */ 
	get_header();
	$categories = get_terms( array(
		'taxonomy' => 'service-category',
		'hide_empty' => false,
		'order' => 'DESC',
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
						if($category->parent == 0){
				?>
				<li data-tab="#tab0<?php echo  $i ?>"><a href="<?php echo get_term_link($cateID) ?>"><?php echo  $cateName ?></a></li>
				<?php }} ?>
			</ul>
			<div class="tab_main mt-30">
				<?php
					$i = 0;
					foreach ($categories as $category) {
						$cateName = $category->name;
						$cateDesc = $category->description;
						$cateID = $category ->term_id;
						$cateSlug = $category ->slug;
						$childCates = get_categories(
							array(
							  'taxonomy' => 'service-category',
							  'parent' => $cateID
							)
						);
						$i++;
						if($category->parent == 0){
				?>
				<div class="tab_content" id="tab0<?php echo  $i ?>">
					<div class="parents flexBox center">
					<?php
						if(isset($childCates) && !empty($childCates)){
							foreach($childCates as $childCate){
								$args = array(
									'post_type' => 'service',
									'posts_per_page' => 8,
									'orderby' => 'ID',
									'nopaging' => true,
									'order' => 'ASC',
									'tax_query' => array(
										array(
											'taxonomy' => 'service-category',
											'field' => 'slug',
											'terms' => $childCate->slug,
										)
									)
								);
								$query = new WP_Query( $args );
								$posts = $query->posts;
					?>
						<div class="column-4">
							<h4 class="title text-up fz-16 mb-30 color-black"><?php echo $childCate->name; ?></h4>
							<?php if ( $query->have_posts() ) {  ?>
							<?php
									while ( $query->have_posts() ) : $query->the_post();
									$thumb =  get_the_post_thumbnail_url($post->ID);
									$title = get_the_title();
									$price = get_field('price');
							?>
							<a class="item flexBox space color-black midle mt-15" href="<?php the_permalink() ?>">
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
									<div class="name fnt-medium text-up">
										<?php echo $title?>
									</div>
									<?php if($price){ ?>
									<div class="price">
										<?php echo  $price ?>/buổi
									</div>
									<?php } ?>
								</div>
							</a>
							<?php endwhile; wp_reset_query(); }  ?>
						</div>
						<?php 
						}} else { 
							$args = array(
								'post_type' => 'service',
								'posts_per_page' => 8,
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
							if ( $query->have_posts() ) { 
						?>
						<div class="column-2">
							<?php 
								if ( $query->have_posts() ) {  
									while ( $query->have_posts() ) : $query->the_post();
									$thumb =  get_the_post_thumbnail_url($post->ID);
									$title = get_the_title();
									$price = get_field('price');
							?>
							<a class="item flexBox space color-black midle mt-15" href="<?php the_permalink() ?>">
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
									<div class="name fnt-medium text-up">
										<?php the_title(); ?>
									</div>
									<?php if($price){ ?>
									<div class="price">
										<?php echo  $price ?>/buổi
									</div>
									<?php } ?>
								</div>
							</a>
							<?php endwhile; wp_reset_query(); }  ?>
						</div>
					<?php }} ?>
					</div>
				</div>
				<?php }} ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>