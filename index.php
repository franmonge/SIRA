<?php require('sesion.php')?>
<?php
  if(isset($_POST['Usuario']) && (isset($_POST['Password']))){
    $Usuario = filter_input(INPUT_POST, 'Usuario');
    $Password = filter_input(INPUT_POST, 'Password');
    verificarLogIn($Usuario, $Password);
  }

  function verificarLogIn($Usuario, $Password){
      $resultado = existeUsuario($Usuario, $Password, $conn);
	  if($resultado == 1){
          $administrador = usuarioAdministrador($Usuario);
          $_SESSION['user'] = $Usuario;
          $_SESSION['isAdmin'] = $administrador;
          header("Location: ./index.php");
          exit();
      }else{
          header("Location: ./logIn.php");
          exit();
      }
    }



  function usuarioAdministrador($Usuario){
    require('BD_Consultas\Conexion.php');
    if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }else{
      $idUsuario = consultaUsuario($Usuario, $conn);
      $_SESSION['userID'] = $idUsuario;
      $sql = "SELECT CASE WHEN EXISTS(SELECT 1 FROM administrador WHERE id_usuario = '$idUsuario') THEN 1 ELSE 0 END";
      $resultado = mysqli_query($conn, $sql);
      $resultado2 = $resultado->fetch_array(MYSQLI_NUM);
      $conn->close();
      return $resultado2[0];
    }
  }

  function consultaUsuario($Usuario, $conn){
    $sql = "SELECT id, Nombre, Apellidos FROM usuario WHERE Email = '$Usuario'";
    $result = mysqli_query($conn, $sql);
    // $result2 = $result->fetch_array(MYSQLI_NUM);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id_Usuario = $row['id'];
            $_SESSION['test'] = "Test";
            $_SESSION['nombre'] = $row['Nombre'];
            $_SESSION['nombreCompleto'] = $row['Nombre'] ." ".$row['Apellidos'];
            $_SESSION['email'] = $Usuario;
        }
    }
    return $id_Usuario;
  }

  function existeUsuario($Usuario, $Password){
    require('BD_Consultas\Conexion.php');
    if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
      $sql = "SELECT CASE WHEN EXISTS(SELECT 1 FROM usuario WHERE Email = '$Usuario' AND Password = '$Password') THEN 1 ELSE 0 END";
      $resultado = mysqli_query($conn, $sql);
      $resultado2 = $resultado->fetch_array(MYSQLI_NUM);
      $conn->close();
      return $resultado2[0];
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

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
  crossorigin="anonymous"
/>
  <?php include 'BD_Consultas\IndexGruposPreview.php'?>
  <?php include 'BD_Consultas\IndexPresentacionesPreview.php'?>
  <?php include 'BD_Consultas\indexGetImage.php'?>
  <?php include 'BD_Consultas\getCarousel.php'?>
</head>

<body>
<style>
.card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: scale-down;
}
</style>
  <!-- Start your project here-->
<?php include('Componentes\Navbar.php')?>

  <!--Carousel Wrapper-->
<div id="carouselSira" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel" style="width:100%; background-color:#00002F">
  <!--Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#carouselSira" data-slide-to="0" class="active"></li>
    <li data-target="#carouselSira" data-slide-to="1"></li>
    <li data-target="#carouselSira" data-slide-to="2"></li>
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner"  role="listbox">
      <?php getCarouselImages(); ?>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carouselSira" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselSira" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->

  <br>
  <!-- <div class="container"> -->
  <!-- Section heading -->
  <h2 class="h1-responsive font-weight-bold text-center my-5">Próximas Presentaciones</h2>
  <!-- Section description -->

  <!-- Card deck -->
  <div class="container">
    <div class="card-deck">
     <?php getPresentaciones(); ?>
    </div>
  </div>
  <!-- Card deck -->

  <br>

    <!-- Section: Blog v.1 -->
<section class="my-5">

  <!-- Section heading -->
  <h2 class="h1-responsive font-weight-bold text-center my-5">Grupos Artísticos</h2>
 <div class="container">
    <div class="card-deck">
      <?php getGrupos()?>
  </div>
</div>
</section>
<!-- Section: Blog v.1 -->

  <br>

  <!-- Gallery -->


    <br>

    <section class="my-5">

      <!-- Section heading -->
      <h2 class="h1-responsive font-weight-bold text-center my-5">Galería de Fotos</h2>
     <div class="container">
        <div class="card-deck">
          <?php getPreviewImages()?>
      </div>
    </div>
    </section>
    <!-- Section heading -->
    <!-- <h2 class="h1-responsive font-weight-bold text-center my-5">Galería de Fotos</h2>
    <br>

    <div class="container">
        <div class="row">
        </div>
    </div> -->
  <br>

  <!-- <blockquote class="blockquote text-center">
  <h3 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</h3>
  <footer class="blockquote-footer mb-3">Someone famous in <cite title="Source Title">Source Title</cite></footer>
</blockquote> -->

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
</body>

</html>
