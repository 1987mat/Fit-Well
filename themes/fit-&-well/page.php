<?php

get_header(); ?>

  <h1>This is a page</h1>

<?php

while(have_posts()) {
  the_post(); ?>

  <li> <?php the_title(); ?> </li>
  <p><?php the_content();?></p>

<?php } 

get_footer();

?>


