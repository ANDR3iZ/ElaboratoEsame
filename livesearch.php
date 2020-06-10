<?php
include('db_connect.php');

$query = "SELECT o.*, c.*, s.*
            FROM offerte_lavoro as o, competenze as c, sedi as s
            WHERE RUOLO = DENOMINAZIONE AND o.ID_OFFERTA = s.ID_SEDE";

$connection = mysqli_query($conn, $query);
$output = "";

$string = strtoupper(filter_var($_GET["q"], FILTER_SANITIZE_STRING));
$response="";

while($row = mysqli_fetch_array($connection)) {
    if(strpos(strtoupper($row['RUOLO']), $string)>-1){
        
        $id=$row['ID_OFFERTA'];
        $Azienda = $row['AZIENDA'];
        $retribuzione = $row['RETRIBUZIONE'];
        $ore = $row['ORE_GIORNALIERE'];
        $contratto = $row['TIPO_CONTRATTO'];
        $ruolo = str_replace($string, "<u>".$string."</u>", strtoupper($row['RUOLO']));
        //$ruolo = $row['DENOMINAZIONE'];
        $descrizione = $row['DESCRIZIONE'];
        $indirizzo = $row['VIA'] . " " . $row['N_CIVICO'] . ', ' . $row['CAP'] . ', ' . $row['CITTA'];


        $output = "<span>$ruolo</span>";
        
        echo $output;
        
    }
    
}


$conn -> close();

                    
// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($output=="") {
  $response="<span>no suggestion</span>";
}

//output the response
echo $response;
?>