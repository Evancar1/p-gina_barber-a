<?php
session_start();

if (isset($_SESSION["iniciarSession"]) && $_SESSION["iniciarSession"] == "ok") {
  error_reporting(0);
  include "modulos/admin/head-footer/head.php";
  echo '<div id="layout-wrapper">';

  include "modulos/admin/contenido/admin-header.php";
  include "modulos/admin/contenido/admin-sidebar.php";

  if (isset($_GET["ruta"])) {

    if (
      $_GET["ruta"] == "admin-inicio" ||
      $_GET["ruta"] == "admin-usuarios" ||
      $_GET["ruta"] == "admin-empresa" ||
      $_GET["ruta"] == "admin-seo" ||
      $_GET["ruta"] == "admin-servicio" ||
      $_GET["ruta"] == "admin-precio" ||
      $_GET["ruta"] == "admin-galeria" ||
      $_GET["ruta"] == "admin-reservas" ||
      $_GET["ruta"] == "admin-suscriptor" ||
      $_GET["ruta"] == "admin-vista" ||
      $_GET["ruta"] == "admin-salir"
    ) {

      include "modulos/admin/contenido/" . $_GET["ruta"] . ".php";
    } else {

      include "modulos/admin/contenido/admin-404.php";
    }
  } else {

    include "modulos/admin/contenido/admin-inicio.php";
  }

  echo '</div>';
  include "modulos/admin/contenido/admin-ring-sidebar.php";
  include "modulos/admin/head-footer/footer.php";
} else {
  include "modulos/inicio.php";
}
