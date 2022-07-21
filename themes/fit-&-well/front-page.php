
<?php get_header(); ?>

<main class="main-body-content">

  <section class="heading-section">
      <a href="#classes">
        <div class="heading">
          <h1>Welcome!</h1>
          <h4>Ready to get in shape?</h4>
        </div>
     </a>
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
            <h4><?php the_title(); ?></h4> 
            </a>

          <?php } 
          wp_reset_postdata();
          ?>
    </div>
  </section>

  <section class="homepage-workouts">
    <h2>Workout Plans</h2>
    <div class="workouts-container">
      <p>replace text</p>
      <?php
        $img_src = get_template_directory_uri() . '/images/workout-homepage.jpg';
      ?>
      <div class="workout-image-container">
        <img src="<?php echo $img_src ?>">
      </div>
    </div>
  </section>

  <section class="homepage-events"> 
    <div class="events-heading">
      <a href="<?php echo get_post_type_archive_link('event'); ?>">Events & More</a>
    </div>
  </section>

  <section class="homepage-feeds"> 
    <h2>Follow Us!</h2>
    <div class="social-media-container">
      <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-official"></i></a>
      <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
      <a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
      <a href="https://pinterest.com" target="_blank"><i class="fa fa-pinterest"></i></a>
    </div>
    <div class="feed-container">

      <?php 

        $src1 = get_template_directory_uri() . '/images/feed1.jpg';
        $src2 = get_template_directory_uri() . '/images/feed2.jpg';
        $src3 = get_template_directory_uri() . '/images/feed3.jpg';

        $images = array($src1, $src2, $src3);
        
        for ($x = 0; $x < count($images); $x++) {
        ?>

            <img src="<?php echo $images[$x];?>">

        <?php 
        }
      ?>

    </div>
  </section>
</main>

<?php get_footer(); ?>


