<?php

function ausente($UserId, $EnsayoId){
  require('Conexion.php'); 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE asistenciaensayos as A INNER JOIN ensayo as E SET estado = 'Ausente' WHERE A.idPersona = '$UserId' AND A.id = '$EnsayoId'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminAsistencia.php"); /* Redirect browser */
  exit();
}
}

function presente($UserId,$EnsayoId){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE asistenciaensayos as A INNER JOIN ensayo as E SET estado = 'Presente' WHERE A.idPersona = '$UserId' AND A.id = '$EnsayoId'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminAsistencia.php"); /* Redirect browser */
  exit();
}
}


function crearEnsayo($idGrupo,$fecha){
  require('Conexion.php');
  require('..\..\sesion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
  $query = "INSERT INTO ensayo(idGrupo, fecha) VALUES ('$idGrupo','$fecha')";
  $result = mysqli_query($conn, $query);

  $query2 = "SELECT id FROM ensayo WHERE idGrupo = '$idGrupo' AND fecha = '$fecha'";
  $result2 = mysqli_query($conn, $query2);
  $row2 = $result2->fetch_array(MYSQLI_NUM);
  $idEnsayo = $row2[0];

  $query3 = "SELECT U.id FROM usuario as U INNER JOIN uxg as A ON u.id = a.id_Usuario where U.estado='Activo' and a.id_Grupo = '$idGrupo'";
  $result3 = mysqli_query($conn, $query3);

  if($result3->num_rows > 0){
    while($row = $result3->fetch_assoc()){
      $x = $row['id'];

    echo "alert('$x')";
      $query4 = "INSERT INTO asistenciaensayos(idEnsayo, idPersona, Estado) VALUES ('$idEnsayo', '$x','Presente')";
      $result4 = mysqli_query($conn, $query4);
    }
  }else{
    echo "<option>Error en crearEnsayo a partir query3</option>";
  }
  $conn->close();
  $_SESSION["CargarEstudiantes"] = $idGrupo;
  header("Location: ..\adminAsistencia.php"); /* Redirect browser */
  }
}

function getEnsayoId($idGrupo, $fecha){
  require('Conexion.php');
  require('..\..\sesion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "SELECT id FROM ensayo WHERE idGrupo = '$idGrupo' AND fecha = '$fecha'";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_array(MYSQLI_NUM);
    $idEnsayo = $row[0];
    return $idEnsayo;
  }
}

if (!empty($_POST["ensayo"])) {
    $idGrupo = filter_input(INPUT_POST, 'ensayo');
    $fecha = date("Y/m/d");
    crearEnsayo($idGrupo,$fecha);
} 

if (!empty($_POST["IdAusente"])) {
    require('..\..\sesion.php');
    $fecha = date("Y/m/d");
    $uId = filter_input(INPUT_POST, 'IdAusente');
    ausente($uId,getEnsayoId($_SESSION["CargarEstudiantes"],$fecha));
} 

if (!empty($_POST["IdPresente"])) {
    require('..\..\sesion.php');
    $uId = filter_input(INPUT_POST, 'IdPresente');    
    presente($uId,$_SESSION["CargarEstudiantes"]);
} 


function miembrosPresentes($idGrupo){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "SELECT U.id, U.nombre, U.apellidos, U.email FROM usuario as U INNER JOIN uxg as A INNER JOIN asistenciaensayos as E WHERE U.estado='Activo' AND U.id = A.id AND A.id_Grupo = '$idGrupo' AND E.Estado = 'Presente'";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      $Codigo = "
      <section class=\"content\">
      <div class=\"row\">
      <div class=\"col-xs-12\">
      <div class=\"box\">
      <div class=\"box-header\">
      <h3 class=\"box-title\">Presentes</h3>
      </div>
      <!-- /.box-header -->
      <div class=\"box-body\">
      <table id=\"table-Miembros-Presentes\" class=\"table table-bordered table-striped\">
      <thead>
      <tr>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Email</th>
      <th>Ausentes</th>
      </tr>
      </thead>
      <tbody>";

      while($row = $result->fetch_assoc()){
        $Codigo .= "<tr>";
        $Codigo .= "<td>".$row["nombre"]."</td>";
        $Codigo .= "<td>" .$row["apellidos"] . "</td>";
        $Codigo .= "<td>" .$row["email"] . "</td>";
        $Codigo .= "<td>" ."<form action=\"BD_Consultas\Asistencia.php\" method=\"post\">
        <input type=\"hidden\" name=\"IdAusente\" value=\"".$row["id"]."\" >
        <input type=\"submit\"  class=\"btn btn-block btn-danger btn-flat\" value=\"Ausente\">
        </form></td>";
        $Codigo .= "</tr>";
      }
      $Codigo .= "
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
      $Codigo = "<section class=\"content\">
      <div class=\"row\">
      <div class=\"col-xs-12\">
      <div class=\"box\">
      <div class=\"box-header\">
      <h3 class=\"box-title\">Presentes</h3>
      </div>
      <!-- /.box-header -->
      <div class=\"box-body\">
      <h2> No hay miembros presentes</h2>
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


function miembrosAusentes($idGrupo){
  require('BD_Consultas\Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "SELECT U.id, U.nombre, U.apellidos, U.email FROM usuario as U INNER JOIN uxg as A INNER JOIN asistenciaensayos as E WHERE U.estado='Activo' AND U.id = A.id AND A.id_Grupo = '$idGrupo' AND E.Estado = 'Ausente'";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      $Codigo = "
      <!-- Main content -->
      <section class=\"content\">
      <div class=\"row\">
      <div class=\"col-xs-12\">
      <div class=\"box\">
      <div class=\"box-header\">
      <h3 class=\"box-title\">Ausentes</h3>
      </div>
      <!-- /.box-header -->
      <div class=\"box-body\">

      <table id=\"table-Miembros-Ausentes\" class=\"table table-bordered table-striped\">
      <thead>
      <tr>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Email</th>
      <th>Presentes</th>
      </tr>
      </thead>
      <tbody>";

      while($row = $result->fetch_assoc()){
        $Codigo .= "<tr>";
        $Codigo .= "<td>".$row["nombre"]."</td>";
        $Codigo .= "<td>" .$row["apellidos"] . "</td>";
        $Codigo .= "<td>" .$row["email"] . "</td>";
        $Codigo .= "<td>" ."<form action=\"BD_Consultas\Asistencia.php\" method=\"post\">
        <input type=\"hidden\" name=\"IdPresente\" value=\"".$row["id"]."\" >
        <input type=\"submit\"  class=\"btn btn-block btn-primary btn-flat\" value=\"Presente\">
        </form></td>";
        $Codigo .= "</tr>";
      }
      $Codigo .= "

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
      <div class=\"box-header\">
      <h3 class=\"box-title\">Ausentes</h3>
      </div>
      <!-- /.box-header -->
      <div class=\"box-body\">
      <h2> No hay miembros ausentes </h2>
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
