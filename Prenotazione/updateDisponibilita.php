<?php
// Includi la connessione al database e le impostazioni PHP necessarie
require_once '../config.php';
$conn->set_charset("utf8");

// Verifica se è stato inviato il parametro NomeClasse
if(isset($_POST['NomeClasse'])){
    // Ottieni il valore del parametro NomeClasse
    $NomeClasse = $_POST['NomeClasse'];

    // Prepara la query con un segnaposto per il parametro
    $query = "SELECT Disponibilita
              FROM Aule
              WHERE NomeAula = ?";

    // Prepara e esegui la query in modo sicuro utilizzando una query parametrica preparata
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $NomeClasse);
    $stmt->execute();
    
    // Ottieni il risultato della query
    $result = $stmt->get_result();

    // Verifica se ci sono risultati
    if ($result->num_rows > 0) {
        // Estrai la riga risultante
        $row = $result->fetch_assoc();
        $disponibilita = $row['Disponibilita'];
        
        // Output della disponibilità
        echo $disponibilita;
    } else {
        // Nessun risultato trovato
        echo "Errore";
    }

    // Chiudi lo statement
    $stmt->close();
} else {
    // Parametro mancante
    echo "Errore";
}

// Chiudi la connessione al database
$conn->close();
?>