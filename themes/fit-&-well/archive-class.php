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
    $classTitle = lcfirst(get_the_title());
      
    ?>
    <div class="class-wrapper">
      <a href="<?php the_permalink();?>"><h3><?php the_title(); ?></h3></a>
      <div class="single-class <?php echo $classTitle; ?>">
    </div>  
      
    </div>

  <?php }
  ?>
</div>



<?php get_footer(); ?>
