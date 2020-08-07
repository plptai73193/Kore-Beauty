<?php
  $categories = get_terms( array(
    'taxonomy' => 'service-category',
    'hide_empty' => false,
    'order' => 'DESC',
    'parent' => 0
  ));
  $logo = get_field('logo', 'option');
  $mobileLogo = get_field('mobile_logo', 'option');
  $address = get_field('address', 'option');
  $social = get_field('social', 'option');
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="ja"><![endif]-->
<!--[if IE 7]><html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="ja"><![endif]-->
<!--[if IE 8]><html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="ja"><![endif]-->
<!--[if IE 9]><html class="ie ie9 ie-lt10 no-js" lang="ja"><![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php echo get_bloginfo('name') ?>">
    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes" />
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>common/fonts/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>common/css/slick.css"/>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>common/css/slick-theme.css"/>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>common/css/common.css"/>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>common/css/styles.css"/>
    <div id="fb-root"></div>
    <script src="<?php echo JS_PATH; ?>common/js/jquery.min.js"></script>
    <script src="<?php echo JS_PATH; ?>common/fonts/all.js"></script>
    <script src="<?php echo JS_PATH; ?>common/js/slick.js"></script>
    <script src="<?php echo JS_PATH; ?>common/js/custom_slider.js"></script>
    <script src="<?php echo JS_PATH; ?>common/js/select_custom.js"></script>
    <script src="<?php echo JS_PATH; ?>common/js/main.js"></script>
    <script async="" defer="" crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&amp;version=v7.0" nonce="OBK3N4Wa"></script>
    <?php wp_head(); ?>
  </head>
  <body class="index"> 
    <header>
      <div class="wraper">
        <div class="flexBox center midle">
          <div class="address fz-14"> <i class="fas fa-map-marker-alt mr-5"></i><?php echo $address ?></div>
          <h1 class="logo"><a href="<?php echo site_url(''); ?>">
            <img class="logo_main imgAuto" src="<?php echo $logo; ?>" alt="<?php echo bloginfo('name'); ?>"/>
          
          	<img class="logo_fix imgAuto" src="<?php echo $mobileLogo; ?>" alt="<?php echo bloginfo('name'); ?>"/></a></h1>
          <div class="header-right flexBox center midle">
            <form class="form_search mr-10" action="">
              <input type="text"/>
              <button><i class="fas fa-search"></i></button>
            </form>
            <ul class="social flexBox">
              <li class="ml-10 mr-10"><a href="<?php echo $social[0]['facebook'] ?>"><i class="fab fa-facebook-f"></i></a></li>
              <li class="ml-10 mr-10"><a href="<?php echo $social[0]['google_plus'] ?>"><i class="fab fa-google-plus-g"></i></a></li>
              <li class="ml-10 mr-10"><a href="<?php echo $social[0]['linkedin'] ?>"><i class="fab fa-linkedin-in"></i></a></li>
              <li class="ml-10 mr-10"><a href="<?php echo $social[0]['twitter'] ?>"><i class="fab fa-twitter"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <nav class="fz-14">
        <div class="wraper">
          <ul class="flexBox center midle">
            <li><a href="<?php echo site_url(''); ?>">TRANG CHỦ</a></li>
            <li><a href="<?php echo site_url('about'); ?>">VỀ CHÚNG TÔI</a></li>
            <li class="toggle_parents"><a href="<?php echo site_url('service'); ?>">DỊCH VỤ</a><span class="toggle_btn"><i class="fas fa-sort-down"></i></span>
                <div class="mega_menu shadow toggle_content">
                  <div class="tab_hover flexBox">
                    <ul class="tab_nav">
                    <?php
                      $i = 0;
                      foreach ($categories as $category) {
                        $cateName = $category->name;
                        $cateDesc = $category->description;
                        $cateID = $category ->term_id;
                        $i++;
                    ?>
                      <li class="<?php if($i == 1) echo 'current' ?>" data-tab="#mega<?php echo  $i ?>NaN"> <a href="<?php echo  get_term_link($cateID) ?>"><?php echo  $cateName ?><i class="fas fa-chevron-right"></i></a></li>
                    <?php } ?>
                    </ul>
                    <div class="tab_main">
                    <?php 
                      $i = 0;
                      foreach ($categories as $category) {
                        $cateID = $category ->term_id;
                        $cateSlug = $category ->slug;
                        $i++;
                    ?>
                      <div class="tab_content <?php if($i == 1) echo 'current' ?>" id="mega<?php echo  $i ?>NaN">
                        <?php
                          $args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 2,
                            'orderby' => 'ID',
                            'nopaging' => false,
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
                        ?>
                        <div class="flexBox">
                        <?php 
                          if( !empty($posts) ){
                            foreach( $posts as $post ){	
                              $thumb = get_the_post_thumbnail_url($post->ID);
                              $title = $post->post_title;
                              $id = $post->ID;
                        ?>
                          <div class="column">
                            <h4 class="title text-up fnt-medium"> <a href="<?php echo  the_permalink($id) ?>"><?php echo  $title; ?></a></h4>
                            <div class="images mt-10">
                              <a class="imgDrop" href="<?php echo  the_permalink() ?>">
                              <?php if ($thumb != '') { ?>
                              <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
                              <?php } else { ?>
                              <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
                              <?php } ?>
                              </a>
                            </div>
                          </div>
                          <?php }} ?>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
            </li>
            <li class="toggle_parents">
            	<a href="<?php echo site_url('knowled'); ?>">CÁC VẤN ĐỀ VỀ DA</a>
            	<span class="toggle_btn"><i class="fas fa-sort-down"></i></span>
                <div class="mega_menu shadow toggle_content">
                <div class="tab_hover flexBox">
                    <ul class="tab_nav">
                    <?php
                      $categories = get_terms( array(
                        'taxonomy' => 'knowled-category',
                        'hide_empty' => false,
                        'order' => 'DESC',
                        'parent' => 0
                      ));
                      $i = 0;
                      foreach ($categories as $category) {
                        $cateName = $category->name;
                        $cateDesc = $category->description;
                        $cateID = $category ->term_id;
                        $i++;
                    ?>
                      <li class="<?php if($i == 1) echo 'current' ?>" data-tab="#mega<?php echo  $i ?>NaN"> <a href="<?php echo  get_term_link($cateID) ?>"><?php echo  $cateName ?><i class="fas fa-chevron-right"></i></a></li>
                    <?php } ?>
                    </ul>
                    <div class="tab_main">
                    <?php 
                      $i = 0;
                      foreach ($categories as $category) {
                        $cateID = $category ->term_id;
                        $cateSlug = $category ->slug;
                        $i++;
                    ?>
                      <div class="tab_content <?php if($i == 1) echo 'current' ?>" id="mega<?php echo  $i ?>NaN">
                        <?php
                          $args = array(
                            'post_type' => 'knowled',
                            'posts_per_page' => 2,
                            'orderby' => 'ID',
                            'nopaging' => false,
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'knowled-category',
                                    'field' => 'slug',
                                    'terms' => $cateSlug,
                                )
                            )
                          );
                          $query = new WP_Query( $args );
                          $posts = $query->posts;
                        ?>
                        <div class="flexBox">
                        <?php 
                          if( !empty($posts) ){
                            foreach( $posts as $post ){	
                              $thumb = get_the_post_thumbnail_url($post->ID);
                              $title = $post->post_title;
                              $id = $post->ID;
                        ?>
                          <div class="column">
                            <h4 class="title text-up fnt-medium"> <a href="<?php echo  the_permalink($id) ?>"><?php echo  $title; ?></a></h4>
                            <div class="images mt-10">
                              <a class="imgDrop" href="<?php echo  the_permalink() ?>">
                              <?php if ($thumb != '') { ?>
                              <img src="<?php echo  $thumb ?>" alt="<?php echo  $title; ?>"/>
                              <?php } else { ?>
                              <img src="<?php echo  NO_IMAGE; ?>" alt="<?php echo  $title; ?>"/>
                              <?php } ?>
                              </a>
                            </div>
                          </div>
                          <?php }} ?>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
            </li>
            <li><a href="<?php echo site_url('news'); ?>">TIN TỨC</a></li>
            <li><a href="<?php echo site_url('feedback'); ?>">FEEDBACK</a></li>
            <li><a href="<?php echo site_url('contact'); ?>">ĐĂNG KÝ TƯ VẤN</a></li>
          </ul>
        </div>
      </nav>
      <div class="nav_btn" onclick="document.body.classList.toggle('active')"><span></span></div>
    </header>
    <main>
      <?php
      $args = array(
        'post_type' => 'service',
          'posts_per_page' => 4,
          'orderby' => 'ID',
        'meta_query'    => array(
          'relation' => 'OR',
          array(
             'key'       => 'frontpage_view',
             'value'     => 'tc ',
             'compare'   => 'LIKE',
          ),
        ),
       );
      $query = new WP_Query( $args );
      $posts = $query->posts;
    ?>
  		<section class="banner text-center flexBox center midle">
	        <div class="img-left"><img class="imgDrop" src="<?php echo IMAGE_PATH; ?>common/images/banner_01.png" alt=""/></div>
	        <div class="img-right"><img class="imgDrop" src="<?php echo IMAGE_PATH; ?>common/images/banner_02.png" alt=""/></div>
	        <div class="content">
	          <h2 class="fz-54 text-up fnt-utm ttl_line">
             <?php echo  $posts[0]->post_title ?> 
            </h2>
	          <div class="text mt-20">
              <?php
                echo word_count($posts[0]->post_excerpt , $limit);
              ?> 
            </div>
	          <div class="flexBox center mt-15 button"><a class="btn_line" href="<?php echo  get_the_permalink($posts[0]->ID) ?>">view service</a><a class="btn_fill" href="<?php echo site_url('contact'); ?>">BOOK NOW</a></div>
	        </div>
	      </section>