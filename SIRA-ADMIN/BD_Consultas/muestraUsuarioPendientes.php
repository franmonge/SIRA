<?php
	require('Conexion.php');
 	$postnames = array_keys($_POST);
 	if ($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
	}else{
		$sql = "SELECT Nombre FROM usuario WHERE Estado = 'Pendiente'";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
            echo
            "<div>
                <div class=\"box box-danger\">
                    <div class=\"box-header with-border\">
                    <h3 class=\"box-title\">Nuevas Solicitudes</h3>
                </div>
            <!-- /.box-header -->
            <div class=\"box-body no-padding\">
                <ul class=\"users-list clearfix\">";
			while($row = $result->fetch_assoc()){
                echo 
                "<li>
                    <img src=\"dist/img/user3-128x128.jpg\" alt=\"User Image\">
                    <a class=\"users-list-name\">".$row['Nombre']. "</a>       
                </li>";
            }
            echo
                "</ul>
            <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
                <div class=\"box-footer text-center\">
                    <a href=\"adminSolicitudes.php\" class=\"uppercase\">View All Users</a>
                </div>
            <!-- /.box-footer -->
            </div>";
                
		}else{
			echo "Fallo";
		}
	}
	$conn->close();

 ?>