<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>SIRA - LogIn</title>
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
 
  <!-- Start your project here-->

  <?php include('Componentes\Navbar.php')?>
    
   <!-- Container -->
  <div class="container col-md-6">
    
 
    
    <!-- Default form login -->
<form class="text-center border border-light p-5" action="index.php" method="POST">
    <h2>Ingresa a tu cuenta</h2>
    <h5 class="card-header info-color white-text text-center py-4">
      <strong>Ingresa a tu cuenta</strong>
    </h5>
    <br>
    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" name="Usuario" placeholder="Correo Electrónico">
    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" name="Password" placeholder="Contraseña">
 
    <!-- Sign in button -->
    <div class="text-center text-md-left">
      <button type="summit" class="btn btn-info btn-block my-4">Ingresar</button>
    </div>   

    <!-- Register -->
    <p>¿No tienes cuenta? <a href="./registro.php"><b>Registrarse</b></a> </p>


</form>
<!-- Default form login -->


  <br>
  
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
