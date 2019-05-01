<?php

function deactivate($id){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE usuario SET estado='Inactivo' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    header("Location: ..\adminMiembros.php"); /* Redirect browser */
  exit();
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
  exit();
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

if (!empty($_POST["deactivateId"])) {
    $uId = filter_input(INPUT_POST, 'deactivateId');
    deactivate($uId);
} else {
    echo "No post received";
}

if (!empty($_POST["activateId"])) {
    $uId = filter_input(INPUT_POST, 'activateId');
    activate($uId);
} else {
    echo "No post received";
}

if (!empty($_POST["acceptId"])) {
    $uId = filter_input(INPUT_POST, 'acceptId');
    $gNombre = filter_input(INPUT_POST, 'Grupos');
    accept($uId, $gNombre);
} else {
    echo "No post received";
}

if (!empty($_POST["rejectId"])) {
    $uId = filter_input(INPUT_POST, 'rejectId');
    reject($uId);
} else {
    echo "No post received";
}

if (!empty($_POST["addAdmin"])) {
    $uId = filter_input(INPUT_POST, 'addAdmin');
    add($uId);
} else {
    echo "No post received";
}

if (!empty($_POST["removeAdmin"])) {
    $uId = filter_input(INPUT_POST, 'removeAdmin');
    remove($uId);
} else {
    echo "No post received";
}
 ?>
