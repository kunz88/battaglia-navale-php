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
    <div class="container">
        <h1>Soluzioni Battaglia Navale PHP</h1>
        <?php
        session_start();
        // creo un array di barche
        $boats = [
            "cacciatorpediniere" => ["CC", "CC", "CC", "CC", "CC"],
            "incrociatori" => ["TT", "TT", "TT", "TT", "TT"],
            "portaaerei" => ["PP", "PP", "PP", "PP", "PP"],
            "sommergibile" => ["SS", "SS", "SS", "SS", "SS"]
        ];
        // creo la mappa di gioco utiliazzando la funzione createARR()
        $map = createArr();

        // creo una nuova sessione dove inserisco la mappa implementata dopo l'inserimento di una barca attraverso la funzione posShip()
        $map = posShip($map, $boats);
        $_SESSION['maps'] = $map;
        // mando a schermo la sessione con la mappa
        printArr($_SESSION['maps']);
        // ****************** Sotto trovi tutte le funzioni ******************


        // funzione per creare la mappa 10x10 come matrice ovvero array multidimensionale
        function createArr()
        {
            for ($row = 0; $row < 10; $row++) {

                for ($col = 0; $col < 10; $col++) {
                    $map[$row][$col] = 0;
                }
            }
            return $map;
        }

        // funzione per posizionare le barche in maniera randomica
        function posShip($map, $boats)
        {
            // rendo casuale il posizionamento randomizzando colonne righe e direzione

            foreach ($boats as $boat) {

                $row = rand(0, 9); // righe
                $col = rand(0, 9); // colonne
                $direction = rand(0, 1);; //direzione
                $count = 0; // contatore
                $posizioneValida = true;


                if ($direction == 0) { // caso verticale

                    while ($posizioneValida) {
                        while (($row + count($boat)) > 10) { // controllo se la lunghezza della barca è superiore allo spazio della riga
                            $row = rand(0, 9);
                            $col = rand(0, 9);        // se inferiore oppure è occupato ri-randomizzo la riga
                        }
                        // nave ok
                        for ($i = 0; $i < count($boat); $i++) {
                            if ($map[$row + $i][$col] != 0) {
                                $row = rand(0, 9);
                                $col = rand(0, 9);
                                break;
                            }
                            if ($i == count($boat) - 1) {
                                $posizioneValida = false;
                            }
                        }
                    }
                    while ($count < count($boat)) { // posiziono la barca sulla riga
                        $map[$row][$col] = $boat[0];
                        $row++;
                        $count++;
                    }

                    /*************************************************************************************/
                } else { // caso orizzontale

                    while ($posizioneValida) {
                        while (($col + count($boat)) > 10) { // controllo se la lunghezza della barca è superiore allo spazio della riga
                            $row = rand(0, 9);
                            $col = rand(0, 9); // se inferiore oppure è occupato ri-randomizzo la riga
                        }
                        // nave ok
                        for ($i = 0; $i < count($boat); $i++) {
                            if ($map[$row][$col + $i] != 0) {
                                $row = rand(0, 9);
                                $col = rand(0, 9);
                                break;
                            }
                            if ($i == count($boat) - 1) {
                                $posizioneValida = false;
                            }
                        }
                    }
                    do { // posiziono la barca sulla riga
                        $map[$row][$col] = $boat[0]; //se inferiore ri-randomizzo la colonna
                        $col++;
                        $count++;
                    } while ($count < count($boat));
                }
            }
            $mapWithBoat = $map;

            return $mapWithBoat; // ritorno la mappa aggiornata dopo l'inserimento della barca
        }
        // Funzione creata per stampare l'array della mappa completo di barche
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
                    echo  "<div onclick='changeDisplay($row,$col)' class='sea'><button type='input' class='name$row$col button' id='$row$col' method='GET'>" . $map[$row][$col] . "</button></div>";
                }
            }
        }
        ?>
    </div>
    <script>
        function changeDisplay(row, col) {
            const elementId = `name${row}${col}`;
            document.querySelector(`.${elementId}`).style.visibility = "visible";
        }
    </script>
</body>

</html>