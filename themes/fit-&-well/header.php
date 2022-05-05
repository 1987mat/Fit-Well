<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset');?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
  <header class="site-header">
    <div class="container">
      <h1 class="main-title"><a href="<?php echo site_url(); ?>"><strong><h1>Fit&Well</h1></strong></a></h1>
      <nav class="main-navigation">
    
        <!-- <?php 
          wp_nav_menu(array(
            'theme_location' => 'headerMenuLocation'
          )); 
        ?> -->
        <ul>
          <li <?php if(get_post_type() == 'workout') echo 'class="current-menu-item"'?>><a href="<?php echo get_post_type_archive_link('workout'); ?>">Workouts</a></li>
          <li <?php if(get_post_type() == 'nutrition') echo 'class="current-menu-item"'?>><a href="<?php echo get_post_type_archive_link('nutrition'); ?>">Nutrition</a></li>
          <li <?php if(is_page('community')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/community'); ?>">Community</a></li>
          <li <?php if(is_page('contact') or wp_get_post_parent_id(0) == 2) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/contact'); ?>">Contact</a></li>
          <li <?php if(is_page('about') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/about'); ?>">About</a></li?>
          <li <?php if(get_post_type() == 'post') echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/blog'); ?>">Blog</a></li?>
        </ul>
      </nav>
      <div class="header-util">

        <!-- Leave a comment if user is logged in or Log Out  -->
        <?php if(is_user_logged_in()) { ?>
          <span <?php if(is_page('my-comments')) echo 'class="current-menu-item"';?>><a href="<?php echo site_url('/my-comments'); ?>">My Comments</a></span>
          <a href="<?php echo wp_logout_url(); ?>">Log Out</a>

          <!-- Login if user is logged out or Sign up if new user -->
        <?php } else { ?>
          <a href="<?php echo wp_login_url();?>">Login</a>
          <a href="<?php echo wp_registration_url();?>">Signup</a>
         <?php }
        ?>
        <a href="#"><i class="fa fa-search"></i></a>
      </div>
    </div>
  </header>
  
