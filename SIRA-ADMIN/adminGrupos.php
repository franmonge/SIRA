
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>SIRA | Grupos</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <?php include('headerLinks.php')?>
   <?php include('BD_Consultas\Grupos.php')?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include('adminNav.php')?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <?php getGrupos(); ?>

      <section class="content-header">
        <h1>Crear Nuevo Grupo</h1>
      </section>

      <div class="content-header">
        
      
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ingrese los datos solicitados</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="form-grupos" action="BD_Consultas\Grupos.php" method="POST">
          <div class="box-body">         
            <div class="form-group ">
              <label for="exampleInputEmail1">Nombre</label>
              <input type="text" class="form-control" placeholder="Nombre" name="NombreGrupo">
            </div>
            <div class="form-group">
              <label>Descripción</label>
              <textarea class="form-control" rows="3" placeholder="Descripción" name="DescripcionGrupo"></textarea>
            </div>
            <div class="form-group">
              <label>Historia</label>
              <textarea class="form-control" rows="3" placeholder="Historia" name="HistoriaGrupo"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Imagen</label>
              <input type="file" id="exampleInputFile" name="ImagenGrupo">
            </div> 
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="btnCrearGrupo">Crear Grupo</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
      </div>

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
