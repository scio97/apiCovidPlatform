<?php
    include("connessione.php");
//////////MENU//////////
    if($_GET["mod"]=="ultimo_aggiornamento"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT MAX(data) AS ultimo_aggiornamento FROM andamento_nazionale");
        $stmt->execute();
        $ris=$stmt->fetch(PDO::FETCH_ASSOC);
        echo $json_response = json_encode($ris);
    }
//////////HOME//////////
    if($_GET["mod"]=="box"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT data,totale_casi, dimessi_guariti, deceduti, totale_positivi FROM andamento_nazionale ORDER BY data DESC LIMIT 2");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        $var["totale_casi"]=$ris[0]["totale_casi"];
        $var["dimessi_guariti"]=$ris[0]["dimessi_guariti"];
        $var["deceduti"]=$ris[0]["deceduti"];
        $var["totale_positivi"]=$ris[0]["totale_positivi"];
        $var["var_totale_casi"]=$ris[0]["totale_casi"]-$ris[1]["totale_casi"];
        $var["var_dimessi_guariti"]=$ris[0]["dimessi_guariti"]-$ris[1]["dimessi_guariti"];
        $var["var_deceduti"]=$ris[0]["deceduti"]-$ris[1]["deceduti"];
        $var["var_totale_positivi"]=$ris[0]["totale_positivi"]-$ris[1]["totale_positivi"];
        echo $json_response = json_encode($var);
    }
    if($_GET["mod"]=="grafico_regioni"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT denominazione_regione,totale_casi FROM andamento_regionale ORDER BY data DESC LIMIT 21");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        for($i=0; $i<21; $i++){
            $myarray[$ris[$i]["denominazione_regione"]]=$ris[$i]["totale_casi"];
        }
        echo $json_response = json_encode($myarray);
    }
    if($_GET["mod"]=="grafico_totale_casi"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT data, totale_casi FROM andamento_nazionale ORDER BY data");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        for($i=0; $i<count($ris); $i++){
            $myarray[$ris[$i]["data"]]=$ris[$i]["totale_casi"];
        }
        echo $json_response = json_encode($myarray);
    }
    if($_GET["mod"]=="grafico_nuovi_positivi"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT data, nuovi_positivi FROM andamento_nazionale ORDER BY data");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        for($i=0; $i<count($ris); $i++){
            $myarray[$ris[$i]["data"]]=$ris[$i]["nuovi_positivi"];
        }
        echo $json_response = json_encode($myarray);
    }
    if($_GET["mod"]=="grafico_tamponi"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT data, tamponi FROM andamento_nazionale ORDER BY data");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        $myarray[$ris[0]["data"]]=$ris[0]["tamponi"];
        for($i=1; $i<count($ris); $i++){
                $myarray[$ris[$i]["data"]]=$ris[$i]["tamponi"]-$ris[$i-1]["tamponi"];
        }
        echo $json_response = json_encode($myarray);
    }
    if($_GET["mod"]=="grafico_comparativo_data"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT data FROM andamento_nazionale ORDER BY data");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        for($i=0; $i<count($ris); $i++){
                $myarray[$i]=$ris[$i]["data"];
        }
        echo $json_response = json_encode($myarray);
    }
    if($_GET["mod"]=="grafico_comparativo_positivi"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT totale_positivi FROM andamento_nazionale ORDER BY data");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        for($i=0; $i<count($ris); $i++){
                $myarray[$i]=$ris[$i]["totale_positivi"];
        }
        echo $json_response = json_encode($myarray);
    }
    if($_GET["mod"]=="grafico_comparativo_guariti"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT dimessi_guariti FROM andamento_nazionale ORDER BY data");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        for($i=0; $i<count($ris); $i++){
                $myarray[$i]=$ris[$i]["dimessi_guariti"];
        }
        echo $json_response = json_encode($myarray);
    }
    if($_GET["mod"]=="grafico_comparativo_deceduti"){
        global $conn;
        header("Content-Type:application/json");
        $stmt = $conn->prepare("SELECT deceduti FROM andamento_nazionale ORDER BY data");
        $stmt->execute();
        $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
        for($i=0; $i<count($ris); $i++){
                $myarray[$i]=$ris[$i]["deceduti"];
        }
        echo $json_response = json_encode($myarray);
    }
?>