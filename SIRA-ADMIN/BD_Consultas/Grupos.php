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


	function getGrupos(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT Nombre, Descripcion FROM grupo WHERE Estado = '1'";
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
                     <th>Imagen</th>
                     <th>Opciones</th>
                   </tr>
                   </thead>
                   <tbody>";
      while($row = $result->fetch_assoc()){
        $Codigo .= "<tr>";
        $Codigo .= "<td>".$row["Nombre"]."</td>";
        $Codigo .= "<td>" .$row["Descripcion"] . "</td>";
        $Codigo .= "<td>" .$row["Descripcion"] . "</td>";
        $Codigo .= "<td>" .
        			"<div class=\"input-group-btn\">
							<button type=\"button\" class=\"btn  btn-block btn-info btn-flat\" data-toggle=\"modal\" data-target=\"#member-modal\">Miembros</button>
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
		if(isset($_POST['btnCrearGrupo'])){
			require('Conexion.php');
			if($conn->connect_error){
				die("Connection failed: ".$conn->connect_error);
			}else{
				// $Grupo = filter_input(INPUT_POST, 'GrupoRegistro');
				$Nombre = filter_input(INPUT_POST, 'NombreGrupo');
				$Descripcion = filter_input(INPUT_POST, 'DescripcionGrupo');
				$Historia = filter_input(INPUT_POST, 'HistoriaGrupo');
				$Estado = '1';
				$sql = "INSERT INTO grupo(Nombre, Descripcion, Historia, Estado) VALUES ('$Nombre', '$Descripcion', '$Historia', '$Estado')";
				if(mysqli_query($conn, $sql)){
					header("Location: ../adminGrupos.php");
				}else{
					echo "Error" .mysqli_error($conn);
				}
			}
			$conn->close();
		}
	}

 ?>
