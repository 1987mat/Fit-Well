<?php

get_header();

while(have_posts()) {
  the_post(); ?>

  <div class="page-container">
    <?php pageBanner(); ?>

    <div class="metabox">
        <a href="<?php echo get_post_type_archive_link('class'); ?>">Go Back</a>
    </div>

    <div class="generic-content">
      <div class="one-third">
        <?php the_post_thumbnail(); ?>
      </div>
    </div>
    <hr>
    <?php 

      // Get the 'Class' Pod
      $pod = pods( 'class', get_the_id() );
      // Get the related field related_workouts
      $relatedWorkouts = $pod->field( 'related_workouts' );

      // If the array is not empty
      if ( ! empty( $relatedWorkouts ) ) {

        echo '<h2>Related Workouts</h2>';
        echo '<ul class="link-list">';
        foreach ( $relatedWorkouts as $rel ) {
          // Get the ID 
          $id = $rel[ 'ID' ];
          // Display link with the related workout post based on the id
          ?>  
          <li>
            <a class="related-post" href="<?php echo get_permalink( $id ) ?>">
              <div class="related-post-container">
                <img class="post-image" src="<?php echo get_the_post_thumbnail_url($id);?>">
                <div class="text-overlay">
                  <h3 class="post-title"><?php echo get_the_title($id) ;?></h3>
                </div>
              </div>    
            </a>
          </li>
        <?php 
        }
        echo '</ul>';
      }
    ?>
  </div>
<?php }
get_footer();
?>