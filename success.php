<link rel="stylesheet" href="style.css" />

<div id="container">
  <div id="success-box">
    <div class="dot"></div>
    <div class="dot two"></div>
    <div class="face">
      <div class="eye"></div>
      <div class="eye right"></div>
      <div class="mouth happy"></div>
    </div>
    <div class="shadow scale"></div>
    <?php
    session_start();
    echo "<div class='message'><h1 class='alert'>Success!</h1><p>".$_SESSION["success"]."</p></div>";
    ?>
    
    <a href="index.php"><button class="button-box"><h1 class="green">continue</h1></button></a>
  </div>
</div>
