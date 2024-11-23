<?php 
    require_once("../config.php");

    // Ottieni il contenuto della richiesta POST
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica che tutti i dati necessari siano presenti
    if (!isset($data['data'], $data['orario'], $data['NomeClasse'], $data['usernameLogin'], $data['dayOfWeek'])) {
        echo json_encode(array("success" => false, "message" => "Dati incompleti."));
        exit;
    }

    // Estrazione dati
    $dataPrenotazione = $conn->real_escape_string($data['data']);
    $orario = $conn->real_escape_string($data['orario']);
    $nomeClasse = $conn->real_escape_string($data['NomeClasse']);
    $usernameLogin = $conn->real_escape_string($data['usernameLogin']);

    // Preparazione query di inserimento
    $query = "INSERT INTO Prenotazioni (Email, Data_Prenotazione, Orario, Nome_Aula)
            VALUES ('$usernameLogin', '$dataPrenotazione', '$orario', '$nomeClasse')";

    // Esecuzione query
    if ($conn->query($query) === TRUE) {
        echo json_encode(array("success" => true, "message" => "Prenotazione aggiunta con successo."));
    } else {
        echo json_encode(array("success" => false, "message" => "Errore durante l'inserimento: " . $conn->error));
    }

    // Chiudi connessione
    $conn->close();
?>