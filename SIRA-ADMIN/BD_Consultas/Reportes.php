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
		// Crea Excel
		$phpExcel = new PHPExcel;
		// Setting font to Arial Black
		$phpExcel->getDefaultStyle()->getFont()->setName('Arial');
		// Setting font size to 14
		$phpExcel->getDefaultStyle()->getFont()->setSize(10);
		//Setting description, creator and title
		$phpExcel ->getProperties()->setTitle("Postulantes Becas");
		// Creating PHPExcel spreadsheet writer object
		// We will create xlsx file (Excel 2007 and above)
		$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
		// When creating the writer object, the first sheet is also created
		// We will get the already created sheet
		$sheet = $phpExcel ->getActiveSheet();
		// Setting title of the sheet
		$sheet->setTitle('Postulantes Becas');
		$phpExcel->getActiveSheet()->mergeCells('A1:I1');
		$phpExcel->getActiveSheet()->mergeCells('A2:I2');
		$phpExcel->getActiveSheet()->mergeCells('F4:G4');
		// add some text
		$sheet ->getCell('A1')->setValue('ESTUDIANTES POSTULADOS');
		// $phpExcel->getActiveSheet()->setCellValue('A1','ESTUDIANTES POSTULADOS');
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
		// Making headers text bold and larger
		// $sheet->getStyle('A1:D1')->getFont()->setBold(true)->setSize(14);
		// Insert product data
		// Autosize the columns 
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);

		//Consulta bd
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
						$celdaNombre = 'C'.$celda;
						$celdaCarnet = 'B'.$celda;
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
		    $writer->save('Postuluantes Becas '.$nombreGrupo.'.xlsx');
			$conn->close();
			header("Location: ../adminReportes.php");
			// header('Content-Type: application/vnd.ms-excel');
   //  		header('Content-Disposition: attachment; filename="Spreadsheet.xls"');
			// ob_get_clean();
			// echo file_get_contents($filename);
			// ob_end_flush();
			// $writer->save('php://output');
	 }

	 if(isset($_POST['GenerarPresentacionesbtn'])){
	 	include('Conexion.php');
	 	$groupId = filter_input(INPUT_POST, 'group');
	 	$annio = filter_input(INPUT_POST, 'Annio');
		// // Crea Excel
		$phpExcel = new PHPExcel;
		// Setting font to Arial Black
		$phpExcel->getDefaultStyle()->getFont()->setName('Arial');
		// Setting font size to 14
		$phpExcel->getDefaultStyle()->getFont()->setSize(10);
		//Setting description, creator and title
		$phpExcel ->getProperties()->setTitle("REPORTE PRESENTACIONES");
		// Creating PHPExcel spreadsheet writer object
		// We will create xlsx file (Excel 2007 and above)
		$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
		// When creating the writer object, the first sheet is also created
		// We will get the already created sheet
		$sheet = $phpExcel ->getActiveSheet();
		// Setting title of the sheet
		$sheet->setTitle('Reporte Presentaciones');
		$phpExcel->getActiveSheet()->mergeCells('A1:I1');
		// add some text
		$sheet ->getCell('A1')->setValue('REPORTE DE PRESENTACIONES '.$annio);
		// $phpExcel->getActiveSheet()->setCellValue('A1','ESTUDIANTES POSTULADOS');
		$sheet->getCell('A3')->setValue('NO.');
		$sheet->getCell('B3')->setValue('NOMBRE');
		$sheet->getCell('C3')->setValue('FECHA');
		$sheet->getCell('D3')->setValue('HORA');
		$sheet->getCell('E3')->setValue('LUGAR');
		$sheet->getCell('F3')->setValue('COSTO');
		$sheet->getCell('G3')->setValue('DESCRIPCIÓN');
		// Making headers text bold and larger
		// $sheet->getStyle('A1:D1')->getFont()->setBold(true)->setSize(14);
		// Insert product data
		// Autosize the columns
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);

		//Consulta bd
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
		    $writer->save('Reporte de '.$nombreGrupo.'.xlsx');
			$conn->close();
			header("Location: ../adminReportes.php");
	 	}
	}
		
		// Save the spreadsheet
		// $writer->save('excel-files/products.xlsx');
		// We'll be outputting an excel file
		// header('Content-type: application/vnd.ms-excel');
		// // It will be called file.xls
		// header('Content-Disposition: attachment; filename="products.xls"');
		// Write file to the browser
		
		// $writer->save('php://output');
?>