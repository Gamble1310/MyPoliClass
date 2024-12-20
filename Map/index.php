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
    <link rel="stylesheet" href="../Map/styleMap.css">
    

</head>

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
    <img src="../Home/user.svg" alt="immagine-profilo" class="profileimg">
    <a href="../Dashboard"><img src="../Home/dashboard.svg" width="36px" height="36px">Dashboard</a>
    <a href="../SearchPage"><img src="../Home/menu-search.svg" width="36px" height="36px">Ricerca</a>
    <a href="../Map"><img src="../Home/map-icon.svg" width="36px" height="36px">Mappa</a>
    <a href="../Prenotazioni-effetuate"><img src="../Home/reservation.svg" width="36px"
            height="36px">Le mie Prenotazioni</a>
    <a href="https://www.poliba.it/"><img src="../Home/link.svg" width="36px" height="36px">Link sito Poliba</a>
    <!-- &nbsp; simbolo del carattere di spaziatura-->
    <!-- Icona per il logout -->
    <a href="../Logout.php" class="logout"> Logout <img src="../Home/logout.svg" alt="logout" width="64px"
        height="64px"></a>
</div>

<!--Oscuramento della pagina quando e' attiva la sidenav, cliccando sulla pagina l'overlay scampare con la sidebar-->
<div id="overlay" onclick="closeNav()"></div>

<!--Bottone per tornare in cima alla pagina-->
<button onclick="topFunction()" id="topbutton" title="Torna su"><img src="../Home/arrow-upward.svg" alt="arrow-upward"
        height="40px" width="40px"></button>

