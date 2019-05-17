<?php
    function getPreviewImages(){

        require('Conexion.php');
        if ($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
        }else{
          $query = "SELECT id, image_path FROM galeria ORDER BY id DESC LIMIT 3";
          $result = mysqli_query($conn, $query);
          $Codigo="";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $Codigo .= "<div class=\"card card-cascade wider\">
                    <div class=\"view view-cascade overlay\">
                      <img  class=\"card-img-top\" src=\"".$row['image_path']."\"  alt=\"No image\">
                      </div>
                  </div>";
          }
          $Codigo .= "<div class=\"card card-cascade wider\">
                          <div class=\"view view-cascade overlay\">
                          <div style=\"
                          display: flex;
                          flex-direction: column;
                          justify-content: center;
                          overflow: auto;\" >
                          <p style=\"margin:0;\">
                      <button type=\"button\" class=\"btn btn-light-blue btn-md\" style=\"margin:35% auto; display:block\" onclick=\"location.href='galeria.php';\">+Ver Más</button>
                      </p>
                      </div>
                      </div>
              </div>
              ";
      }
          else {
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

          }
        }
        $conn->close();
        echo $Codigo;
        }
?>
