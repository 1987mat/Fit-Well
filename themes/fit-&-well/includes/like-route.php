<?php

add_action('rest_api_init', 'likeRoutes');

function likeRoutes() {
  register_rest_route('fitness/v1', 'manageLike', array(
    'methods' => 'POST',
    'callback' => 'createLike'
  ));

  register_rest_route('fitness/v1', 'manageLike', array(
    'methods' => 'DELETE',
    'callback' => 'deleteLike'
  ));

  function createLike($data) {
    $event = sanitize_text_field($data['eventID']);

    wp_insert_post(array(
      'post_type' => 'like',
      'post_status' => 'publish',
      'post_title' => '2nd PHP Test',
      'meta_input' => array(
        'liked_event_id' => $event
      )
    ));
  }

  function deleteLike() {
    return 'thanks for deleting a like';
  }
}