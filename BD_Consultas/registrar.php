<?php 
	function dropdownGrupos(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT Nombre FROM grupo";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<option>" .$row['Nombre']."</option>";
				}
			}else{
				echo "<option>No hay grupos</option>";
			}
		$conn->close();
		}
	}

	function dropdownCarreras(){
		require('Conexion.php');
		if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "SELECT Nombre FROM carrera";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<option>" .$row['Nombre']."</option>";
				}
			}else{
				echo "<option>No hay carreras registradas</option>";
			}
		$conn->close();
		}
	}

	function dropdownTiposSanges(){
		require('Conexion.php');
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
		}else{
			$sql = "SELECT tipoSangre FROM tiposangre";
			$result = mysqli_query($conn, $sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<option>" .$row['tipoSangre']."</option>";
				}
			}else{
				echo "<option>Error, no se encontro tipo de sangre</optionn>";
			}
		}
		$conn->close();
	}
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['btnRegistrar'])){
			$Grupo = filter_input(INPUT_POST, 'GrupoRegistro');
			$Nombre = filter_input(INPUT_POST, 'NombreRegistro');
			$Apellidos = filter_input(INPUT_POST, 'ApellidosRegistro');
			$Email = filter_input(INPUT_POST, 'EmailRegistro');
			$Password = filter_input(INPUT_POST, 'PasswordRegistro');
			$Pasaporte = filter_input(INPUT_POST, 'PasaporteRegistro');
			$FechaNacimiento = filter_input(INPUT_POST, 'FechaNacimientoRegistro');
			$TelefonoCelular = filter_input(INPUT_POST, 'TelefonoCelularRegistro');
			$TelefonoDomicilio = filter_input(INPUT_POST, 'TelefonoDomicilioRegistro');
			$Carrera = filter_input(INPUT_POST, 'CarreraRegistro');
			$TipoSangre = filter_input(INPUT_POST, 'TipoSangreRegistro');
			$DireccionDomicilio = filter_input(INPUT_POST, 'DireccionDomicilioRegistro');
			$DireccionLectiva = filter_input(INPUT_POST, 'DireccionLectivaRegistro');
			$Estatura = filter_input(INPUT_POST, 'EstaturaRegistro');
			$Calzado = filter_input(INPUT_POST, 'TallaCalzadoRegistro');
			$Blusa = filter_input(INPUT_POST, 'TallaBlusaRegistro');
			$Pantalon = filter_input(INPUT_POST, 'TallaPantalonRegistro');
			$Enfermedades = filter_input(INPUT_POST, 'EnfermedadesRegistro');
			$Observaciones = filter_input(INPUT_POST, 'ObservacionesRegistro');
		}	
	}
 ?>