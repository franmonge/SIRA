<?php
  $a = ""; $b = "";$c = "";$d = "";$e = "";$f = "";$g = "";$h = "";$i = "";
  $archivo_actual = $_SERVER['PHP_SELF'] ; //Regresa el nombre del archivo actual
  switch($archivo_actual) //Valido en que archivo estoy para generar mi CSS de selección
  {
    case "/SIRA/SIRA-ADMIN/admin.php":
      $a = "class=\"active\"";
      $b = "";$c = "";$d = "";$e = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/SIRA/SIRA-ADMIN/adminGrupos.php":
      $b = "class=\"active\"";
      $a = "";$c = "";$d = "";$e = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/SIRA/SIRA-ADMIN/adminPresentaciones.php":
      $c = "class=\"active\"";
      $a = "";$b = "";$d = "";$e = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/SIRA/SIRA-ADMIN/adminMiembros.php":
      $d = "class=\"active\"";
      $a = "";$b = "";$c = "";$e = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/SIRA/SIRA-ADMIN/adminSolicitudes.php":
      $e = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/SIRA/SIRA-ADMIN/adminAsistencia.php":
      $f = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$e = "";$g = "";$h = "";$i = "";
      break;
    case "/SIRA/SIRA-ADMIN/adminReportes.php":
      $g = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$e = "";$f = "";$h = "";$i = "";
      break;
    case "/SIRA/SIRA-ADMIN/adminGaleria.php":
      $h = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$e = "";$f = "";$g = "";$i = "";
      break;
    case "/SIRA/SIRA-ADMIN/adminAdministradores.php":
      $i = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$e = "";$f = "";$g = "";$h = "";
      break;
  }
?>
