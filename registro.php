<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>SIRA - Registro</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>
  <?php include('BD_Consultas\registrar.php')?>
</head>

<body>

  <!-- Start your project here-->

  <?php include('Componentes\Navbar.php')?>  
    
   <!-- Container -->
  <div class="container">
    
    <br>
    <h2>Por favor ingrese sus datos</h2>
    <br>
    <!-- Extended default form grid -->
<form id="form-registro" action="BD_Consultas\registrar.php" method="POST">  
  <!-- Grid row -->
  <div class="form-row">
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nombre</label>
      <input type="text" class="form-control" id="Nombre" name="NombreRegistro" placeholder="Nombre" required/>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Apellidos</label>
      <input type="text" class="form-control" id="Apellidos" name="ApellidosRegistro" placeholder="Apellidos" required/>
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="Email" name="EmailRegistro" placeholder="Email" required/>
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Contraseña</label>
      <input type="password" class="form-control" id="Password" name="PasswordRegistro" placeholder="Password" required/>
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Pasaporte</label>
      <input type="text" class="form-control" id="Pasaporte" name="PasaporteRegistro" placeholder="Pasaporte" required/>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Fecha de Vencimiento </label>
      <input type="month" class="form-control" name="start" min="2019-01" max="2080-01" value="2019-04" id="FechaVencimiento" name="FechaVencimientoRegistro" required/>
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">
    <!-- Default input -->
    <div class="form-group col-md-4">
      <label for="inputEmail4">Fecha de Nacimiento</label>
      <input type="date" id="FechaNacimiento" name="FechaNacimientoRegistro" class="form-control" required/>

      <!-- <input type="email" class="form-control" id="inputEmail4" placeholder="Fecha de Nacimiento"> -->
    </div>
    <!-- Default input -->
    <div class="form-group col-md-4">
      <label for="inputPassword4">Teléfono Celular</label>
      <input type="text" class="form-control" id="TelefonoCelular" name="TelefonoCelularRegistro" placeholder="Teléfono Celular" required/>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-4">
      <label for="inputPassword4">Teléfono Domicilio</label>
      <input type="text" class="form-control" id="TelefonoDomicilio" name="TelefonoDomicilioRegistro" placeholder="Teléfono Domicilio" required/>
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Carrera</label>
      <select class="browser-default custom-select" name="CarreraRegistro" id="Carrera" required/>
        <?php dropdownCarreras()?>
      </select>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-6">
      <label for="inputPassword4">Tipo de Sangre</label>
      <select class="browser-default custom-select" name="TipoSangreRegistro" id="TipoSangre" required/>
        <?php dropdownTiposSanges()?>
      </select>
    </div>
  </div>
  <!-- Grid row -->

  <!-- Default input -->
  <div class="form-group">
    <label for="inputAddress">Carnet</label>
    <input type="text" class="form-control" id="Carnet" name="CarnetRegistro" placeholder="Carnet" required/>
  </div>
  <!-- Default input -->
  <div class="form-group">
    <label for="inputAddress">Dirección de Domicilio</label>
    <input type="text" class="form-control" id="DireccionDomicilio" name="DireccionDomicilioRegistro" placeholder="Dirección de Domicilio" required/>
  </div>
  <!-- Default input -->
  <div class="form-group">
    <label for="inputAddress">Dirección de Tiempo Lectivo</label>
    <input type="text" class="form-control" id="DireccionLectiva" name="DireccionLectivaRegistro" placeholder="Dirección de Tiempo Lectivo" required/>
  </div>  
  <div class="form-row">
  <!-- Default input -->
  <div class="form-group col-md-3">
    <label for="inputAddress">Estatura (metros)</label>
    <input type="Number" step="0.01" class="form-control" value="1.0" id="Estatura" name="EstaturaRegistro" placeholder="Estatura (metros)" required/>
  </div>
  <!-- Default input -->
  <div class="form-group col-md-3">
    <label for="inputAddress">Talla de Calzado</label>
    <input type="Number" step="0.01" class="form-control" id="TallaCalzado" name="TallaCalzadoRegistro" placeholder="Talla de Calzado" required/>
  </div>
  <!-- Default input -->
  <div class="form-group  col-md-3">
    <label for="inputAddress">Talla de Blusa/Camisa</label>
    <select class="browser-default custom-select" name="TallaBlusaRegistro" id="TallaBlusa" required>
      <option>XL</option>
      <option>L</option>
      <option>M</option>
      <option>S</option>
      <option>XS</option>
    </select>
  </div>
  <!-- Default input -->
  <div class="form-group  col-md-3">
    <label for="inputAddress">Talla de Pantalón</label>
    <input type="Number" step="0.01" class="form-control" id="TallaPantalon" name="TallaPantalonRegistro" placeholder="Talla de Pantalón" required/>
  </div>
  </div>
  <!-- Default input -->
  <div class="form-group">
    <label for="inputAddress">Enfermedades</label>
    <input type="text" class="form-control" id="Enfermedades" name="EnfermedadesRegistro">
  </div>
  <!--Material textarea-->
  <div class="form-group">
    <label for="inputAddress">Observaciones</label>
    <textarea class="form-control" rows="4" cols="50" id="Observaciones" name="ObservacionesRegistro"></textarea>
  </div>
  
  <div class="container flex-center">
    <button type="submit" class="btn btn-dark btn-block btn-md" name="btnRegistrar">Registrarme</button>
  </div>
</form>
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