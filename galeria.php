<?php require('sesion.php')?>
<?php function getGallery(){

            require('BD_Consultas/Conexion.php');
            if ($conn->connect_error){
              die("Connection failed: " . $conn->connect_error);
            }else{
              $query = "SELECT id, image_path FROM galeria ORDER BY id DESC";
              $result = mysqli_query($conn, $query);
              $Codigo="";
              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $Codigo .= " <div class=\"col-lg-4 col-md-12 mb-4\">
                       <!--Modal: Name-->
                       <div class=\"modal fade\" id=\"modal".$row['id']."\">
                         <div class=\"modal-dialog modal-lg\" role=\"document\">
                           <!--Content-->
                           <div class=\"modal-content\">
                             <!--Body-->
                             <div class=\"modal-body mb-0 p-0\">
                               <div class=\"embed-responsive embed-responsive-16by9 z-depth-1-half\" >
                                 <iframe class=\"embed-responsive-item\" src=\"".$row['image_path']."\"
                                   allowfullscreen></iframe>
                               </div>
                             </div>
                           </div>
                           <!--/.Content-->
                         </div>
                       </div>
                       <!--Modal: Name-->
                       <a><img class=\"img-fluid\" src=\"".$row['image_path']."\"
                           data-toggle=\"modal\" data-target=\"#modal".$row['id']."\"></a>
                     </div>";
              }
          }
            }
            $conn->close();
            echo $Codigo;
        }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>SIRA - Galería</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>
</head>

<body>
<?php //require('sesion.php')?>
  <!-- Start your project here-->
  <style>
  .card-img-top {
      width: 100%;
      height: 15vw;
      object-fit: cover;
  }
  </style>

 <?php include('Componentes\Navbar.php')?>

   <!-- Container -->
  <div class="container">

    <!-- Gallery -->
  <div class="container">

    <br>
    <h2>Galería de Fotos</h2>
    <br>

      <!-- Grid row -->
    <div class="row">
        <?php getGallery(); ?>
    </div>
    <!-- Grid row -->
  </div>
  <!-- Gallery -->

  </div>

  <?php include('Componentes\footer.php')?>
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
