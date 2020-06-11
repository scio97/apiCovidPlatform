<?php
function ultimo_aggiornamento($conn){
    $stmt = $conn->query("SELECT MAX(data) AS ultimo_aggiornamento FROM andamento_nazionale");
    $ris=$stmt->fetch(PDO::FETCH_ASSOC);
    echo $json_response = json_encode($ris);
}

function box($conn){
    $reg=fix();
    if($reg=="Abruzzo"||$reg=="Basilicata"||$reg=="P.A. Bolzano"||$reg=="Calabria"||$reg=="Campania"||$reg=="Emilia-Romagna"||$reg=="Friuli Venezia Giulia"||$reg=="Lazio"||$reg=="Liguria"||$reg=="Lombardia"||$reg=="Marche"||$reg=="Molise"||$reg=="Piemonte"||$reg=="Puglia"||$reg=="Sardegna"||$reg=="Sicilia"||$reg=="Toscana"||$reg=="P.A. Trento"||$reg=="Umbria"||$reg=="Valle d\'Aosta"||$reg=="Veneto"){
        $stmt = $conn->query("SELECT data,totale_casi, dimessi_guariti, deceduti, totale_positivi, nuovi_positivi FROM andamento_regionale WHERE denominazione_regione='$reg' ORDER BY data DESC LIMIT 3");
    }else{
        $stmt = $conn->query("SELECT data,totale_casi, dimessi_guariti, deceduti, totale_positivi, nuovi_positivi FROM andamento_nazionale ORDER BY data DESC LIMIT 3");
    }
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $var["totale_casi"]=$ris[0]["totale_casi"];
    $var["dimessi_guariti"]=$ris[0]["dimessi_guariti"];
    $var["deceduti"]=$ris[0]["deceduti"];
    $var["totale_positivi"]=$ris[0]["totale_positivi"];
    $var["var_totale_casi"]=$ris[0]["nuovi_positivi"];
    $var["var_dimessi_guariti"]=$ris[0]["dimessi_guariti"]-$ris[1]["dimessi_guariti"];
    $var["var_deceduti"]=$ris[0]["deceduti"]-$ris[1]["deceduti"];
    $var["var_totale_positivi"]=$ris[0]["totale_positivi"]-$ris[1]["totale_positivi"];
    $var["mortalita"]=round(($ris[0]["deceduti"]/$ris[0]["totale_casi"])*100,2)."%";
    $var["var_mortalita"]=round((($ris[0]["deceduti"]/$ris[0]["totale_casi"])-($ris[1]["deceduti"]/$ris[1]["totale_casi"]))*100,2)."%";
    echo $json_response = json_encode($var);
}
function grafico_regioni($conn){
    $stmt = $conn->query("SELECT denominazione_regione,totale_casi FROM andamento_regionale ORDER BY data DESC LIMIT 21");
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    for($i=0; $i<21; $i++){
        $myarray[$ris[$i]["denominazione_regione"]]=$ris[$i]["totale_casi"];
    }
    echo $json_response = json_encode($myarray);
}

function grafico_date($conn){
    $stmt = $conn->query("SELECT data FROM andamento_nazionale ORDER BY data");
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    for($i=0; $i<count($ris); $i++){
            $myarray[$i]=$ris[$i]["data"];
    }
    echo $json_response = json_encode($myarray);
}

