<!DOCTYPE html>
<html lang="it">

<head>

  <title>MyPoliClass</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link all'icona della pagina accanto al titolo, type="image/x-icon" indica il tipo di dati e rel="icon" indicano 
    cosa sia e l'utilizzo (icon come icona o apple-toch-icon per le icone degli shortcut su dispositivi apple -->
  <link rel="icon" type="image/x-icon" href="../Home/icon.ico">

  <!-- Link ai file dell'estetica-->
  <link rel="stylesheet" href="../Home/style.css">
  <link rel="stylesheet" href="../SearchPage/styleSearchPage.css">


  <script>
    function searchResults() {
      const query = document.getElementById("search").value.toLowerCase().replace(/\s+/g, ""); // Rimuove tutti gli spazi dalla query
      const results = document.querySelectorAll(".search-result");
  
      results.forEach((result) => {
        const aulaName = result.querySelector(".aula-name").innerText.toLowerCase().replace(/\s+/g, ""); // Rimuove tutti gli spazi dal nome aula
        if (aulaName.includes(query)) {
          result.style.display = ""; // Mostra se corrisponde
        } else {
          result.style.display = "none"; // Nascondi se non corrisponde
        }
      });
    }
    
  </script>
</head>

<body>

  <!--Per l'header ho usato una flexbox-->
  <header>
    <img src="../Home/menu-icon.svg" alt="menu" class="navbarIcon" onclick="openNav()">
    <span>
      <h1>MYPOLICLASS </h1>
      <a href="#"></a><img src="../Home/icon.ico" alt="icon" width="64px" height="64px"></a>
    </span>
    <i width="64px"></i>
    <!-- Questo elemento vuoto mi serve per far in modo che il nome del sito sia centrato, poiche' per l'header uso una flexbox con justify-content: spacebetween;-->
  </header>

  <!--Barra di navigazione laterale a scomparsa (nome in inglese: offcanvas)-->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <!--&times; e' la combinazione di caratteri della X come icoma di chiusura-->
    <img src="../Home/user.svg" alt="immagine-profilo" class="profileimg">
    <a href="../Dashboard/index.html"><img src="../Home/dashboard.svg" width="36px" height="36px">Dashboard</a>
    <a href="../SearchPage/index.html"><img src="../Home/menu-search.svg" width="36px" height="36px">Ricerca</a>
    <a href="../Map/index.html"><img src="../Home/map-icon.svg" width="36px" height="36px">Mappa</a>
    <a href="../Prenotazioni-effetuate/index.html"><img src="../Home/reservation.svg" width="36px" height="36px"> Le mie
      Prenotazioni</a>
    <a href="https://www.poliba.it/"><img src="../Home/link.svg" width="36px" height="36px">Link sito Poliba</a>
    <!-- &nbsp; simbolo del carattere di spaziatura-->
    <!-- Icona per il logout -->
    <a href="../Login/index.html" class="logout"> Logout <img src="../Home/logout.svg" alt="logout" width="64px"
        height="64px"></a>
  </div>

  <!--Oscuramento della pagina quando e' attiva la sidenav, cliccando sulla pagina l'overlay scampare con la sidebar-->
  <div id="overlay" onclick="closeNav()"></div>

  <!--Bottone per tornare in cima alla pagina-->
  <button onclick="topFunction()" id="topbutton" title="Torna su"><img src="../Home/arrow-upward.svg" alt="arrow-upward"
      height="40px" width="40px"></button>


  <!--Menu dei filtri-->
  <div class="filters">

    <!--Titolo filtri-->
    <div id="filterTitle">
      <p>Filtri</p>
      <img src="../SearchPage/filter-icon.svg" alt="filter icon" width="40px" height="40px"></p>
    </div>

    <form><!--   Aggiungere la destinzazione dei dati inseriti nel form    -->

      <!--   Selettore grandezza    -->
      <fieldset class="filterbuttons">
        <legend>Grandezza</legend>
        <span><input type="radio" id="piccola" name="grandezza" value="piccola">
          <label for="piccola">Piccola</label></span>
        <span><input type="radio" id="grande" name="grandezza" value="grande">
          <label for="grande">Grande</label></span>
      </fieldset>


      <!--  Selettore dei filtri aggiuntivi   -->

      <!-- Essendo dentro un form e' molto importante definire che il tipo sia button,
           poichè di default tutti i bottoni nei form eseguonao una submit, ma questo non e'
           voluto in questo caso ed e' molto importante che il bottone esegua la sua funzione senza submit, altrimenti non funziona-->
      <button type="button" onclick="toggleDropdown()" class="dropdownBtn"> Filtri Aggiuntivi 
        <img src="../SearchPage/dropdown-arrow.svg" alt="dropdown" style="height: 36px;width: 36px;" id="dropArrow"></button>

      <!-- Contenitore dei filtri aggiuntivi, che appare a schermo quando si clicca sul bottone col nome filti aggiuntivi -->
      <fieldset id="dropdownMenu">
        <span><input type="checkbox" id="prese" name="extraPrese" value="prese">
          <label for="prese">Presnza di prese elettriche</label></span><br>
        <span><input type="checkbox" id="lim" name="extraLim" value="lim">
          <label for="lim">Lim</label></span><br>
        <span><input type="checkbox" id="connessione" name="extraConnessione" value="connessione">
          <label for="connessione">Connessione</label></span><br>
        <span><input type="checkbox" id="aria-condizonata" name="extraAC" value="AC">
          <label for="aria-condizonata">Aria condizionata</label></span><br>
      </fieldset>


      <!--Pulsanti per inviare o resettare i valori nel form-->
      <div class="filterbuttons">
        <input type="submit" value="Invia" title="Filtra i risultati">
        <input type="reset" value="Reset" title="Rimuovi tutti i filtri">
      </div>
    </form>
  </div>

  <!--Contenuto pagina-->
  <div class="content">
    <h2>Pagina di Ricerca</h2>


    <!--Barra di ricerca-->
    <form id="searchbar" class="searchbar">
      <button type="submit" title="Cerca"><img src="search.svg" alt="searc-icon" height="28px" width="28px"></button>
      <input type="text" name="search" placeholder="Ricerca.." spellcheck="false">
    </form>



      <!-- Lista dinamica -->
    <div class="search-list">
      <?php
          require_once('../config.php');
          
          // Raccolta dati dai filtri
          $grandezza = isset($_POST['grandezza']) ? $_POST['grandezza'] : null;
          $prese = isset($_POST['extraPrese']) ? true : false;
          $lim = isset($_POST['extraLim']) ? true : false;
          $connessione = isset($_POST['extraConnessione']) ? true : false;
          $aria = isset($_POST['extraAC']) ? true : false;
          $reset=isset($_POST['reset']) ? true : false;
          // Costruzione della query
          $query = "SELECT Nome_Aula, Numero_Posti, Piano, Prese, Aria, Descrizione, Immagine, Connessione, Lim FROM aule WHERE 1=1";
          
          if($reset==false)
          {
          
          
          // Filtro per grandezza
          if ($grandezza) {
              if ($grandezza == "piccola") {
                  $query .= " AND Tipologia='Piccola'"; 
              } elseif ($grandezza == "grande") {
                  $query .= " AND Tipologia='Grande'";
              }
          }
          
          // Filtro per prese
          if ($prese) {
              $query .= " AND Prese = 1";
          }
          
          // Filtro per Lim
          if ($lim) {
              $query .= " AND Lim = 1";
          }
          
          // Filtro per Connessione internet
          if ($connessione) {
              $query .= " AND Connessione = 1";
          }
          
          // Filtro per aria condizionata
          if ($aria) {
              $query .= " AND Aria = 1";
          }
          }
          
          // Esecuzione della query
          $result = $mysqli->query($query);
          
          // Mostra i risultati
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '<a href="../Prenotazione/index.html" class="search-result-link">';
                  echo '<div class="search-result" >';
                  echo '<img src="' . $row['Immagine'] . '" alt="Immagine aula">';
                  echo '<section>';
                  echo '<span class="aula-name"><b>' . 'AULA-' . $row['Nome_Aula'] . '</b><br><br></span>';
                  echo '<span class="dimensione">Numero posti: ' . $row['Numero_Posti'] . '</span><br>';
                  echo '<span class="edificio">Piano: ' . $row['Piano'] . '</span><br>';
                  echo '<span class="prese">Prese elettriche: ' . ($row['Prese'] ? 'Sì' : 'No') . '</span><br>';
                  echo '<span class="aria">Aria condizionata: ' . ($row['Aria'] ? 'Sì' : 'No') . '</span><br>';
                  echo '<span class="lim">Presenza Lim: ' . ($row['Lim'] ? 'Sì' : 'No') . '</span><br>';
                  echo '<span class="connessione">Connessione internet: ' . ($row['Connessione'] ? 'Sì' : 'No') . '</span><br>';
                  echo '</section>';
                  echo '</div>';
                echo '</a>';
              }
          } else {
              echo '<p> Nessun risultato soddisfa i requisiti della ricerca </p>';
          }
          
          
          
          $mysqli->close();
      ?>
      
      </div>
    </div>

    <br><br>

    <!--  Paginatore   -->
    <div class="center-pagination">
      <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">&raquo;</a>
      </div>
    </div>

    <br><br>


    <script type="text/javascript" src="../Home/topbutton.js"></script>
    <script type="text/javascript" src="../Home/sidenav.js"></script>
    <script type="text/javascript" src="../SearchPage/dropdown.js"></script>
</body>

</html>