<?php

get_header();

while(have_posts()) {
  the_post(); ?>

  <div class="page-container">
    <h2><?php the_title();?></h2>

    <div class="metabox">
        <a href="<?php echo site_url('/blog'); ?>">Blog Home</a>
        <span>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.d.y'); ?> in <?php echo get_the_category_list(', '); ?></span>
    </div>
  
    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>

<?php } 


get_footer();
