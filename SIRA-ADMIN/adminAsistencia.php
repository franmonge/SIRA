 <?php
  if(isset($_POST['functionname']) && !empty($_POST["functionname"])){
    include('BD_Consultas\Asistencia.php');
    switch($_POST["functionname"]){
      case 'llenaTablasPresente':
        consigueEnsayo($_POST['grupo'], $_POST['fecha']);
        break;
      case 'llenaTablasAusente':
        consigueEnsayoAusentes($_POST['grupo'], $_POST['fecha']);
        break;
      case 'ponerPresente':
        presente($_POST['idUsuario'], $_POST['idEnsayo']);
        break;
      case 'ponerAusente':
        ausente($_POST['idUsuario'], $_POST['idEnsayo']);
        break;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>SIRA | Asistencia</title>
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
      <!-- <form action="BD_Consultas\Asistencia.php" method="POST">       -->
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Seleccione el grupo</label>
              <select class="form-control select2" name="ensayo" id="Grupo">
                <?php dropdownGrupos()?>
              </select>
          </div>
          <div class="form-group col-md-6">
            <label>Seleccione la fecha</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" id="Fecha" name="FechaCreacion" class="form-control" required/>
          </div>
        </div>
        <input type="submit" class="btn btn-info btn-flat col-md-4" id="btnConsultarEnsayo" value="Consultar Ensayo">
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
                        <th>Presentes</th>
                      </tr>
                    </thead>
                  <tbody id="tbodyPresentes">
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
                      <th>Ausentes</th>
                    </tr>
                    </thead>
                    <tbody id="tbodyAusentes">
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
      <!-- </form> -->
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
  <script>
    document.getElementById("btnConsultarEnsayo").addEventListener("click", consultar);
    var tablePresentes = document.getElementById("table-Miembros-Presentes").getElementsByTagName('tbody')[0];
    var tableAusentes = document.getElementById("table-Miembros-Ausentes").getElementsByTagName('tbody')[0];

    function consultar(){
      var idGrupo = document.getElementById("Grupo").value;
      var fecha = document.getElementById("Fecha").value;
      jQuery.ajax({
        type:"POST",
        url:'adminAsistencia.php',
        data: {functionname:'llenaTablasPresente', grupo: idGrupo, fecha: fecha},
        success: function(data){
          data = data.split('<!DOCTYPE')[0];
          var tbody = data;
          tablePresentes.innerHTML = tbody;
        }
      });
      jQuery.ajax({
        type:"POST",
        url:'adminAsistencia.php',
        data: {functionname:'llenaTablasAusente', grupo: idGrupo, fecha: fecha},
        success: function(data){
          data = data.split('<!DOCTYPE')[0];
          var tbody = data;
          tableAusentes.innerHTML = tbody;
        }
      });
    }

    function recargaTabla(idBtn){
      idBtn = idBtn.split('onclick=')[0];
      var btnEnsayo = 'idEnsayoAusente'+idBtn;
      var ensayoId = document.getElementById(btnEnsayo).value;
      jQuery.ajax({
      type:"POST",
      url:'adminAsistencia.php',
      data: {functionname:'ponerPresente', idUsuario: idBtn, idEnsayo: ensayoId},
      success: function(data){
        $("#tbodyPresentes").empty();
        $("#tbodyAusentes").empty();
        consultar();
        $("#tbdoyPresentes").html(result);
        $("#tbodyAusentes").html(result);
      }
    });
  }

  function recargaTablaAusente(idBtn){
    idBtn = idBtn.split('onclick=')[0];
    var btnEnsayo = 'idEnsayoPresente'+idBtn;
    var ensayoId = document.getElementById(btnEnsayo).value;
    jQuery.ajax({
      type:"POST",
      url:'adminAsistencia.php',
      data: {functionname:'ponerAusente', idUsuario: idBtn, idEnsayo: ensayoId},
      success: function(data){
        $("#tbodyPresentes").empty();
        $("#tbodyAusentes").empty();
        consultar();
        $("#tbdoyPresentes").html(result);
        $("#tbodyAusentes").html(result);
      }
    });
  }
  </script>
</body>
</html>
