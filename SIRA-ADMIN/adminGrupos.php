
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
      <?php include('adminNav.php')?>


      <div class="modal modal-info fade" role="dialog"  id="editGroup-modal">
          <!-- <form action="adminGrupos.php" method="POST" enctype="multipart/form-data"> -->
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Presentación</h4>
                  </div>
                  <div class="modal-body">
                      <div class="input-group">
                          <input id="inName" type="text"   class="form-control" name="inGroupName"   placeholder="Nombre" required>
                          <textarea id="inDescription" rows="4"   class="form-control" name="inGroupDetail" placeholder="Descripción" style="resize: none;"   required></textarea>
                          <textarea id="inHistory" rows="4"   class="form-control" name="inGroupHistory" placeholder="Historia" style="resize: none;"   required></textarea>
                          <input type="file" name="inFileToUpload" id="inFileToUpload">
                          <input type="hidden" name="inGroupId" id="inGroupId">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Guardar</button>
                    <!-- <input type="submit" class="btn btn-outline" name="ACTION" value="Guardar" > -->
                 </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          <!-- </form> -->
        </div>
        <!-- /.modal -->



<div class="wrapper">
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
        <form role="form" id="form-grupos" action="BD_Consultas\Grupos.php" method="POST" enctype="multipart/form-data">
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
              <input type="file" name="fileToUpload" id="fileToUpload" required>
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
      function loadEdit(id){
          $("#inName").val(document.getElementById('name'+id).innerHTML);
          $("#inDescription").val(document.getElementById('description'+id).innerHTML);
          $("#inHistory").val(document.getElementById('history'+id).innerHTML);
          $("#inGroupId").val(id);
          $("#editGroup-modal").modal('show');

      }
  </script>
  <script>
  $(function () {
    $('#example1').DataTable()
    $('#table-Miembros').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    })
  })
  </script>
 </body>
 </html>
