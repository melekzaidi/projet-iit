<link rel="stylesheet" href="style.css" />

<div id="container">
  
  <div id="error-box">
    <div class="dot"></div>
    <div class="dot two"></div>
    <div class="face2">
      <div class="eye"></div>
      <div class="eye right"></div>
      <div class="mouth sad"></div>
    </div>
    <div class="shadow move"></div>
    <?php
    session_start();
 echo'   <div class="message"><h1 class="alert">Error!</h1><p>'.$_SESSION["error"].'.</div>';

    ?>
  </div>
</div>

<footer>
  <p>made by <a href="https://codepen.io/juliepark"> julie</a> ♡
</footer>