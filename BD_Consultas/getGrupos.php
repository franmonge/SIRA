<?php
	function getGrupos(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT Descripcion, Nombre, Imagen FROM grupo WHERE Estado = '1'";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo
						"<form action=\"grupoEspecifico.php\" method=\"post\">
							<div class=\"card mb-3\">
									<h3 class=\"card-header indigo white-text text-uppercase text-center\">" .$row['Nombre']. "</h3>
									<div class=\"card-body\">
										<div class=\"media d-block d-md-flex mt-md-0 mt-4 mb-4\">
											<img class=\"d-flex mb-md-0 mb-3 avatar-2 z-depth-1 mx-auto\" style=\"max-height:250px; max-width:250px;\"src=\"".$row['Imagen']."\"
												alt=\"No image\">
											<div class=\"media-body ml-md-3 ml-0\">
												<p align=\"justify\">" .$row['Descripcion']."</p>
												<div class=\"text-center text-md-left\">
													<input type=\"submit\" class=\"btn btn-info btn-md\" name=\"" .$row['Nombre'] . "\" value=\"Ver Más\"></button>
												</div>
											</div>
										</div>
									</div>
								</div>
						</form>
						";
				}
			}
	}
	$conn->close();
}
?>
