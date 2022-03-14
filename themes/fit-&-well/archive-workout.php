<?php 

/* Template Name: Custom Archive Page Workout */

  get_header();
?>


<h1>Workouts</h1>

<?php 

$workouts = new WP_Query(array(
  'post_type' => 'workout',
  'post_per_page' => 3,
  'order' => 'ASC'
));

while($workouts->have_posts()) {
  $workouts->the_post(); ?>

  <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
  <p><?php the_content();?></p>

<?php }
?>


<?php get_footer(); ?>
