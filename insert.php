<?php
include('db_connect.php');
 
// Check connection
if($conn === false){
    die("ERROR Could not connect" . mysqli_connect_error());
}

$nome = mysqli_real_escape_string($conn, $_REQUEST['nome']);
$via = mysqli_real_escape_string($conn, $_REQUEST['via']);
$civico = mysqli_real_escape_string($conn, $_REQUEST['civico']);
$cap = mysqli_real_escape_string($conn, $_REQUEST['cap']);
$citta = mysqli_real_escape_string($conn, $_REQUEST['citta']);

//offerta
$ruolo = mysqli_real_escape_string($conn, $_REQUEST['ruolo']);
$descrizione = mysqli_real_escape_string($conn, $_REQUEST['descrizione']);
$retribuzione = mysqli_real_escape_string($conn, $_REQUEST['retribuzione']);
$ore = mysqli_real_escape_string($conn, $_REQUEST['ore']);
$contratto = mysqli_real_escape_string($conn, $_REQUEST['contratto']);

// PROBLEMA CON GLI ID

$sql1 = "INSERT INTO SEDI (CITTA, VIA, N_CIVICO, CAP, ID_OFFERTA) VALUES ('$citta', '$via', '$civico', '$cap', );";
$sql2 = "INSERT INTO OFFERTE_LAVORO (AZIENDA, RETRIBUZIONE, ORE_GIORNALIERE, TIPO_CONTRATTO, RUOLO) VALUES ('$nome', '$retribuzione', '$ore', '$contratto', '$ruolo');";
$sql3 = "INSERT INTO COMPETENZE (DENOMINAZIONE, DESCRIZIONE) VALUES ('$ruolo', '$descrizione')";
$sql4 = "INSERT INTO RICHIESTE(ID_OFFERTA, ID_COMPETENZA) VALUES ( );";

if(mysqli_query($conn, $sql1)){
    if(mysqli_query($conn, $sql2)){
        if(mysqli_query($conn, $sql3)){
            if(mysqli_query($conn, $sql4)){
                echo "Records aggiunti";
                header("Location:index.php");
            }
        }
    }
} else{
    echo "ERROR $sql. " . mysqli_error($conn);
}
 
// Close connection
mysqli_close($conn);
?>