function grafico_totale_casi($conn){
    $reg=fix();
    if($reg=="Abruzzo"||$reg=="Basilicata"||$reg=="P.A. Bolzano"||$reg=="Calabria"||$reg=="Campania"||$reg=="Emilia-Romagna"||$reg=="Friuli Venezia Giulia"||$reg=="Lazio"||$reg=="Liguria"||$reg=="Lombardia"||$reg=="Marche"||$reg=="Molise"||$reg=="Piemonte"||$reg=="Puglia"||$reg=="Sardegna"||$reg=="Sicilia"||$reg=="Toscana"||$reg=="P.A. Trento"||$reg=="Umbria"||$reg=="Valle d\'Aosta"||$reg=="Veneto"){
        $stmt = $conn->query("SELECT data, totale_casi FROM andamento_regionale WHERE denominazione_regione='$reg' ORDER BY data");
    }else{
        $stmt = $conn->query("SELECT data, totale_casi FROM andamento_nazionale ORDER BY data");
    }
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    for($i=0; $i<count($ris); $i++){
        $myarray[$ris[$i]["data"]]=$ris[$i]["totale_casi"];
    }
    echo $json_response = json_encode($myarray);
}
function grafico_nuovi_positivi($conn){
    $reg=fix();
    if($reg=="Abruzzo"||$reg=="Basilicata"||$reg=="P.A. Bolzano"||$reg=="Calabria"||$reg=="Campania"||$reg=="Emilia-Romagna"||$reg=="Friuli Venezia Giulia"||$reg=="Lazio"||$reg=="Liguria"||$reg=="Lombardia"||$reg=="Marche"||$reg=="Molise"||$reg=="Piemonte"||$reg=="Puglia"||$reg=="Sardegna"||$reg=="Sicilia"||$reg=="Toscana"||$reg=="P.A. Trento"||$reg=="Umbria"||$reg=="Valle d\'Aosta"||$reg=="Veneto"){
        $stmt = $conn->query("SELECT data, nuovi_positivi FROM andamento_regionale WHERE denominazione_regione='$reg' ORDER BY data");
    }else{
        $stmt = $conn->query("SELECT data, nuovi_positivi FROM andamento_nazionale ORDER BY data");
    }
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    for($i=0; $i<count($ris); $i++){
        $myarray[$ris[$i]["data"]]=$ris[$i]["nuovi_positivi"];
    }
    echo $json_response = json_encode($myarray);
}
function grafico_tamponi($conn){
    $reg=fix();
    if($reg=="Abruzzo"||$reg=="Basilicata"||$reg=="P.A. Bolzano"||$reg=="Calabria"||$reg=="Campania"||$reg=="Emilia-Romagna"||$reg=="Friuli Venezia Giulia"||$reg=="Lazio"||$reg=="Liguria"||$reg=="Lombardia"||$reg=="Marche"||$reg=="Molise"||$reg=="Piemonte"||$reg=="Puglia"||$reg=="Sardegna"||$reg=="Sicilia"||$reg=="Toscana"||$reg=="P.A. Trento"||$reg=="Umbria"||$reg=="Valle d\'Aosta"||$reg=="Veneto"){
        $stmt = $conn->query("SELECT data, tamponi FROM andamento_regionale WHERE denominazione_regione='$reg' ORDER BY data");
    }else{
        $stmt = $conn->query("SELECT data, tamponi FROM andamento_nazionale ORDER BY data");
    }
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $myarray[$ris[0]["data"]]=$ris[0]["tamponi"];
    for($i=1; $i<count($ris); $i++){
            $myarray[$ris[$i]["data"]]=$ris[$i]["tamponi"]-$ris[$i-1]["tamponi"];
    }
    echo $json_response = json_encode($myarray);
}

function grafico_comparativo($conn){
    $reg=fix();
    if($reg=="Abruzzo"||$reg=="Basilicata"||$reg=="P.A. Bolzano"||$reg=="Calabria"||$reg=="Campania"||$reg=="Emilia-Romagna"||$reg=="Friuli Venezia Giulia"||$reg=="Lazio"||$reg=="Liguria"||$reg=="Lombardia"||$reg=="Marche"||$reg=="Molise"||$reg=="Piemonte"||$reg=="Puglia"||$reg=="Sardegna"||$reg=="Sicilia"||$reg=="Toscana"||$reg=="P.A. Trento"||$reg=="Umbria"||$reg=="Valle d\'Aosta"||$reg=="Veneto"){
        $stmt = $conn->query("SELECT totale_positivi, dimessi_guariti, deceduti FROM andamento_regionale WHERE denominazione_regione='$reg' ORDER BY data");
    }else{
        $stmt = $conn->query("SELECT totale_positivi, dimessi_guariti, deceduti FROM andamento_nazionale ORDER BY data");
    }
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    for($i=0; $i<count($ris); $i++){
            $myarray[$i]["totale_positivi"]=$ris[$i]["totale_positivi"];
            $myarray[$i]["dimessi_guariti"]=$ris[$i]["dimessi_guariti"];
            $myarray[$i]["deceduti"]=$ris[$i]["deceduti"];
    }
    echo $json_response = json_encode($myarray);
}

