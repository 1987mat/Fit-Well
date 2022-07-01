<?php

get_header();

while(have_posts()) {
  the_post(); 
  ?>
  <div class="page-container">
  <?php
    pageBanner();
  ?>

    <p><?php the_time('F j y'); ?></p>
    <hr>
    <div class="metabox">
        <a href="<?php echo get_post_type_archive_link('event'); ?>">Go Back</a>
    </div>
  
    <div class="generic-content">
      <?php the_content(); 

        // Create the query object for the like count
        $likeCount = new WP_Query(array(
          'post_type' => 'like',
          'meta_query' => array(
            array(
              'key' => 'liked_event_id',
              'compare' => '=',
              'value' => get_the_ID()
            )
          )
        ));

        $existStatus = 'no';

        $existQuery = new WP_Query(array(
          'author' => get_current_user_id(),
          'post_type' => 'like',
          'meta_query' => array(
            array(
              'key' => 'liked_event_id',
              'compare' => '=',
              'value' => get_the_ID()
            )
          )
        ));

        if($existQuery->found_posts) {
          $existStatus = 'yes';
        }

      ?>

      <span class="like-box" data-exist="<?php echo $existStatus; ?>">
        <i class="fa fa-heart-o" aria-hidden="true"></i>
        <i class="fa fa-heart" aria-hidden="true"></i>
        <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
      </span>
    </div>

    <?php 

      // Get the 'Event' Pod
      $pod = pods( 'event', get_the_id() );
      // Get the related field related_workouts
      $relatedWorkouts = $pod->field( 'related_workouts' );

      // If the array is not empty
      if ( ! empty( $relatedWorkouts ) ) {

        echo '<h2>Related Workouts</h2>';
        echo '<ul class="link-list">';
        foreach ( $relatedWorkouts as $rel ) {
          // Get the ID 
          $id = $rel[ 'ID' ];

          // Display link with the related post's title
          echo '<li>
                  <a class="related-post" href="'.esc_url( get_permalink( $id ) ).'">'.get_the_title( $id ).'</a>
                </li>';
        }
        echo '</ul>';

      
      }
    
    ?>
  </div>

<?php } 


get_footer();
