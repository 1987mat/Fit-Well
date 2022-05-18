<?php

get_header();

while(have_posts()) {
  the_post(); ?>

  <div class="page-container">
    <h2><?php the_title();?></h2>
    <div class="metabox">
        <a href="<?php echo get_post_type_archive_link('class'); ?>">Go Back</a>
    </div>

    <div class="generic-content">
      <div class="one-third">
        <?php the_post_thumbnail('medium'); ?>
      </div>

      <div class="two-thirds">
        <?php the_content(); ?>
      </div>
    </div>

    <?php 

      // Get the 'Event' Pod
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
?>
