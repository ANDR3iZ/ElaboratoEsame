<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenzia di Lavoro</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Agenzia di Lavoro</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn--green btn-success rounded text-white " href="registerazienda.html" role="button" aria-haspopup="true" aria-expanded="false">Registrazione Azienda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">Offerte di Lavoro
                </h1>

                <!-- Blog Post -->
                
                  
                  <?php
                    include('db_connect.php');
                            
                    $query = "SELECT o.*, c.*, s.*
                                FROM offerte_lavoro as o, competenze as c, sedi as s
                                WHERE RUOLO = DENOMINAZIONE AND o.ID_OFFERTA = s.ID_SEDE";
                    
                    $query2 = "SELECT o.*, c.*
                                FROM OFFERTE_LAVORO AS o, COMPETENZE AS c
                                WHERE RUOLO = DENOMINAZIONE";

                    $connection = mysqli_query($conn, $query);
                    $connection2 = mysqli_query($conn, $query2);
                    $output = "";

                    while($row = mysqli_fetch_array($connection)) {
                        $id = $row['ID_OFFERTA'];
                        $Azienda = $row['AZIENDA'];
                        $retribuzione = $row['RETRIBUZIONE'];
                        $ore = $row['ORE_GIORNALIERE'];
                        $contratto = $row['TIPO_CONTRATTO'];
                        $ruolo = $row['RUOLO'];
                        $ruolo = $row['DENOMINAZIONE'];
                        $descrizione = $row['DESCRIZIONE'];
                        $indirizzo = $row['VIA'] . " " . $row['N_CIVICO'] . ', ' . $row['CAP'] . ', ' . $row['CITTA'];
                        
                        
                            $output = "<div class='card mb-4'>
                                    <div class='card-body'>
                                        <h2 class='card-title'>$ruolo</h2>
                                        <p class='card-text'> <b> Descrizione: </b> $descrizione </p>
                                        <p class='card-text'><b>Contratto: </b> $contratto </p>
                                        <p class='card-text'><b>Ore giornaliere: </b> $ore </p>
                                        <p class='card-text'><b>Retribuzione annua: </b> $retribuzione euro </p>
                                        <p class='card-text'><b>Indirizzo sede: </b> $indirizzo </p>
                            
                                </div>
                                <div class='card-footer text-muted'>
                                Caricato da <a href='Profile.php?p=$id'>$Azienda</a>
                            </div>
                            </div>";
                        
                    echo $output;
                    
                    }
                    
                    
                    $conn -> close();
                  ?>

                <!-- Pagination -->
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item">
                        <a class="page-link" href="#">&larr; Older</a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                <div class="card my-4">

                    <h5 class="card-header">Cerca</h5>
                    <div class="card-body">
                    <script>
                        
                        function showResult(str) {
                            if (str.length==0) {
                             document.getElementById("livesearch").innerHTML="";
                            document.getElementById("livesearch").style.border="0px";
                            return;
                        }
                        
                      var xmlhttp=new XMLHttpRequest();
                        xmlhttp.onreadystatechange=function() {
                        
                        if (this.readyState==4 && this.status==200) {
                            document.getElementById("livesearch").innerHTML=this.responseText;
                            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                        }
                    }
                    xmlhttp.open("GET","livesearch.php?q="+str,true);
                    xmlhttp.send();
}
                    </script>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Ricerca offerte..." onkeyup="showResult(this.value)">
                            <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Vai</button>
                            <div id="livesearch"></div>
                        </span>
                        </div>
                    </div>
                </div>



            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-3 bg-primary fixed-bottom">
        <div class="container">
            <p class="m-0 text-center text-white">Anton Andrei - Agenzia di Lavoro</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>