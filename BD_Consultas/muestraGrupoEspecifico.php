<?php
	require('Conexion.php');
 	$postnames = array_keys($_POST);
 	if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
	}else{
		$grupo = str_replace("_"," ", $postnames[0]);
		$sql = "SELECT Descripcion, Historia, Imagen FROM grupo WHERE Nombre = '$grupo'";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo
					"<div class=\"row\">
							 <div class=\"col-lg-7\">
								<h2 class=\"h1-responsive font-weight-bold text-center my-5\">" .$grupo . "</h2>
								<hr class=\"my-5\">
								<p>" .$row['Descripcion'] . "</p>
								<br>
								<h3 class=\"fon-weight-bold mb-3\"><strong>Historia</strong></h3>
								<hr class=\"my-5\">
								<p>" .$row['Historia'] . "</p>
							</div>
							<div class=\"col-lg-5\">
								<div class=\"view overlay rounded z-depth-2 mb-log-0 mb-4\">
									<img class=\"img-fluid\" src=\"".$row['Imagen']."\" alt=\"No image\">
									<a>
							          <div class=\"mask rgba-white-slight\"></div>
							        </a>
							    </div>
							 </div>
							</div>";
			}
		}else{
			echo "Fallo";
		}
	}
	$conn->close();

 ?>
