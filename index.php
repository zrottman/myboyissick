<?php # index.php

# Connect to DB
require_once ('../../dbconnect/mysqli_connect_myboyissick.php');

# Grid generation query
$q_grid = "SELECT myboy, papa, mama FROM sick";
$r_grid = @mysqli_query ($dbc, $q_grid);

# Stats query
$q_stats = "SELECT
                SUM(myboy) AS s_b,
                COUNT(*) - SUM(myboy) AS w_b,
                AVG(myboy) AS savg_b,
                SUM(myboy) / (COUNT(*) - SUM(myboy)) AS sw_b,

                SUM(papa) AS s_p,
                COUNT(*) - SUM(papa) AS w_p,
                AVG(papa) AS savg_p,
                SUM(papa) / (COUNT(*) - SUM(papa)) AS sw_p,

                SUM(mama) AS s_m,
                COUNT(*) - SUM(mama) AS w_m,
                AVG(mama) AS savg_m,
                SUM(mama) / (COUNT(*) - SUM(mama)) AS sw_m
            FROM sick";
$r_stats = @mysqli_query ($dbc, $q_stats);

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
    <title>He's sick!</title>
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


      <div id="grid">
      <?php

        while ($row = mysqli_fetch_array($r_grid, MYSQLI_ASSOC)) {
            echo '<div class="day">';
                if($row['myboy']) {echo '<div class="sickBoy"></div>';}
                if($row['papa']) {echo '<div class="sickPapa"></div>';}
                if($row['mama']) {echo '<div class="sickMama"></div>';}
            echo '</div>';
        }

      ?>
      </div>


      <div id="stats">
      <?php
        $stats = mysqli_fetch_array($r_stats, MYSQLI_ASSOC);

        echo '<div></div>';
        echo '<div class="bold tooltip">Record (S-NS)<span class="tooltiptext">S: days sick<br>NS: days not sick</span></div>';
        echo '<div class="bold tooltip">.SAVG<span class="tooltiptext">S / (S + NS)</span></div>';
        echo '<div class="bold tooltip">S/NS Ratio<span class="tooltiptext">S / NS</span></div>';

        echo '<div class="bold">My boy</div>';
        echo '<div>' . $stats['s_b'] . '-' . $stats['w_b'] . '</div>';
        echo '<div>' . $stats['savg_b'] . '</div>';
        echo '<div>' . $stats['sw_b'] . '</div>';

        echo '<div class="bold">Papa</div>';
        echo '<div>' . $stats['s_p'] . '-' . $stats['w_p'] . '</div>';
        echo '<div>' . $stats['savg_p'] . '</div>';
        echo '<div>' . $stats['sw_p'] . '</div>';

        echo '<div class="bold">Mama</div>';
        echo '<div>' . $stats['s_m'] . '-' . $stats['w_m'] . '</div>';
        echo '<div>' . $stats['savg_m'] . '</div>';
        echo '<div>' . $stats['sw_m'] . '</div>';

      ?>
      </div>
      
      <?php
        mysqli_close($dbc);
      ?>

    </div>
  </body>
</html>
