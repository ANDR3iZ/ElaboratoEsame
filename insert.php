<?php
include('db_connect.php');
 
// Check connection
if($conn === false){
    die("ERROR Could not connect" . mysqli_connect_error());
}




$nome = filter_var($_REQUEST['nome'], FILTER_SANITIZE_STRING);
$via = filter_var($_REQUEST['via'], FILTER_SANITIZE_STRING);
$civico = filter_var($_REQUEST['civico'], FILTER_SANITIZE_NUMBER_INT);
$cap = filter_var($_REQUEST['cap'], FILTER_SANITIZE_NUMBER_INT);
$citta = filter_var($_REQUEST['citta'], FILTER_SANITIZE_STRING);

$ruolo = filter_var($_REQUEST['ruolo'], FILTER_SANITIZE_STRING);
$descrizione = filter_var($_REQUEST['descrizione'], FILTER_SANITIZE_STRING);
$retribuzione = filter_var($_REQUEST['retribuzione'], FILTER_SANITIZE_NUMBER_INT);
$ore = filter_var($_REQUEST['ore'], FILTER_SANITIZE_NUMBER_INT);
$contratto = filter_var($_REQUEST['contratto'], FILTER_SANITIZE_STRING);

echo "nome: ".$nome."<br>";
echo "via: ".$via."<br>";
echo "civico: ".$civico."<br>";
echo "cap: ".$cap."<br>";
echo "citta: ".$citta."<br>";

echo "ruolo: ".$ruolo."<br>";
echo "descrizione: ".$descrizione."<br>";
echo "retribuzione: ".$retribuzione."<br>";
echo "ore: ".$ore."<br>";
echo "contratto: ".$contratto."<br>";

// PROBLEMA CON GLI ID

$sql1 = "INSERT INTO OFFERTE_LAVORO (AZIENDA, RETRIBUZIONE, ORE_GIORNALIERE, TIPO_CONTRATTO, RUOLO) VALUES ('$nome', '$retribuzione', '$ore', '$contratto', '$ruolo');";
$resOfferteLavoro=mysqli_query($conn,$sql1);
if($resOfferteLavoro){
    $selectIDOfferte = "SELECT LAST_INSERT_ID();";//prendo l'ID dell'ultima riga inserita
    $resIdOfferte=mysqli_query($conn,$selectIDOfferte);
    if(mysqli_num_rows($resIdOfferte)>0){
        $idOfferta = mysqli_fetch_array($resIdOfferte);
        $idOfferta=$idOfferta[0];
        echo "id offerta: ".$idOfferta;
    }
}



$sql2 = "INSERT INTO SEDI (CITTA, VIA, N_CIVICO, CAP, ID_OFFERTA) VALUES ('$citta', '$via', '$civico', '$cap', '$idOfferta' );";
$resSedi=mysqli_query($conn,$sql2);
if($resSedi){
    $selectIDSedi = "SELECT LAST_INSERT_ID();";//prendo la chiave primaria dell'ultima riga inserita
    $resIdSedi=mysqli_query($conn,$selectIDSedi);
    if(mysqli_num_rows($resIdSedi)>0){
        $idSede = mysqli_fetch_array($resIdSedi);
        $idSede=$idSede[0];
        echo "id sede: ".$idSede;
    }
}




$sql3 = "INSERT INTO COMPETENZE (DENOMINAZIONE, DESCRIZIONE) VALUES ('$ruolo', '$descrizione')";
$resCompetenze=mysqli_query($conn,$sql3);
if($resCompetenze){
    $selectIDCompetenza = "SELECT LAST_INSERT_ID();";//prendo l'ID dell'ultima riga inserita
    $resIdCompetenza=mysqli_query($conn,$selectIDCompetenza);
    if(mysqli_num_rows($resIdCompetenza)>0){
        $idCompetenza = mysqli_fetch_array($resIdCompetenza);
        $idCompetenza=$idCompetenza[0];
        echo "id competenza: ".$idCompetenza;
    }
}


$sql4 = "INSERT INTO RICHIESTE(ID_OFFERTA, ID_COMPETENZA) VALUES ('$idOfferta', '$idCompetenza' );";
$resRichieste=mysqli_query($conn,$sql4);



if($resOfferteLavoro&&$resSedi&&$resCompetenze&&$resRichieste){
    echo "Records aggiunti";
    header("Location:index.php");
}

// Close connection
mysqli_close($conn);
?>