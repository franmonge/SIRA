<?php
	function getGrupos(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT Nombre FROM grupo LIMIT 3;";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo
						"<div class=\"card card-cascade wider\">
				        <div class=\"view view-cascade overlay\">
				          <img  class=\"card-img-top\" src=\"https://mdbootstrap.com/img/Photos/Others/photo6.jpg\" alt=\"Card image cap\">

				        </div>
				        <div class=\"card-body card-body-cascade text-center\">
				          <h4 class=\"card-title\"><strong>".$row['Nombre']."</strong></h4>
				        </div>
				      </div>";
				}
				echo
					"
					<div class=\"card card-cascade wider\">
				        <div class=\"view view-cascade overlay\">
							<button type=\"button\" class=\"btn btn-light-blue btn-md\" onclick=\"location.href='grupos.php';\">+Ver Más</button>
						</div>
					</div>
					";
			}
		}
		$conn->close();
	}
?>