<!--Contenuto pagina-->
<div class="map-page">
    <h2> Mappa Grandi Aule </h2>


    <!--Immagine della paintina della grandi aule-->
    <div class="container">
        <img src="Grandi-aule.jpeg" alt="Grandi-aule" width="100%" height="auto">

        <!--Aree colorate con link che porta alla pagina della prenotazione, 
            ogni aula fa parte di alcune classi per determinarne la grandezza e la posizione-->

        <a id="A" href="../Prenotazione?class=A" class="big bottom">Aula A

            <!-- Tooltip aula A -->
            <span class="tooltip">
                <img src="../immagini_aule/aulaa.jpeg" alt="img-aula-emsepio">
                <b style="text-align: center; color: #2d4b65;">Aula A</b><br>
                Dimensione: Grande<br>
                Prese elettriche: Si<br>
                Lim: Si<br>
            </span>


        </a>


        <a id="B" href="../Prenotazione?class=B" class="small_left bottom">Aula B

            <!-- Tooltip aula B -->   <!-- AULA B DA AGGIUNGERE AL DB-->
            <span class="tooltip">
                <img src="../immagini_aule/aulab.jpeg" alt="img-aula-emsepio">
                <b style="text-align: center; color: #2d4b65;">Aula B</b><br>
                Dimensione: Piccola<br>
                Prese elettriche: No<br>
                Lim: Si<br>
            </span>
        </a>




        <a id="C" href="../Prenotazione?class=C" class="big bottom">Aula C

            <!-- Tooltip aula C -->   
            <span class="tooltip">
                <img src="../immagini_aule/aulac.jpeg" alt="img-aula-emsepio">
                <b style="text-align: center; color: #2d4b65;">Aula C</b><br>
                Dimensione: Grande<br>
                Prese elettriche: Si<br>
                Lim: Si<br>
            </span>


        </a>

        <a id="D" href="../Prenotazione?class=D" class="big top"> Aula D
            
           <!-- Tooltip aula D -->   
           <span class="tooltip">
            <img src="../immagini_aule/aulad.jpeg" alt="img-aula-emsepio">
            <b style="text-align: center; color: #2d4b65;">Aula D</b><br>
            Dimensione: Grande<br>
            Prese elettriche: Si<br>
            Lim: Si<br>
        </span>




        </a>


        <a id="E" href="../Prenotazione?class=E" class="small_left top"> Aula E

            <!-- Tooltip aula E -->   
           <span class="tooltip">
            <img src="../immagini_aule/aulae.jpeg" alt="img-aula-emsepio">
            <b style="text-align: center; color: #2d4b65;">Aula E</b><br>
            Dimensione: Piccola<br>
            Prese elettriche: No<br>
            Lim: Si<br>
        </span>

        </a>


        <a id="Orabona" href="../Prenotazione?class=Magna" class="big top"> Aula Magna Orabona  
         
       <!-- Tooltip Aula Magna Orabona -->   
         <span class="tooltip">
            <img src="../immagini_aule/magna.jpeg" alt="img-aula-emsepio">
            <b style="text-align: center; color: #2d4b65;">Aula Magna Orabona</b><br>
            Dimensione: Grande<br>
            Prese elettriche: Si<br>
            Lim: Si<br>
        </span>
        
        </a>


        <a id="G" href="../Prenotazione?class=G" class="big bottom"> Aula G

        <!-- Tooltip Aula G -->   
         <span class="tooltip">
            <img src="../immagini_aule/aulag.jpeg" alt="img-aula-emsepio">
            <b style="text-align: center; color: #2d4b65;">Aula G</b><br>
            Dimensione: Grande<br>
            Prese elettriche: Si<br>
            Lim: Si<br>
        </span>

        </a>

        <a id="H" href="../Prenotazione?class=H" class="small_right bottom"> Aula H
                    <!-- Tooltip Aula G -->   
                    <span class="tooltip">
                        <img src="../immagini_aule/aulah.jpeg" alt="img-aula-emsepio">
                        <b style="text-align: center; color: #2d4b65;">Aula H</b><br>
                        Dimensione: Piccola <br>
                        Prese elettriche: No <br>
                        Lim: Si<br>
                    </span>
        </a>

        <a id="I" href="../Prenotazione?class=I" class="big bottom"> Aula I
            
            <!-- Tooltip Aula I -->   
            <span class="tooltip">
                <img src="../immagini_aule/aulai.jpeg" alt="img-aula-emsepio">
                <b style="text-align: center; color: #2d4b65;">Aula I</b><br>
                Dimensione: Grande<br>
                Prese elettriche: Si<br>
                Lim: Si<br>
            </span>

        </a>

        <a id="L" href="../Prenotazione?class=l" class="big top">    Aula L

            <!-- Tooltip Aula L -->   
            <span class="tooltip">
                <img src="../immagini_aule/aulal.jpeg" alt="img-aula-emsepio">
                <b style="text-align: center; color: #2d4b65;">Aula L</b><br>
                Dimensione: Grande<br>
                Prese elettriche: Si<br>
                Lim: Si<br>
            </span>

        </a>


        <a id="M" href="../Prenotazione?class=M" class="small_right top"> Aula M

            <!-- Tooltip Aula M -->   
            <span class="tooltip">
                <img src="../immagini_aule/aulam.jpeg" alt="img-aula-emsepio">
                <b style="text-align: center; color: #2d4b65;"> Aula M</b><br>
                Dimensione: Piccola<br>
                Prese elettriche: No<br>
                Lim: Si<br>
            </span>

        </a>

        <a id="N" href="../Prenotazione?class=N" class="big top">    Aula N
            <!-- Tooltip Aula N -->   
            <span class="tooltip">
                <img src="../immagini_aule/aulan.jpeg" alt="img-aula-emsepio">
                <b style="text-align: center; color: #2d4b65;"> Aula N</b><br>
                Dimensione: Grande<br>
                Prese elettriche: Si<br>
                Lim: Si<br>
            </span>
        </a>
    </div>



</div>



<script type="text/javascript" src="../Home/topbutton.js"></script>
<script type="text/javascript" src="../Home/sidenav.js"></script>
</body>


</html>