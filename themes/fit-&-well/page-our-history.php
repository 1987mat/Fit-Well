<?php
  get_header(); 

?>

<div class="page-container">

  <?php

    while(have_posts()) {
      the_post(); 
      pageBanner(); 


      $theParent = wp_get_post_parent_id(get_the_ID());
      // If the current page has a parent page show the navigation link
        if($theParent) {
          ?> 
          <div class="metabox">
            <span>Back To <a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent);?></a></span>
          </div>
          <?php
        } 
      ?>

      <div class="about-container">

          <img src="<?php echo get_the_post_thumbnail_url();?>" class="about-image">
        
          <div class="generic-content">
              <p><?php the_content();?></p>
          </div>


          <?php 
            $testArray = get_pages(array(
              'child_of' => get_the_ID()
            ));

            // Show side menu only if the page is a parent or child page
            if($theParent or $testArray) { ?>
              <div class="page-list">
                <h2><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent);?></a></h2>
                <ul class="list">
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
              </div> 
          <?php
            }
          ?>
        </div>
      <?php
    } 
  ?>
</div>

<?php
  get_footer();
?>



