<?php 
  get_header();
?>

<div class="posts-container">

  <?php 
  
  pageBanner(array(
    'title' => 'Classes',
    'subtitle' => 'Choose the class!'
  ));

  $classes = new WP_Query(array(
    'post_type' => 'class',
    'post_per_page' => -1,
    'order' => 'ASC'
  ));

  while($classes->have_posts()) {
    $classes->the_post(); 

    $sub = get_post_meta($post->ID, 'subtitle', TRUE);
    echo $sub;
  
    ?>


    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <p><?php the_content();?></p>

  <?php }
  ?>
</div>



<?php get_footer(); ?>
