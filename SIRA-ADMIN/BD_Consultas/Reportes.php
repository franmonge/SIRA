<?php
	require('Classes\PHPExcel.php');
	if(isset($_POST['GenerarBecas'])){
		include('Conexion.php');
		$groupId = filter_input(INPUT_POST, 'group');
		$Annio = date('Y');
		if(date('m') < 07){
		  $Semestre = "II";
		  $Annio = $Annio -1;
		}else{
		  $Semestre ="I";
		}
		$phpExcel = new PHPExcel;
		$phpExcel->getDefaultStyle()->getFont()->setName('Arial');
		$phpExcel->getDefaultStyle()->getFont()->setSize(10);
		$phpExcel ->getProperties()->setTitle("Postulantes Becas");
		$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
		$sheet = $phpExcel ->getActiveSheet();
		$sheet->setTitle('Postulantes Becas');
		$phpExcel->getActiveSheet()->mergeCells('A1:I1');
		$phpExcel->getActiveSheet()->mergeCells('A2:I2');
		$phpExcel->getActiveSheet()->mergeCells('F4:G4');
		$sheet ->getCell('A1')->setValue('ESTUDIANTES POSTULADOS');
		$sheet->getCell('A2')->setValue('BECA CULTURAL Y DEPORTIVA');
		$sheet->getCell('F4')->setValue('RENDIMIENTO '.$Semestre .' SEMESTRE '.$Annio);
		$sheet->getCell('A5')->setValue('NO.');
		$sheet->getCell('B5')->setValue('CARNÉ');
		$sheet->getCell('C5')->setValue('NOMBRE COMPLETO');
		$sheet->getCell('D5')->setValue('GRUPO');
		$sheet->getCell('E5')->setValue('NOTA');
		$sheet->getCell('F5')->setValue('MATRICULADOS');
		$sheet->getCell('G5')->setValue('APROBADOS');
		$sheet->getCell('H5')->setValue('CATEGORIA BECA');
		$sheet->getCell('I5')->setValue('OBSERVACIONES');
		$phpExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpExcel->getActiveSheet()->getStyle('A2:I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpExcel->getActiveSheet()->getStyle('A5:I5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00008B');
		$phpExcel->getActiveSheet()->getStyle('F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00008B');
		$phpExcel->getActiveSheet()->getStyle('F4')->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_WHITE));
		$phpExcel->getActiveSheet()->getStyle('A5:I5')->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_WHITE));
		$phpExcel->getActiveSheet()->getStyle('A5:I5')->getFont()->setBold(true);
		$phpExcel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		if ($conn->connect_error){
	    	die("Connection failed: " . $conn->connect_error);
	  	}else{
		    $query = "SELECT id_Usuario FROM uxg WHERE id_Grupo = '$groupId'";
		    $idUsuario = mysqli_query($conn, $query);
		    $query = "SELECT nombre FROM grupo WHERE id = '$groupId'";
		    $result = mysqli_query($conn, $query);
		    while($row = $result->fetch_assoc()){
		    	$nombreGrupo = $row['nombre'];
		    }
		    $celda = '6';
		    $contador = '1';
				while($row = $idUsuario->fetch_assoc()){
					$id = $row['id_Usuario'];
					$query = "SELECT nombre, apellidos, carnet FROM usuario WHERE id = '$id'";
					$result3 = mysqli_query($conn, $query);
					while($row2 = $result3->fetch_assoc()){
						$nombreUsuario = $row2['nombre']." ".$row2['apellidos'];
						$carnetUsuario = $row2['carnet'];
						$celdaNum = 'A'.$celda;
						$celdaCarnet = 'B'.$celda;
						$celdaNombre = 'C'.$celda;
						$celdaGrupo = 'D'.$celda;
						$sheet->getCell($celdaNum)->setValue($contador);
						$sheet->getCell($celdaNombre)->setValue($nombreUsuario);
						$sheet->getCell($celdaCarnet)->setValue($carnetUsuario);
						$sheet->getCell($celdaGrupo)->setValue($nombreGrupo);
						$celda += 1;
						$contador += 1;
					}
				}
			}
			$fileN = str_replace(' ','_','Postulantes Becas '.$nombreGrupo.'.xls');
		    $writer->save($fileN);
			$file = $fileN;

			if (file_exists($file)) {
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			    header('Content-Disposition: attachment; filename='.basename($file));
			    header('Content-Transfer-Encoding: binary');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($file));
			    ob_clean();
			    flush();
			    readfile($file);
				unlink($file);
			    exit;
			}
			$conn->close();
			header("Location: ../adminReportes.php");
	 }

	 if(isset($_POST['GenerarAsistenciasbtn'])){
	 	include('Conexion.php');
		$groupId = filter_input(INPUT_POST, 'group');
		$Annio = date('Y');
		$mes = filter_input(INPUT_POST, 'mes');
		if($mes < 07){
		  $Semestre = "I";
		}else{
		  $Semestre ="II";
		}
		$phpExcel = new PHPExcel;
		$phpExcel->getDefaultStyle()->getFont()->setName('Arial');
		$phpExcel->getDefaultStyle()->getFont()->setSize(10);
		$phpExcel ->getProperties()->setTitle("Postulantes Becas");
		$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
		$sheet = $phpExcel ->getActiveSheet();
		$sheet->setTitle('Reporte de Asistencia');
		$phpExcel->getActiveSheet()->mergeCells('A1:I1');
		$phpExcel->getActiveSheet()->mergeCells('A2:I2');
		$phpExcel->getActiveSheet()->mergeCells('F4:G4');
		$sheet->getCell('A2')->setValue('Reporte de asistencia - '.$Semestre .' Semestre '.$Annio);
		$sheet->getCell('A4')->setValue('NO.');
		$sheet->getCell('B4')->setValue('CARNÉ');
		$sheet->getCell('C4')->setValue('NOMBRE COMPLETO');
		$sheet->getCell('D4')->setValue('Fecha');
		$sheet->getCell('E4')->setValue('Asistencia');
		$phpExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpExcel->getActiveSheet()->getStyle('A2:I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpExcel->getActiveSheet()->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00008B');
		$phpExcel->getActiveSheet()->getStyle('A4:E4')->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_WHITE));
		$phpExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true);
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		if ($conn->connect_error){
	    	die("Connection failed: " . $conn->connect_error);
	  	}else{	
	  		$query = "SELECT nombre FROM grupo WHERE id =".$groupId;
	  		$result = mysqli_query($conn, $query);
	  		while($row = $result->fetch_assoc()){
		    	$nombreGrupo = $row['nombre'];
		    }
	  		$sheet->getCell('A1')->setValue($nombreGrupo);
	  		$fecha = (date($Annio.'-'.$mes.'-1'));
	  		$celda = '5';
	  		$contador = '1';
	  		$query = "SELECT id, fecha FROM ensayo WHERE MONTH(fecha)='$mes' AND YEAR(fecha)='$Annio' AND idGrupo=".$groupId;
	  		if($result = mysqli_query($conn, $query)){
	  			echo "entre!";
		  		while($row = $result->fetch_assoc()){
		  			$query2 = "SELECT nombre, apellidos, carnet, asistenciaensayos.Estado FROM usuario JOIN asistenciaensayos ON idPersona = usuario.id AND idEnsayo =".$row['id'];
		  			$result2 = mysqli_query($conn, $query2);
		  			while($row2 = $result2->fetch_assoc()){
		  				$nombreUsuario = $row2['nombre']." ".$row2['apellidos'];
						$carnetUsuario = $row2['carnet'];
		  				$fecha = $row['fecha'];
		  				$asistencia = $row2['Estado'];
		  				$celdaNum = 'A'.$celda;
		  				$celdaCarnet = 'B'.$celda;
		  				$celdaNombre = 'C'.$celda;
		  				$celdaFecha = 'D'.$celda;
		  				$celdaAsistencia = 'E'.$celda;
		  				$sheet->getCell($celdaNum)->setValue($contador);
		  				$sheet->getCell($celdaCarnet)->setValue($carnetUsuario);
		  				$sheet->getCell($celdaNombre)->setValue($nombreUsuario);
		  				$sheet->getCell($celdaFecha)->setValue($fecha);
		  				$sheet->getCell($celdaAsistencia)->setValue($asistencia);
		  				$phpExcel->getActiveSheet()->getStyle($celdaAsistencia)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_WHITE));
						$phpExcel->getActiveSheet()->getStyle($celdaAsistencia)->getFont()->setBold(true);
		  				if($sheet->getCell($celdaAsistencia)->getValue() == "Presente"){
		  					$phpExcel->getActiveSheet()->getStyle($celdaAsistencia)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');
		  				}else{
		  					$phpExcel->getActiveSheet()->getStyle($celdaAsistencia)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
		  				}
		  				$celda += 1;
		  				$contador += 1;
		  			}
		  		}
		  	}
			$fileN = str_replace(' ','_','Reporte de asistencias de '.$nombreGrupo.' del '.$mes.' de '.$Annio.'.xls');
		    $writer->save($fileN);
			$file = $fileN;
			if (file_exists($file)) {
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			    header('Content-Disposition: attachment; filename='.basename($file));
			    header('Content-Transfer-Encoding: binary');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($file));
			    ob_clean();
			    flush();
			    readfile($file);
				unlink($file);
			    exit;
			}
			$conn->close();
			header("Location: ../adminReportes.php");
	 	}
	}

	 if(isset($_POST['GenerarPresentacionesbtn'])){
	 	include('Conexion.php');
	 	$groupId = filter_input(INPUT_POST, 'group');
	 	$annio = filter_input(INPUT_POST, 'Annio');
		$phpExcel = new PHPExcel;
		$phpExcel->getDefaultStyle()->getFont()->setName('Arial');
		$phpExcel->getDefaultStyle()->getFont()->setSize(10);
		$phpExcel ->getProperties()->setTitle("REPORTE PRESENTACIONES");
		$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
		$sheet = $phpExcel ->getActiveSheet();
		$sheet->setTitle('Reporte Presentaciones');
		$phpExcel->getActiveSheet()->mergeCells('A1:I1');
		$sheet ->getCell('A1')->setValue('REPORTE DE PRESENTACIONES '.$annio);
		$sheet->getCell('A3')->setValue('NO.');
		$sheet->getCell('B3')->setValue('NOMBRE');
		$sheet->getCell('C3')->setValue('FECHA');
		$sheet->getCell('D3')->setValue('HORA');
		$sheet->getCell('E3')->setValue('LUGAR');
		$sheet->getCell('F3')->setValue('COSTO');
		$sheet->getCell('G3')->setValue('DESCRIPCIÓN');
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		if ($conn->connect_error){
	    	die("Connection failed: " . $conn->connect_error);
	  	}else{
	  		$contador = '1';
	  		$celda = '4';
	  		$query = "SELECT nombre FROM grupo WHERE id = '$groupId'";
		    $result = mysqli_query($conn, $query);
		    while($row = $result->fetch_assoc()){
		    	$nombreGrupo = $row['nombre'];
		    }
	  		$query = "SELECT nombre, date(fecha) as fecha, Time(fecha) as hora, lugar, costo, descripcion FROM presentacion WHERE  YEAR(Fecha) = $annio";
	  		$result = mysqli_query($conn, $query);
	  		while($row = $result->fetch_assoc()){
	  			$nombrePresentacion = $row['nombre'];
	  			$fechaPresentacion = $row['fecha'];
	  			$horaPresentacion = $row['hora'];
	  			$lugarPresentacion = $row['lugar'];
	  			$costoPresentacion = $row['costo'];
	  			$descripcionPresentacion = $row['descripcion'];
	  			$celdaNum = 'A'.$celda;
	  			$celdaNombre = 'B'.$celda;
	  			$celdaFecha = 'C'.$celda;
	  			$celdaHora = 'D'.$celda;
	  			$celdaLugar = 'E'.$celda;
	  			$celdaCosto = 'F'.$celda;
	  			$celdaDescripcion = 'G'.$celda;
	  			$sheet->getCell($celdaNum)->setValue($contador);
	  			$sheet->getCell($celdaNombre)->setValue($nombrePresentacion);
	  			$sheet->getCell($celdaFecha)->setValue($fechaPresentacion);
	  			$sheet->getCell($celdaHora)->setValue($horaPresentacion);
	  			$sheet->getCell($celdaLugar)->setValue($lugarPresentacion);
	  			$sheet->getCell($celdaCosto)->setValue($costoPresentacion);
	  			$sheet->getCell($celdaDescripcion)->setValue($descripcionPresentacion);
	  			$celda += 1;
	  			$contador += 1;
	  		}
			$fileN = str_replace(' ','_','Reporte de '.$nombreGrupo.' '.$annio.'.xls');
		    $writer->save($fileN);
			$file = $fileN;
			if (file_exists($file)) {
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			    header('Content-Disposition: attachment; filename='.basename($file));
			    header('Content-Transfer-Encoding: binary');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($file));
			    ob_clean();
			    flush();
			    readfile($file);
				unlink($file);
			    exit;
			}
			$conn->close();
			header("Location: ../adminReportes.php");
	 	}
	}
?>
