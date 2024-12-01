<!DOCTYPE html>
<html lang="it">

<!-- Verifica se la sessione è attiva tramite il file checksession-->
<?php
include '../checksession.php';
?>

<head>
    <title>MyPoliClass</title>
    <!-- <meta charset="UTF-8"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link all'icona della pagina accanto al titolo -->
    <link rel="icon" type="image/x-icon" href="../Home/icon.ico">

    <!-- Link ai file dell'estetica-->
    <link rel="stylesheet" href="../Home/style.css">
    <link rel="stylesheet" href="../Prenotazione/styleInfo.css">
    <link rel="stylesheet" href="../Prenotazione/cssPrenotaLezioni.css">
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
        <a href="../Dashboard/index.php"><img src="../Home/dashboard.svg" width="36px" height="36px">Dashboard</a>
        <a href="../SearchPage/index.php"><img src="../Home/menu-search.svg" width="36px" height="36px">Ricerca</a>
        <a href="../Map/index.php"><img src="../Home/map-icon.svg" width="36px" height="36px">Mappa</a>
        <a href="../Prenotazioni-effetuate/index.php"><img src="../Home/reservation.svg" width="36px" height="36px">Le
            mie Prenotazioni</a>
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

    <!--Contenitore contenuto pagina-->
    <div class="page-content">
        <h2>Prenotazione aula <span id="class-name">...</span></h2>

        <!-- Contenitore delle informazioni dell'aula -->
        <div class="aula-info">

            <!-- Conteniteore della descrizione dell'aula -->
            <div class="aula-descr">


                <!-- Immagine dell'aula desiderata -->
                <img src="../Prenotazione/aula-esempio.jpg" alt="Foto aula" class="aula-img">


                <!-- Dati dell'aula -->
                <?php
                require_once('../config.php');
                $NomeClasse = $_GET['class'];  // Prendi il valore del parametro 'class'
                $query = "SELECT Nome_Aula, Tipologia, Numero_Posti, Piano, Lim, Prese, Connessione, Aria FROM aule WHERE Nome_Aula = '$NomeClasse'";  // Usa il placeholder per la preparazione della query
