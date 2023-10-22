<?php 
//importiamo la sessione della mappa al gioco
session_start();
$map = $_SESSION['maps'];
$boats = [
      "cacciatorpediniere" => ["CC", "CC", "CC"],
      "incrociatori" => ["TT", "TT", "TT", "TT"],
      "portaaerei" => ["PP", "PP", "PP", "PP", "PP"],
      "sommergibile" => ["SS", "SS"]
];
// creiamo una pagina html dove applicare le funzioni create
?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link href="css/style.css" rel="stylesheet">
</head>

<body>
      <div class="containerNew">
            <div class="mappa">
                  <h1> Battaglia Navale</h1>
                  <h2>Esercizio in PHP su "Session"</h2>
                  <?php //inserisco la mappa di gioco importata
                   printArr($map); ?>
            </div>
            <div class="caption">

                  <p class="boat">Cacciatorpediniere <?php echo count($boats["cacciatorpediniere"]); // rendo dinamico la lunghezza della barca ?>
                        <img src="img/Cacciatorpediniere-transformed.png" class="boatIm" alt="Mia Immagine">
                  </p>
                  <p class="boat">Incrociatore <?php echo count($boats["incrociatori"]); ?>
                        <img src="img/incrociatore-transformed.png" class="boatIm" alt="Mia Immagine">
                  </p>
                  <p class="boat">Portaerei <?php echo count($boats["portaaerei"]); ?>
                        <img src="img/Portaerei-transformed.png" class="boatIm" alt="Mia Immagine">
                  </p>
                  <p class="boat">Sommergibile <?php echo count($boats["sommergibile"]); ?>
                        <img src="img/Sommergibile-transformed.png" class="boatIm" alt="Mia Immagine">
                  </p>
                  <?php
                  // controllo se e in che casella avviene il "colpo"
                  if (isset($_GET['riga']) && isset($_GET['col'])) {

                        $row = $_GET['riga'];
                        $col = $_GET['col'];
                        // salvo il colpo in una sessione
                        $_SESSION['last_shot_row'] = $row;
                        $_SESSION['last_shot_col'] = $col;

                        if ($map[$row][$col] != 0) {

                              if ($map[$row][$col] == 'X') {
                                    echo " <div class='stampa'> Hai già colpito questa parte di nave </div>";
                                    echo " <div class='stampa'> Ultimo colpo riga: " . $_SESSION['last_shot_row'] . " col: " .
                                          $_SESSION['last_shot_col'] = $col . "</div>";
                              } else if ($map[$row][$col] != 'X') {
                                    echo "<div class='stampa'> Hai colpito una nave </div>";
                                    echo " <div class='stampa'> Ultimo colpo riga: " . $_SESSION['last_shot_row'] . " col: " .
                                          $_SESSION['last_shot_col'] = $col . "</div>";
                                    $map[$row][$col] = 'X';
                              }
                        } else {
                              echo "<div class='acqua'><p> Hai colpito l'acqua </p></div>";
                              echo " <div class='stampa'> Ultimo colpo riga: " . $_SESSION['last_shot_row'] . "col: " .
                                    $_SESSION['last_shot_col'] = $col . "</div>";
                        }
                        $_SESSION['maps'] = $map;
                  }
                  ?>
            </div>

      </div>
      <!-- funzione javascript per posizionare il onclick sulle caselle della mappa -->
      <script>
            function changeDisplay(row, col) {
                  const elementId = `name${row}${col}`;
                  document.querySelector(`.${elementId}`).style.visibility = "visible";
            }
      </script>

</body>

</html>

<?php
// funzione per mandare a scermo la mappa di gioco
function printArr($map)
{
      $char = "A";
      for ($col = 0; $col < 10; $col++) {
            echo "<div class='bord'>" . ($char++) . "</div>";
      }
      for ($row = 0; $row < 10; $row++) {
            echo " <br> <div class='bord'>" . $row . "</div>";
            for ($col = 0; $col < 10; $col++) {
                  echo  "<div onclick='changeDisplay($row,$col)' class='sea'><form method='GET'>
                              <input type='hidden id='riga' name='riga' value='$row'>
                              <input type='hidden' id='col' name='col' value='$col'>
                        <input type='submit' value=" . $map[$row][$col] . " class='name$row$col button' id='$row$col' method='GET'></form></div>";
            }
      }
}
?>