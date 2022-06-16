<?php

  // Prevent user to visit the page if not logged in
  if(!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

  get_header();

  while(have_posts()) {
    the_post();
    pageBanner();

  ?>

  <div class="page-container">
    <ul id="my-comments">
      <?php

      $userComments = new WP_Query(array(
        'post_type' => 'comment',
        'posts_per_page' => -1,
        'author' => get_current_user_id()
      ));

      while($userComments->have_posts()) {
        $userComments->the_post(); ?>

        <li data-id="<?php the_ID();?>">
          <div class="comment-top">
            <input readonly value="<?php echo esc_attr(get_the_title()); ?>">
            <button class="edit-comment"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</button>
            <button class="delete-comment"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
         </div>
          <textarea readonly>"<?php echo esc_attr(wp_strip_all_tags(get_the_content())); ?>"</textarea>
          <button class="update-comment"><i class="fa fa-check" aria-hidden="true"></i>Save</button>

        </li>

      <?php }

      ?>


    </ul>
  </div>

  <?php } 

  get_footer();

?>

