<?php
	function getPresentaciones(){
    $out = "";
		require('Conexion.php');
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
		}else{
			$sql = "SELECT Nombre, Fecha, Color FROM presentacion";
			$result = mysqli_query($conn, $sql);
			$count = 0;
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$color = $row['Color'];
          $date= new DateTime($row['Fecha']) ;
          $day = $date->format('d');
          $month = $date->format('m')-1;
          $year = $date->format('Y');
          $hour = $date->format('H');
          $minute = $date->format('i');
					$out .= ($count>0) ? "," : "" ;
					$out .= "{
                title          : '".$row['Nombre']."',
                start          : new Date(".$year.", ".$month.", ".$day.",".$hour.",".$minute."),
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








 ?>
