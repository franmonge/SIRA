<?php
  function getAdministradores(){
  require('BD_Consultas\Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "SELECT usuario.id, nombre, apellidos, email FROM usuario INNER JOIN administrador ON usuario.id = administrador.id_Usuario";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      $Codigo = "
       <!-- Main content -->
       <section class=\"content\">
         <div class=\"row\">
           <div class=\"col-xs-12\">
             <div class=\"box\">
               <div class=\"box-body\">
                 <table id=\"table-Administradores\" class=\"table table-bordered table-striped\">
                   <thead>
                   <tr>
                     <th>Nombre</th>
                     <th>Apellidos</th>
                     <th>Email</th>
                     <th>Opciones</th>
                   </tr>
                   </thead>
                   <tbody>";
      while($row = $result->fetch_assoc()){
        $Codigo .= "<tr>";
        $Codigo .= "<td>" .$row["nombre"] . "</td>";
        $Codigo .= "<td>" .$row["apellidos"] . "</td>";
        $Codigo .= "<td>" .$row["email"] . "</td>";
        $Codigo .= "<td>" .
                    "<div class=\"input-group-btn\">
                      <form action=\"BD_Consultas\miembros.php\" method=\"post\">
                        <input type=\"hidden\" name=\"removeAdmin\" value=\"".$row["id"]."\" >
                        <input type=\"submit\"  class=\"btn btn-block btn-warning btn-flat\" value=\"Eliminar\">
                      </form>
                    </div>"
                  . "</td>";
        $Codigo .= "</tr>";
      }
      $Codigo .= "
      </tbody>
        <tfoot>
          <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Opciones</th>
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
               <div class=\"box-body\">
               <h2> No hay administradores </h2>
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

  function getNoAdmin(){
  require('BD_Consultas\Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "SELECT usuario.id, nombre, apellidos, email FROM usuario WHERE usuario.ID NOT IN (SELECT id_Usuario FROM administrador)
                 AND usuario.Estado = 'Activo'";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      $Codigo = "
       <!-- Main content -->
       <section class=\"content\">
         <div class=\"row\">
           <div class=\"col-xs-12\">
             <div class=\"box\">
               <div class=\"box-body\">
                 <table id=\"table-Administradores\" class=\"table table-bordered table-striped\">
                   <thead>
                   <tr>
                     <th>Nombre</th>
                     <th>Apellidos</th>
                     <th>Email</th>
                     <th>Opciones</th>
                   </tr>
                   </thead>
                   <tbody>";
      while($row = $result->fetch_assoc()){
        $Codigo .= "<tr>";
        $Codigo .= "<td>" .$row["nombre"] . "</td>";
        $Codigo .= "<td>" .$row["apellidos"] . "</td>";
        $Codigo .= "<td>" .$row["email"] . "</td>";
        $Codigo .= "<td>" .
                    "<div class=\"input-group-btn\">
                      <form action=\"BD_Consultas\miembros.php\" method=\"post\">
                        <input type=\"hidden\" name=\"addAdmin\" value=\"".$row["id"]."\" >
                        <input type=\"submit\"  class=\"btn btn-block btn-info btn-flat\" value=\"Agregar\">
                      </form>
                    </div>"
                  . "</td>";
        $Codigo .= "</tr>";
      }
      $Codigo .= "
      </tbody>
        <tfoot>
          <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Opciones</th>
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
               <div class=\"box-body\">
               <h2> No hay más miembros </h2>
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
       <section class=\"content-header\">
          <h1>Administradores</h1>
        </section>
        <?php getAdministradores();
              getNoAdmin();
        ?>
        <section class=\"content\">
          <div class=\"row\">
            <div class=\"col-xs-12\">
              <div class=\"box\">
                <div class=\"box-body\">

                </div>
             </div>
            </div>
          </div>
        </section>

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
    $('#table-Administradores').DataTable({
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
