<?php

/* =================================
CONTROLADORES
================================= */
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/empresa.controlador.php";
require_once "controladores/seo.controlador.php";
require_once "controladores/servicio.controlador.php";
require_once "controladores/precio.controlador.php";
require_once "controladores/galeria.controladores.php";
require_once "controladores/reserva.controlador.php";
require_once "controladores/suscribir.controlador.php";
require_once "controladores/visitas.controlador.php";   

/* ===================================
MODELOS
=================================== */

require_once "modelos/conexion.php";
require_once "modelos/usuarios.modelos.php";
require_once "modelos/empresa.modelos.php";
require_once "modelos/seo.modelo.php";
require_once "modelos/servicio.modelo.php";
require_once "modelos/precio.modelo.php";
require_once "modelos/galeria.modelo.php";
require_once "modelos/reserva.modelo.php";
require_once "modelos/suscribir.modelo.php";
require_once "modelos/visitas.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();