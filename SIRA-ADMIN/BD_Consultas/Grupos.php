<?php
	function dropdownGrupos(){
		require('Conexion.php');
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
		}else{
			$sql = "SELECT id, Nombre FROM grupo WHERE Estado = '1'";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<option value=".$row['id'].">" .$row['Nombre']."</option>";
				}
			}else{
				echo "<option>Error, no se encontraron grupos</option>";
			}
		}
		$conn->close();
	}

	if(isset($_POST['imageId'])){
    require('Conexion.php');
    $id = filter_input(INPUT_POST, 'imageId');
    $name = filter_input(INPUT_POST, 'imageName');
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }else{
        $sql = "DELETE FROM grupo WHERE grupo.id = $id";
        if(mysqli_query($conn, $sql)){
						unlink('../'.$name);
        }else{
            echo "Error" .mysqli_error($conn);
        }
    }
    $conn->close();
    //echo "<br>Archivo eliminado con éxito".$id;
}


	function getGrupos(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT id, Nombre, Descripcion,Historia, Imagen FROM grupo WHERE Estado = '1'";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){

      $Codigo = "
      <!-- Content Header (Page header) -->
      <section class=\"content-header\">
         <h1>Grupos Disponibles</h1>
       </section>
       <!-- Main content -->
       <section class=\"content\">
         <div class=\"row\">
           <div class=\"col-xs-12\">
             <div class=\"box\">
               <!-- /.box-header -->
               <div class=\"box-body\">
                 <table id=\"table-Miembros\" class=\"table table-bordered table-striped\">
                   <thead>
                   <tr>
                     <th>Nombre</th>
										 <th>Descripción</th>
										 <th>Historia</th>
                     <th>Imagen</th>
                     <th>Opciones</th>
                   </tr>
                   </thead>
                   <tbody>";
      while($row = $result->fetch_assoc()){
        $Codigo .= "<tr>";
        $Codigo .= "<td>".$row["Nombre"]."</td>";
        $Codigo .= "<td>" .$row["Descripcion"] . "</td>";
				$Codigo .= "<td>" .$row["Historia"] . "</td>";
				$Codigo .= "<td style=\"text-align: center;\"> <div class=\"modal fade\" id=\"modal".$row["id"]."\">
            <div class=\"modal-dialog modal-lg\" role=\"document\">
              <!--Content-->
              <div class=\"modal-content\">
                <!--Body-->
                <div class=\"modal-body mb-0 p-0\">
                  <div class=\"embed-responsive embed-responsive-16by9 z-depth-1-half\">
                    <iframe class=\"embed-responsive-item\" src=\"../".$row["Imagen"]."\"
                      allowfullscreen></iframe>
                  </div>
                </div>
              </div>
              <!--/.Content-->
            </div>
          </div>
          <!--Modal: Name-->
          <a><img class=\"img-fluid\" alt=\"\" src=\"../".$row["Imagen"]."\"
              data-toggle=\"modal\" data-target=\"#modal".$row["id"]."\" style=\"max-width: 250px;max-height: 250px;\"></a></td>";
        $Codigo .= "<td>" ."<form action=\"adminGrupos.php\" method=\"post\">
        			<div class=\"input-group-btn\">
                  		<button id=\"edit-group\" type=\"button\" class=\"btn btn-block btn-warning btn-flat\" data-toggle=\"modal\" data-target=\"#editGroup-modal\">Editar</button>
											<input type=\"hidden\" name=\"imageId\" value=\"".$row["id"]."\" >
											<input type=\"hidden\" name=\"imageName\" value=\"".$row["Imagen"]."\" >
											<input type=\"submit\"  class=\"btn btn-block btn-danger btn-flat\" value=\"Eliminar\">
                	</div>
                	 </form></td>";
        $Codigo .= "</tr>";
      }
      $Codigo .= "
      </tbody>
        <tfoot>
          <tr>
            <th>Nombre</th>
						<th>Descripción</th>
						<th>Historia</th>
            <th>Imagen</th>
            <th>Opciones</th>
          </tr>
        </tfoot>
      </table>
      </div>
          <!-- /.box-body -->
      </div>
      <!-- /.box -->
      </div>
      <!-- /.col -->
      </div>
      <!-- /.row -->
      </section>
      <!-- /.content -->";
      echo $Codigo;
			}
		}
		$conn->close();
	}


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$target_dir = "../../img/groups/";
    $target_file = $target_dir;
    if(isset($_FILES["fileToUpload"]["name"])){
        $target_file .= basename($_FILES["fileToUpload"]["name"]);
    }
     $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if(isset($_POST['btnCrearGrupo'])){
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "<br>El archivo no es una imagen";
            $uploadOk = 0;
				}
				// Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
					echo "<br>No se puede cargar, el archivo es demasiado grande";
					$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
					echo "<br>No se puede cargar, formato no soportado";
					$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
					echo "<br>El archivo no se pudo cargar";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						require('Conexion.php');
						if($conn->connect_error){
							die("Connection failed: ".$conn->connect_error);
						}else{
							// $Grupo = filter_input(INPUT_POST, 'GrupoRegistro');
							$Nombre = filter_input(INPUT_POST, 'NombreGrupo');
							$Descripcion = filter_input(INPUT_POST, 'DescripcionGrupo');
							$Historia = filter_input(INPUT_POST, 'HistoriaGrupo');
							$path = "img/groups/".basename($_FILES["fileToUpload"]["name"]);
							$Estado = '1';
							$sql = "INSERT INTO grupo(Nombre, Descripcion, Historia, Estado, Imagen) VALUES ('$Nombre', '$Descripcion', '$Historia', '$Estado', '$path')";
							if(mysqli_query($conn, $sql)){
								header("Location: ../adminGrupos.php");
							}else{
								echo "Error" .mysqli_error($conn);
							}
						}
						$conn->close();
					}else {
						echo "<br>Error al cargar el archivo.";
					}
				}
			}
	}

 ?>