// Esegui la query per ottenere i dati delle aule
                

                $result = $conn->query($query);
                $conn->set_charset("utf8");
                // Verifica se ci sono risultati
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="data">';
                        echo '<span class="aula-name">AULA: <span id="class-name">' . htmlspecialchars($row['Nome_Aula']) . '</span></span><br>';
                        echo 'Tipologia: ' . htmlspecialchars($row['Tipologia']) . '<br>';
                        echo 'Numero posti: ' . htmlspecialchars($row['Numero_Posti']) . '<br>';
                        echo 'Piano: ' . htmlspecialchars($row['Piano']) . '<br>';
                        echo 'Lim: ' . ($row['Lim'] ? 'Sì' : 'No') . '<br>';
                        echo 'Prese: ' . ($row['Prese'] ? 'Sì' : 'No') . '<br>';
                        echo 'Connessione: ' . ($row['Connessione'] ? 'Sì' : 'No') . '<br>';
                        echo 'Aria condizionata: ' . ($row['Aria'] ? 'Sì' : 'No') . '<br>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Nessun risultato trovato.</p>';
                }

                //$conn->close();
                ?>


                <!-- Mappa in cui dovrebbe essere evidenziata l'aula deasiderata  -->
                <a href="../Map/index.php" class="aula-map"><img src="../Dashboard/mapview.png" alt="Psizione aula"
                        style="border-radius: 20px; width:100%; height:100%;"></a>

                <!-- Descrizione della posizione -->
                <span class="position-descr"><span class="aula-name">POSIZIONE AULA</span><br>
                    Clicca sull'immagine per aprire la mappa dell'edificio in cui si trova l'aula</span>


            </div>


            <!--    Calendario da cui prenotare le lezioni     -->
            <div class="calendar-container">
                <?php
                require_once '../config.php';
                $conn->set_charset("utf8");
                ?>
                <!DOCTYPE html>
                <html class="wide wow-animation" lang="it">

                <head>

                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Calendario delle Prenotazioni</title>
                    <link rel="stylesheet" href="cssPrenotaLezioni.css">



                </head>

                <!-- <div class="overlay" id="overlay"></div> -->

                <body style="background-color: white; user-select: none;">

                    <h1 id="TitoloPrincipale" style="visibility:hidden">Calendario per le Prenotazioni</h1>
                    <br>
                    <h3 id="current-month"></h3>

                    <div class="container">
                        <table class="calendar" style="user-select: none; border:none; margin:0;">
                            <thead>
                                <tr>
                                    <p id="selected-day-of-week"></p>
                                    <th></th>
                                </tr>
                            </thead>
                            <tr id="giornisett" style="visibility:hidden">
                                <th>LUN</th>
                                <th>MAR</th>
                                <th>MER</th>
                                <th>GIO</th>
                                <th>VEN</th>
                                <th>SAB</th>
                                <th>DOM</th>
                            </tr>
                            <tbody id="calendar-body" style="user-select: none;">
                            </tbody>
                        </table>
                    </div>
                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <span class="close-popup" id="close-popup">&times;</span>
                            <h2>Seleziona l'orario:</h2>
                            <p id="giorno-selezionato" style="font-size:19px"></p>
                            <ul id="time-slots">
                            </ul>
                        </div>
                    </div>


                    <div id="booking-popup" class="popup" style="width: 90vw; max-width: 500px;">
                        <div class="popup-content">
                            <span class="close-popup" id="close-booking-popup">&times;</span>
                            <br>
                            <h2>Conferma la prenotazione:</h2>
                            <p id="booking-details" style="font-size:19px"></p>
                            <div class="button-container">
                                <button id="confirm-booking" class="switchbutton">Conferma</button>
                                <button id="cancel-booking" class="switchbutton">Annulla</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        var GiaPrenotate = "";
                        var formattedDate = "";
                        const calendarBody = document.getElementById("calendar-body");
                        const popup = document.getElementById("popup");
                        const closePopup = document.getElementById("close-popup");
                        const timeSlots = document.querySelectorAll("#time-slots li");
                        const currentMonthElement = document.getElementById("current-month");
                        const bookingPopup = document.getElementById("booking-popup");
                        const closeBookingPopup = document.getElementById("close-booking-popup");
                        const confirmBookingBtn = document.getElementById("confirm-booking");
                        const cancelBookingBtn = document.getElementById("cancel-booking");
                        const bookingDetails = document.getElementById("booking-details");
                        var disponibilita = "";
                        let selectedDateCell;

                        function updateClass() {
                            // Ottieni i parametri dalla query string della URL
                            const urlParams = new URLSearchParams(window.location.search);

                            // Ottieni il valore del parametro "class"
                            const NomeClasse = urlParams.get('class');

                            // Controlla se il valore è stato trovato e usalo
                            if (NomeClasse) {
                                console.log("NomeClasse:", NomeClasse.trim());
                            } else {
                                console.log("Parametro 'class' non trovato nella query string.");
                            }

                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "updateClass.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4) {
                                    if (xhr.status === 200) {
                                        /*
                                        if(disponibilita == "")
                                        {
                                            updateClass();
                                        }
                                        */
                                        var responseJSON = JSON.parse(xhr.responseText);
                                        GiaPrenotate = responseJSON;

                                        removeCalendarRows();
                                        generateCalendar();

                                        document.getElementById("giornisett").style.visibility = "visible";
                                        document.getElementById("TitoloPrincipale").style.visibility = "visible";

                                        const greenDayCircles = document.querySelectorAll(".green-day span.circle");
                                        greenDayCircles.forEach((circle) => {
                                            circle.addEventListener("click", function () {
                                                const cell = circle.parentElement;
                                                const clickedCell = cell;
                                                if (clickedCell.classList.contains("date") && !clickedCell.classList.contains("past-day")) {
                                                    selectedDateCell = clickedCell;
                                                    const selectedDate = parseInt(selectedDateCell.textContent);
                                                    const dayOfWeek = selectedDateCell.dataset.dayOfWeek;
                                                    const currentDate = new Date();
                                                    while (currentDate.getDate() !== selectedDate) {
                                                        currentDate.setDate(currentDate.getDate() + 1);
                                                    }
                                                    const currentMonth = currentDate.toLocaleString('default', { month: 'long' });
                                                    const currentYear = currentDate.getFullYear();
                                                    const currentDay = currentDate.getDate();
                                                    const currentMonthNumeric = currentDate.getMonth() + 1;
                                                    const currentYearNumeric = currentDate.getFullYear();
                                                    formattedDate = `${currentYearNumeric}-${currentMonthNumeric.toString().padStart(2, '0')}-${currentDay.toString().padStart(2, '0')}`;
                                                    //const confirmationMessage = `Hai selezionato il giorno: ${dayOfWeek} ${selectedDate} ${currentMonth} ${currentYear}`;
                                                    //alert(confirmationMessage);
                                                    const disponibilitaArray = disponibilita.split("/");
                                                    var giorniDellaSettimana = ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato", "Domenica"];
                                                    var orariPerGiorno = {};
                                                    var giornoCorrente = "";
                                                    disponibilitaArray.forEach(function (elemento) {

                                                        if (giorniDellaSettimana.includes(elemento)) {
                                                            giornoCorrente = elemento;
                                                            orariPerGiorno[giornoCorrente] = [];
                                                        } else {

                                                            orariPerGiorno[giornoCorrente].push(elemento);
                                                        }
                                                    });
                                                    stampaDisponibilita = "";
                                                    for (var giorno in orariPerGiorno) {
                                                        if (giorno === dayOfWeek) {
                                                            var orari = orariPerGiorno[giorno];
                                                            if (orari.length > 0) {

                                                                var orariDisponibili = orari.filter(function (orario) {
                                                                    return !isOrarioPrenotato(orario);
                                                                });

                                                                if (orariDisponibili.length > 0) {
                                                                    stampaDisponibilita += "<li>" + orariDisponibili.join("</li><li>") + "</li>";
                                                                } else {
                                                                    stampaDisponibilita += "Nessuna disponibilità";
                                                                }
                                                            } else {
                                                                stampaDisponibilita += "Nessuna disponibilità";
                                                            }
                                                        }
                                                    }
                                                    function isOrarioPrenotato(orario) {
                                                        for (var i = 0; i < GiaPrenotate.length; i++) {
                                                            var prenotazione = GiaPrenotate[i];
                                                            if (prenotazione.Data === formattedDate && prenotazione.Ora === orario) {
                                                                return true;
                                                            }
                                                        }
                                                        return false;
                                                    }
                                                    var giornoselezionato = document.getElementById("giorno-selezionato");
                                                    var timeSlotsList = document.getElementById("time-slots");
                                                    giornoselezionato.innerHTML = `${dayOfWeek} ${selectedDate} ${currentMonth} ${currentYear}`;
                                                    timeSlotsList.innerHTML = stampaDisponibilita;

                                                    popup.style.display = "block";
                                                }
                                            });
                                        });

                                    } else {
                                        console.error("Errore durante la richiesta al server:", xhr.status, xhr.statusText);
                                        alert("Si è verificato un errore durante la richiesta al server.");

                                    }
                                }
                            };
                            xhr.send("NomeClasse=" + encodeURIComponent(NomeClasse));
                        }

                        function updateDisponibilita() {
                            // Ottieni i parametri dalla query string della URL
                            const urlParams = new URLSearchParams(window.location.search);

                            // Ottieni il valore del parametro "class"
                            const NomeClasse = urlParams.get('class');

                            // Controlla se il valore è stato trovato e usalo
                            if (NomeClasse) {
                                console.log("NomeClasse:", NomeClasse.trim());
                            } else {
                                console.log("Parametro 'class' non trovato nella query string.");
                            }

                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "Disponibilita.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4) {
                                    if (xhr.status === 200) {
                                        disponibilita = xhr.responseText;
                                        updateClass();
                                    } else {
                                        console.error("Errore durante la richiesta al server:", xhr.status, xhr.statusText);
                                        alert("Si è verificato un errore durante la richiesta al server.");
                                    }
                                }
                            };
                            xhr.send("NomeClasse=" + encodeURIComponent(NomeClasse));
                        }

                        function removeCalendarRows() {
                            const calendarBody = document.getElementById("calendar-body");
                            while (calendarBody.firstChild) {
                                calendarBody.removeChild(calendarBody.firstChild);
                            }
                        }

                        function generateCalendar() {
                            const today = new Date();
                            today.setHours(0, 0, 0, 0); // Imposta l'ora a mezzanotte per la data odierna
                            const startDate = new Date(today);
                            startDate.setDate((today.getDate() + (1 - today.getDay())) - 7); // Imposta la data iniziale alla prossima Domenica
                            const endDate = new Date(startDate);
                            endDate.setDate(startDate.getDate() + 38); // Imposta la data finale a 19 giorni dopo
                            const daysOfWeek = ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"];
                            const months = ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];
                            currentMonthElement.textContent = `${months[startDate.getMonth()]} ${startDate.getFullYear()} / ${months[endDate.getMonth()]}  ${endDate.getFullYear()}`;
                            let hasGreenDay = false;
                            while (startDate <= endDate) {
                                const row = calendarBody.insertRow();
                                row.classList.add("week");
                                for (let j = 0; j < 7; j++) {
                                    const cell = row.insertCell();
                                    const currentDate = startDate.getDate();
                                    const currentDayOfWeek = startDate.getDay();
                                    cell.textContent = currentDate;
                                    cell.classList.add("date");
                                    cell.dataset.dayOfWeek = daysOfWeek[currentDayOfWeek];
                                    const controllo = new Date();
                                    controllo.setDate(today.getDate() + 30);
                                    if (startDate < today || startDate > controllo) {
                                        cell.classList.add("past-day");
                                    } else if (startDate.getTime() === today.getTime()) {
                                        cell.classList.add("today");
                                        cell.classList.add("past-day");
                                    } else {
                                        const dayOfWeek = daysOfWeek[currentDayOfWeek];
                                        disponibilitaArray = disponibilita.split("/");
                                        if (disponibilitaArray.includes(dayOfWeek)) {
                                            const formattedDate = `${startDate.getFullYear()}-${(startDate.getMonth() + 1).toString().padStart(2, '0')}-${startDate.getDate().toString().padStart(2, '0')}`;
                                            const isOraGiaPrenotata = isOraPrenotata(formattedDate, GiaPrenotate, disponibilitaArray);

                                            if (isOraGiaPrenotata) {
                                                cell.classList.add("green-day");
                                                hasGreenDay = true;
                                            }
                                            else {
                                                cell.classList.add("past-day");
                                            }

                                        } else {
                                            cell.classList.add("past-day");
                                        }
                                    }
                                    startDate.setDate(startDate.getDate() + 1);
                                }
                            }


                            // All'interno della funzione generateCalendar()
                            if (!hasGreenDay) {
                                createPopup("Nessuna data disponibile");
                            }



                            const greenDayCells = document.querySelectorAll(".green-day");
                            greenDayCells.forEach((cell) => {
                                const circleSpan = document.createElement("span");
                                circleSpan.classList.add("circle");
                                cell.appendChild(circleSpan);
                            });
                        }


                        // Funzione per creare il popup
                        function createPopup(message) {
                            // Creazione del popup
                            const popup = document.createElement("div");
                            popup.classList.add("popupStyle");
                            popup.textContent = message;
                            // Aggiunta del popup al documento
                            document.body.appendChild(popup);
                        }

                        // CSS per lo stile del popup ellittico
                        const popupStyle = `
                                                                .poppopupStyleup {
                                                                    position: absolute;
                                                                    top: 50%;
                                                                    left: 50%;
                                                                    transform: translate(-50%, -50%);
                                                                    padding: 20px;
                                                                    background-color: rgba(255, 255, 255, 0.9);
                                                                    border-radius: 50%;
                                                                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
                                                                    z-index: 9999;
                                                                }
                                                            `;

                        // Aggiungi gli stili al documento
                        const styleElement = document.createElement("style");
                        styleElement.textContent = popupStyle;
                        document.head.appendChild(styleElement);


                        function isOraPrenotata(formattedDate, GiaPrenotate, disponibilitaArray) {
                            var orariGiaPrenotati = OrariGiaPrenotate(GiaPrenotate, formattedDate);
                            var orariDisponibilita = OraridisponibilitaArray(disponibilitaArray, formattedDate);
                            orariDisponibilita = "" + orariDisponibilita;
                            const array1 = orariGiaPrenotati.split(',');
                            const array2 = orariDisponibilita.split(',');
                            const array1Ordinato = array1.sort();
                            const array2Ordinato = array2.sort();

                            // Verifica che tutti i valori in array2Ordinato si trovino in array1Ordinato
                            const sonoTuttiPresenti = array2Ordinato.every(val => array1Ordinato.includes(val));

                            console.log("--------------------------------");
                            console.log(disponibilitaArray);
                            console.log(formattedDate);
                            console.log(JSON.stringify(array1Ordinato));
                            console.log(JSON.stringify(array2Ordinato));
                            console.log(sonoTuttiPresenti);
                            console.log("--------------------------------");

                            return !sonoTuttiPresenti;
                        }

                        function OrariGiaPrenotate(dates, formattedDate) {
                            const oreEstratte = [];
                            for (let i = 0; i < dates.length; i++) {
                                const date = dates[i].Data;
                                const ora = dates[i].Ora;
                                if (date === formattedDate) {
                                    const [inizio, fine] = ora.split('-');
                                    oreEstratte.push(`${inizio}-${fine}`);
                                }
                            }
                            const ris = oreEstratte.join(',');
                            return ris;
                        }

                        function OraridisponibilitaArray(disponibilitaArray, formattedDate) {
                            var giorniDellaSettimana = ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"];
                            var orariPerGiorno = {};
                            var giornoCorrente = "";
                            const data = new Date(formattedDate);
                            const giorno = giorniDellaSettimana[data.getDay()];
                            disponibilitaArray.forEach(function (elemento) {
                                if (giorniDellaSettimana.includes(elemento)) {
                                    giornoCorrente = elemento;
                                    orariPerGiorno[giornoCorrente] = [];
                                } else {
                                    orariPerGiorno[giornoCorrente].push(elemento);
                                }
                            });
                            return orariPerGiorno[giorno] || []; // Restituiamo un array vuoto se il giorno non è stato trovato
                        }

                        closePopup.addEventListener("click", function () {
                            popup.style.display = "none";
                        });
                        updateDisponibilita();
                        const greenDayCircles = document.querySelectorAll(".green-day span.circle");
                        greenDayCircles.forEach((circle) => {
                            circle.addEventListener("click", function () {
                                const cell = circle.parentElement;
                                const clickedCell = cell;
                                if (clickedCell.classList.contains("date") && !clickedCell.classList.contains("past-day")) {
                                    selectedDateCell = clickedCell;
                                    const selectedDate = parseInt(selectedDateCell.textContent);
                                    const dayOfWeek = selectedDateCell.dataset.dayOfWeek;
                                    const currentDate = new Date();
                                    while (currentDate.getDate() !== selectedDate) {
                                        currentDate.setDate(currentDate.getDate() + 1);
                                    }
                                    const currentMonth = currentDate.toLocaleString('default', { month: 'long' });
                                    const currentYear = currentDate.getFullYear();
                                    const currentDay = currentDate.getDate();
                                    const currentMonthNumeric = currentDate.getMonth() + 1; // +1 perché i mesi sono indicizzati da 0 a 11
                                    const currentYearNumeric = currentDate.getFullYear();
                                    formattedDate = `${currentYearNumeric}-${currentMonthNumeric.toString().padStart(2, '0')}-${currentDay.toString().padStart(2, '0')}`;
                                    const confirmationMessage = `Hai selezionato il giorno: ${dayOfWeek} ${selectedDate} ${currentMonth} ${currentYear}`;
                                    alert(confirmationMessage);
                                    var disponibilitaArray = disponibilita.split("/");
                                    var giorniDellaSettimana = ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato", "Domenica"];
                                    var orariPerGiorno = {};
                                    var giornoCorrente = "";
                                    disponibilitaArray.forEach(function (elemento) {
                                        if (giorniDellaSettimana.includes(elemento)) {
                                            giornoCorrente = elemento;
                                            orariPerGiorno[giornoCorrente] = [];
                                        } else {
                                            orariPerGiorno[giornoCorrente].push(elemento);
                                        }
                                    });
                                    stampaDisponibilita = "";
                                    for (var giorno in orariPerGiorno) {
                                        if (giorno === dayOfWeek) {
                                            var orari = orariPerGiorno[giorno];
                                            if (orari.length > 0) {
                                                var orariDisponibili = orari.filter(function (orario) {
                                                    return !isOrarioPrenotato(orario);
                                                });
                                                if (orariDisponibili.length > 0) {
                                                    stampaDisponibilita += "<li>" + orariDisponibili.join("</li><li>") + "</li>";
                                                } else {
                                                    stampaDisponibilita += "Nessuna disponibilità";
                                                }
                                            } else {
                                                stampaDisponibilita += "Nessuna disponibilità";
                                            }
                                        }
                                    }
                                    function isOrarioPrenotato(orario) {
                                        for (var i = 0; i < GiaPrenotate.length; i++) {
                                            var prenotazione = GiaPrenotate[i];
                                            if (prenotazione.Data === formattedDate && prenotazione.Ora === orario) {
                                                return true;
                                            }
                                        }
                                        return false;
                                    }
                                    var timeSlotsList = document.getElementById("time-slots");
                                    timeSlotsList.innerHTML = stampaDisponibilita;
                                    popup.style.display = "block";

                                }
                            });
                        });

                        var selectedTime = "";
                        var timeSlotsList = document.getElementById("time-slots");
                        timeSlotsList.addEventListener("click", function (event) {
                            var clickedTimeSlot = event.target;
                            if (clickedTimeSlot.tagName === "LI") {
                                selectedTime = clickedTimeSlot.textContent;
                                var selectedDate = selectedDateCell.textContent;
                                var dayOfWeek = selectedDateCell.dataset.dayOfWeek;
                                var currentDate = new Date();
                                var currentMonth = currentDate.toLocaleString('default', { month: 'long' });
                                var currentYear = currentDate.getFullYear();
                                var confirmationMessage = `Confermi di voler prenotare nella data ${dayOfWeek} ${selectedDate} ${currentMonth} ${currentYear} All'orario ${selectedTime}?`;

                                bookingDetails.textContent = confirmationMessage;
                                bookingPopup.style.display = "block";
                                popup.style.display = "none";

                            }
                        });

                        closeBookingPopup.addEventListener("click", function () {
                            overlay.style.display = "none";
                            bookingPopup.style.display = "none";
                        });

                        confirmBookingBtn.addEventListener("click", function () {
                            var currentDate = new Date();
                            // Ottieni i parametri dalla query string della URL
                            const urlParams = new URLSearchParams(window.location.search);

                            // Ottieni il valore del parametro "class"
                            const NomeClasse = urlParams.get('class');

                            // Controlla se il valore è stato trovato e usalo
                            if (NomeClasse) {
                                console.log("NomeClasse:", NomeClasse.trim());
                            } else {
                                console.log("Parametro 'class' non trovato nella query string.");
                            }

                            var usernameLogin = "v.volpe@studenti.poliba.it";
                            var dayOfWeek = selectedDateCell.dataset.dayOfWeek
                            var data = {
                                data: formattedDate,
                                orario: selectedTime,
                                NomeClasse: NomeClasse,
                                usernameLogin: usernameLogin,
                                dayOfWeek: dayOfWeek
                            };

                            var xhr2 = new XMLHttpRequest();
                            xhr2.open("POST", "invioAula.php", true);
                            xhr2.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                            xhr2.onload = function () {
                                if (xhr2.status === 200) {
                                    // La richiesta è stata completata con successo
                                    console.log("Risposta dal server:", xhr2.responseText); // Debug: Visualizza la risposta dal server       
                                    alert("Aula prenotata con successo");
                                    window.location.href = "../Dashboard";
                                } else {
                                    // Gestisci gli errori qui
                                    console.error("Errore durante la richiesta al server:", xhr2.status, xhr2.statusText);
                                    alert("Si è verificato un errore durante la richiesta al server.");
                                }
                            };
                            xhr2.onerror = function () {
                                console.error("Errore di rete durante la richiesta al server.");
                                alert("Si è verificato un errore di rete.");
                            };
                            xhr2.send(JSON.stringify(data));
                            bookingPopup.style.display = "none";
                        });

                        cancelBookingBtn.addEventListener("click", function () {
                            bookingPopup.style.display = "none";
                        });



                    </script>

                </body>

                </html>
                <?php
                // Rilascia il risultato
                $conn->close();
                ?>

            </div>

        </div>

    </div>


    <script type="text/javascript" src="../Home/topbutton.js"></script>
    <script type="text/javascript" src="../Home/sidenav.js"></script>
    <script type="text/javascript" src="../Prenotazione/name.js"></script>
</body>

</html>