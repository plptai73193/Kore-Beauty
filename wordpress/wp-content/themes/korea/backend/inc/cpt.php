<?php

// Post Type Infomation
function fcv_cpt_info($cptname,$cptslug,$cpticon,$nocat=false) {
    $labels = array(
        'name'               => _x( $cptname, 'post type general name', 'fcv' ),
        'singular_name'      => _x( $cptname, 'post type singular name', 'fcv' ),
        'menu_name'          => _x( $cptname, 'admin menu', 'fcv' ),
        'name_admin_bar'     => _x( $cptname, 'add new on admin bar', 'fcv' ),
        'add_new'            => _x( 'Thêm mới', $cptname, 'fcv' ),
        'add_new_item'       => __( 'Thêm mới '.$cptname, 'fcv' ),
        'new_item'           => __( 'Thêm  '.$cptname, 'fcv' ),
        'edit_item'          => __( 'Sửa  '.$cptname, 'fcv' ),
        'view_item'          => __( 'Xem  '.$cptname, 'fcv' ),
        'all_items'          => __( 'Tất cả  '.$cptname, 'fcv' ),
        'search_items'       => __( 'Tìm  '.$cptname, 'fcv' ),
        'parent_item_colon'  => __( 'Cha  '.$cptname.':', 'fcv' ),
        'not_found'          => __( 'No '.$cptname.' found.', 'fcv' ),
        'not_found_in_trash' => __( 'No '.$cptname.' found in Trash.', 'fcv' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Mô tả.', 'fcv' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => $cptslug  ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 6,
        'menu_icon'          => $cpticon,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes','post-formats' )
    );

    register_post_type( $cptslug , $args );

    $category_name = 'Danh Mục '.$cptname; 
    $category_slug = $cptslug.'-category'; 

    if($nocat!=false) {
        $labels = array(
            'name'              => _x( $category_name, 'taxonomy general name' ),
            'singular_name'     => _x( $category_name, 'taxonomy singular name' ),
            'search_items'      => __( 'Tìm '.$category_name ),
            'all_items'         => __( 'Tất cả  '.$category_name ),
            'parent_item'       => __( 'Cha  '.$category_name ),
            'parent_item_colon' => __( 'Cha  '.$category_name.':' ),
            'edit_item'         => __( 'Sửa  '.$category_name ),
            'update_item'       => __( 'Cập nhật  '.$category_name ),
            'add_new_item'      => __( 'Thêm mới  '.$category_name ),
            'new_item_name'     => __( 'Thêm '.$category_name.' 名' ),
            'menu_name'         => __( $category_name ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => true,
            '_builtin'          => false,
            'show_in_nav_menus' => true,
            'sort' => true
        );

        register_taxonomy( $category_slug, array($cptslug), $args );
    }
    
}

// Register Post Type
function fcv_post_init() {
    $fcv_dashicons = get_template_directory_uri().'/backend/images/cpt.png';
    fcv_cpt_info(__('Dịch vụ','fcv'), 'service', $fcv_dashicons, true);
    fcv_cpt_info(__('Kiến Thức Về Da','fcv'), 'knowled', $fcv_dashicons, true);
    fcv_cpt_info(__('Videos','fcv'), 'video', $fcv_dashicons, true);
}
add_action( 'init', 'fcv_post_init' );