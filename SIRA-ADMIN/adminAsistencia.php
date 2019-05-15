<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>SIRA | Asistencia</title>
 <!-- Tell the browser to be responsive to screen width -->
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

 <?php include('headerLinks.php')?>
 <?php include('BD_Consultas\Grupos.php')?> 
 <?php include('BD_Consultas\Asistencia.php')?>
 
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include('adminNav.php')?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Asistencia</h1>
      </section>
      <form action="BD_Consultas\Asistencia.php" method="POST">      
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Seleccione el grupo</label>
              <select class="form-control select2" name="ensayo" id="Grupos">
                <?php dropdownGrupos()?>
              </select>
          </div>
          <div class="form-group col-md-6">
            <label>Seleccione la fecha</label>
            <input type="date" id="FechaNacimiento" name="FechaNacimientoRegistro" class="form-control" required/>
          </div>
        </div>
        <input type="submit" class="btn btn-info btn-flat col-md-4" value="Consultar Ensayo">
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Presentes</h3>
                </div>
                <div class="box-body">
                  <table id="table-Miembros-Presentes" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Ausentes</th>
                      </tr>
                    </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      <th>Ausentes</th>
                    </tr>
                  </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Ausentes</h3>
                </div>
                <div class="box-body">
                  <table id="table-Miembros-Ausentes" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      <th>Presentes</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      <th>Presentes</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </form>
    </div>

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
      $('#table-Miembros-Presentes').DataTable({
        'paging'      : false,
        'lengthChange': true,
        'searching'   : false,
        'ordering'    : false,
        'info'        : false,
        'autoWidth'   : true
      })
      $('#table-Miembros-Ausentes').DataTable({
        'paging'      : false,
        'lengthChange': true,
        'searching'   : false,
        'ordering'    : false,
        'info'        : false,
        'autoWidth'   : true
      })
    })
  </script>
</body>
</html>
