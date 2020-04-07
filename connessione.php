<?php
$servername = "remotemysql.com";
$username = "MB8CKtLiWy";
$password = "qYUGJJqFG5";
$db="MB8CKtLiWy";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connessione fallita: " . $e->getMessage();
}
?>