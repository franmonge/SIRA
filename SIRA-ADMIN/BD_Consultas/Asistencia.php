<?php

function ausente($id, $gNombre){
  require('Conexion.php');  
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $idGrupo = consultaGrupo($gNombre, $conn);
    #$query = "INSERT INTO uxg(id_Grupo, id_Usuario) VALUES ('$idGrupo', '$id')";
    #$result = mysqli_query($conn, $query);
    $query = "UPDATE usuario SET estado='Inactivo' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminAsistencia.php"); /* Redirect browser */
  exit();
}
}

function presente($id){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE usuario SET estado='Activo' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminAsistencia.php"); /* Redirect browser */
  exit();
}
}

function consultaGrupo($gNombre){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $sql = "SELECT ID FROM grupo WHERE Nombre = '$gNombre'";
    $result = mysqli_query($conn, $sql);
    $result2 = $result->fetch_array(MYSQLI_NUM);
    $id_grupo = $result2[0];
    return $id_grupo;
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
  $conn->close();
  $_SESSION["CargarEstudiantes"] = $idGrupo;
  header("Location: ..\adminAsistencia.php"); /* Redirect browser */
  }
}

if (!empty($_POST["ensayo"])) {
    $idGrupo = filter_input(INPUT_POST, 'ensayo');
    $fecha = date("Y/m/d");
    crearEnsayo($idGrupo,$fecha);
} 

if (!empty($_POST["IdAusente"])) {
    $uId = filter_input(INPUT_POST, 'IdAusente');
    $gNombre = $_POST['Grupos'];
    echo $gNombre;
    ausente($uId,$gNombre);
} 

if (!empty($_POST["IdPresente"])) {
    $uId = filter_input(INPUT_POST, 'IdPresente');    
    $gNombre = filter_input(INPUT_POST, 'Grupos');
    presente($uId,$gNombre);
} 


function miembrosPresentes($idGrupo){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "SELECT U.id, U.nombre, U.apellidos, U.email FROM usuario as U INNER JOIN uxg as A WHERE U.estado='Activo' ";
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
    $query = "  SELECT id, nombre, apellidos, email FROM usuario WHERE estado='Inactivo'";
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
