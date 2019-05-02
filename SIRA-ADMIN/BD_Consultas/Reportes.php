<?php
	require('Classes\PHPExcel.php');
	include('Conexion.php');
	// $conn->close();
	if(isset($_POST['GenerarBecas'])){
		$groupId = filter_input(INPUT_POST, 'group');
		$filename = "bechas.xls";
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
		$Grupo = "COMPAÑÍA FOLCLÓRICA TIERRA Y COSECHA";
		//Consulta bd
		
		if ($conn->connect_error){
	    	die("Connection failed: " . $conn->connect_error);
	  	}else{
		    $query = "SELECT id FROM grupo WHERE nombre = '$Grupo'";
		    $result = mysqli_query($conn, $query);
			$result2 = $result->fetch_array(MYSQLI_NUM);
			$idGrupo = $result2[0];
		    $query = "SELECT id_Usuario FROM uxg WHERE id_Grupo = '$idGrupo'";
		    $idUsuario = mysqli_query($conn, $query);
		    $celda = '6';
		    $contador = '1';
		 //    if($idUsuario->num_rows > 0){
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
						$sheet->getCell($celdaGrupo)->setValue($Grupo);
						$celda += 1;
						$contador += 1;
						echo $carnetUsuario;
					}
					// $nombreUsuario = str($result3->fetch_assoc());					
				}
			}
		    $writer->save('Postuluantes Becas'.$Grupo.'.xlsx');
			$conn->close();
			// header('Content-Type: application/vnd.ms-excel');
   //  		header('Content-Disposition: attachment; filename="Spreadsheet.xls"');
			// ob_get_clean();
			// echo file_get_contents($filename);
			// ob_end_flush();
			// $writer->save('php://output');
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