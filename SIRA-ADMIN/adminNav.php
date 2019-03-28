<?php require('activeSideBar.php') ?>


<header class="main-header">
  <!-- Logo -->
  <a href="admin.php" class="logo">
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
            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs">Marvin Santos</span>
          </a>

          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              <p>Marvin Santos - Web Developer<small>Member since Nov. 2012</small></p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="/SIRA-ADMIN/pages/examples/profile.php" class="btn btn-default btn-flat">Mi Perfil</a>
              </div>
              <div class="pull-right">
                <a href="/SIRA/logOut.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
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

      <li <?php echo $a; ?>>
        <a href="admin.php"> <i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li>

      <li <?php echo $b; ?>>
        <a href="adminGrupos.php"> <i class="fa fa-group"></i> <span>Grupos</span></a>
      </li>

      <li <?php echo $c; ?>>
        <a href="adminPresentaciones.php"> <i class="fa fa-calendar"></i> <span>Presentaciones</span></a>
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
        <a href="#"> <i class="fa fa-check"></i> <span>Asistencia</span></a>
      </li>

      <li <?php echo $g; ?>>
        <a href="#"> <i class="fa fa-file"></i> <span>Reportes</span></a>
      </li>

      <li <?php echo $h; ?>>
        <a href="#"> <i class="fa fa-image"></i> <span>Galería</span></a>
      </li>

      <li <?php echo $i; ?>>
        <a href="adminAdministradores.php"> <i class="fa fa-shield"></i> <span>Administradores</span></a>
      </li>

      <li>
        <a href="pages/UI/icons.html">
          <i class="fa fa-laptop"></i>
          <span>UI Elements</span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Examples</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
          <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
