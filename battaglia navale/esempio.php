<?php

$lunghezzeNavi = array(3, 4, 5); // Lunghezze navi
$dimensioneMatrice = 10; // Dimensione Matrice

$matriceNavi = MiUccidoConLeNavi($lunghezzeNavi, $dimensioneMatrice);
printArr($matriceNavi);




function printArr($map)
{

    $char = "A";
    echo " <div class='bord'>&nbsp</div> ";
    for ($col = 0; $col < 10; $col++) {
        echo "<div class='bord'>" . ($char++) . "</div>";
    }
    for ($row = 0; $row < 10; $row++) {
        echo " <br> <div class='bord'>" . $row . "</div>";
        for ($col = 0; $col < 10; $col++) {

            echo  "<div class='sea'><p href='#' class='name' id='$row$col' method='GET'>" . $map[$row][$col] . "</p></div>";
        }
    }
}
// Stampa la matrice risultante
for ($i = 0; $i < $dimensioneMatrice; $i++) {
    for ($j = 0; $j < $dimensioneMatrice; $j++) {
        echo $matriceNavi[$i][$j] . " ";
    }
    echo "<br>";
}





//************************************************************* */
function MiUccidoConLeNavi($lunghezzeNavi, $dimensioneMatrice)
{
    $matrice = array();
    for ($i = 0; $i < $dimensioneMatrice; $i++) {
        for ($j = 0; $j < $dimensioneMatrice; $j++) {
            $matrice[$i][$j] = 0; 
            // Inizializzazione della  matrice con lo zero
        }
    }

    foreach ($lunghezzeNavi as $lunghezza) {
        $orientamento = rand(0, 1); // 0 se è orizzontale, 1 se è verticale 
        $posizioneValida = false;

        while (!$posizioneValida) {
            if ($orientamento == 0) {
                // Posizionamento orizzontale
                $riga = rand(0, $dimensioneMatrice - 1);
                $colonna = rand(0, $dimensioneMatrice - $lunghezza);

                $posizioneValida = true;
                for ($i = 0; $i < $lunghezza; $i++) {
                    if ($matrice[$riga][$colonna + $i] != 0) {
                        $posizioneValida = false;
                        break;
                    }
                }

                if ($posizioneValida) {
                    for ($i = 0; $i < $lunghezza; $i++) {
                        $matrice[$riga][$colonna + $i] = 1; 
                        // Posizione nave nella matrice
                    }
                }
            } else {
                // Posizionamento verticale
                $riga = rand(0, $dimensioneMatrice - $lunghezza);
                $colonna = rand(0, $dimensioneMatrice - 1);

                $posizioneValida = true;
                for ($i = 0; $i < $lunghezza; $i++) {
                    if ($matrice[$riga + $i][$colonna] != 0) {
                        $posizioneValida = false;
                        break;
                    }
                }

                if ($posizioneValida) {
                    for ($i = 0; $i < $lunghezza; $i++) {
                        $matrice[$riga + $i][$colonna] = 1; 
                        // Posizione nave nella matrice
                    }
                }
            }
        }
    }

    return $matrice;
}
?>