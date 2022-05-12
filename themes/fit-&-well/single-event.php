<?php

get_header();

while(have_posts()) {
  the_post(); ?>

  <div class="page-container">
    <h2><?php the_title();?></h2>
    <p><?php the_time('F j y'); ?></p>
    <hr>


    <div class="metabox">
        <a href="<?php echo get_post_type_archive_link('event'); ?>">Go Back</a>
    </div>
  
    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>

<?php } 


get_footer();
