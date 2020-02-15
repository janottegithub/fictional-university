<?php

get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All events 123 Magic Page</h1>
      <div class="page-banner__intro">
        <p>Try to link me to main events!</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
  <?php
  while(have_posts()){
    the_post(); 
    get_template_part('template-parts/content-event');
  }

    echo paginate_links();

  ?>
</div>

<?php get_footer();
?>