<?php get_header(); ?>

<div class="blog-section"> 
  <h1>Welcome to our blog</h1>
  <p>Keep up with the latest news</p>
</div>

<div class="page-container"> 

  <?php while(have_posts()) {
    the_post(); ?>

    <div class="single-post">

      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="metabox">
        <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.d.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
      </div>

      <div class="generic-content">
        <p><?php the_excerpt(); ?></p>
        <p><a href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
      </div>

    </div>

  <?php }
  
  echo paginate_links();

  ?> 


</div>


<?php get_footer(); ?> 