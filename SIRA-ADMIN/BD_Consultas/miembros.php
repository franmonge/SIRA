<?php
function tablaGrupos($filtro){
  require('BD_Consultas\Conexion.php');
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "SELECT usuario.id, usuario.nombre, usuario.apellidos, usuario.email FROM usuario JOIN uxg ON uxg.id_Grupo = (SELECT id FROM grupo WHERE nombre = '$filtro') AND uxg.id_Usuario=usuario.id;";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row['nombre']."</td><td>".$row['apellidos']."</td><td>".$row['email']."</td><td><form action=\"BD_Consultas\miembros.php\" method=\"post\"><input type=\"hidden\" name=\"deactivateId\" value=\"".$row['id']."\"><input type=\"submit\"  class=\"btn btn-block btn-danger btn-flat\" value=\"Desactivar\"></form></td></tr>";
      }
    }
  }
}

function tablaCarreras($filtro){
  require('BD_Consultas\Conexion.php');
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $idCarrera = consultaCarrera($filtro);
    $query = "SELECT id, nombre, apellidos, email FROM usuario WHERE estado = 'Activo' AND id_Carrera = '$idCarrera'";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row['nombre']."</td><td>".$row['apellidos']."</td><td>".$row['email']."</td><td><form action=\"BD_Consultas\miembros.php\" method=\"post\"><input type=\"hidden\" name=\"deactivateId\" value=\"".$row['id']."\"><input type=\"submit\"  class=\"btn btn-block btn-danger btn-flat\" value=\"Desactivar\"></form></td></tr>";
      }
    }
  }
}

function consultaCarrera($filtro){
  require('BD_Consultas\Conexion.php');
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "SELECT ID FROM carrera WHERE Nombre = '$filtro'";
    $result = mysqli_query($conn, $query);
    $result2 = $result->fetch_array(MYSQLI_NUM);
    $id_Carrera = $result2[0];
    return $id_Carrera;
  }
}    

 function tablaTodos(){
  require('BD_Consultas\Conexion.php');
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
      $query = "SELECT id, nombre, apellidos, email FROM usuario WHERE estado='Activo'";
      $result = mysqli_query($conn, $query);
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          echo "<tr><td>".$row['nombre']."</td><td>".$row['apellidos']."</td><td>".$row['email']."</td><td><form action=\"BD_Consultas\miembros.php\" method=\"post\"><input type=\"hidden\" name=\"deactivateId\" value=\"".$row['id']."\"><input type=\"submit\"  class=\"btn btn-block btn-danger btn-flat\" value=\"Desactivar\"></form></td></tr>";
      }
    }
  }
}

function dropdownCarreras(){
    require('..\BD_Consultas\Conexion.php');
    if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }else{
      $sql = "SELECT Nombre FROM carrera";
      $result = mysqli_query($conn, $sql);
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          echo "<option value=\"".$row['Nombre']."\">".$row['Nombre']."</option>";
        }
      }else{
        echo "<option>No hay carreras registradas</option>";
      }
    $conn->close();
    }
  }

function dropdownGrupos(){
  require('..\BD_Consultas\Conexion.php');
    if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }else{
      $sql = "SELECT Nombre FROM grupo";
      $result = mysqli_query($conn, $sql);
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          echo "<option>" .$row['Nombre']."</option>";
        }
      }else{
          echo "<option>No hay grupos registrados</option>";
      }
      $conn->close();
    }
}

function deactivate($id){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE usuario SET estado='Inactivo' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminMiembros.php"); /* Redirect browser */
  }
}

function activate($id){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE usuario SET estado='Activo' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminMiembros.php"); /* Redirect browser */
  }
}

function insertarEstudianteGrupo($id, $gNombre, $conn){
  $idGrupo = consultaGrupo($gNombre, $conn);
  $query = "INSERT INTO uxg(id_Grupo, id_Usuario) VALUES ('$idGrupo', '$id')";
  $result = mysqli_query($conn, $query);
}

function accept($id, $gNombre){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE usuario SET estado='Activo' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    insertarEstudianteGrupo($id, $gNombre, $conn);
    $conn->close();
    header("Location: ..\adminSolicitudes.php"); /* Redirect browser */
    exit();
  }
}

function consultaGrupo($gNombre, $conn){
    $sql = "SELECT ID FROM grupo WHERE Nombre = '$gNombre'";
    $result = mysqli_query($conn, $sql);
    $result2 = $result->fetch_array(MYSQLI_NUM);
    $id_grupo = $result2[0];
    return $id_grupo;
  }

function reject($id){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "DELETE FROM usuario WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminSolicitudes.php"); /* Redirect browser */
  exit();
}
}


function add($id){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "INSERT INTO administrador(id_Usuario) VALUES ('$id')";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminAdministradores.php"); /* Redirect browser */
  exit();
}
}


function remove($id){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "DELETE FROM administrador WHERE id_Usuario='$id'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminAdministradores.php"); /* Redirect browser */
  exit();
}
}

function miembrosInactivos(){
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
               <h3 class=\"box-title\">Inactivos</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">

               <table id=\"table-Miembros\" class=\"table table-bordered table-striped\">
                 <thead>
                 <tr>
                   <th>Nombre</th>
                   <th>Apellidos</th>
                   <th>Email</th>
                   <th>Desactivar</th>
                 </tr>
                 </thead>
                 <tbody>";

    while($row = $result->fetch_assoc()){
      $Codigo .= "<tr>";
      $Codigo .= "<td>".$row["nombre"]."</td>";
      $Codigo .= "<td>" .$row["apellidos"] . "</td>";
      $Codigo .= "<td>" .$row["email"] . "</td>";
      $Codigo .= "<td>" ."<form action=\"BD_Consultas\miembros.php\" method=\"post\">
      <input type=\"hidden\" name=\"activateId\" value=\"".$row["id"]."\" >
      <input type=\"submit\"  class=\"btn btn-block btn-primary btn-flat\" value=\"Activar\">
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
          <th>Desactivar</th>
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
               <h3 class=\"box-title\">Inactivos</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">
             <h2> No hay miembros inactivos </h2>
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

if (!empty($_POST["deactivateId"])) {
    $uId = filter_input(INPUT_POST, 'deactivateId');
    deactivate($uId);
}

if (!empty($_POST["activateId"])) {
    $uId = filter_input(INPUT_POST, 'activateId');
    activate($uId);
}

if (!empty($_POST["acceptId"])) {
    $uId = filter_input(INPUT_POST, 'acceptId');
    $gNombre = filter_input(INPUT_POST, 'Grupos');
    accept($uId, $gNombre);
}

if (!empty($_POST["rejectId"])) {
    $uId = filter_input(INPUT_POST, 'rejectId');
    reject($uId);
}

if (!empty($_POST["addAdmin"])) {
    $uId = filter_input(INPUT_POST, 'addAdmin');
    add($uId);
}

if (!empty($_POST["removeAdmin"])) {
    $uId = filter_input(INPUT_POST, 'removeAdmin');
    remove($uId);
}
 ?>
