<?php
	function getPresentaciones(){
    $out = "";
		require('Conexion.php');
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
		}else{
			$sql = "SELECT p.id, p.Nombre, p.Descripcion, p.Fecha, p.Lugar,
			p.Costo, p.Color FROM presentacion AS p INNER JOIN UxP AS u WHERE
			p.id = u.id_Presentacion and u.id_usuario =". $_SESSION['userID'];
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
	?>
