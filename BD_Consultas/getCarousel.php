<?php

function getCarouselImages(){

    require('Conexion.php');
    if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }else{
      $query = "SELECT id, image_path FROM galeria ORDER BY id DESC LIMIT 3";
      $result = mysqli_query($conn, $query);
      $Codigo="";
      $active = "active";
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $Codigo .= "<div class=\"carousel-item ".$active."\">
              <div class=\"view\">
                <img class=\"d-block w-100\" src=\"".$row['image_path']."\" alt=\"No image\" style=\" max-height:600px; object-fit: contain;\">
              </div>
            </div>";
            $active = "";
            }
        }
    }
    $conn->close();
    echo $Codigo;
}


 ?>
