<?php
    function getPreviewImages(){

        require('Conexion.php');
        if ($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
        }else{
          $query = "SELECT id, image_path FROM galeria ORDER BY id DESC LIMIT 2";
          $result = mysqli_query($conn, $query);
          $Codigo="";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $Codigo .= "<div class=\"col-lg-4 col-md-12 mb-4\">
                <!--Modal: Name-->
                <div class=\"modal fade\" id=\"modal".$row["id"]."\">
                  <div class=\"modal-dialog modal-lg\" role=\"document\">
                    <!--Content-->
                    <div class=\"modal-content\">
                      <!--Body-->
                      <div class=\"modal-body mb-0 p-0\">
                        <div class=\"embed-responsive embed-responsive-16by9 z-depth-1-half\">
                          <iframe class=\"embed-responsive-item\" src=\"".$row["image_path"]."\"
                            allowfullscreen></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <a><img class=\"img-fluid\" src=\"".$row["image_path"]."\"
                    data-toggle=\"modal\" data-target=\"#modal".$row["id"]."\"></a>
              </div>";
          }
          $Codigo .= "<div class=\"card card-cascade wider col-lg-4 col-md-12 mb-4\">
                  <div class=\"view view-cascade overlay\">
                      <button type=\"button\" class=\"btn btn-light-blue btn-md\"
                      style=\"margin-left:auto;margin-right:auto;display:block;margin-top:50%\" onclick=\"location.href='galeria.php';\">+Ver Más</button>
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
