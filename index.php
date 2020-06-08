<?php
    include("connessione.php");
    include("funzioni.php");
    header("Content-Type:application/json");
    switch($_GET["mod"]){
        case "ultimo_aggiornamento":
            ultimo_aggiornamento($conn);
        break;
        case "box":
            box($conn);
        break;
        case "grafico_regioni":
            grafico_regioni($conn);
        break;
        case "grafico_totale_casi":
            grafico_totale_casi($conn);
        break;
        case "grafico_nuovi_positivi":
            grafico_nuovi_positivi($conn);
        break;
        case "grafico_tamponi":
            grafico_tamponi($conn);
        break;
        case "grafico_date":
            grafico_date($conn);
        break;
        case "grafico_comparativo":
            grafico_comparativo($conn);
        break;
        case "tabella":
            tabella($conn);
        break;
        case "grafico_provincie":
            grafico_provincie($conn);
        break;
        case "login":
            login($conn);
        break;
        case "registra":
            registra($conn);
        break;
    }
?>