<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>SIRA - Grupos</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>
  <?php include('getGrupos.php') ?>
</head>

<body>

  <!-- Start your project here-->

  <?php include('Navbar.php')?>
    

  <br>

   <!-- Container -->
  <div class="container">
 

  <br>


  <div class="container">
    <h2>Grupos Artísticos</h2>
    </div>
  
  <br>

  <!-- Grid column -->
  <div >
    <!--Panel-->
    <?php getGrupos() ?>
  <!-- Grid column -->


  
  </div>
  <!-- Container -->

    <br>

  
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

    <script src="https://unpkg.com/react/umd/react.production.js" crossorigin />

<script
  src="https://unpkg.com/react-dom/umd/react-dom.production.js"
  crossorigin
/>

<script
  src="https://unpkg.com/react-bootstrap@next/dist/react-bootstrap.min.js"
  crossorigin
/>

<script>var Alert = ReactBootstrap.Alert;</script>
</body>

</html>
