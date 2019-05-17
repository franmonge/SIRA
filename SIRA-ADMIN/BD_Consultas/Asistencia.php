<?php

function consigueEnsayo($idGrupo, $fecha){
  require('Conexion.php');
  if($conn->connect_error){
    die("Connection failed: " . "$conn->connect_error");
  }else{
    $query = "SELECT id FROM ensayo WHERE idGrupo = '$idGrupo' AND fecha = (SELECT STR_TO_DATE('$fecha', '%Y-%m-%d'))";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $idEnsayo = $row['id'];
        mostraTablaEnsayosPresentes($conn, $idEnsayo);
      }
    }else{
      $idEnsayo = crearEnsayo($idGrupo, $fecha, $conn);
      llenaAsistenciaEnsayo($idEnsayo, $idGrupo, $conn);
      mostraTablaEnsayosPresentes($conn, $idEnsayo);
    }
  }
  $conn->close();
}

function consigueEnsayoAusentes($idGrupo, $fecha){
  require('Conexion.php');
  if($conn->connect_error){
    die("Connection failed: " . "$conn->connect_error");
  }else{
    $query = "SELECT id FROM ensayo WHERE idGrupo = '$idGrupo' AND fecha = (SELECT STR_TO_DATE('$fecha', '%Y-%m-%d'))";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $idEnsayo = $row['id'];
        mostraTablaEnsayosAusentes($conn, $idEnsayo, $idGrupo);
      }
    }
  }
  $conn->close();
}

function mostraTablaEnsayosPresentes($conn, $idEnsayo){
  $query = "SELECT usuario.id, nombre, apellidos, email from usuario join asistenciaensayos on asistenciaensayos.idEnsayo = '$idEnsayo' and asistenciaensayos.idPersona = usuario.id and asistenciaensayos.Estado = 'Presente'";
  $result = mysqli_query($conn, $query);
  if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
      echo "<tr><td>".$row['nombre']."</td><td>".$row['apellidos']."</td><td>".$row['email']."</td><td>
      <input type=\"hidden\" name=\"CambiarAusente\" value=\"".$row['id']."\">
      <input type=\"hidden\" id=\"idEnsayoPresente".$row['id']."\" value=\"".$idEnsayo."\">
      <button id=\"".$row['id']."\" onclick=\"recargaTablaAusente(this.id)\" class=\"btn btn-block btn-danger btn-flat\">Ausente</td></tr>";
    }
  }
}

function mostraTablaEnsayosAusentes($conn, $idEnsayo){
  $query = "SELECT usuario.id, nombre, apellidos, email from usuario join asistenciaensayos on asistenciaensayos.idEnsayo = '$idEnsayo' and asistenciaensayos.idPersona = usuario.id and asistenciaensayos.Estado = 'Ausente'";
  $result = mysqli_query($conn, $query);
  if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
      echo "<tr><td>".$row['nombre']."</td><td>".$row['apellidos']."</td><td>".$row['email']."</td><td>
      <input type=\"hidden\" name=\"CambiarPresente\" value=\"".$row['id']."\">
      <input type=\"hidden\" id=\"idEnsayoAusente".$row['id']."\" value=\"".$idEnsayo."\">
      <button id=\"".$row['id']."\" onclick=\"recargaTabla(this.id)\" class=\"btn btn-block btn-info btn-flat\">Presente</button></td></tr>";
    }
  }
}

function llenaAsistenciaEnsayo($idEnsayo, $idGrupo, $conn){
  $query = "SELECT usuario.id FROM usuario JOIN uxg ON usuario.Estado='Activo' AND uxg.id_Grupo = '$idGrupo' AND uxg.id_Usuario = usuario.id";
  $result = mysqli_query($conn, $query);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $id_Usuario = $row['id'];
      $query2 = "INSERT INTO asistenciaensayos(Estado, idEnsayo, idPersona) VALUES('Presente','$idEnsayo','$id_Usuario')";
      if(mysqli_query($conn, $query2)){
      }else{
        echo "Error al insertar asistentes";
      }
    }
  }
}

function crearEnsayo($idGrupo, $fecha, $conn){
  $query = "INSERT INTO ensayo(idGrupo, fecha) VALUES('$idGrupo', '$fecha')";
  if (mysqli_query($conn, $query)){
    $ultimoID = mysqli_insert_id($conn);
  }
  return $ultimoID;
}

function presente($idUsuario, $idEnsayo){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE asistenciaensayos SET estado = 'Presente' WHERE idPersona = '$idUsuario' AND idEnsayo = '$idEnsayo'";
    if(mysqli_query($conn, $query)){
      return true;
    }
  }
}

function ausente($idUsuario, $idEnsayo){
  require('Conexion.php');
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }else{
    $query = "UPDATE asistenciaensayos SET estado = 'Ausente' WHERE idPersona = '$idUsuario' AND idEnsayo = '$idEnsayo'";
    if(mysqli_query($conn, $query)){
      return true;
    }
  }
}
?>
