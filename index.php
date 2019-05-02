<?php require('sesion.php')?>
<?php
  if(isset($_POST['Usuario']) && (isset($_POST['Password']))){
    $Usuario = filter_input(INPUT_POST, 'Usuario');
    $Password = filter_input(INPUT_POST, 'Password');
    verificarLogIn($Usuario, $Password);
  }

  function verificarLogIn($Usuario, $Password){
    require('BD_Consultas\Conexion.php');
    if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$resultado = existeUsuario($Usuario, $Password, $conn);
			if($resultado == 1){
        $administrador = usuarioAdministrador($Usuario);
        if($administrador == 1){
          $_SESSION['user'] = $Usuario;
        }else{
          header("Location: ./logIn.php");
        }
      }else{
         header("Location: ./logIn.php");
      }
      $conn->close();
    }
  }

  function usuarioAdministrador($Usuario){
    require('BD_Consultas\Conexion.php');
    if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }else{
      $idUsuario = consultaUsuario($Usuario, $conn);
      $sql = "SELECT CASE WHEN EXISTS(SELECT 1 FROM administrador WHERE id_usuario = '$idUsuario') THEN 1 ELSE 0 END";
      $resultado = mysqli_query($conn, $sql);
      $resultado2 = $resultado->fetch_array(MYSQLI_NUM);
      $conn->close();
      return $resultado2[0];
    }
  }

  function consultaUsuario($Usuario, $conn){
    $sql = "SELECT id FROM usuario WHERE Email = '$Usuario'";
    $result = mysqli_query($conn, $sql);
    $result2 = $result->fetch_array(MYSQLI_NUM);
    $id_Usuario = $result2[0];
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
</head>

<body>

  <!-- Start your project here-->
<?php include('Componentes\Navbar.php')?>

  <!--Carousel Wrapper-->
<div id="carousel-example-2" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
  <!--Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-2" data-slide-to="1"></li>
    <li data-target="#carousel-example-2" data-slide-to="2"></li>
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <div class="view">
        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(105).jpg" alt="First slide">
        <div class="mask rgba-black-light"></div>
      </div>
      <div class="carousel-caption">
        <h3 class="h3-responsive">This is the first title</h3>
        <p>First text</p>
      </div>
    </div>
    <div class="carousel-item">
      <!--Mask color-->
      <div class="view">
        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(115).jpg" alt="Second slide">
        <div class="mask rgba-black-light"></div>
      </div>
      <div class="carousel-caption">
        <h3 class="h3-responsive">Thir is the second title</h3>
        <p>Secondary text</p>
      </div>
    </div>
    <div class="carousel-item">
      <!--Mask color-->
      <div class="view">
        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(108).jpg" alt="Third slide">
        <div class="mask rgba-black-light"></div>
      </div>
      <div class="carousel-caption">
        <h3 class="h3-responsive">This is the third title</h3>
        <p>Third text</p>
      </div>
    </div>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->

  <br>
  <div class="container">
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
  <div class="container">

    <br>
    <!-- Section heading -->
    <h2 class="h1-responsive font-weight-bold text-center my-5">Galería de Fotos</h2>
    <!-- Section description -->
    <p class="text-center w-responsive mx-auto mb-5">Duis aute irure dolor in reprehenderit in voluptate velit
      esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
      qui officia deserunt mollit anim id est laborum.</p>
    <br>

      <!-- Grid row -->
    <div class="row">

  <!-- Grid column -->
  <div class="col-lg-4 col-md-12 mb-4">
    <!--Modal: Name-->
    <div class="modal fade" id="modal1">
      <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Body-->
          <div class="modal-body mb-0 p-0">
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <iframe class="embed-responsive-item" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: Name-->
    <a><img class="img-fluid" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
        data-toggle="modal" data-target="#modal1"></a>
  </div>
  <!-- Grid column -->

  <!-- Grid column -->
  <div class="col-lg-4 col-md-12 mb-4">
    <!--Modal: Name-->
    <div class="modal fade" id="modal1">
      <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Body-->
          <div class="modal-body mb-0 p-0">
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <iframe class="embed-responsive-item" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: Name-->
    <a><img class="img-fluid" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
        data-toggle="modal" data-target="#modal1"></a>
  </div>
  <!-- Grid column -->

  <!-- Grid column -->
  <div class="col-lg-4 col-md-12 mb-4">
    <!--Modal: Name-->
    <div class="modal fade" id="modal1">
      <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Body-->
          <div class="modal-body mb-0 p-0">
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <iframe class="embed-responsive-item" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: Name-->
    <a><img class="img-fluid" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
        data-toggle="modal" data-target="#modal1"></a>
  </div>
  <!-- Grid column -->

  <!-- Grid column -->
  <div class="col-lg-4 col-md-12 mb-4">
    <!--Modal: Name-->
    <div class="modal fade" id="modal1">
      <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Body-->
          <div class="modal-body mb-0 p-0">
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <iframe class="embed-responsive-item" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: Name-->
    <a><img class="img-fluid" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
        data-toggle="modal" data-target="#modal1"></a>
  </div>
  <!-- Grid column -->

  <!-- Grid column -->
  <div class="col-lg-4 col-md-12 mb-4">
    <!--Modal: Name-->
    <div class="modal fade" id="modal1">
      <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Body-->
          <div class="modal-body mb-0 p-0">
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <iframe class="embed-responsive-item" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: Name-->
    <a><img class="img-fluid" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
        data-toggle="modal" data-target="#modal1"></a>
  </div>
  <!-- Grid column -->

  <!-- Grid column -->
  <div class="col-lg-4 col-md-12 mb-4">
    <!--Modal: Name-->
    <div class="modal fade" id="modal1">
      <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Body-->
          <div class="modal-body mb-0 p-0">
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <iframe class="embed-responsive-item" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: Name-->
    <a><img class="img-fluid" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
        data-toggle="modal" data-target="#modal1"></a>
  </div>
  <!-- Grid column -->
    </div>
    <!-- Grid row -->
  </div>
  <!-- Gallery -->

  </div>
  <br>

  <blockquote class="blockquote text-center">
  <h3 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</h3>
  <footer class="blockquote-footer mb-3">Someone famous in <cite title="Source Title">Source Title</cite></footer>
</blockquote>

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
