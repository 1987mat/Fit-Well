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

    <div class="create-comment">
    <span class="message"></span>
      <h2>Add New Comment</h2>
      <input class="comment-title" placeholder="Title">
      <textarea class="comment-body" rows="6"
      placeholder="Your comment here..."></textarea>
      <input type="submit" class="submit-comment-btn">
    </div>


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
            <input class="comment-input-field" readonly value="<?php echo esc_attr(get_the_title()); ?>">
            <button class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</button>
            <button class="delete-btn"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
         </div>
          <textarea class="comment-body-field" readonly>"<?php echo esc_attr(wp_strip_all_tags(get_the_content())); ?>"</textarea>
          <button class="update-btn"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
        </li>

      <?php }

      ?>


    </ul>
  </div>

  <?php } 

  get_footer();

?>

