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

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../Home/icon.ico">

  <!-- CSS principali -->
  <link rel="stylesheet" href="../Home/style.css">
  <link rel="stylesheet" href="../SearchPage/styleSearchPage.css">

  <!-- Inclusione dello script JavaScript -->
  <script>
    function toggleDropdown() {
      const dropdownMenu = document.getElementById("dropdownMenu");
      const dropArrow = document.getElementById("dropArrow");

      if (dropdownMenu.style.display === "block") {
        dropdownMenu.style.display = "none"; // Nascondi il menu
        dropArrow.style.transform = "rotate(0deg)"; // Ripristina la freccia
      } else {
        dropdownMenu.style.display = "block"; // Mostra il menu
        dropArrow.style.transform = "rotate(180deg)"; // Ruota la freccia
      }
    }

    function filterResults() {
      const query = document.getElementById("search").value.toLowerCase().replace(/\s+/g, "");
      const results = document.querySelectorAll(".search-result");
      let hasResults = false;

      results.forEach((result) => {
        const aulaName = result.querySelector(".aula-name").innerText.toLowerCase().replace(/\s+/g, "");
        if (aulaName.includes(query)) {
          result.style.display = "";
          hasResults = true;
        } else {
          result.style.display = "none";
        }
      });

      const noResultsMessage = document.getElementById("noResultsMessage");

      if (!hasResults) {
        if (!noResultsMessage) {
          const message = document.createElement("p");
          message.id = "noResultsMessage";
          message.textContent = "Nessuna aula corrisponde alla tua ricerca.";
          message.style.color = "red";
          message.style.textAlign = "center";
          document.querySelector(".search-list").appendChild(message);
        }
      } else {
        if (noResultsMessage) {
          noResultsMessage.remove();
        }
      }
    }
  </script>
</head>

<body>
<header>
    <img src="../Home/menu-icon.svg" alt="menu" class="navbarIcon" onclick="openNav()">
    <span>
        <h1>MYPOLICLASS </h1>
        <a href="#"></a><img src="../Home/icon.ico" alt="icon" width="64px" height="64px"></a>
    </span>
    <i width="64px"></i>
    <!-- Questo elemento vuoto mi serve per far in modo che il nome del sito sia centrato, poiche' per l'header uso una flexbox con justify-content: spacebetween;-->
