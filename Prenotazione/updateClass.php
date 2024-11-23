<?php
// Includi la connessione al database e le impostazioni PHP necessarie
require_once '../config.php';
$conn->set_charset("utf8");
$Username = 'v.volpe@studenti.poliba.it';
if(isset($_POST['NomeClasse'])){
    $NomeClasse = $_POST['NomeClasse'];

    $query = "SELECT Data_Prenotazione AS Data, Orario AS Ora
    FROM Prenotazioni
    WHERE 
        (Nome_Aula = ? OR Email = ?) -- Filtra per Nome_Aula o Email
        AND Data_Prenotazione >= CURDATE() -- Prenotazioni future
        AND Data_Prenotazione <= DATE_ADD(CURDATE(), INTERVAL 20 DAY); -- Fino a 20 giorni avanti
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

    // Converti l'array in formato JSON
    $GiaPrenotateJSON = json_encode($lezioniLezioni);

    // Invia l'array JSON come risposta
    echo $GiaPrenotateJSON;
}
else{
    echo "Errore";
}
?>
