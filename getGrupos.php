<?php
	function getGrupos(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT Descripcion, Nombre FROM grupo";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo
						"<div class=\"row\">
						<div class=\"col-lg-5\">
							<div class=\"view overlay rounded z-depth-2 mb-log-0 mb-4\">
								<img class=\"img-fluid\" src=\"https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg\" alt=\"Sample image\">
								<a>
						          <div class=\"mask rgba-white-slight\"></div>
						        </a>
						    </div>
						 </div>";
					echo
						"<div class=\"col-lg-7\">
							<h3 class=\"fon-weight-bold mb-3\"><strong>" .$row['Nombre'] . "</strong></h3>
							<p>" .$row['Descripcion'] . "</p>
							<a class=\"btn btn-success btn-md\">Ver Más</a>
						</div>
						</div>
						<hr class=\"my-5\">";

				}
			}
	}
}
?>