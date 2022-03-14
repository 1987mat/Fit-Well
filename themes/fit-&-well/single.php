<?php

get_header();

while(have_posts()) {
  the_post(); ?>

  <div>
  <h1>This is a post</h1>
  <h2><?php the_title();?></h2>
  </div>
  
  <div>
  <p><a href="<?php echo site_url('/workouts'); ?>">Workouts Home</a>
  <?php the_content(); ?>
  </div>

<?php } 


get_footer();
