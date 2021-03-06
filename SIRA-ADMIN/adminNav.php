<?php require('activeSideBar.php') ?>

<header class="main-header">
  <!-- Logo -->
  <a href="..\index.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>SIRA</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>SIRA</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../img/user.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
          </a>

          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="../img/user.png" class="img-circle" alt="User Image">
              <p><?php echo $_SESSION['nombreCompleto']; ?><small><?php echo $_SESSION['email'] ?></small></p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div>
                <a href="/SIRA/logOut.php" class="btn btn-block btn-primary btn-flat">Cerrar Sesión</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"></li>

      <li <?php echo $c; ?>>
        <a href="adminPresentaciones.php"> <i class="fa fa-calendar"></i> <span>Presentaciones</span></a>
      </li>

      <li <?php echo $b; ?>>
        <a href="adminGrupos.php"> <i class="fa fa-group"></i> <span>Grupos</span></a>
      </li>

      <li <?php echo $j; ?>>
        <a href="adminCoreografias.php"> <i class="fa fa-folder"></i> <span>Coreografías</span></a>
      </li>

      <li <?php echo $d; ?>>
        <a href="adminMiembros.php"><i class="fa fa-user"></i><span>Miembros</span></a>
      </li>

      <li <?php echo $e; ?>>
        <a href="adminSolicitudes.php"><i class="fa fa-plus"></i><span>Solicitudes</span>
          <span class="pull-right-container">
            <?php
            function getSolicitudes(){
              require('BD_Consultas/Conexion.php');
            if ($conn->connect_error){
              die("Connection failed: " . $conn->connect_error);
            }else{
              $query = "select count(*) as counter FROM usuario WHERE estado=\"Pendiente\"";
              $result = mysqli_query($conn, $query);
              $row = $result->fetch_assoc();
              $result = $row['counter'];
              $conn->close();
              if ($result != "0" ){
                echo "<span class=\"label label-primary pull-right\">$result</span>";
              }
          } }
          getSolicitudes();
          ?>
          </span>
        </a>
      </li>

      <li <?php echo $f; ?>>
        <a href="adminAsistencia.php"> <i class="fa fa-check"></i> <span>Asistencia</span></a>
      </li>

      <li <?php echo $g; ?>>
        <a href="adminReportes.php"> <i class="fa fa-file"></i> <span>Reportes</span></a>
      </li>

      <li <?php echo $h; ?>>
        <a href="adminGaleria.php"> <i class="fa fa-image"></i> <span>Galería</span></a>
      </li>

      <li <?php echo $i; ?>>
        <a href="adminAdministradores.php"> <i class="fa fa-shield"></i> <span>Administradores</span></a>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
