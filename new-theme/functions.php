<?php

require get_theme_file_path('/inc/search-route.php');

function university_custom_rest(){
 register_rest_field('post', 'authorName', array(
  'get_callback' => function() {return get_the_author();}   
 ));
};


add_action('rest_api_init', 'university_custom_rest');

function pageBanner($args){

if(!$args['title']){
    $args['title'] = get_the_title();
}

if(!$args['subtitle']){
$args['subtitle']= get_field('page_banner_subtitle');
}

/*
if(!$args['photo']){
   if(get_field('page_banner_background_image')){
    $args['photo'] = get_field('page_banner_background_image');
   } else {
        $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
         }
}*/

?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: 
            url(<?php 
            echo $args['photo'];
            /*
            $pageBannerImage = get_field('page_banner_background_image'); 
            echo $pageBannerImage['url'] 
            */?>);">
        </div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'];?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle'];?></p>
        </div>
        </div> 
    </div> 
<?php }


function university_files(){
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyB8jsABjI_CI_jRWtOQDQMZY0JBDciGXiU
    ', NULL, 1.0, true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awessome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime());
    wp_localize_script('main-university-js','universityData', array(
    'root_url' => get_site_url()
    ));
} 

add_action('wp_enqueue_scripts', 'university_files');

function university_features(){
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');


    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    add_image_size('professorLandscape, 400, 260, true');
    add_image_size('professorPortrait, 480, 650, true');
    add_image_size('pageBanner, 1500, 350, true');
}

add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query){
    if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()){
        $query->set('post_per_page', -1);
    }
    //the code above for the pins on the map doesn't work so if it doesnt make more than 10 posts here is the problem!

    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()){
    $query->set('orderby','title');
    $query->set('order','ASC');
    $query->set('post_per_page',-1);
    }
}
add_action('after_setup_theme', 'university_adjust_queries');




function universityMapKey($api){
$api['key'] = 'AIzaSyB8jsABjI_CI_jRWtOQDQMZY0JBDciGXiU';
return $api;
}

add_filter('acf/fields/google_map/api', 'universityMapKey');

?>