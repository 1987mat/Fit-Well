<?php get_header(); ?>

<div class="blog-section"> 
  <h1>Our Events</h1>
  <p>Come join us!</p>
  <p><?php the_archive_description(); ?></p>
</div>

<div class="page-container"> 

  <?php while(have_posts()) {
    the_post(); ?>

    <div class="single-event">
      <div class="date-container">
        <p><?php the_time('F j'); ?></p>
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


</div>


<?php get_footer(); ?> 