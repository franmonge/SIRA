<?php
    function getPreviewImages(){
        
        echo"      <div class=\"col-lg-4 col-md-12 mb-4\">
        <!--Modal: Name-->
        <div class=\"modal fade\" id=\"modal1\">
          <div class=\"modal-dialog modal-lg\" role=\"document\">
            <!--Content-->
            <div class=\"modal-content\">
              <!--Body-->
              <div class=\"modal-body mb-0 p-0\">
                <div class=\"embed-responsive embed-responsive-16by9 z-depth-1-half\"> 
                  <iframe class=\"embed-responsive-item\" src=\"http://localhost/SIRA/FotoSIRA/100_6967.JPG\"
                    allowfullscreen></iframe>
                </div>
              </div>
            </div>
            <!--/.Content-->
          </div>
        </div>
        <!--Modal: Name-->
        <a><img class=\"img-fluid\" src=\"http://localhost/SIRA/FotoSIRA/100_6967.JPG\"
            data-toggle=\"modal\" data-target=\"#modal1\"></a>
      </div>";
      }
?>