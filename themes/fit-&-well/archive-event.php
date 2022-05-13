<?php get_header(); ?>

<div class="blog-section"> 
  <h1>Upcoming Events</h1>
  <p>Come join us!</p>
  <p><?php the_archive_description(); ?></p>
</div>

<div class="page-container"> 

  <?php 
  
  $today = date('Y-m-d');
  $events = new WP_Query(array(
    'posts_per_page' => 2,
    'post_type' => 'event',
    'orderby' => 'post_date',
    'order' => 'ASC',
    // Don't show past events
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    )
  ));

  while($events->have_posts()) {
    $events->the_post(); ?>

    <div class="single-event">
      <div class="date-container">
        <!-- Show date from Pods custom field -->
        <p><?php echo get_post_meta( get_the_ID(), 'event_date', true );?></p>
      </div>
      <div class="event-info">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="generic-content">
          <p><?php the_excerpt(); ?></p>
          <p><a href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
        </div>
      </div>
    </div>

  <?php }
  
  echo paginate_links();

  ?> 

  <hr>

  <p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events');?>">Check out our past events!</a></p>


</div>


<?php get_footer(); ?> 