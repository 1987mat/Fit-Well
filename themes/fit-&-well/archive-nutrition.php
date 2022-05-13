<?php 

/* Template Name: Custom Archive Page Nutrition */

  get_header();
?>

<div class="posts-container">
  <h1>Nutrition</h1>
  <ul>

  <?php 

  $nutrition = new WP_Query(array(
    'post_type' => 'nutrition',
    'post_per_page' => 3,
    'order' => 'ASC'
  ));

  while($nutrition->have_posts()) {
    $nutrition->the_post(); ?>

    <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
    <p><?php the_content();?></p>

  <?php }
  ?>

  </ul>
</div>


<?php get_footer(); ?>
