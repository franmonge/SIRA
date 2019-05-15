 <?php
if(isset($_POST['functionname']) && !empty($_POST["functionname"])){
  include('BD_Consultas\miembros.php');
  switch($_POST["functionname"]){
  case 'llenaDropdown':
    dropdownCarreras();
    break;
  case 'llenaDropdownGrupo':
    dropdownGrupos();
    break;
  case 'todosTabla':
    tablaTodos();
    break;
  case 'gruposTabla':
    tablaGrupos($_POST['filtro']);
    break;
  case 'carrerasTabla':
    tablaCarreras($_POST['filtro']);
    break;
  }
}
?>

 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>SIRA | Miembros</title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <?php include('headerLinks.php')?>
   <?php include('BD_Consultas\miembros.php')?>
   <script src="../js/jquery-3.3.1.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include('adminNav.php')?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Miembros</h1>
      </section>
      <section class="content">
       <div class="row">
         <div class="col-xs-12">
           <div class="box">
             <div class="box-header">
               <h3 class="box-title">Activos</h3>
             </div>
              <span style="margin-left:10px; margin-right:10px">Filtrar por:</span>
                  <select id="PrimerFiltro" name="selectPrimerFiltro">
                    <option value="Todos">Todos</option>
                    <option value="Carrera">Carrera</option>
                    <option value="Grupo">Grupo</option>
                  </select>
                  <select id="SegundoFiltro" name="selectSegundoFiltro">
                  </select>
               <div class="box-body">
                 <table id="table-Miembros" class="table table-bordered table-striped">
                   <thead>
                   <tr>
                     <th>Nombre</th>
                     <th>Apellidos</th>
                     <th>Email</th>
                     <th>Desactivar</th>
                   </tr>
                   </thead>
                   <tbody>
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
           </div>
         </div>
       </div>
     </section>
     <?php miembrosInactivos();?>
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
  var dropdown1 = document.getElementById("PrimerFiltro");
  var dropdown2 = document.getElementById("SegundoFiltro");
  var table = document.getElementById("table-Miembros");
  var tableBody = document.getElementsByTagName("tbody")[0];
  onchange1();
  // onchange2();
  dropdown1.onchange = onchange1;
  dropdown2.onchange = onchange2;

  function onchange2(){
    var segundoFiltro = dropdown2.value;
    if(dropdown1.value == "Carrera"){
      jQuery.ajax({
        type:"POST",
        url:'adminMiembros.php',
        data: {functionname:'carrerasTabla', filtro:segundoFiltro},
        success: function(data){
          data = data.split('<!DOCTYPE')[0];
          var tbody = "<tr><td>No hay miembros</td></tr>";
          if($.trim(data)){
            var tbody = data;
          }
            tableBody.innerHTML = tbody;
        }
      });
    }
    if(dropdown1.value == "Grupo"){
      jQuery.ajax({
        type:"POST",
        url:'adminMiembros.php',
        data: {functionname:'gruposTabla', filtro:segundoFiltro},
        success: function(data){
          data = data.split('<!DOCTYPE')[0];
          var tbody = "<tr><td>No hay miembros</td></tr>";
          if($.trim(data)){
            var tbody = data;
          }
            tableBody.innerHTML = tbody;
        }
      });
    }
  }

  function onchange1(){
    if(dropdown1.value == "Todos"){
      jQuery.ajax({
        type:"POST",
        url:'adminMiembros.php',
        data: {functionname:'todosTabla'},
        success: function(data){
          data = data.split('<!DOCTYPE')[0];
          var tbody = data;
          tableBody.innerHTML = tbody;
          dropdown2.innerHTML = "<option>-</option>";
        }
      });
    }
    if(dropdown1.value == "Carrera"){
      jQuery.ajax({
        type:"POST",
        url:'adminMiembros.php',
        data: {functionname:'llenaDropdown'},
        success: function(data){
          var opcionDropdown2 = "";
          data = data.split('<!DOCTYPE')[0];
          var opcionDropdown2 = "<option>-</option>"+data;
          dropdown2.innerHTML = opcionDropdown2;
        }
      });
    }
    if(dropdown1.value == "Grupo"){
      var segundoFiltro = dropdown2.value;
      jQuery.ajax({
        type:"POST",
        url:'adminMiembros.php',
        data: {functionname:'llenaDropdownGrupo'},
        success: function(data){
          var opcionDropdown2 = "";
          data = data.split('<!DOCTYPE')[0];
          var opcionDropdown2 = "<option>-</option>"+data;
          dropdown2.innerHTML = opcionDropdown2;
        }
      });
    }
  }
</script>
 </body>
 </html>