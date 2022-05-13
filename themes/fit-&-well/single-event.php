<?php

get_header();

while(have_posts()) {
  the_post(); ?>

  <div class="page-container">
    <h2><?php the_title();?></h2>
    <p><?php the_time('F j y'); ?></p>
    <hr>


    <div class="metabox">
        <a href="<?php echo get_post_type_archive_link('event'); ?>">Go Back</a>
    </div>
  
    <div class="generic-content">
      <?php the_content(); ?>
    </div>

    <?php 

      // Get the 'Event' Pod
      $pod = pods( 'event', get_the_id() );
      // Get the related field related_workouts
      $relatedWorkouts = $pod->field( 'related_workouts' );

      // If the array is not empty
      if ( ! empty( $relatedWorkouts ) ) {
        foreach ( $relatedWorkouts as $rel ) {
          // Get the ID 
          $id = $rel[ 'ID' ];

          // Display link with the related post's title
          echo '<a class="related-post" href="'.esc_url( get_permalink( $id ) ).'">'.get_the_title( $id ).'</a>';
        }
      
      }
    
    ?>

  </div>

<?php } 


get_footer();
