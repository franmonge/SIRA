<?php
	function getPresentaciones(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT Nombre, Date_Format(Fecha,'%d-%m-%Y') as F, Descripcion, Imagen FROM presentacion WHERE FECHA >= CURRENT_DATE() ORDER by F ASC LIMIT 3;";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo"<div class=\"card card-cascade wider\">
				        <div class=\"view view-cascade overlay\">

				          <img  class=\"card-img-top\" src=\"".$row['Imagen']."\"  alt=\"No image\">
				        </div>
				        <div class=\"card-body card-body-cascade text-center\">
				          <h4 class=\"card-title\"><strong>".$row['Nombre']."</strong></h4>
						   <h5 class=\"blue-text pb-2\"><i class=\"fas fa-calendar\"></i>".$row['F']."</h5>
						<p class=\"card-text\">".$row['Descripcion']."</p>
				        </div>
				      </div>";
				}
				echo "<div class=\"card card-cascade wider\">
								<div class=\"view view-cascade overlay\">
								<div style=\"
								display: flex;
								flex-direction: column;
								justify-content: center;
								overflow: auto;\" >
								<p style=\"margin:0; padding: 20px;\">
							<button type=\"button\" class=\"btn btn-light-blue btn-md\" style=\"margin:35% auto; display:block\" onclick=\"location.href='presentaciones.php';\">+Ver Más</button>
							</p>
							</div>
							</div>
					</div>
					";
			}else {
				echo "<h4 ><strong>No hay próximas presentaciones</strong></h4>";
			}
		}
		$conn->close();
	}

	function getPresentacionesFull(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT Nombre, Date_Format(Fecha,'%d-%m-%Y') as F, Descripcion, Lugar, Imagen FROM presentacion WHERE FECHA >= CURRENT_DATE() ORDER by F ASC;";
			$result = mysqli_query($conn, $sql);
			$lineBreaker = 1;
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo"<div class=\"card card-cascade wider\">
				        <div class=\"view view-cascade overlay\">
				          <img  class=\"card-img-top\" src=\"".$row['Imagen']."\" alt=\"No image\" >

				        </div>
				        <div class=\"card-body card-body-cascade text-center\">
				          <h4 class=\"card-title\"><strong>".$row['Nombre']."</strong></h4>
						   <h5 class=\"blue-text pb-2\"><i class=\"fas fa-calendar\"></i>".$row['F']."</h5>
						   <p class=\"card-text\">".$row['Descripcion']."</p>
						   <p class=\"card-text\">".$row['Lugar']."</p>
				        </div>
				      </div>";
					  echo ($lineBreaker % 3 == 0)?"</div> </div><br><br><div class=\"container\"><div class=\"card-deck\">":"";
					 $lineBreaker++;
				}
			}else {
				echo "<h4 ><strong>No hay próximas presentaciones</strong></h4>";
			}
		}
		$conn->close();
	}
?>