function tabella($conn){
    $reg=fix();
    if($reg=="Abruzzo"||$reg=="Basilicata"||$reg=="P.A. Bolzano"||$reg=="Calabria"||$reg=="Campania"||$reg=="Emilia-Romagna"||$reg=="Friuli Venezia Giulia"||$reg=="Lazio"||$reg=="Liguria"||$reg=="Lombardia"||$reg=="Marche"||$reg=="Molise"||$reg=="Piemonte"||$reg=="Puglia"||$reg=="Sardegna"||$reg=="Sicilia"||$reg=="Toscana"||$reg=="P.A. Trento"||$reg=="Umbria"||$reg=="Valle d\'Aosta"||$reg=="Veneto"){
        $stmt = $conn->query("SELECT tamponi, terapia_intensiva, ricoverati_con_sintomi, isolamento_domiciliare, totale_positivi FROM andamento_regionale WHERE denominazione_regione='$reg' ORDER BY data DESC LIMIT 4");
    }else{
        $stmt = $conn->query("SELECT tamponi, terapia_intensiva, ricoverati_con_sintomi, isolamento_domiciliare, totale_positivi FROM andamento_nazionale ORDER BY data DESC LIMIT 4");
    }
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $myarray["tamponi"]=$ris[0]["tamponi"];
    $myarray["perc_terapia_intensiva"]=round(($ris[0]["terapia_intensiva"]/$ris[0]["totale_positivi"])*100,2);
    $myarray["perc_ricoverati_con_sintomi"]=round(($ris[0]["ricoverati_con_sintomi"]/$ris[0]["totale_positivi"])*100,2);
    $myarray["perc_isolamento_domiciliare"]=round(($ris[0]["isolamento_domiciliare"]/$ris[0]["totale_positivi"])*100,2);
    for($i=0; $i<3; $i++){
            $myarray["terapia_intensiva$i"]=$ris[$i]["terapia_intensiva"];
            $myarray["ricoverati_con_sintomi$i"]=$ris[$i]["ricoverati_con_sintomi"];
            $myarray["isolamento_domiciliare$i"]=$ris[$i]["isolamento_domiciliare"];
    }
    echo $json_response = json_encode($myarray);
}

function grafico_provincie($conn){
    $reg=fix();
    $stmt = $conn->query("SELECT denominazione_provincia, totale_casi FROM andamento_provinciale WHERE denominazione_regione='$reg' GROUP BY denominazione_provincia, totale_casi,data HAVING data=(SELECT MAX(data) FROM andamento_provinciale);");
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    for($i=0; $i<count($ris); $i++){
        $myarray[$ris[$i]["denominazione_provincia"]]=$ris[$i]["totale_casi"];
    }
    echo $json_response = json_encode($myarray);
}

function login($conn){
    $user = $_GET["user"];
    $password = $_GET["password"];
    $stmt = $conn->query("SELECT user, password, tipo FROM utenti WHERE user='$user'");
    if ($stmt->rowCount() > 0) {
        $row=$stmt->fetchALL();
        if($row[0]["password"]==$password){
            $risposta["risultato"]="ok";
            $risposta["tipo"]=$row[0]["tipo"];
        }else{
            $risposta["risultato"]="passworderr";
        }
    }else{
        $risposta["risultato"]="usererr";
    }
    echo $json_response = json_encode($risposta);
}

function registra($conn){
    $user = $_GET["user"];
    $password = $_GET["password"];
    if(!check_utente($user)){
        $stmt = $conn->query("INSERT INTO utenti (user, password, tipo) VALUES ('$user', '$password', 1)");
        $risposta["risultato"]=true;
    }else{
        $risposta["risultato"]=false;
    }
    echo $json_response = json_encode($risposta);
}

