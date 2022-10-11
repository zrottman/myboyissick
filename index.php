<?php # index.php

# Connect to DB
require_once ('../../dbconnect/mysqli_connect_myboyissick.php');

$q = "SELECT myboy, papa, mama FROM sick";
$r = @mysqli_query ($dbc, $q);

?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='./resources/css/reset.css' rel='stylesheet'>
    <link href='./resources/css/style.css' rel='stylesheet'>
    <script>
      function toggle (buttonID, boxClass) {
          const button = document.querySelector(buttonID);
          const boxes = document.querySelectorAll(boxClass);

          button.style.opacity = button.style.opacity ==  .5 ? 1 : .5;

          boxes.forEach(box => {
            box.style.display = box.style.display == 'none' ? 'block' : 'none';
          });
      }
    </script>
  </head>

  <body>
    <div id="wrapper">

      <div id="header">
        <p>My boy started school.<br>
        My boy is sick.<br>
        How sick?</p>
      </div>

      <div id="filters">
        <div id="boyButton" class="button" onclick="toggle('#boyButton', '.sickBoy');">My boy</div>
        <div id="papaButton" class="button" onclick="toggle('#papaButton', '.sickPapa');">Papa</div>
        <div id="mamaButton" class="button" onclick="toggle('#mamaButton', '.sickMama');">Mama</div>
      </div>

      <div id="stats">
        <span>S: 17</span>
        <span>W: 33</span>
        <span>.SAVG: .340</span>
        <span>S/W Ratio: .510</span>
        <span>Last 10: 2-8</span>
      </div>

      <div id="grid">
      <?php
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo '<div class="day">';
                if($row['myboy']) {echo '<div class="sickBoy"></div>';}
                if($row['papa']) {echo '<div class="sickPapa"></div>';}
                if($row['mama']) {echo '<div class="sickMama"></div>';}
            echo '</div>';
        }

        mysqli_close($dbc);
      ?>
      <!--
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
            <div class="sickBoy"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
          </div>

          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>

          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>      

          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
            <div class="sickBoy"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
          </div>

          <div class="day">
            <div class="sickBoy"></div>
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
            <div class="sickBoy"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
            <div class="sickPapa"></div>
          </div>

          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
            <div class="sickMama"></div>
          </div>

          <div class="day">
            <div class="sickMama"></div>
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
            <div class="sickBoy"></div>
          </div>

          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickBoy"></div>
            <div class="sickMama"></div>
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickPapa"></div>
          </div>

          <div class="day">
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickPapa"></div>
          </div>
          <div class="day">
            <div class="sickPapa"></div>
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          <div class="day">
          </div>
          -->
      </div>

    </div>
  </body>
</html>
