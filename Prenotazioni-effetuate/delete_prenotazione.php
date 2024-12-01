<?php
require_once '../config.php';

$nome_aula = $_GET['nome_aula'] ?? null;
$data_prenotazione = $_GET['data_prenotazione'] ?? null;
$orario = $_GET['orario'] ?? null;

if (!$nome_aula || !$data_prenotazione || !$orario) {
    header("Location: index.php?cancellazione=errore");
    exit;
}

$query = "DELETE FROM Prenotazioni WHERE Nome_Aula = ? AND Data_Prenotazione = ? AND Orario = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("sss", $nome_aula, $data_prenotazione, $orario);
    if ($stmt->execute()) {
        header("Location: index.php?cancellazione=successo");
        exit;
    }
}

header("Location: index.php?cancellazione=errore");
exit;
?>