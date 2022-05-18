
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
          // Create custom query for Class posts
          $homepageClasses = new WP_Query(array(
            'post_per_page' => -1,
            'post_type' => 'class',
            'orderby' => 'title',
            'order' => 'ASC'
          ));

          // Show class posts in the front page
          while($homepageClasses->have_posts()) {
            $homepageClasses->the_post(); 
            $classTitle = lcfirst(get_the_title());
            ?>

            <!-- Have different classes based on post title -->
            <div class="single-class <?php echo $classTitle; ?>">
              <h3><?php the_title(); ?></h3>
            </div>  

          <?php } 
          wp_reset_postdata();
          ?>
    </div>
  </section>

  <section class="history-section">
    <h2>Our History</h2>
    <div class="our-history">
      <?php
        $img_src = get_template_directory_uri() . '/images/history-img.jpg';
      ?>
      <img src="<?php echo $img_src ?>">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
  </section>

  <section class="homepage-events"> 
    <div class="events-container">
      <a href="<?php echo get_post_type_archive_link('event'); ?>">Events & More</a>
    </div>
  </section>

</main>

<?php get_footer(); ?>