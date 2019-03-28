<?php
  if(isset($_SESSION['user'])){
    echo
  "<!--Navbar -->
  <nav class=\"mb-1 navbar navbar-expand-lg navbar-dark\">
    <a class=\"navbar-brand\" href=\"./index.php\"><b><h2>SIRA</h2></b></a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent-333\"
      aria-controls=\"navbarSupportedContent-333\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>

    <div class=\"collapse navbar-collapse\" id=\"navbarButtons\">
      <ul class=\"navbar-nav ml-auto\">
        <li class=\"nav-item active\">
          <a class=\"nav-link\" href=\"./index.php\"><b>Inicio</b>
            <span class=\"sr-only\">(current)</span>
          </a>
        </li>
        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"./grupos.php\"><b>Grupos</b></a>
        </li>
        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"./presentaciones.php\"><b>Presentaciones</b></a>
        </li>
        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"./galeria.php\"><b>Galería</b></a>
        </li>
        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"./galeria.php\"><b>Administrador</b></a>
        </li>
      </ul>

      <li class=\"navbar-nav ml-auto nav-flex-icons\">
        <a class=\"fas fa-user\" href=\"./logOut.php\" ><b> Cerrar Sesión</b></a>
      </li>
    </div>
  </nav>
  <!--/.Navbar -->
  ";
  }else{
  echo
  "<!--Navbar -->
  <nav class=\"mb-1 navbar navbar-expand-lg navbar-dark\">
    <a class=\"navbar-brand\" href=\"./index.php\"><b><h2>SIRA</h2></b></a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent-333\"
      aria-controls=\"navbarSupportedContent-333\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>

    <div class=\"collapse navbar-collapse\" id=\"navbarButtons\">
      <ul class=\"navbar-nav ml-auto\">
        <li class=\"nav-item active\">
          <a class=\"nav-link\" href=\"./index.php\"><b>Inicio</b>
            <span class=\"sr-only\">(current)</span>
          </a>
        </li>
        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"./grupos.php\"><b>Grupos</b></a>
        </li>
        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"./presentaciones.php\"><b>Presentaciones</b></a>
        </li>
        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"./galeria.php\"><b>Galería</b></a>
        </li>
      </ul>

      <li class=\"navbar-nav ml-auto nav-flex-icons\">
        <a class=\"fas fa-user\" href=\"./logIn.php\"><b>  Iniciar Sesión</b></a>
      </li>
    </div>
  </nav>
  <!--/.Navbar -->
  ";
  }
  ?>