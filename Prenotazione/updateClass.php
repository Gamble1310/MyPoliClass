<?php
// Includi la connessione al database e le impostazioni PHP necessarie
require_once '../../config.php';
$conn->set_charset("utf8");
require '../../VerificaAutenticazione.php';
$Username = 'v.volpe@studenti.poliba.it';
if(isset($_POST['NomeClasse'])){
    $NomeClasse = $_POST['NomeClasse'];

    $query = "SELECT Data_Prenotazione, Orario
    FROM Prenotazioni
    WHERE 
        (Nome_Aula = ? OR Email = ?) -- Filtra per Nome_Aula o Email
        AND Data_Prenotazione >= CURDATE() -- Prenotazioni future
        AND Data_Prenotazione <= DATE_ADD(CURDATE(), INTERVAL 20 DAY) -- Fino a 20 giorni avanti
    ORDER BY Data_Prenotazione, Ora_Inizio; -- Ordina per data e ora
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $NomeClasse, $Username);
    $stmt->execute();
    $resultQ = $stmt->get_result();

    $lezioniLezioni = []; // Inizializza un array vuoto per le lezioni

    // Esegui la query e ottieni i risultati

    while ($row = $resultQ->fetch_assoc()) {
        $lezioniLezioni[] = $row; // Aggiungi ogni riga come elemento nell'array
    }

    // Array per le lezioni dalla tabella PauseTutor
    $lezioniPauseTutor = [];
    while ($row = $resultQ2->fetch_assoc()) {
        $lezioniPauseTutor[] = $row;
    }

    // Unione degli array delle lezioni
    $GiaPrenotate = array_merge($lezioniLezioni);

    // Converti l'array in formato JSON
    $GiaPrenotateJSON = json_encode($GiaPrenotate);

    // Invia l'array JSON come risposta
    echo $GiaPrenotateJSON;
}
else{
    echo "Errore";
}
?>
