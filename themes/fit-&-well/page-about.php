<?php
  get_header(); 
?>

<div class="page-container-about"> 

  <?php
    while(have_posts()) {
      the_post(); 
      pageBanner();

      $testArray = get_pages(array(
        'child_of' => get_the_ID()
      ));

      // Show side menu only if the page is a parent or child page
      if($theParent or $testArray) {    
      ?>
        <ul class="link-list">
          <?php 
            // Current page is a child
            if($theParent) {
              $findChildrenOf = $theParent;

              // Current page is a parent
            } else {
              $findChildrenOf = get_the_ID();
            }

            // Associative array
            wp_list_pages(array(
              'title_li' => NULL,
              'child_of' => $findChildrenOf,
              'sort_column' => 'menu_order'
            ));  
          ?>
        </ul>
      <?php
      }
    }  

    $theParent = wp_get_post_parent_id(get_the_ID());
    // If the current page has a parent page show the navigation link
      if($theParent) {
        ?> 
        <div class="metabox">
          <a href="<?php echo get_permalink($theParent); ?>">Go Back To <?php echo get_the_title($theParent);?></a>
          <p><?php the_title(); ?>
        </div>
      <?php
      } 
    ?>

    <div class="about-container">
      <div class="generic-content">
          <p><?php the_content();?></p>
      </div>
      <img src="<?php echo get_the_post_thumbnail_url();?>" class="about-image">
    </div>
</div>

<?php
  get_footer();
?>