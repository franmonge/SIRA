<?php
  $archivo_actual = $_SERVER['PHP_SELF'] ; //Regresa el nombre del archivo actual
  switch($archivo_actual) //Valido en que archivo estoy para generar mi CSS de selección
  {
    case "/sira/SIRA-ADMIN/admin.php":
      $a = "class=\"active\"";
      $b = "";$c = "";$d = "";$e = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/sira/SIRA-ADMIN/adminGrupos.php":
      $b = "class=\"active\"";
      $a = "";$c = "";$d = "";$e = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/sira/SIRA-ADMIN/adminPresentaciones.php":
      $c = "class=\"active\"";
      $a = "";$b = "";$d = "";$e = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/sira/SIRA-ADMIN/adminMiembros.php":
      $d = "class=\"active\"";
      $a = "";$b = "";$c = "";$e = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/sira/SIRA-ADMIN/adminSolicitudes.php":
      $e = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$f = "";$g = "";$h = "";$i = "";
      break;
    case "/sira/SIRA-ADMIN/adminAsistencia.php":
      $f = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$e = "";$g = "";$h = "";$i = "";
      break;
    case "/sira/SIRA-ADMIN/adminReportes.php":
      $g = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$e = "";$f = "";$h = "";$i = "";
      break;
    case "/sira/SIRA-ADMIN/adminGaleria.php":
      $h = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$e = "";$f = "";$g = "";$i = "";
      break;
    case "/sira/SIRA-ADMIN/adminAdministradores.php":
      $i = "class=\"active\"";
      $a = "";$b = "";$c = "";$d = "";$e = "";$f = "";$g = "";$h = "";
      break;
  }
?>