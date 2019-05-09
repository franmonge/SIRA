<?php
	function getPresentaciones(){
    $out = "";
		require('Conexion.php');
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
		}else{
			$sql = "SELECT id, Nombre, Descripcion, Fecha, Lugar, Costo, Color, id_Grupo FROM presentacion";
			$result = mysqli_query($conn, $sql);
			$count = 0;
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$id = $row['id'];
					$color = $row['Color'];
					$groupId = $row['id_Grupo'];
		            $date= new DateTime($row['Fecha']) ;
		            $day = $date->format('d');
		            $month = $date->format('m')-1;
		            $year = $date->format('Y');
		            $hour = $date->format('H');
		            $minute = $date->format('i');
					// $dateAux = $month."/".$day."/".$year;
					$dateAux = $year."-".$month."-".$day;
					$timeAux = $hour.":".$minute;
					$out .= ($count>0) ? "," : "" ;
					$out .= "{
                id          : '".$row['id']."',
				title          : '".$row['Nombre']."',
                start          : new Date(".$year.", ".$month.", ".$day.",".$hour.",".$minute."),
				description    : '".$row['Descripcion']."',
				date    : '".$dateAux."',
				time    : '".$timeAux."',
				place    : '".$row['Lugar']."',
				cost    : '".$row['Costo']."',
				backgroundColor: '$color',
                groupId: '$groupId',
                borderColor    : '$color'
              }";
					$count += 1;
				}
			}else{
				$out = "";
			}
		}
		$conn->close();
    echo $out;
	}

	function addEvent($groupId, $name, $detail, $timestamp, $place, $cost, $color, $Coreografias, $Participantes ){
	  require('Conexion.php');
	  if ($conn->connect_error){
	    die("Connection failed: " . $conn->connect_error);
			echo "Connection failed";
	  }else{
			//$query1 = "INSERT INTO cxp(id_Coreografia, id_Presentacion) VALUES ($Coreografias[0],$Participantes[2])";
			//$result = mysqli_query($conn, $query1);
	    $query = "INSERT INTO presentacion(id_Grupo, Nombre, Descripcion, Fecha, Lugar, Costo, Color) VALUES ($groupId, '$name', '$detail', '$timestamp', '$place', '$cost', '$color')";
			echo "query";
			if(mysqli_query($conn, $query)){
				$ultimoID = mysqli_insert_id($conn);
			}
			for ($i=0; $i<count($Coreografias); $i++) {
				$query = "INSERT INTO cxp(id_Coreografia, id_Presentacion) VALUES ($Coreografias[$i],$ultimoID)";
				mysqli_query($conn, $query);
			}
			for ($i=0; $i<count($Participantes); $i++) {
				$query = "INSERT INTO UxP(id_Usuario, id_Presentacion) VALUES ($Participantes[$i],$ultimoID)";
				mysqli_query($conn, $query);
			}
			echo "result";
	    $conn->close();
			echo "close";
			header("Location: ../adminPresentaciones.php");
	  exit();
	}
	}

function updateEvent($id,$name, $detail, $timestamp, $place,$cost,$groupId, $Coreografias, $Participantes){
	require('Conexion.php');
	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
		echo "Connection failed";
  	}else{
		$query = "UPDATE presentacion SET Nombre='$name', Descripcion='$detail', Fecha='$timestamp', Lugar='$place', Costo='$cost', id_Grupo='$groupId' WHERE presentacion.id = $id";
		if(mysqli_query($conn, $query)){
			$ultimoID =$id;
		}
		$query = "DELETE FROM cxp where cxp.id_Presentacion =  $ultimoID";
		$result = mysqli_query($conn, $query);
		for ($i=0; $i<count($Coreografias); $i++) {
			$query = "INSERT INTO cxp(id_Coreografia, id_Presentacion) VALUES ($Coreografias[$i],$ultimoID)";
			mysqli_query($conn, $query);
		}
		$query = "DELETE FROM uxp where uxp.id_Presentacion =  $ultimoID";
		$result = mysqli_query($conn, $query);
		for ($i=0; $i<count($Participantes); $i++) {
			$query = "INSERT INTO UxP(id_Usuario, id_Presentacion) VALUES ($Participantes[$i],$ultimoID)";
			mysqli_query($conn, $query);
		}
		$conn->close();
		header("Location: ../adminPresentaciones.php");
  		exit();
	}
}

function deleteEvent($id){
	require('Conexion.php');
	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
		echo "Connection failed";
  	}else{
		$query = "DELETE FROM presentacion WHERE presentacion.id = $id";
		$result = mysqli_query($conn, $query);
		$conn->close();
		header("Location: ../adminPresentaciones.php");
  		exit();
	}
}


