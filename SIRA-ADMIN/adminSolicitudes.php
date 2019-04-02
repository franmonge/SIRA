<?php
  function solicitudesPendientes(){
  require('BD_Consultas\Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "  SELECT id, nombre, apellidos, email FROM usuario WHERE estado='Pendiente'";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      $Codigo = "
       <!-- Main content -->
       <section class=\"content\">
         <div class=\"row\">
           <div class=\"col-xs-12\">
             <div class=\"box\">
               <div class=\"box-body\">
                 <table id=\"table-Solicitudes\" class=\"table table-bordered table-striped\">
                   <thead>
                     <tr>
                       <th>Nombre</th>
                       <th>Apellidos</th>
                       <th>Email</th>
                       <th>Grupo</th>
                       <th>Opciones</th>
                     </tr>
                     </thead>
                     <tbody>";
      while($row = $result->fetch_assoc()){
        $Codigo .= "<tr>";
        $Codigo .= "<td>" .$row["nombre"] . "</td>";
        $Codigo .= "<td>" .$row["apellidos"] . "</td>";
        $Codigo .= "<td>" .$row["email"] . "</td>";
        $Codigo .= "<form action=\"BD_Consultas\miembros.php\" method=\"post\">";
        $Codigo .= "<td><select  name=\"Grupos\" id=\"Grupos\">";
        $Codigo .= dropdownGrupos();
        $Codigo .= "</select></td>";
        $Codigo .= "<td>" .
                    "<div class=\"input-group-btn\">
                        <input type=\"hidden\" name=\"acceptId\" value=\"".$row["id"]."\" >
                        <input type=\"submit\"  class=\"btn btn-block btn-success btn-flat\" value=\"Aceptar\">
                      </form>
                      <form action=\"BD_Consultas\miembros.php\" method=\"post\">
                        <input type=\"hidden\" name=\"rejectId\" value=\"".$row["id"]."\" >
                        <input type=\"submit\"  class=\"btn btn-block btn-danger btn-flat\" value=\"Rechazar\">
                      </form>
                    </div>"
                  . "</td>";
        $Codigo .= "</tr>";
      }
      $Codigo .= "
      </tbody>
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
               <div class=\"box-body\">
               <h2> No hay solicitudes pendientes </h2>
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

  function dropdownGrupos(){
    $out = "";
    require('BD_Consultas\Conexion.php');
    if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }else{
      $sql = "SELECT Nombre FROM grupo";
      $result = mysqli_query($conn, $sql);
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $out .= "<option>" .$row['Nombre']."</option>";
        }
      }else{
        $out .= "<option>No hay grupos</option>";
      }
    $conn->close();
    }
    return $out;
  }
?>

<!-- class=\"browser-default custom-select\" -->

 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>SIRA | Solicitudes</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <?php include('headerLinks.php')?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include('adminNav.php')?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
          <h1>Solicitudes de Miembros</h1>
        </section>
       <?php solicitudesPendientes(); ?>
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
    $('#table-Solicitudes').DataTable({
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
