<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta http-equiv="x-ua-compatible" content="ie=edge">
	  <title>SIRA</title>
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	  <!-- Bootstrap core CSS -->
	  <link href="css/bootstrap.min.css" rel="stylesheet">
	  <!-- Material Design Bootstrap -->
	  <link href="css/mdb.min.css" rel="stylesheet">
	  <!-- Your custom styles (optional) -->
	  <link href="css/style.css" rel="stylesheet">

	   <link
	  rel="stylesheet"
	  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
	  integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
	  crossorigin="anonymous"/>
	<title></title>

</head>
<body>
	<?php 
	include('Navbar.php');
 	require('Conexion.php');
 	$postnames = array_keys($_POST);
 	if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
	}else{
		$grupo = str_replace("_"," ", $postnames[0]);
		$sql = "SELECT Descripcion, Historia FROM grupo WHERE Nombre = '$grupo'";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo 
					"<div class=\"row\">
							 <div class=\"col-lg-7\">
								<h2 class=\"h1-responsive font-weight-bold text-center my-5\">" .$grupo . "</h2>
								<hr class=\"my-5\">
								<p>" .$row['Descripcion'] . "</p>
								<br>
								<h3 class=\"fon-weight-bold mb-3\"><strong>Historia</strong></h3>
								<hr class=\"my-5\">
								<p>" .$row['Historia'] . "</p>
							</div>
							<div class=\"col-lg-5\">
								<div class=\"view overlay rounded z-depth-2 mb-log-0 mb-4\">
									<img class=\"img-fluid\" src=\"https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg\" alt=\"Sample image\">
									<a>
							          <div class=\"mask rgba-white-slight\"></div>
							        </a>
							    </div>
							 </div>
							</div>";
			}
		}else{
			echo "Fallo";
		}
	}

 ?>
<!-- Footer -->
    <footer class="page-footer font-small pt-4">
    <!-- Footer Links -->
      <!-- Grid row -->
      <div class="row">
      <div class="row">
        <!-- Grid column -->
        <div class="col-md-3">
          <!-- Content -->
          <img src="img/logoTECBLANCO.png" class="rounded">
        </div>
        <!-- Grid column -->       

        <!-- Grid column -->
        <div class="col-md-6 text-center">
            <!-- Links -->
            <h1>SIRA</h1>
            <h5>Sistema Institucional de Registro Artístico</h5>
        </div>

        <!-- Grid column -->
        <div class="col-md-3 text-center">
          <!-- Links -->
          <h5>Seguinos en Redes Sociales</h5>
          <ul class="list-unstyled mb-5 flex-center">
            <li>
              <a class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-3x" href="https://www.facebook.com/tierraycosecha/"></a>
            </li>
            <li>
              <a class="fab fa-youtube fa-lg white-text mr-md-5 mr-3 fa-3x" href="#!"></a>
            </li>
          </ul>
        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->
    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
      <a href="https://www.tec.ac.cr/"> www.tec.ac.cr </a>
    </div>
    <!-- Copyright -->
   
    </footer>
    <!-- Footer -->


    <!-- /Start your project here-->


    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.js"></script>
</body>

</html>