if (!empty($_POST["group"])) {
	$groupId = filter_input(INPUT_POST, 'group');
	if (!empty($_POST["eventName"])) {
		$name = filter_input(INPUT_POST, 'eventName');
		if (!empty($_POST["eventDate"])) {
			$date = filter_input(INPUT_POST, 'eventDate');
			if (!empty($_POST["eventTime"])) {
				$time = filter_input(INPUT_POST, 'eventTime');
				if (!empty($_POST["eventPlace"])) {
					$place = filter_input(INPUT_POST, 'eventPlace');
					if (!empty($_POST["eventDetail"])) {
						$detail = filter_input(INPUT_POST, 'eventDetail');
						$timestamp = $date." ".$time;
						if (isset($_POST["eventCost"])){
							$cost = filter_input(INPUT_POST, 'eventCost');
							if (!empty($_POST["eventDetail"])){
								$color = filter_input(INPUT_POST, 'eventColor');
								$Coreografias = $_POST['Coreografias'];
								$Participantes = $_POST['Participantes'];
								addEvent($groupId, $name, $detail, $timestamp, $place,$cost, $color, $Coreografias, $Participantes );
							}
						}
					}
				}
			}
		}
	}

}

// update event values


if (!empty($_POST["inEventName"])) {
	$name = filter_input(INPUT_POST, 'inEventName');
	if (!empty($_POST["inEventDate"])) {
		$date = filter_input(INPUT_POST, 'inEventDate');
		if (!empty($_POST["inEventTime"])) {
			$time = filter_input(INPUT_POST, 'inEventTime');
			if (!empty($_POST["inEventPlace"])) {
				$place = filter_input(INPUT_POST, 'inEventPlace');
				if (!empty($_POST["inEventDetail"])) {
					$detail = filter_input(INPUT_POST, 'inEventDetail');
					$timestamp = $date." ".$time;
					if (isset($_POST["inEventCost"])){
						$cost = filter_input(INPUT_POST, 'inEventCost');
						if (!empty($_POST["inEventId"])){
							$id = filter_input(INPUT_POST, 'inEventId');
							$action = filter_input(INPUT_POST, 'ACTION');
							if (!empty($_POST["inGroup"])) {
								$groupId = filter_input(INPUT_POST, 'inGroup');
								$Coreografias = $_POST['inCoreografias'];
								$Participantes = $_POST['inParticipantes'];
								if ($action == "Eliminar"){
									deleteEvent($id);
								}else{
									if($action == "Guardar"){
										updateEvent($id,$name, $detail, $timestamp, $place,$cost,$groupId, $Coreografias, $Participantes);
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

if (!empty($_POST["inEventCoreo"])) {
	$id = filter_input(INPUT_POST, 'inEventCoreo');
	$out = fetch_selected_coreo($id);
	echo $out;

}
if (!empty($_POST["inEventParticipantes"])) {
	$id = filter_input(INPUT_POST, 'inEventParticipantes');
	$out = fetch_selected_participante($id);
	echo $out;
}

function fetch_selected_coreo($id){
	$out = "";
	require('Conexion.php');
	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}else{
		$sql = "SELECT coreografia.id as cid, coreografia.nombre as cnombre FROM coreografia INNER JOIN cxp ON cxp.id_Coreografia = coreografia.id WHERE cxp.id_Presentacion = $id ";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$out .= "<input type=\"checkbox\" name=\"inCoreografias[]\" value = ".$row['cid']." checked>".$row['cnombre']."<br>";
			}
		}else{
			$out .=  "";
		}

		$sql = "SELECT coreografia.id as cid, coreografia.nombre as cnombre from coreografia WHERE coreografia.id NOT IN (SELECT id_Coreografia from cxp WHERE id_Presentacion = $id) ";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$out .= "<input type=\"checkbox\" name=\"inCoreografias[]\" value = ".$row['cid']." >".$row['cnombre']."<br>";
			}
		}else{
			$out .=  "";
		}


	}
	$conn->close();
	return ($out == "")?"No se encontraron coreografías":$out;
}

function fetch_selected_participante($id){
	$out = "";
	require('Conexion.php');
	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}else{
		$sql = "SELECT usuario.id as uid, usuario.nombre as unombre FROM usuario INNER JOIN uxp ON uxp.id_Usuario = usuario.id WHERE uxp.id_Presentacion = $id ";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$out .= "<input type=\"checkbox\" name=\"inParticipantes[]\" value = ".$row['uid']." checked>".$row['unombre']."<br>";
			}
		}else{
			$out .=  "";
		}

		$sql = "SELECT usuario.id as uid, usuario.nombre as unombre FROM usuario WHERE usuario.id NOT IN (SELECT id_Usuario from uxp WHERE id_Presentacion = $id) ";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$out .= "<input type=\"checkbox\" name=\"inParticipantes[]\" value = ".$row['uid']." >".$row['unombre']."<br>";
			}
		}else{
			$out .=  "";
		}


	}
	$conn->close();
	return ($out == "")?"No se encontraron participantes":$out;;
}


function fetch_coreo(){
	require('Conexion.php');
	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}else{
		$sql = "SELECT id, nombre FROM coreografia";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "<input type=\"checkbox\" name=\"Coreografias[]\" value = ".$row['id']." >".$row['nombre']."<br>";
			}
		}else{
			echo "No se encontraron coreografías";
		}
	}
	$conn->close();
}

function fetch_participante(){
	require('Conexion.php');
	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}else{
		$sql = "SELECT id, Nombre FROM usuario WHERE estado = 'Activo'";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "<input type=\"checkbox\" name=\"Participantes[]\" value = ".$row['id']." >".$row['Nombre']."<br>";
			}
		}else{
			echo "No se encontraron participantes";
		}
	}
	$conn->close();
}

 ?>
