<?php # index.php

# Connect to DB
require_once ('../../dbconnect/mysqli_connect_myboyissick.php');

# Grid generation query
$q_grid = "SELECT myboy, papa, mama FROM sick WHERE date <= CURDATE()";
$r_grid = @mysqli_query ($dbc, $q_grid);

# Full stats query
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
            FROM sick
            WHERE date <= CURDATE()";
$r_stats = @mysqli_query ($dbc, $q_stats);

# Abbreviated 30-day stats query
$q_stats_30d = "SELECT 
                    AVG(myboy) as avg_30d
                FROM sick 
                WHERE date BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()";
$r_stats_30d = @mysqli_query ($dbc, $q_stats_30d);

?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:title" content="My boy is sick." />
    <meta property="og:url" content="http://myboyissick.com" />
    <meta property="og:image" content="http://myboyissick.com/resources/images/og-image.jpg" />

    <link href='./resources/css/reset.css' rel='stylesheet'>
    <link href='./resources/css/style.css' rel='stylesheet'>
    <script type="text/javascript" src="./resources/js/scripts.js"></script>
    
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W0GFKV396E"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-W0GFKV396E');
    </script>

    <title>He's sick!</title>
  </head>

  <body>
    <div id="wrapper">

      <div id="header">
      <?php
        $stats_30d = mysqli_fetch_array($r_stats_30d, MYSQLI_ASSOC);
        
        if ($stats_30d > .5) {
            $headline = "My boy is sick.";
        } elseif ($stats_30d > .2) {
            $headline = "<strike>My boy is sick.</strike>Lately my boy is moderately sick.";
        } else {
            $headline = "<strike>My boy is sick.</strike>Lately my boy is not so sick.";
        }

        echo "<p>My boy started school.<br>\n";
        echo $headline . "<br>\n";
        echo "How sick?</p>\n";
      ?>
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
            echo "</div>\n";
        }

      ?>
      </div>


      <div id="stats">
      <?php
        $stats = mysqli_fetch_array($r_stats, MYSQLI_ASSOC);

        echo "<div></div>\n";
        echo "<div class=\"bold tooltip\">Record<span class=\"tooltiptext\">Days Sick (S) - Days Not Sick (NS)</span></div>\n";
        echo "<div class=\"bold tooltip\">.SAVG<span class=\"tooltiptext\">S / (S + NS)</span></div>\n";
        echo "<div class=\"bold tooltip\">S/NS Ratio<span class=\"tooltiptext\">S / NS</span></div>\n";

        echo "<div class=\"bold\">My boy</div>\n";
        echo "<div>" . $stats['s_b'] . "-" . $stats['w_b'] . "</div>\n";
        echo "<div>" . $stats['savg_b'] . "</div>\n";
        echo "<div>" . $stats['sw_b'] . "</div>\n";

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
