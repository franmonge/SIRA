<?php
	function dropdownCoreografias(){
		require('Conexion.php');
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
		}else{
			$sql = "SELECT id, nombre FROM coreografia";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<option value=".$row['id'].">" .$row['Nombre']."</option>";
				}
			}else{
				echo "<option>Error, no se encontraron coreografias</option>";
			}
		}
		$conn->close();
	}


	function getCoreografias(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT nombre, Descripcion, Cancion, Link FROM coreografia";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){

      $Codigo = "
      <!-- Content Header (Page header) -->
      <section class=\"content-header\">
         <h1>Coreografias Disponibles</h1>
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
										 <th>Cancion</th>
										 <th>Link</th>
                     <th>Opciones</th>
                   </tr>
                   </thead>
                   <tbody>";
      while($row = $result->fetch_assoc()){
        $Codigo .= "<tr>";
        $Codigo .= "<td>".$row["nombre"]."</td>";
        $Codigo .= "<td>" .$row["Descripcion"] . "</td>";
				$Codigo .= "<td>" .$row["Cancion"] . "</td>";
				$Codigo .= "<td>" .$row["Link"] . "</td>";
        $Codigo .= "<td>" .
        			"<div class=\"input-group-btn\">
                  		<button id=\"edit-group\" type=\"button\" class=\"btn btn-block btn-warning btn-flat\" data-toggle=\"modal\" data-target=\"#editGroup-modal\">Editar</button>
                  		<button id=\"delete-group\" type=\"button\" class=\"btn btn-block btn-danger btn-flat\" data-toggle=\"modal\"data-target=\"#deleteGroup-modal\">Eliminar</button>
                	</div>"
                	. "</td>";
        $Codigo .= "</tr>";
      }
      $Codigo .= "
      </tbody>
        <tfoot>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cancion</th>
						<th>Link</th>
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
		if(isset($_POST['btnCrearCoreografia'])){
			require('Conexion.php');
			if($conn->connect_error){
				die("Connection failed: ".$conn->connect_error);
			}else{
				// $Grupo = filter_input(INPUT_POST, 'GrupoRegistro');
				$Nombre = filter_input(INPUT_POST, 'NombreCoreografia');
				$Descripcion = filter_input(INPUT_POST, 'DescripcionGrupo');
				$Cancion = filter_input(INPUT_POST, 'NombreCancion');
				$Link = filter_input(INPUT_POST, 'LinkCancion');
				$sql = "INSERT INTO coreografia(nombre, Descripcion, Cancion, Link) VALUES ('$Nombre', '$Descripcion', '$Cancion', '$Link')";
				if(mysqli_query($conn, $sql)){
					header("Location: ../adminCoreografias.php");
				}else{
					echo "Error" .mysqli_error($conn);
				}
			}
			$conn->close();
		}
	}

 ?>
