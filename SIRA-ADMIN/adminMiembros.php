<?php

function miembrosActivos(){
require('BD_Consultas\Conexion.php');
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}else{
  $query = "  SELECT id, nombre, apellidos, email FROM usuario WHERE estado='Activo'";
  $result = mysqli_query($conn, $query);
  if($result->num_rows > 0){
    $Codigo = "
     <!-- Main content -->
     <section class=\"content\">
       <div class=\"row\">
         <div class=\"col-xs-12\">
           <div class=\"box\">
             <div class=\"box-header\">
               <h3 class=\"box-title\">Activos</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">

               <table id=\"table-Miembros\" class=\"table table-bordered table-striped\">
                 <thead>
                 <tr>
                   <th>Nombre</th>
                   <th>Apellidos</th>
                   <th>Email</th>
                   <th>Desactivar</th>
                 </tr>
                 </thead>
                 <tbody>";

    while($row = $result->fetch_assoc()){
      $Codigo .= "<tr>";
      $Codigo .= "<td>".$row["nombre"]."</td>";
      $Codigo .= "<td>" .$row["apellidos"] . "</td>";
      $Codigo .= "<td>" .$row["email"] . "</td>";
      $Codigo .= "<td>" ."<form action=\"BD_Consultas\miembros.php\" method=\"post\">
      <input type=\"hidden\" name=\"deactivateId\" value=\"".$row["id"]."\" >
      <input type=\"submit\"  class=\"btn btn-block btn-primary btn-flat\" value=\"Desactivar\">
      </form></td>";
      $Codigo .= "</tr>";
    }
    $Codigo .= "
    </tbody>
      <tfoot>
        <tr>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Email</th>
          <th>Desactivar</th>
        </tr>
      </tfoot>
    </table>
    </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->";
    echo $Codigo;
  }else {
    $Codigo = " <!-- Main content -->
     <section class=\"content\">
       <div class=\"row\">
         <div class=\"col-xs-12\">
           <div class=\"box\">
             <div class=\"box-header\">
               <h3 class=\"box-title\">Activos</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">
             <h2> No hay miembros activos </h2>
             </div>
                 <!-- /.box-body -->
            </div>
             <!-- /.box -->
          </div>
             <!-- /.col -->
        </div>
             <!-- /.row -->
      </section>
             <!-- /.content -->";
             echo $Codigo;
  }
}
$conn->close();
}


function miembrosInactivos(){
require('BD_Consultas\Conexion.php');
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}else{
  $query = "  SELECT id, nombre, apellidos, email FROM usuario WHERE estado='Inactivo'";
  $result = mysqli_query($conn, $query);
  if($result->num_rows > 0){
    $Codigo = "
     <!-- Main content -->
     <section class=\"content\">
       <div class=\"row\">
         <div class=\"col-xs-12\">
           <div class=\"box\">
             <div class=\"box-header\">
               <h3 class=\"box-title\">Inactivos</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">

               <table id=\"table-Miembros\" class=\"table table-bordered table-striped\">
                 <thead>
                 <tr>
                   <th>Nombre</th>
                   <th>Apellidos</th>
                   <th>Email</th>
                   <th>Desactivar</th>
                 </tr>
                 </thead>
                 <tbody>";

    while($row = $result->fetch_assoc()){
      $Codigo .= "<tr>";
      $Codigo .= "<td>".$row["nombre"]."</td>";
      $Codigo .= "<td>" .$row["apellidos"] . "</td>";
      $Codigo .= "<td>" .$row["email"] . "</td>";
      $Codigo .= "<td>" ."<form action=\"BD_Consultas\miembros.php\" method=\"post\">
      <input type=\"hidden\" name=\"activateId\" value=\"".$row["id"]."\" >
      <input type=\"submit\"  class=\"btn btn-block btn-primary btn-flat\" value=\"Activar\">
      </form></td>";
      $Codigo .= "</tr>";
    }
    $Codigo .= "

    </tbody>
      <tfoot>
        <tr>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Email</th>
          <th>Desactivar</th>
        </tr>
      </tfoot>
    </table>
    </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->";
    echo $Codigo;
  }else {
    $Codigo = " <!-- Main content -->
     <section class=\"content\">
       <div class=\"row\">
         <div class=\"col-xs-12\">
           <div class=\"box\">
             <div class=\"box-header\">
               <h3 class=\"box-title\">Inactivos</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">
             <h2> No hay miembros inactivos </h2>
             </div>
                 <!-- /.box-body -->
            </div>
             <!-- /.box -->
          </div>
             <!-- /.col -->
        </div>
             <!-- /.row -->
      </section>
             <!-- /.content -->";
             echo $Codigo;
  }
}
$conn->close();
}
?>



 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>SIRA | Miembros</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <?php include('headerLinks.php')?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include('adminNav.php')?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content-header">
        <h1>Miembros</h1>
      </section>

       <?php miembrosActivos();
             miembrosInactivos();?>
    </div>
  <!-- ./wrapper -->

  <?php include('adminFooter.php')?>

  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- page script -->
  <script>
  $(function () {
    $('#example1').DataTable()
    $('#table-Miembros').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
  </script>
 </body>
 </html>
