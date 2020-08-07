<?php
	$args = array(
	'post_type' => 'post',
	'posts_per_page' => 3,
	'meta_key'		=> 'featured',
	'meta_value'	=> 'yes'
	);
	$query = new WP_Query( $args );
?>
<div id="sidebar">
	<div id="search">
		<form role="search" method="get" id="searchform"
			class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div>
				<label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
				<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
				<input type="submit" id="searchsubmit"
				value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
			</div>
		</form>
	</div>
	<div class="box">
		<h3><span><?php _e('PICK UP！','fcv'); ?></span></h3>
		<div class="list_top">
			<div id="news_top">
				<?php
					$postcount = 0;
					if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
						$author_name = get_the_author_meta('display_name');
						$author_desc = get_the_author_meta('description');
						$author_avatar = get_wp_user_avatar();
						$featured = get_field('featured');
						$thumb = (get_the_post_thumbnail_url('', 'sidebar-thumb')) ? get_the_post_thumbnail_url('', 'sidebar-thumb') : get_template_directory_uri().'/html/shared/img/shared/noimage.jpg';
				?>
				<div class="item clearfix">
					<p class="thumb"><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb; ?>" width="auto" alt="<?php echo get_the_title(); ?>"/></a></p>
					<dl>
						<dt><?php echo get_the_date(); ?></dt>
						<dd><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></dd>
					</dl>
				</div>
				<?php
					$postcount++;
					//loop here
					endwhile; endif;
					wp_reset_query();
				?>
			</div>
		</div>
	</div>
	<div class="box">
		<h3><span><?php _e('人気記事ランキング','fcv'); ?></span></h3>
		<?php
			$args = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			);
			$query = new WP_Query( $args );
		?>
		<div class="list_top">
			<div id="news_ran">
				<ul>
					<?php
					$postcount = 1;
					if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
					$author_name = get_the_author_meta('display_name');
					$author_desc = get_the_author_meta('description');
					$author_avatar = get_wp_user_avatar();
					$featured = get_field('featured');
					$thumb = (get_the_post_thumbnail_url('', 'sidebar-thumb')) ? get_the_post_thumbnail_url('', 'sidebar-thumb') : get_template_directory_uri().'/html/shared/img/shared/noimage.jpg';
					?>
					<li>
						<span class="num num0<?php echo $postcount; ?>"><?php echo $postcount; ?></span>
						<span class="photo">
							<img src="<?php echo $thumb; ?>" width="auto" alt="<?php echo get_the_title(); ?>"/>
						</span>
						<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
					</li>
					<?php
					$postcount++;
					//loop here
					endwhile; endif;
					wp_reset_query();
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="box">
		<h3><span><?php _e('BACK NUMBER','fcv'); ?></span></h3>
		<div class="list_top">
			<div id="num_ran">
				<ul class="side-categories">
					<?php
						$year = (int)date("Y");
					?>
					<li class="btn-tg01 close toggle" role="ct01"><span><?php echo $year; ?>年</span>
					<ul id="ct01" class="sub_cate">
						<?php for($i=12; $i>=1; $i--) {
							$args = array(
								'posts_per_page' => -1,
								'post_type' => 'post',
								'date_query' => array(
									array(
										'year'  => get_the_date($year),
										'month' => get_the_date($i)
									),
								),
							);
							$posts = get_posts( $args );
							$count_post = count($posts);
							if($i<10){ $prefix = '0'; }
							if($count_post>0) { ?>
							<li><a href="<?php echo get_month_link($year,$i); ?>"><?php echo $prefix.$i.'月'; ?></a></li>
						<?php } // End if
						} // End for ?>
					</ul>
				</li>
			</li>
		</ul>
	</div>
</div>
</div>