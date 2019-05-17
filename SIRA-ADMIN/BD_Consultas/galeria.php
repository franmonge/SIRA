<?php


if(isset($_POST['imageId'])){
    require('Conexion.php');
    $id = filter_input(INPUT_POST, 'imageId');
    $name = filter_input(INPUT_POST, 'imageName');
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }else{
        $sql = "DELETE FROM galeria where id = $id";
        if(mysqli_query($conn, $sql)){
            unlink('../'.$name);
        }else{
            echo "Error" .mysqli_error($conn);
        }
    }
    $conn->close();
    echo "<br>Archivo eliminado con éxito";
}

function uploadImage(){
    $target_dir = "../img/";
    $target_file = $target_dir;
    if(isset($_FILES["fileToUpload"]["name"])){
        $target_file .= basename($_FILES["fileToUpload"]["name"]);
    }
     $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "<br>El archivo no es una imagen";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<br>No se puede cargar, el archivo ya existe";
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
                    $path = "img/".basename($_FILES["fileToUpload"]["name"]);
                    $sql = "INSERT INTO galeria(image_path) VALUES ('$path')";
                    if(mysqli_query($conn, $sql)){
                        //
                    }else{
                        echo "Error" .mysqli_error($conn);
                    }
                }
                $conn->close();
                echo "<br>Archivo cargado con éxito";
            } else {
                echo "<br>Error al cargar el archivo.";
            }
        }
    }
    else{
        echo "";
    }
}

function getImages(){
require('BD_Consultas\Conexion.php');
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}else{
  $query = "  SELECT id, image_path FROM galeria ORDER BY id DESC";
  $result = mysqli_query($conn, $query);
  if($result->num_rows > 0){
    $Codigo = "
     <!-- Main content -->
     <section class=\"content\">
       <div class=\"row\">
         <div class=\"col-xs-12\">
           <div class=\"box\">
             <div class=\"box-header\">
               <h3 class=\"box-title\">Galería</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">

               <table id=\"table-Gallery\" class=\"table table-bordered table-striped\">
                 <thead>
                 <tr>
                   <th>Imagen</th>
                   <th>Eliminar</th>
                 </tr>
                 </thead>
                 <tbody>";

    while($row = $result->fetch_assoc()){
      $Codigo .= "<tr>";
      $Codigo .= "<td style=\"text-align: center;\"> <div class=\"modal fade\" id=\"modal".$row["id"]."\">
            <div class=\"modal-dialog modal-lg\" role=\"document\">
              <!--Content-->
              <div class=\"modal-content\">
                <!--Body-->
                <div class=\"modal-body mb-0 p-0\">
                  <div class=\"embed-responsive embed-responsive-16by9 z-depth-1-half\">
                    <img class=\"embed-responsive-item\" src=\"../".$row["image_path"]."\">
                  </div>
                </div>
              </div>
              <!--/.Content-->
            </div>
          </div>
          <!--Modal: Name-->
          <a><img class=\"img-fluid\" src=\"../".$row["image_path"]."\"
              data-toggle=\"modal\" data-target=\"#modal".$row["id"]."\" style=\"max-width: 250px;max-height: 250px;\"></a></td>";


      $Codigo .= "<td style=\"vertical-align:middle\">" ."<form action=\"adminGaleria.php\" method=\"post\">
      <input type=\"hidden\" name=\"imageId\" value=\"".$row["id"]."\">
      <input type=\"hidden\" name=\"imageName\" value=\"".$row["image_path"]."\" >
      <input type=\"submit\"  class=\"btn btn-block btn-danger btn-flat\" value=\"Eliminar\">
      </form></td>";
      $Codigo .= "</tr>";
    }
    $Codigo .= "
    </tbody>
      <tfoot>
        <tr>
          <th>Imagen</th>
          <th>Eliminar</th>
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
  }else {
    $Codigo = " <!-- Main content -->
     <section class=\"content\">
       <div class=\"row\">
         <div class=\"col-xs-12\">
           <div class=\"box\">
             <div class=\"box-header\">
               <h3 class=\"box-title\">Galería</h3>
             </div>
             <!-- /.box-header -->
             <div class=\"box-body\">
             <h2> No hay imágenes para mostrar </h2>
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
?>