function modifica_nazione($conn){
    $data = $_GET["data"];
    $chiave = $_GET["chiave"];
    $valore = $_GET["valore"];
    $user=$_GET["user"];
    $data_attuale=date("y-m-d");
    $stmt = $conn->query("SELECT $chiave FROM andamento_nazionale WHERE data='$data'");
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $valore_vecchio=$ris[0]["$chiave"];
    $stmt = $conn->query("UPDATE andamento_nazionale SET $chiave=$valore WHERE data='$data'");
    $stmt = $conn->query("INSERT INTO modifiche (data_modifica, data, luogo, chiave, valore_vecchio, valore_nuovo, user_fk)  VALUES ('$data_attuale', '$data', 'Italia', '$chiave', $valore_vecchio, $valore, '$user')");
}
function modifica_regione($conn){
    $reg=fix();
    $data = $_GET["data"];
    $chiave = $_GET["chiave"];
    $valore = $_GET["valore"];
    $user=$_GET["user"];
    $data_attuale=date("y-m-d");
    $stmt = $conn->query("SELECT $chiave FROM andamento_regionale WHERE data='$data' AND denominazione_regione='$reg'");
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $valore_vecchio=$ris[0]["$chiave"];
    $stmt = $conn->query("UPDATE andamento_regionale SET $chiave=$valore WHERE data='$data' AND denominazione_regione='$reg'");
    $stmt = $conn->query("INSERT INTO modifiche (data_modifica, data, luogo, chiave, valore_vecchio, valore_nuovo, user_fk)  VALUES ('$data_attuale', '$data', '$reg', '$chiave', $valore_vecchio, $valore, '$user')");
}
function modifica_provincia($conn){
    $prov=fix_prov();
    $data = $_GET["data"];
    $valore = $_GET["valore"];
    $user=$_GET["user"];
    $data_attuale=date("y-m-d");
    $stmt = $conn->query("SELECT totale_casi FROM andamento_provinciale WHERE data='$data' AND denominazione_provincia='$prov'");
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $valore_vecchio=$ris[0]["totale_casi"];
    $stmt = $conn->query("UPDATE andamento_provinciale SET totale_casi=$valore WHERE data='$data' AND denominazione_provincia='$prov'");
    $stmt = $conn->query("INSERT INTO modifiche (data_modifica, data, luogo, chiave, valore_vecchio, valore_nuovo, user_fk)  VALUES ('$data_attuale', '$data', '$prov', 'totale_casi', $valore_vecchio, $valore, '$user')");
}

function cronologia_modifiche($conn){
    $stmt = $conn->query("SELECT * FROM modifiche");
    $rows=$stmt->rowCount();
    $ris=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $myarray["rows"]=$rows;
    for($i=0; $i<$rows; $i++){
        $myarray[$i]=[$ris[$i]["id"],$ris[$i]["data_modifica"],$ris[$i]["data"],$ris[$i]["luogo"],$ris[$i]["chiave"],$ris[$i]["valore_vecchio"],$ris[$i]["valore_nuovo"],$ris[$i]["user_fk"]];
    }
    echo $json_response = json_encode($myarray);
}

function elimina($conn){
    $id = $_GET["id"];
    $stmt = $conn->query("DELETE FROM modifiche WHERE id='$id'");
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function check_utente($user){
    global $conn;
    $stmt = $conn->query("SELECT user FROM utenti WHERE user='$user'");
    if ($stmt->rowCount() > 0) {
            return true;
    }else{
        return false;
    }
}

function fix(){
    if($_GET["reg"]!="Emilia-Romagna"){
        $reg=str_replace('-', ' ', $_GET["reg"]);
        $reg=str_replace("'", "\'", $reg);
        return $reg;
    }else{
        $reg=$_GET["reg"];
        return $reg;
    }
}
function fix_prov(){
    if($_GET["prov"]!="Barletta-Andria-Trani"&&$_GET["prov"]!="Forlì-Cesena"&&$_GET["prov"]!="Verbano-Cusio-Ossola"){
        $prov=str_replace('-', ' ', $_GET["prov"]);
        $prov=str_replace("'", "\'", $prov);
        return $prov;
    }else{
        $prov=$_GET["prov"];
        return $prov;
    }
}
?>