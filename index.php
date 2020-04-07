<?php
include("connessione.php");
if($_GET["mod"]=="ultimo_aggiornamento"){
    global $conn;
    header("Content-Type:application/json");
    $stmt = $conn->prepare("SELECT MAX(data) AS ultimo_aggiornamento FROM andamento_nazionale");
    $stmt->execute();
    $ris=$stmt->fetch(PDO::FETCH_ASSOC);
    echo $json_response = json_encode($ris);
}
?>