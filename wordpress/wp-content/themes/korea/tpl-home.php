<?php
	get_header();
?>
<div class="main_section clearfix">
	<div id="content">
		<div id="group_cat">
			<div class="slider clearfix">
				<?php
				$args = array(
				'post_type' => 'post',
				'posts_per_page' => 6,
				);
				$query = new WP_Query( $args );
				$postcount = 0;
				if ($query->have_posts()) :
				while ($query->have_posts()) : $query->the_post();
					$author_ID = get_the_author_meta('ID');
					$author_name = get_the_author_meta('display_name');
					$author_desc = get_the_author_meta('description');
					$author_avatar = get_wp_user_avatar();
					$dummy = get_field('dummy_image', 'option');
					$dummy_url = $dummy['url'];
					$dummy_image_url = ($dummy_url) ? $dummy_url : get_template_directory_uri().'/html/shared/img/shared/noimage.jpg';
					$thumb = (get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : $dummy_image_url;
				?>
				<div>
					<div class="item heightLine-a">
						<p class="photo">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo $thumb; ?>" width="100%" alt="<?php echo get_the_title(); ?>"/>
							</a>
						</p>
						<h3 class="tt01">
						<?php
						$categories = get_the_category(get_the_ID());
						foreach ($categories as $category) {
						$category_name = $category->name;
						$category_id = $category->term_id;
						$category_url = get_category_link( $category_id );
						$category_color = get_field('category_color', 'category_' . $category_id);
						?>
						<a href="<?php echo $category_url; ?>">
							<span style="background-color: <?php echo $category_color; ?> !important"><?php echo $category_name; ?></span>
						</a>
						<?php } ?>
						
						</h3>
						<p class="date"><?php echo get_the_date(); ?></p>
						<dl>
							<dt><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></dt>
							<dd><?php echo get_the_excerpt(); ?></dd>
						</dl>
						<div class="info clearfix">
							<div class="bio">
								<h4>
								<a href="<?php echo home_url().'/writer/#author-'.$author_ID; ?>">
									<?php echo $author_name; ?>
								</a>
								</h4>
								<p class="txt"><?php echo $author_desc; ?></p>
							</div>
							<p class="photo_sub">
								<a href="<?php echo home_url().'/writer/#author-'.$author_ID; ?>">
									<?php echo $author_avatar; ?>
								</a>
							</p>
						</div>
					</div>
				</div>
				
				<?php
				$postcount++;
				//loop here
				endwhile; endif;
				wp_reset_query();
				?>
			</div>
		</div>
		<p class="btn01"><a href="<?php echo home_url('blog'); ?>">もっと見てみる ＞＞</a></p>
	</div>
	<?php get_sidebar('custom'); ?>
</div>
<?php get_footer(); ?>