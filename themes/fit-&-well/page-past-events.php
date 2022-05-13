<?php get_header(); ?>

<div class="blog-section"> 
  <h1>Past Events</h1>
  <p>A recap of our past events.</p>
  <p><?php the_archive_description(); ?></p>
</div>

<div class="page-container"> 

  <?php 
    
  $today = date('Y-m-d');
  $pastEvents = new WP_Query(array(
    // Pagination
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'orderby' => 'post_date',
    'order' => 'ASC',
    // Don't show past events
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '<',
        'value' => $today,
        'type' => 'numeric'
      )
    )
  ));

  while($pastEvents->have_posts()) {
    $pastEvents->the_post(); ?>

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
  
  echo paginate_links(array(
    'total' => $pastEvents->max_num_pages
  ));

  ?> 

  <a href="<?php echo get_post_type_archive_link('event');?>">Go Back</a>

</div>


<?php get_footer(); ?> 