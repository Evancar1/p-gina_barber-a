<?php

require_once "../controladores/precio.controlador.php";
require_once "../modelos/precio.modelo.php";

class AjaxPrecio{

	/*=============================================
	EDITAR PRECIO
	=============================================*/	

	public $idPrecio;

	public function ajaxEditarPrecio(){

		$item = "id_precio";
		$valor = $this->idPrecio;

        $respuesta = ControladorPrecio::ctrMostrarPrecio($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR PRECIO 
=============================================*/
if(isset($_POST["idPrecio"])){

	$editar = new AjaxPrecio();
	$editar -> idPrecio = $_POST["idPrecio"];
	$editar -> ajaxEditarPrecio();

}
