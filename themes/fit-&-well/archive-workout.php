<?php 
  get_header();
?>

<div class="posts-container">
  <?php pageBanner(array(
    'title' => 'Workouts',
    'subtitle' => 'Choose your plan!'
  ));  ?>
 
  <ul>
    <?php 

    $workouts = new WP_Query(array(
      'post_type' => 'workout',
      'post_per_page' => 3,
      'order' => 'ASC'
    ));

    while($workouts->have_posts()) {
      $workouts->the_post(); 
      get_template_part('content', 'event');      
    }
    ?>
  </ul>
</div>


<?php get_footer(); ?>
