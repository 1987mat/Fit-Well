<?php

get_header(); ?>

<h1>This is a page</h1>


  <?php 
  if(is_user_logged_in()) {  ?>
    <a class="comments-link" href=" <?php echo site_url('/my-comments');?>">Click here to leave a comment!</a>
  <?php
  } else { ?>
    <a class="comments-link" href=" <?php echo wp_login_url();?>">Join our community!</a> 
  <?php }

while(have_posts()) {
  the_post(); ?>

  <li> <?php the_title(); ?> </li>
  <p><?php the_content();?></p>

<?php } 

get_footer();

?>

