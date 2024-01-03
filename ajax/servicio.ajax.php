<?php

require_once "../controladores/servicio.controlador.php";
require_once "../modelos/servicio.modelo.php";

class AjaxServicio{

	/*=============================================
	EDITAR SERVICIO
	=============================================*/	

	public $idServicio;

	public function ajaxEditarServicio(){

		$item = "id_servicio";
		$valor = $this->idServicio;

        $respuesta = ControladorServicio::ctrMostrarServicio($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR SERVICIO 
=============================================*/
if(isset($_POST["idServicio"])){

	$editar = new AjaxServicio();
	$editar -> idServicio = $_POST["idServicio"];
	$editar -> ajaxEditarServicio();

}
