<?php

get_header();

?>

<div>
  <div class="form-container">
    <h1>Get in touch!</h1>
    <form class="contact-form">
      <input type="text" placeholder="First Name" required>
      <input type="text" placeholder="Last Name" required>
      <input type="email" placeholder="Email" required>
      <textarea maxlength="30" placeholder="Your comments here..." required>
      </textarea>
      <button class="submit-btn" type="submit">SUBMIT</button>
    </form>
  </div>

  <!-- MAP -->
  <?php
    $mymap = new Mappress_Map(array("width" => 600));
    $mypoi = new Mappress_Poi(array("title" => "500 Chestnut St", "body" => "Independence National Park, Philadelphia, PA<br/>19106", "point" => array("lat" => 39.948712,"lng" => -75.15001)));
    $mymap->pois = array($mypoi); 
    echo $mymap->display();
  ?>
</div>

<?php

get_footer();

?>




