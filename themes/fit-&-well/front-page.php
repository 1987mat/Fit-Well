
<?php get_header(); ?>

<main class="main-body-content">

  <section class="heading-section">
      <a href="#classes">
        <div class="heading">
          <h2 class="main-title">Welcome!</h2>
          <h3 class="main-subtitle">Ready to get in shape?</h3>
        </div>
     </a>
  </section>

  <section class="homepage-classes" id="classes">
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
            <a class="single-class <?php echo $classTitle; ?>" href="<?php echo get_post_type_archive_link('class'); ?>">              
              <h3><?php the_title(); ?></h3> 
            </a>

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

  <section class="homepage-workouts">
    <h2>Workout Plans</h2>
    <div class="workouts-container">
      <p>lorem ipsum</p>
      <div class="workouts-heading">
        <?php
          $img_src = get_template_directory_uri() . '/images/outdoor.jpg';
        ?>
        <div class="workout-image-container">
          <img src="<?php echo $img_src ?>">
          <a href="<?php echo site_url('/workout'); ?>">View More</a>
        </div>
      </div>
    </div>
  </section>

  <section class="homepage-events"> 
    <div class="events-heading">
      <a href="<?php echo get_post_type_archive_link('event'); ?>">Events & More</a>
    </div>
  </section>

</main>

<?php get_footer(); ?>