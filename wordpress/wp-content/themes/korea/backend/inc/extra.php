<?php
// Get Current Url for all function
function get_current_url() {
    global $current_url;
    $current_url = "http" . (($_SERVER['SERVER_PORT'] == 443 || $_SERVER['SERVER_PORT'] == 8800) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $current_url = htmlspecialchars($current_url, ENT_QUOTES, 'UTF-8');
    return $current_url;
}

// Add custom field to menu
add_filter('wp_nav_menu_objects', 'fcv_nav_objects', 10, 2);

function fcv_nav_objects( $items, $args ) {
    // loop
    foreach( $items as &$item ) {
        // vars
        $ja_title = get_field('ja_title', $item);
        // append ja_title
        if( $ja_title ) {
            $item->title .= '<span class="ja-title">'.$ja_title.'</span>'; 
        }
    }
    // return
    return $items;   
}

// Custom Archive Title
function fcv_archive_title() {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_year() ) {
        /* translators: Yearly archive title. %s: Year */
        $title = sprintf( __( 'Year: %s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
    } elseif ( is_month() ) {
        /* translators: Monthly archive title. %s: Month name and year */
        $title = sprintf( __( 'Month: %s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
    } elseif ( is_day() ) {
        /* translators: Daily archive title. %s: Date */
        $title = sprintf( __( 'Day: %s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }   
    return $title;
}
add_filter( 'get_the_archive_title', 'fcv_archive_title' );

// Custom Single Title
function fcv_single_title() {
    if(is_single()) {
        $post_tags = get_the_tags();
        if ( $post_tags ) {
            $tag_name = array();
            foreach( $post_tags as $tag ) {
                $tag_name[].=$tag->name;
            }
        }   
        if($tag_name) {
            $tag = implode($tag_name, ', ');
            $title = $tag;
        } else {
            $title = get_the_title();
        }
    } 
    return $title;
}

// FCV Custom Title
function fcv_custom_title() {
    if(is_single()) {
        $title =  fcv_single_title();
    } elseif(is_page()) {
        $title = get_the_title();
    } else {
        $title = fcv_archive_title();
    }
    return $title;
}


// Add Option Page Setting
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'  => 'Thiết lập chung',
        'menu_title'  => 'Thiết lập chung',
        'menu_slug'   => 'theme-general-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false
    ));

/*    acf_add_options_sub_page(array(
        'page_title'  => 'Theme Header Settings',
        'menu_title'  => 'Header',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Theme Footer Settings',
        'menu_title'  => 'Footer',
        'parent_slug' => 'theme-general-settings',
    ));*/
  
}

//Hide Admin Bar
/*add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    show_admin_bar(false);
}*/


// XSS Sercure
function sc_xss($xss) {
    $result = htmlspecialchars($xss, ENT_QUOTES, 'UTF-8');
    return $result;
}


// Youtube Functions
function youtube_url_validate($youtube_url) {
  $parsed = parse_url($youtube_url);
  if ($parsed['host'] == 'youtube.com' || $parsed['host'] == 'youtu.be' || $parsed['host'] == 'www.youtube.com' || $parsed['host'] == 'www.youtu.be') {
      return true;
  } else {
    return false;
  }
}

function youtube_video_id($youtube_url) {
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_url, $match); 
    $youtube_id = $match[1];
    return $youtube_id;
}

function youtube_video_thumb($youtube_url) {
    $youtube_id = youtube_video_id($youtube_url);
    $thumbURL = 'https://img.youtube.com/vi/'.$youtube_id.'/0.jpg';
    return $thumbURL;
}


// Phone Validate
function phone_validate($phone_value) {
    if( !is_numeric($phone_value) || strlen($phone_value) < 9 || strlen($phone_value) > 11  ){
        return false;
    } else {
        return true;
    }
}


// Get img filesize
function getFileSizeInMB($base64string){
    $size_in_bytes = (int) (strlen(rtrim($base64string, '=')) * 3 / 4);
    $size_in_kb    = $size_in_bytes / 1024;
    $size_in_mb    = $size_in_kb / 1024;
    return $size_in_mb;
}

// Save base64 img
function save_base64_image($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen($output_file, 'wb');

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode(',', $base64_string);

    // we could add validation here with ensuring count( $data ) > 1
    fwrite($ifp, base64_decode($data[1]));

    // clean up the file resource
    fclose($ifp);

    return $output_file;
}

/**
 * Lấy tên file từ link file
 * @param $file_path
 * @return mixed
 */
function get_filename($file_path){
    $file=explode('/',$file_path);
    return end($file);
}

function do_save_image($image_key,$post_id){

    $nonce = $_REQUEST['_wpnonce'];
    $action = $_POST['action'];

    $upload_dir = wp_upload_dir();
    // @new
    $upload_path = str_replace('/', DIRECTORY_SEPARATOR, $upload_dir['path']) . DIRECTORY_SEPARATOR;
    $img = $_POST[$image_key];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $decoded = base64_decode($img);
    $filename = date('Y-m-d-H-i-s') . '.png';
    $hashed_filename = md5($filename . microtime()) . '_' . $filename;
    // @new
    // $image_upload     = file_put_contents( $upload_path . $hashed_filename, $decoded );
    $image_upload = save_base64_image($_POST[$image_key], $upload_path . $hashed_filename);

    //HANDLE UPLOADED FILE
    if( !function_exists( 'wp_handle_sideload' ) ) {
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    // Without that I'm getting a debug error!?
    if( !function_exists( 'wp_get_current_user' ) ) {
      require_once( ABSPATH . 'wp-includes/pluggable.php' );
    }

    // @new
    $file             = array();
    $file['error']    = '';
    $file['tmp_name'] = $upload_path . $hashed_filename;
    $file['name']     = $hashed_filename;
    $file['type']     = 'image/png';
    $file['size']     = filesize( $upload_path . $hashed_filename );

    // upload file to server
    // @new use $file instead of $image_upload
    $file_return      = wp_handle_sideload( $file, array( 'test_form' => false ) );

    $filename = $file_return['file'];
    $attachment = array(
     'post_mime_type' => $file_return['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
     'post_content' => '',
     'post_status' => 'inherit',
     'guid' => $upload_dir['url'] . '/' . basename($filename)
     );
    $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    $image_url = $upload_dir['url'].'/'.get_filename($filename);
    return $attach_id;

}

// Custom Social Share Button
function social_share() {
    global $wp;
    $url_share = home_url( $wp->request );
    $title = get_the_title();
    $loadjs='onclick="return fcv_loadpopup_js(this);"';
    $html='<a '.$loadjs.' rel="external nofollow" href="http://www.facebook.com/sharer/sharer.php?u='.$url_share.'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    <a '.$loadjs.' rel="external nofollow" href="http://www.linkedin.com/shareArticle?mini=true&url='.$url_share.'&title=""" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
    <a '.$loadjs.' rel="external nofollow" href="http://twitter.com/intent/tweet/?text='.$title.'&url='.$url_share.'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
    return $html;
}

// No Google index and redirect to home page all post type exists in array
function custom_index_google($array) {
  if (is_singular($array)) {
    echo '<meta name="robots" content="noindex">';
    wp_redirect(home_url());
  }
}

// Get page ID by slug
function get_page_ID_by_slug( $slug ) {
    $page = get_page_by_path( $slug );
    if ( $page ) {
        return (int) $page->ID;
    }
    else {
        return null;
    }
}

// Check if category has parent
function category_has_parent($catid){
    $category = get_category($catid);
    if ($category->category_parent > 0){
        return true;
    }
    return false;
}

// Check if category has children
function has_Children($cat_id)
{
    $children = get_terms(
        'category',
        array( 'parent' => $cat_id, 'hide_empty' => false )
    );
    if ($children){
        return true;
    }
    return false;
}

// Show excerpt length with custom number
function short_excerpt_length( $length ) {
   $excerpt_text = get_the_excerpt();
   return wp_trim_words( $excerpt_text, $length , '...' );
}


// Hard reset excerpt length
/*function fcv_custom_excerpt_length() {
    return 80;
}
add_filter( 'excerpt_length', 'fcv_custom_excerpt_length', 999 );
*/

// Show excerpt length with custom number of word
function custom_length_excerpt($word_count_limit) {
    $content = wp_strip_all_tags(get_the_content() , true );
    echo wp_trim_words($content, $word_count_limit);
}

// Custom excerpt more text
function fcv_excerpt_more( $more ) {
    return ' .....';
}
add_filter( 'excerpt_more', 'fcv_excerpt_more' );

// Get template path (begin from wp-content folder)
function fc_template_path($str = NULL) {
    $path = str_replace(home_url("/"), "", get_template_directory_uri());
    $path .= "/";
    if ($str) $path .= trim($str, "/")."/";

    return $path;
}

// Remove Admin menu
function fcv_remove_menu(){
    // remove_menu_page('edit.php'); // 投稿
    // remove_menu_page('edit.php?post_type=page'); // 固定ページ
    // remove_menu_page('edit-comments.php'); // コメント
    // remove_menu_page('edit.php?post_type=acf-field-group'); // コメント
}
add_action('admin_menu','fcv_remove_menu');

add_filter('wp_nav_menu_objects', 'fcv_nav_objects', 10, 2);


// Remove Admin Submenu
function fcv_remove_admin_submenus() {
    // remove_submenu_page( 'edit.php?post_type=acf-field-group', 'acf-settings-updates' );
    remove_submenu_page('edit.php?post_type=company', 'edit-tags.php?taxonomy=company-category&amp;post_type=company');
}

add_action( 'admin_menu', 'fcv_remove_admin_submenus', 999 );

/**
 * Remove default description column from category
 *
 */
function fcv_remove_taxonomy_description($columns) {
 // only edit the columns on the current taxonomy, replace category with your custom taxonomy (don't forget to change in the filter as well)
 if ( !isset($_GET['taxonomy']) || $_GET['taxonomy'] != 'category' )
 return $columns;

 // unset the description columns
 if ( $posts = $columns['description'] ){ unset($columns['description']); }
 return $columns;
}
add_filter('manage_edit-category_columns','fcv_remove_taxonomy_description');

/// Add WYSIWYG to Category Description
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );

add_filter('edit_category_form_fields', 'cat_description');
function cat_description($tag)
{
    ?>
        <table class="form-table">
            <tr class="form-field">
                <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
                <td>
                <?php
                    $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
                    wp_editor(wp_kses_post($tag->description , ENT_QUOTES, 'UTF-8'), 'cat_description', $settings);
                ?>
                <br />
                <span class="description"><?php _e('The description is not prominent by default; however, some themes may show it.'); ?></span>
                </td>
            </tr>
        </table>
    <?php
}

add_action('admin_head', 'remove_default_category_description');
function remove_default_category_description()
{
    global $current_screen;
    if ( $current_screen->id == 'edit-category' )
    {
    ?>
        <script type="text/javascript">
        jQuery(function($) {
            $('textarea#description').closest('tr.form-field').remove();
        });
        </script>
    <?php
    }
}

function custom_pagination($numpages = '', $pagerange = '', $paged='') {
    
    global $wp_query, $wp_rewrite;
  
    if (empty($pagerange)) {
        $pagerange = 5;
    }

    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }
    if ($numpages == '') {
        $numpages = $wp_query->max_num_pages;
    }
    if(!$numpages) {
        $numpages = 1;
    }

    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';
 

    $pagination_args = array(
        /* 
        'base'            => get_pagenum_link(1) . '%_%',
        'format'          => $format,
        */
        'base'            => @add_query_arg( 'paged', '%#%' ),
        'format'          => '',
        'total'           => $numpages,
        'current'         => $paged,
        'show_all'        => false,
        'end_size'        => 1,
        'mid_size'        => $pagerange,
        'prev_next'       => false,
        'prev_text'       => __('« Prev'),
        'next_text'       => __('Next »'),
        'type'            => 'plain',
        'add_args'        => false,
        'add_fragment'    => ''
    );

    $paginate_links = paginate_links($pagination_args);

    $next_1_page = $paged + 1;
    $next_1_page_link = get_pagenum_link($next_1_page);  

    $next_5_page = $paged + 5;
    $next_5_page_link = get_pagenum_link($next_5_page);

    $prev_1_page = $paged - 1;
    $prev_1_page_link = get_pagenum_link($prev_1_page);  

    $prev_5_page = $paged - 5;
    $prev_5_page_link = get_pagenum_link($prev_5_page);


    if ($paginate_links) {
        echo "<div class='pagination'>";
        if(($prev_1_page > 0)) {
            echo '<a href="'.$prev_1_page_link.'">&laquo; Prev</a>';
        }

        if(($prev_5_page >= 0)) {
            echo '<a href="'.$prev_5_page_link.'">&laquo;</a>';
        }

        echo $paginate_links;

        if(($next_5_page <= $numpages)) {
            echo '<a href="'.$next_5_page_link.'">&raquo;</a>';
        }

        if(($next_1_page <= $numpages)) {
            echo '<a href="'.$next_1_page_link.'">Next &raquo;</a>';
        }

        echo "</div>";
    }

}