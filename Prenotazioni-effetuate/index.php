<!DOCTYPE html>
<html lang="it">

<!-- Verifica se la sessione è attiva tramite il file checksession -->
<?php
include '../checksession.php';
?>

<head>
    <title>MyPoliClass</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link all'icona della pagina accanto al titolo -->
    <link rel="icon" type="image/x-icon" href="../Home/icon.ico">

    <!-- Link ai file CSS -->
    <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="../Prenotazioni-effetuate/resStyle.css">

    <!-- Script necessario per la conferma di cancellazione -->
    <script>
        function confermaCancellazione(nomeAula, dataPrenotazione, orario) {
            if (confirm(`Sei sicuro di voler cancellare la prenotazione per l'aula ${nomeAula} il giorno ${dataPrenotazione} alle ${orario}?`)) {
                window.location.href = `delete_prenotazione.php?nome_aula=${encodeURIComponent(nomeAula)}&data_prenotazione=${encodeURIComponent(dataPrenotazione)}&orario=${encodeURIComponent(orario)}`;
            }
        }
    </script>
</head>

<body>

    <!-- Header -->
    <header>
        <img src="../Home/menu-icon.svg" alt="menu" class="navbarIcon" onclick="openNav()">
        <span>
            <h1>MYPOLICLASS </h1>
            <a href="#"><img src="../Home/icon.ico" alt="icon" width="64px" height="64px"></a>
        </span>
        <i width="64px"></i>
    </header>

    <!-- Barra di navigazione laterale -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <img src="../Home/user.svg" alt="immagine-profilo" class="profileimg">
        <a href="../Dashboard"><img src="../Home/dashboard.svg" width="36px" height="36px">Dashboard</a>
        <a href="../SearchPage"><img src="../Home/menu-search.svg" width="36px" height="36px">Ricerca</a>
        <a href="../Map"><img src="../Home/map-icon.svg" width="36px" height="36px">Mappa</a>
        <a href="../Prenotazioni-effetuate"><img src="../Home/reservation.svg" width="36px"
                height="36px">Le mie Prenotazioni</a>
        <a href="https://www.poliba.it/"><img src="../Home/link.svg" width="36px" height="36px">Link sito Poliba</a>
        <a href="../Logout.php" class="logout"> Logout <img src="../Home/logout.svg" alt="logout" width="64px"
                height="64px"></a>
    </div>

    <!--Oscuramento della pagina quando e' attiva la sidenav, cliccando sulla pagina l'overlay scampare con la sidebar-->
    <div id="overlay" onclick="closeNav()"></div>

    <!--Bottone per tornare in cima alla pagina-->
    <button onclick="topFunction()" id="topbutton" title="Torna su"><img src="../Home/arrow-upward.svg"
            alt="arrow-upward" height="40px" width="40px"></button>

    <!-- Contenuto della pagina -->
    <div class="page-content">
        <h2>Prenotazioni effettuate</h2>

        <div class="resList">
            <?php
            require_once '../config.php';
            $email = $_SESSION['username'];

            $querydel = "DELETE FROM prenotazioni WHERE Data_Prenotazione < CURDATE()";
            $resultdel  = $conn->query($querydel);

            $query = "
                SELECT 
                    Prenotazioni.Data_Prenotazione, 
                    Prenotazioni.Orario, 
                    Aule.Nome_Aula, 
                    Aule.Numero_Posti, 
                    Aule.Piano,
                    Aule.Immagine
                FROM 
                    Prenotazioni
                INNER JOIN 
                    Aule
                ON 
                    Prenotazioni.Nome_Aula = Aule.Nome_Aula
                WHERE 
                    Prenotazioni.Email = '$email'
            ";

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="resItem">';
                    echo '<img class="resImg" src="' . $row['Immagine'] . '" alt="Immagine aula">';
                    echo '<section>';
                    echo '<span class="aula-name"><b>' . 'AULA ' . $row['Nome_Aula'] . '</b><br><br></span>';
                    echo '<span class="dimensione">Numero posti: ' . $row['Numero_Posti'] . '</span><br>';
                    echo '<span class="edificio">Piano: ' . $row['Piano'] . '</span><br>';
                    echo '<span class="data">Data prenotata: ' . $row['Data_Prenotazione'] . '</span><br>';
                    echo '<span class="ora">Orario prenotato: ' . $row['Orario'] . '</span><br>';
                    echo '<button type="button" id="delBtn" title="Cancella prenotazione" 
                            onclick="confermaCancellazione(\'' . $row['Nome_Aula'] . '\', \'' . $row['Data_Prenotazione'] . '\', \'' . $row['Orario'] . '\')">
                            <img src="../Prenotazioni-effetuate/delete.svg" alt="Cancella" style="width:40px; height:40px;">
                          </button>';
                    echo '</section>';
                    echo '</div>';
                }
            } else {
                echo '<p>Nessuna prenotazione effettuata</p>';
            }
            ?>
        </div>
    </div>

    <!-- Messaggi di cancellazione -->
    <?php
    if (isset($_GET['cancellazione'])) {
        $messaggio = '';
        if ($_GET['cancellazione'] === 'successo') {
            $messaggio = 'Prenotazione cancellata con successo!';
        } elseif ($_GET['cancellazione'] === 'errore') {
            $messaggio = 'Si è verificato un errore durante la cancellazione della prenotazione.';
        }
        if ($messaggio) {
            echo "<script>
                alert('$messaggio');
                window.history.replaceState({}, document.title, window.location.pathname);
            </script>";
        }
    }
    ?>

    <!-- Script JS per la barra laterale e il bottone -->
    <script type="text/javascript" src="../Home/topbutton.js"></script>
    <script type="text/javascript" src="../Home/sidenav.js"></script>
</body>

</html>

