<!DOCTYPE html>
<html lang="it">

<!-- Verifica se la sessione è attiva tramite il file checksession-->
<?php
include '../checksession.php';
?>


<head>

    <title>MyPoliClass</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link all'icona della pagina accanto al titolo, type="image/x-icon" indica il tipo di dati e rel="icon" indicano 
    cosa sia e l'utilizzo (icon come icona o apple-toch-icon per le icone degli shortcut su dispositivi apple -->
    <link rel="icon" type="image/x-icon" href="../Home/icon.ico">

    <!-- Link ai file dell'estetica-->
    <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="../Dashboard/dashboard.css">

</head>

<body>

    <!--Per l'header ho usato una flexbox-->
    <header>
        <img src="../Home/menu-icon.svg" alt="menu" class="navbarIcon" onclick="openNav()">
        <span>
            <h1>MYPOLICLASS </h1>
            <a href="#"><img src="../Home/icon.ico" alt="icon" width="64px" height="64px"></a>
        </span>
        <i width="64px"></i>
        <!-- Questo elemento vuoto mi serve per far in modo che il nome del sito sia centrato, poiche' per l'header uso una flexbox con justify-content: spacebetween;-->
    </header>

    <!--Barra di navigazione laterale a scomparsa (nome in inglese: offcanvas)-->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <!--&times; e' la combinazione di caratteri della X come icoma di chiusura-->

        <img src="../Home/user.svg" alt="Immagine profilo" class="profileimg">   <!-- MODIFICA SULLA IMMAGINE, PUò ESSERE SOLO PNG -->
        <a href="../Dashboard"><img src="../Home/dashboard.svg" width="36px" height="36px">Dashboard</a>
        <a href="../SearchPage"><img src="../Home/menu-search.svg" width="36px" height="36px">Ricerca</a>
        <a href="../Map"><img src="../Home/map-icon.svg" width="36px" height="36px">Mappa</a>
        <a href="../Prenotazioni-effetuate"><img src="../Home/reservation.svg" width="36px" height="36px">Le mie Prenotazioni</a>
        <a href="https://www.poliba.it/"><img src="../Home/link.svg" width="36px" height="36px">Link sito Poliba</a>
        <!-- &nbsp; simbolo del carattere di spaziatura-->
        <!-- Icona per il logout -->
        <a href="../Logout.php" class="logout"> Logout <img src="../Home/logout.svg" alt="logout" width="64px"
                height="64px"></a>
    </div>

    <!--Oscuramento della pagina quando e' attiva la sidenav, cliccando sulla pagina l'overlay scampare con la sidebar-->
    <div id="overlay" onclick="closeNav()"></div>

    <!--Bottone per tornare in cima alla pagina-->
    <button onclick="topFunction()" id="topbutton" title="Torna su"><img src="../Home/arrow-upward.svg"
            alt="arrow-upward" height="40px" width="40px"></button>


    <!-- Contenuto della dashboard  -->
    <div class="dashboard-content">

        <h2> Benvenuto nella tua area riservata <?php
            // Mostra l'username dalla sessione
            echo htmlspecialchars($_SESSION['username']);            ?>
        </h2>
        <p>Utilizza lo sturmento di ricerca o la mappa per effettuare la tua prenotazione</p>


        <div class="dashboard-flexbox">
            
            <a href="../Map" class="dashboard-flexitem">
                 <p>Visualizza la Mappa</p>
                 <img src="../Dashboard/mapview.png" alt="Mappa">
                 <br><br>
            </a>

            <a href="../SearchPage" class="dashboard-flexitem">
                <p>Visualizza lo Strumento di Ricerca</p>
                <img src="../Dashboard/searchview.png" alt="Strumrnto di ricerca">
                <br><br>
            </a>

        </div>

    </div>
    <script type="text/javascript" src="../Home/topbutton.js"></script>
    <script type="text/javascript" src="../Home/sidenav.js"></script>
</body>

</html>