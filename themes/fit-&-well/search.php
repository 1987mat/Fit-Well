<?php get_header(); ?>

<div class="blog-section"> 
  <?php 
    pageBanner(array(
      'title' => 'Search Results',
      'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;'
    ));
  ?>
</div>

<div class="page-container">

  <?php while(have_posts()) {
    the_post(); 
    get_template_part('content', get_post_type());   
  }
  echo paginate_links();
  ?> 
</div>

<?php get_footer(); ?> 