</header>



  <!-- Barra laterale -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <img src="../Home/user.svg" alt="immagine-profilo" class="profileimg">
    <a href="../Dashboard/index.php"><img src="../Home/dashboard.svg" width="36px" height="36px">Dashboard</a>
    <a href="../SearchPage/index.php"><img src="../Home/menu-search.svg" width="36px" height="36px">Ricerca</a>
    <a href="../Map/index.php"><img src="../Home/map-icon.svg" width="36px" height="36px">Mappa</a>
    <a href="../Prenotazioni-effetuate/index.php"><img src="../Home/reservation.svg" width="36px" height="36px"> Le mie Prenotazioni</a>
    <a href="https://www.poliba.it/"><img src="../Home/link.svg" width="36px" height="36px">Link sito Poliba</a>
    <a href="../Logout.php" class="logout"> Logout <img src="../Home/logout.svg" alt="logout" width="64px" height="64px"></a>
  </div>

  <!-- Overlay per la sidenav -->
  <div id="overlay" onclick="closeNav()"></div>

  <!-- Bottone torna su -->
  <button onclick="topFunction()" id="topbutton" title="Torna su">
    <img src="../Home/arrow-upward.svg" alt="arrow-upward" height="40px" width="40px">
  </button>

  <!-- Sezione Filtri -->
  <div class="filters">
    <div id="filterTitle">
      <p>Filtri</p>
      <img src="../SearchPage/filter-icon.svg" alt="filter icon" width="40px" height="40px">
    </div>

    <form action="<?=($_SERVER['PHP_SELF'])?>" method="POST">
      <fieldset class="filterbuttons">
        <legend>Grandezza</legend>
        <span><input type="radio" id="piccola" name="grandezza" value="piccola"><label for="piccola">Piccola</label></span>
        <span><input type="radio" id="grande" name="grandezza" value="grande"><label for="grande">Grande</label></span>
      </fieldset>

      <button type="button" onclick="toggleDropdown()" class="dropdownBtn">Filtri Aggiuntivi 
        <img src="../SearchPage/dropdown-arrow.svg" alt="dropdown" style="height: 36px;width: 36px;" id="dropArrow">
      </button>

      <fieldset id="dropdownMenu">
        <span><input type="checkbox" id="prese" name="extraPrese" value="prese"><label for="prese">Presenza di prese elettriche</label></span><br>
        <span><input type="checkbox" id="lim" name="extraLim" value="lim"><label for="lim">Lim</label></span><br>
        <span><input type="checkbox" id="connessione" name="extraConnessione" value="connessione"><label for="connessione">Connessione</label></span><br>
        <span><input type="checkbox" id="aria-condizonata" name="extraAC" value="AC"><label for="aria-condizonata">Aria condizionata</label></span><br>
        <label>Data</label>
        <input type="date" id="data" name="data" title="Seleziona una data" min="<?= date('Y-m-d', strtotime('+1 day')); ?>">

      </fieldset>

      <div class="filterbuttons">
        <input type="submit" value="Applica" title="Applica i filtra ai risultati">
        <input type="submit" value="Reset" title="Rimuovi tutti i filtri">
      </div>
    </form>
  </div>

  <!-- Contenuto principale -->
  <div class="content">
    <h2>Pagina di Ricerca</h2>

    <!-- Barra di ricerca -->
    <form id="searchbar" class="searchbar" onsubmit="return false;">
      <button type="submit">
        <img src="search.svg" alt="search-icon" height="28px" width="28px">
      </button>
      <input type="text" id="search" placeholder="Ricerca.." spellcheck="false" oninput="filterResults()">
    </form>

    <!-- Lista dinamica dei risultati -->
    <div class="search-list">
      <?php
        require_once('../config.php');

        $grandezza = isset($_POST['grandezza']) ? $_POST['grandezza'] : null;
        $prese = isset($_POST['extraPrese']) ? true : false;
        $lim = isset($_POST['extraLim']) ? true : false;
        $connessione = isset($_POST['extraConnessione']) ? true : false;
        $aria = isset($_POST['extraAC']) ? true : false;
        $data = isset($_POST['data']) ? $_POST['data'] : null;

        $query = "SELECT a.Nome_Aula, a.Numero_Posti, a.Tipologia, a.Piano, a.Prese, a.Aria, a.Descrizione, a.Immagine, a.Connessione, a.Lim
                  FROM aule a
                  WHERE 1=1";

        if ($grandezza) {
          $query .= $grandezza == "piccola" ? " AND a.Tipologia = 'Piccola'" : " AND a.Tipologia = 'Grande'";
        }
        if ($prese) $query .= " AND a.Prese = 1";
        if ($lim) $query .= " AND a.Lim = 1";
        if ($connessione) $query .= " AND a.Connessione = 1";
        if ($aria) $query .= " AND a.Aria = 1";

        if ($data) {
          $query .= " AND a.Nome_Aula NOT IN (
                        SELECT Nome_Aula 
                        FROM prenotazioni 
                        WHERE Data_Prenotazione = '$data'
                        GROUP BY Nome_Aula
                        HAVING COUNT(*) = 14
                      )";
        }

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $url = "../Prenotazione/index.php?class=" . urlencode($row['Nome_Aula']); // URL della pagina con il parametro classe
            echo '<div class="search-result" onclick="window.location.href=\'' . $url . '\'">';
            echo '<img src="' . $row['Immagine'] . '" alt="Immagine aula">';
            echo '<section>';
            echo '<span class="aula-name"><b>AULA-' . $row['Nome_Aula'] . '</b></span><br>';
            echo '<span class="dimensione">Numero posti: ' . $row['Numero_Posti'] . '</span><br>';
            echo '<span class="edificio">Piano: ' . $row['Piano'] . '</span><br>';
            echo '<span class="prese">Prese elettriche: ' . ($row['Prese'] ? 'Sì' : 'No') . '</span><br>';
            echo '<span class="aria">Aria condizionata: ' . ($row['Aria'] ? 'Sì' : 'No') . '</span><br>';
            echo '<span class="lim">Presenza Lim: ' . ($row['Lim'] ? 'Sì' : 'No') . '</span><br>';
            echo '<span class="connessione">Connessione internet: ' . ($row['Connessione'] ? 'Sì' : 'No') . '</span><br>';
            echo '</section>';
            echo '</div>';
          }
        } else {
          echo '<p>Nessun risultato trovato.</p>';
        }

        $conn->close();
      ?>
    </div>
  </div>

  <script type="text/javascript" src="../Home/topbutton.js"></script>
  <script type="text/javascript" src="../Home/sidenav.js"></script>

</body>

</html>
