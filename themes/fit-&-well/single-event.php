<?php

get_header();

while(have_posts()) {
  the_post(); ?>

  <div class="page-container">
    <h2><?php the_title();?></h2>

    <div class="metabox">
        <a href="<?php echo site_url('/events'); ?>">Events Home</a>
    </div>
  
    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>

<?php } 


get_footer();
