<?php
error_reporting(0);
date_default_timezone_set("America/Lima");
?>
<!DOCTYPE html>
<html lang="es">

<head>
<?php include "main/head-footer/head.php"; ?>
</head>

<body id="top">

<?php
      /* ================================================
      CONTADOR DE VISITAS
      ================================================ */
      $ip = $_SERVER['REMOTE_ADDR'];
      $tipo = "contar";

      $sqlConsultar = ControladorVisitas::ctrMostrarVisitas($ip, $tipo);

      $contarVisitasG = count($sqlConsultar);
      $contarVisitas0 = count($sqlConsultar);

      
      if($contarVisitasG == 0){

        $contarVisitas0 = 1;
        $ingresoContador = new ControladorVisitas();
        $ingresoContador->ctrCrearVisitas($contarVisitas0);

      }
      else{

        foreach($sqlConsultar as $key => $value){
          $fechaRegistro = $value["fecha_visitas"];
          $fechaActual = date('Y-m-d H:i:s');
          $nuevaFecha = strtotime($fechaRegistro." + 1 hour");
          $nuevaFecha = date('Y-m-d H:i:s', $nuevaFecha);
        }

        if($fechaActual >= $nuevaFecha){

          $ingresoContador = new ControladorVisitas();
          $ingresoContador->ctrCrearVisitas($contarVisitasG+1);

        }

      }

      ?>

  <!-- header -->
  <?php include "main/contenido/header.php"; ?>

  <main>
    <article>
      <!-- slider -->
        <?php include "main/contenido/slider.php"; ?>
      <!-- servicios -->
        <?php include "main/contenido/servicios.php"; ?>
      <!-- precio -->
        <?php include "main/contenido/precio.php"; ?>
      <!-- galeria -->
        <?php include "main/contenido/galeria.php"; ?>
      <!-- citas -->
        <?php include "main/contenido/reservar.php"; ?>
    </article>
  </main>

<?php  include "main/head-footer/footer.php"; ?>
</body>

</html>



<!-- Login -->
<?php include "main/contenido/login.php"; ?>

