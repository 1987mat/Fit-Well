
<?php get_header(); ?>

<main class="main-body-content">

  <section class="heading-section">
      <div class="heading">
          <h2 class="main-title">Welcome!</h2>
          <h3 class="main-subtitle">Ready to get in shape?</h3>
      </div>
  </section>

  <section class="homepage-classes">
    <h2>Our Classes</h2>
    <div class="classes-container">
      <?php 
          // Create custom query for Nutrition posts
          $homepageClasses = new WP_Query(array(
            'post_type' => 'class',
          ));

          // Show event posts in the front page
          while($homepageClasses->have_posts()) {
            $homepageClasses->the_post(); 
            if(get_the_title() === 'Yoga') {
              ?> 
              <div class="single-class yoga">
                <h3><?php the_title(); ?></h3>
              </div>
            <?php 
            } else if (get_the_title() == 'Zumba') {
              ?>
                <div class="single-class zumba">
                  <h3><?php the_title(); ?></h3>
                </div>
              <?php 
            } else if (get_the_title() == 'Outdoor'){
            ?> 
            <div class="single-class outdoor">
              <h3><?php the_title(); ?></h3>
            </div>
            <?php 
            } else {
              ?> 
              <div class="single-class cycling">
                <h3><?php the_title(); ?></h3>
              </div>
            <?php 
            }
          } 
          wp_reset_postdata();
        ?>
    </div>
  </section>

  <section class="our-history">
    <?php
      $img_src = get_template_directory_uri() . '/images/history.jpg';
    ?>
    <img src="<?php echo $img_src ?>">
    <p>Text here</p>
  </section>

  <section class="show-posts">
    <div class="workout-posts">
        <h2>Workout Plans</h2>
        <hr>
        <?php 
          // Create custom query for Workout posts
          $homepageWorkouts = new WP_Query(array(
            'post_type' => 'workout',
            'post_per_page' => 2,
            'order' => 'ASC'
          ));

          // Show workout posts in the front page
          while($homepageWorkouts->have_posts()) {
            $homepageWorkouts->the_post(); ?>
            <li <?php echo 'class="post-title-style"';?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <p <?php echo 'class="post-text"';?>><?php echo wp_trim_words(get_the_content(), 30); ?><a href="<?php the_permalink(); ?>">Read More</p>
          <?php } 
        ?>
       <a href="<?php echo site_url('/workout'); ?>"> <button>View Workouts</button></a>
    </div>

    <div class="nutrition-posts">
      <h2>Nutrition & Diets</h2>
      <hr>
      <?php 
          // Create custom query for Nutrition posts
          $homepageNutrition = new WP_Query(array(
            'post_type' => 'nutrition',
            'post_per_page' => 4,
            'order' => 'ASC'
          ));

          // Show nutrition posts in the front page
          while($homepageNutrition->have_posts()) {
            $homepageNutrition->the_post(); ?>
            <li <?php echo 'class="post-title-style"';?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <p <?php echo 'class="post-text"';?>><?php echo wp_trim_words(get_the_content(), 30); ?><a href="<?php the_permalink(); ?>">Read More</p>
          <?php } wp_reset_postdata();
        ?>
       <a href="<?php echo site_url('/nutrition'); ?>"> <button>View All Diets</button></a>

    </div>
  </section>

  <section class="homepage-events"> 
    <div class="events-container">
      <a href="<?php echo site_url('/events'); ?>">Events & More</a>
    </div>
  </section>

</main>

<?php get_footer(); ?>