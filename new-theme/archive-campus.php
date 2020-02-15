<?php

get_header(); 
pageBanner(array(
    'title' => 'Our campuses',
    'subtitle' => 'We have several conveniently located campuses.',
//    'photo' => 'https://images.unsplash.com/photo-1503293962593-47247718a17a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1049&q=80'
  ));
?>



<!--<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php// echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
-->    
    <div class="page-banner__content container container--narrow">
<!--      <h1 class="page-banner__title">All programs</h1>
      <div class="page-banner__intro">
        <p>There is something for everyone.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
  -->

  <ul class="link-list min-list">
    <div class="acf-map">
    <?php
        while(have_posts()){
            the_post(); 
            $mapLocation = get_field('map_location');
            ?>
            <div class="marker" data-lat="<?php echo $mapLocation['lat']?>" data-lng="<?php echo $mapLocation['lng']?>">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php echo $mapLocation['address'] ?>
            </div>
        <?php  }
        echo paginate_links();
        ?>
    </div>
  </ul>

</div>

<?php get_footer();
?>