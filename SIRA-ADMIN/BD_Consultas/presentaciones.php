<?php
	function getPresentaciones(){
    $out = "";
		require('Conexion.php');
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
		}else{
			$sql = "SELECT id, Nombre, Descripcion, Fecha, Lugar, Costo, Color FROM presentacion";
			$result = mysqli_query($conn, $sql);
			$count = 0;
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$id = $row['id'];
					$color = $row['Color'];
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
	function addEvent($groupId, $name, $detail, $timestamp, $place, $cost, $color){
	  require('Conexion.php');
	  if ($conn->connect_error){
	    die("Connection failed: " . $conn->connect_error);
			echo "Connection failed";
	  }else{
	    $query = "INSERT INTO presentacion(id_Grupo, Nombre, Descripcion, Fecha, Lugar, Costo, Color) VALUES ($groupId, '$name', '$detail', '$timestamp', '$place', '$cost', '$color')";
			echo "query";
	    $result = mysqli_query($conn, $query);
			echo "result";
	    $conn->close();
			echo "close";
			header("Location: ../adminPresentaciones.php");
	  exit();
	}
	}
// 
function updateEvent($id,$name, $detail, $timestamp, $place,$cost){
	require('Conexion.php');
	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
		echo "Connection failed";
  	}else{
		$query = "UPDATE presentacion SET Nombre='$name', Descripcion='$detail', Fecha='$timestamp', Lugar='$place', Costo='$cost' WHERE presentacion.id = $id";
		echo "query";
		$result = mysqli_query($conn, $query);
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
								addEvent($groupId, $name, $detail, $timestamp, $place,$cost, $color );
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
							if ($action == "Eliminar"){
								deleteEvent($id);
							}else{
								if($action == "Guardar"){
									updateEvent($id,$name, $detail, $timestamp, $place,$cost);
								}
							}
						}
					}
				}
			}
		}
	}
}
 ?>
