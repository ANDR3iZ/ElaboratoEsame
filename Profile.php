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
            <a class="navbar-brand" href="index.php">Agenzia di Lavoro</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" id="navbar" role="button" aria-haspopup="true" aria-expanded="false"><b>Profilo Azienda</b></a>
                    </li>
                </ul>
            </div>
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
            <?php 

                include('db_connect.php');

                $code = $_GET['p'];

                $sql = "SELECT o.*, c.*, s.*
                        FROM offerte_lavoro as o, competenze as c, sedi as s
                        WHERE $code = o.ID_OFFERTA AND $code = s.ID_OFFERTA";

                $sqlsedi = "SELECT s.* FROM sedi as s WHERE s.ID_OFFERTA = $code";

                $var = 1;
                $connection = mysqli_query($conn, $sql);
                $connection2 = mysqli_query($conn, $sqlsedi);
                $row = mysqli_fetch_array($connection);
                $Azienda = $row['AZIENDA'];

                echo "<h1 class='my-4'>$Azienda</h1>";

                while($sedi = mysqli_fetch_array($connection2)){

                    $id = $row['ID_OFFERTA'];
                    $indirizzo = $sedi['VIA'] . ", " . $sedi['N_CIVICO'] . ', ' . $sedi['CAP'] . ', ' . $sedi['CITTA'];
                    
                    echo "<h4 class='text'><b>Indirizzo sede $var: </b> $indirizzo </h4>";
                    $var++;
                }   
                       

            ?>
  
            </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-primary fixed-bottom">
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