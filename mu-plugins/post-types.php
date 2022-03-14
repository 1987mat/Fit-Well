<?php

// Register new post type workouts
function post_types() {
  register_post_type('workout', array(
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Workouts',
      'add_new_item' => 'Add New Workout',
      'edit_item' => 'Edit Workout',
      'all_items' => 'All Workouts',
      'singular_name' => 'Workout'
    ),
    'menu_icon' => 'dashicons-calendar-alt'
  ));

  // Register new post type nutrition
    register_post_type('nutrition', array(
      'has_archive' => true,
      'public' => true,
      'labels' => array(
        'name' => 'Nutrition',
        'add_new_item' => 'Add New Nutrition',
        'edit_item' => 'Edit Nutrition',
        'all_items' => 'All Nutritions',
        'singular_name' => 'Nutrition'
      ),
      'menu_icon' => 'dashicons-carrot'
    ));

    // Register new post type note
    register_post_type('note', array(
      'show_in_rest' => true,
      'support' => array('title', 'editor'),
      'public' => false,
      'labels' => array(
        'name' => 'Notes',
        'add_new_item' => 'Add New note',
        'edit_item' => 'Edit note',
        'all_items' => 'All notes',
        'singular_name' => 'note'
      ),
      'menu_icon' => 'dashicons-edit'
    ));
}

add_action('init', 'post_types');