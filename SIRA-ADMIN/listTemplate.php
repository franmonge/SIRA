<?php
function tipoSangre(){
require('Conexion.php');
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}else{
  $query = "SELECT id, tipoSangre FROM tiposangre";
  $result = mysqli_query($conn, $query);
  if($result->num_rows > 0){
    $Codigo = "
    <!-- Content Header (Page header) -->
    <section class=\"content-header\">
       <h1>Tipo de Sangre</h1>
     </section>
     <!-- Main content -->
     <section class=\"content\">
       <div class=\"row\">
         <div class=\"col-xs-12\">
           <div class=\"box\">
             <div class=\"box-header\">
               <h3 class=\"box-title\">Miembros</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">
               <table id=\"table-Miembros\" class=\"table table-bordered table-striped\">
                 <thead>
                 <tr>
                   <th>ID</th>
                   <th>Tipo de Sangre</th>
                 </tr>
                 </thead>
                 <tbody>";
    while($row = $result->fetch_assoc()){
      $Codigo .= "<tr>";
      $Codigo .= "<td>".$row["id"]."</td>";
      $Codigo .= "<td>" .$row["tipoSangre"] . "</td>";
      $Codigo .= "</tr>";
    }
    $Codigo .= "
    </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Tipo de Sangre</th>
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
   <title>AdminLTE 2 | Data Tables</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <!-- Bootstrap 3.3.7 -->
   <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
   <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
   <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->

   <!-- Google Font -->
   <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 </head>
 <body class="hold-transition skin-blue sidebar-mini">
  <?php include('adminNav.php')?>
 <div class="wrapper">


   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">

     <!-- Main content -->
     <?php tipoSangre(); ?>
     <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
   <?php include('adminFooter.php')?>


   <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

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
