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

  <!-- Start your project here-->

  <!--Navbar -->
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="./index.html"><b><h2>SIRA</h2></b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
      aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarButtons">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="./index.html"><b>Inicio</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./grupos.html"><b>Grupos</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./presentaciones.html"><b>Presentaciones</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./galeria.html"><b>Galería</b></a>
        </li>
      </ul>
      <li class="navbar-nav ml-auto nav-flex-icons active">
        <a class="fas fa-user" href="./sesion.html"><b>  Iniciar Sesión</b></a>
      </li>
    </div>
  </nav>
  <!--/.Navbar -->  
    
   <!-- Container -->
  <div class="container">
    
    <br>
    <h2>Por favor ingrese sus datos</h2>
    <br>
    <!-- Extended default form grid -->
<form>  
  <!-- Default input -->
  <div class="form-row ">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Grupo al que solicita ingreso</label>
      <select class="browser-default custom-select">
        <option selected>Grupo al que solicita ingreso</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>
  </div>

  <!-- Grid row -->
  <div class="form-row">
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nombre</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Nombre">
    </div>
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Apellidos</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Apellidos">
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Pasaporte</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Pasaporte">
    </div>
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Fecha de Vencimiento </label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Fecha de Vencimiento">
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">
    <!-- Default input -->
    <div class="form-group col-md-4">
      <label for="inputEmail4">Fecha de Nacimiento</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Fecha de Nacimiento">
    </div>
    <!-- Default input -->
    <div class="form-group col-md-4">
      <label for="inputPassword4">Teléfono Celular</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Teléfono Celular">
    </div>
    <!-- Default input -->
    <div class="form-group col-md-4">
      <label for="inputPassword4">Teléfono Domicilio</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Teléfono Domicilio">
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Carrera</label>
      <select class="browser-default custom-select">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Tipo de Sangre</label>
      <select class="browser-default custom-select">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>
  </div>
  <!-- Grid row -->

  <!-- Default input -->
  <div class="form-group">
    <label for="inputAddress">Dirección de Domicilio</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Dirección de Domicilio">
  </div><!-- Default input -->
  <div class="form-group">
    <label for="inputAddress">Dirección de Tiempo Lectivo</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Dirección de Tiempo Lectivo">
  </div>  
  <div class="form-row">
  <!-- Default input -->
  <div class="form-group col-md-3">
    <label for="inputAddress">Estatura (metros)</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Estatura (metros)">
  </div>
  <!-- Default input -->
  <div class="form-group col-md-3">
    <label for="inputAddress">Talla de Calzado</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Talla de Calzado">
  </div>
  <!-- Default input -->
  <div class="form-group  col-md-3">
    <label for="inputAddress">Talla de Blusa/Camisa</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Talla de Blusa/Camisa">
  </div>
  <!-- Default input -->
  <div class="form-group  col-md-3">
    <label for="inputAddress">Talla de Pantalón</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Talla de Pantalón">
  </div>
  </div>
  <!-- Default input -->
  <div class="form-group">
    <label for="inputAddress">Enfermedades</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Enfermedades">
  </div>
  <!--Material textarea-->
  <label for="inputAddress">Observaciones</label>
  <div class="md-form md-outline">    
    <textarea id="form75" class="form-control" rows="3" placeholder="Observaciones"></textarea>
  </div>
  <div class="container flex-center">
    <button type="submit" class="btn btn-dark btn-block btn-md">Registrarme</button>
  </div>
</form>
<!-- Extended default form grid -->


<br>


  <br>
  
  </div>
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
