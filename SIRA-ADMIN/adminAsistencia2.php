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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content-header">
        <h1>Asistencia</h1>
      </section>

      <!-- Main content -->
      <form action="BD_Consultas\Asistencia.php" method="POST">
        <div class="col-md-12">
          <div class="form-group col-md-6">
            <label>Seleccione el grupo</label>
            <div class="row">
              <div class="col-md-8">
                <select class="form-control select2" name="ensayo" id="Grupos">
                  <?php dropdownGrupos()?>
                </select>
              </div>
              <input type="submit" class="btn btn-info btn-flat col-md-4" value="Crear Ensayo">
            </div>
          </div>
        </div>
      </form>

      <?php
        if (isset($_SESSION["CargarEstudiantes"]) && !empty($_SESSION["CargarEstudiantes"])) {
          miembrosPresentes($_SESSION["CargarEstudiantes"]);
          miembrosAusentes($_SESSION["CargarEstudiantes"]);
        }
      ?>
    </div>


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
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      })
      $('#table-Miembros-Ausentes').DataTable({
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
