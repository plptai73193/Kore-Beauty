<?php
	$args = array(
		'post_type' => 'service',
      'posts_per_page' => 4,
      'orderby' => 'ID',
		'meta_query'    => array(
			'relation' => 'OR',
			array(
				 'key'       => 'trending',
				 'value'     => 'dvnb',
				 'compare'   => 'LIKE',
			),
		),
   );
   $query = new WP_Query( $args );
	$posts = $query->posts;
?>
<aside class="mt-60">
	<h4 class="title_main title_sub fz-14">Dịch vụ nổi bật</h4>
	<?php 
		if ( $query->have_posts() ) {  
			while ( $query->have_posts() ) : $query->the_post();
				$thumb =  get_the_post_thumbnail_url($post->ID);
				$title = get_the_title();
	?>
	<div class="item flexBox mt-25">
		<a class="images" href="detail.html">
			<div class="imgDrop">
				<?php if ($thumb != '') { ?>
					<img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
				<?php } else { ?>
					<img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
				<?php } ?>
			</div>
		</a>
		<div class="content">
		<h4 class="title color-black"><a href="<?php the_permalink() ?>"><?php echo  $title ?></a></h4>
		<div class="mt-5"><a class="btn_view" href="<?php the_permalink() ?>">Xem thêm</a></div>
		</div>
	</div>
	<?php endwhile; } ?>
</aside>
