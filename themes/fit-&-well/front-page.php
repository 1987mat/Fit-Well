
<?php get_header(); ?>

<main class="main-body-content">

  <section class="heading-section">
      <div class="heading">
          <h2 class="main-title">Welcome!</h2>
          <h3 class="main-subtitle">Ready to get in shape?</h3>
      </div>
  </section>

  <section class="show-posts">
    <div class="workout-posts">
        <h2>Workout Plans</h2>
        <hr>
        <?php 
          // Create custom query for Workout posts
          $homepageWorkouts = new WP_Query(array(
            'post_type' => 'workout',
            'post_per_page' => 3,
            'order' => 'ASC'
          ));

          // Show workout posts in the front page
          while($homepageWorkouts->have_posts()) {
            $homepageWorkouts->the_post(); ?>
            <li <?php echo 'class="post-title-style"';?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <p <?php echo 'class="post-text"';?>><?php echo wp_trim_words(get_the_content(), 30); ?></p>
          <?php } 
        ?>
    </div>

    <div class="nutrition-posts">
      <h2>Nutrition & Diets</h2>
      <hr>
      <?php 
          // Create custom query for Nutrition posts
          $homepageNutrition = new WP_Query(array(
            'post_type' => 'nutrition',
            'post_per_page' => 3,
            'order' => 'ASC'
          ));

          // Show nutrition posts in the front page
          while($homepageNutrition->have_posts()) {
            $homepageNutrition->the_post(); ?>
            <li <?php echo 'class="post-title-style"';?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <p <?php echo 'class="post-text"';?>><?php echo wp_trim_words(get_the_content(), 30); ?></p>
          <?php } 
        ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>