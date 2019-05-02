<?php 
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
			require('Conexion.php');
			if($conn->connect_error){
				die("Connection failed: ".$conn->connect_error);
			}else{
				// $Grupo = filter_input(INPUT_POST, 'GrupoRegistro');
				$Nombre = filter_input(INPUT_POST, 'NombreRegistro');
				$Apellidos = filter_input(INPUT_POST, 'ApellidosRegistro');
				$Email = filter_input(INPUT_POST, 'EmailRegistro');
				$Password = filter_input(INPUT_POST, 'PasswordRegistro');
				$Pasaporte = filter_input(INPUT_POST, 'PasaporteRegistro');
				$FechaNacimiento = filter_input(INPUT_POST, 'FechaNacimientoRegistro');
				$Nacimiento = date('Y-m-d', strtotime($FechaNacimiento));
				$FechaVencimiento = (filter_input(INPUT_POST, 'FechaVencimientoRegistro'))."-1";
				$Vencimiento = date('Y-m-d', strtotime($FechaVencimiento));
				$TelefonoCelular = filter_input(INPUT_POST, 'TelefonoCelularRegistro');
				$TelefonoDomicilio = filter_input(INPUT_POST, 'TelefonoDomicilioRegistro');
				$Carrera = filter_input(INPUT_POST, 'CarreraRegistro');
				$TipoSangre = filter_input(INPUT_POST, 'TipoSangreRegistro');
				$Carnet = filter_input(INPUT_POST, 'CarnetRegistro');
				$DireccionDomicilio = filter_input(INPUT_POST, 'DireccionDomicilioRegistro');
				$DireccionLectiva = filter_input(INPUT_POST, 'DireccionLectivaRegistro');
				$Estatura = filter_input(INPUT_POST, 'EstaturaRegistro');
				$Calzado = filter_input(INPUT_POST, 'TallaCalzadoRegistro');
				$Blusa = filter_input(INPUT_POST, 'TallaBlusaRegistro');
				$Pantalon = filter_input(INPUT_POST, 'TallaPantalonRegistro');
				$Enfermedades = filter_input(INPUT_POST, 'EnfermedadesRegistro');
				if(empty($Enfermedades)){
					$Enfermedades = "Ninguno";
				}
				$Observaciones = filter_input(INPUT_POST, 'ObservacionesRegistro');
				if(empty($Observaciones)){
					$Observaciones = "Ninguno";
				}
				$id_Carrera = consultaCarrera($Carrera, $conn);
				$id_Dimension = consultaDimension($Estatura, $Calzado, $Blusa, $Pantalon, $conn);
				$id_Direccion = consultaDireccion($DireccionDomicilio, $DireccionLectiva, $conn);
				$id_Telefono = consultaTelefono($TelefonoCelular, $TelefonoDomicilio, $conn);
				$id_TipoSangre = consultaTipoSangre($TipoSangre, $conn);
				$Estado = "Pendiente";
				$sql = "INSERT INTO usuario(Apellidos, Email, Enfermedad, FecNacimiento, FecVencimiento, id_Carrera, id_Dimension, id_Direccion, id_Telefono, id_TipoSangre, Estado, Nombre, Observacion, Pasaporte, Password, Carnet) VALUES ('$Apellidos', '$Email', '$Enfermedades', '$Nacimiento', '$Vencimiento', '$id_Carrera', '$id_Dimension', '$id_Direccion', '$id_Telefono', '$id_TipoSangre', '$Estado', '$Nombre', '$Observaciones', '$Pasaporte', '$Password', '$Carnet')";
				if(mysqli_query($conn, $sql)){
					header("Location: ../index.php");
				}else{
					echo "Error" .mysqli_error($conn);
				}
			}
			$conn->close();
		}	
	}

	function consultaCarrera($Carrera, $conn){
		$sql = "SELECT ID FROM carrera WHERE Nombre = '$Carrera'";
		$result = mysqli_query($conn, $sql);
		$result2 = $result->fetch_array(MYSQLI_NUM);
		$id_Carrera = $result2[0];
		return $id_Carrera;
	}

	function consultaDimension($Estatura, $Calzado, $Blusa, $Pantalon, $conn){
		$sql = "INSERT INTO Dimension(Calzado, Camisa, Estatura, Pantalon) VALUES ('$Calzado', '$Blusa', '$Estatura', '$Pantalon')";
		if (mysqli_query($conn, $sql)) {
		    $ultimoID = mysqli_insert_id($conn);
		}
		return $ultimoID;
	}

	function consultaDireccion($DireccionDomicilio, $DireccionLectiva, $conn){
		$sql = "INSERT INTO Direccion(Domicilio, Lectivo) VALUES ('$DireccionDomicilio','$DireccionLectiva')";
		if (mysqli_query($conn, $sql)){
			$ultimoID = mysqli_insert_id($conn);
		}
		return $ultimoID;
	}

	function consultaTelefono($Celular, $Domicilio, $conn){
		$sql = "INSERT INTO Telefono(Celular, Domicilio) VALUES ('$Celular','$Domicilio')";
		if (mysqli_query($conn, $sql)){
			$ultimoID = mysqli_insert_id($conn);
		}
		return $ultimoID;
	}

	function consultaTipoSangre($TipoSangre, $conn){
		$sql = "SELECT ID FROM tipoSangre WHERE tipoSangre = '$TipoSangre'";
		$result = mysqli_query($conn, $sql);
		$result2 = $result->fetch_array(MYSQLI_NUM);
		$id_Carrera = $result2[0];
		return $id_Carrera;
	}
 ?>