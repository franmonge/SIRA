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
    <?php include('BD_Consultas\Reportes.php')?>
    <?php include('BD_Consultas\Grupos.php')?>


    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content-header">
        <h1>Reportes generales</h1>

        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <form action="BD_Consultas\Reportes.php" method="POST">
                  <div class="modal modal-info fade" role="dialog" id="ReportePresentaciones-modal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Por favor seleccionar un año</h4>
                        </div>
                        <div class="modal-body">
                            <div class="input-group">
                              <label>Por favor seleccionar un año:</label>
                              <input type="number" style="color:black;" name="Annio" min="2019" max="2099" step="1" value="2019" placeholder="2019" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-outline" name="GenerarPresentacionesbtn" value="Generar">
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <div class="modal modal-info fade" role="dialog" id="ReporteAsistencias-modal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Por favor seleccionar un mes</h4>
                        </div>
                        <div class="modal-body">
                            <div class="input-group">
                              <label>Por favor seleccionar un mes:</label>
                              <input type="number" style="color:black;" name="mes" min="1" max="12" step="1" value="1" placeholder="1" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-outline" name="GenerarAsistenciasbtn" value="Generar">
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <div class="box-header">
                    <h3 class="box-title">Seleccione grupo: </h3>
                    <select class="form-control select2" name="group" id="GruposDisponibles" style="width: 100%;">
                      <?php dropdownGrupos()?>
                    </select>
                  </div>
                  <div class="box-body">
                    <table id = "table-Miembros" class = "table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Reportes</th>
                          <th>Generar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>Excel de becas</td>
                            <td><input type="submit" name="GenerarBecas" class="btn btn-block btn-success btn-flat" value="Descargar"></td>
                        </tr>
                        <tr>
                          <td>Asistencia mensuales</td>
                          <td><input type="button" name="GenerarAsistencias" data-target="#ReporteAsistencia-modal" data-toggle="modal" class="btn btn-block btn-success btn-flat" value="Descargar"></td>
                        </tr>
                        <tr>
                          <td>Presentaciones realizadas</td>
                          <td><input type="button" name="GenerarPresentaciones" data-target="#ReportePresentaciones-modal" data-toggle="modal" class="btn btn-block btn-success btn-flat" value="Descargar"></td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </section>
    </div>
</div>

  <!-- ./wrapper -->


  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <!-- <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
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
