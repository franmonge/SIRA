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
						"<form action=\"grupoEspecifico.php\" method=\"post\">
							<div class=\"card mb-3\">
									<h3 class=\"card-header indigo white-text text-uppercase text-center\">" .$row['Nombre']. "</h3>
									<div class=\"card-body\">
										<div class=\"media d-block d-md-flex mt-md-0 mt-4 mb-4\">
											<img class=\"d-flex mb-md-0 mb-3 avatar-2 z-depth-1 mx-auto\" src=\"https://mdbootstrap.com/img/Others/documentation/img (3)-mini.jpg\"
												alt=\"Generic placeholder image\">
											<div class=\"media-body ml-md-3 ml-0\">
												<p align=\"justify\">" .$row['Descripcion']. "
												</p>
												<div class=\"text-center text-md-left\">
													<input type=\"submit\" class=\"btn btn-success btn-md\" name=\"" .$row['Nombre'] . "\" value=\"Ver Más\"></button>
													
												</div>
											</div>
										</div>       
									</div>
								</div>
								<!--/.Panel-->
							</div>
						</form>
						";

					//// <a href=\"#!\" class=\"dark-blue-text d-flex flex-row-reverse p-2\" name=\"."$row['Nombre']".>
													// 	<h5>Ver más<i class=\"fas fa-angle-double-right ml-2\"></i></h5>
													// </a>
					// echo
					// 	"<form action=\"grupoEspecifico.php\" method=\"post\">
					// 		<div class=\"row\">
					// 		<div class=\"col-lg-5\">
					// 			<div class=\"view overlay rounded z-depth-2 mb-log-0 mb-4\">
					// 				<img class=\"img-fluid\" src=\"https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg\" alt=\"Sample image\">
					// 				<a>
					// 		          <div class=\"mask rgba-white-slight\"></div>
					// 		        </a>
					// 		    </div>
					// 		 </div>
					// 		 <div class=\"col-lg-7\">
					// 			<h3 class=\"fon-weight-bold mb-3\"><strong>" .$row['Nombre'] . "</strong></h3>
					// 			<p>" .$row['Descripcion'] . "</p>
					// 			<input type=\"submit\" class=\"btn btn-success btn-md\" name=\"" .$row['Nombre'] . "\" value=\"Ver Más\"></button>
					// 		</div>
					// 		</div>
					// 		<hr class=\"my-5\">
					// 	</form>";
				}
			}
	}
	$conn->close();
}
?>