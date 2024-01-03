<?php

require_once "../controladores/galeria.controladores.php";
require_once "../modelos/galeria.modelo.php";

class AjaxGaleria{

	/*=============================================
	EDITAR GALERIA
	=============================================*/	

	public $idGaleria;

	public function ajaxEditarGaleria(){

		$item = "id";
		$valor = $this->idGaleria;

		$respuesta = ControladorGaleria::ctrMostrarGaleria($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR GALERIA 
=============================================*/
if(isset($_POST["idGaleria"])){

	$editar = new AjaxGaleria();
	$editar -> idGaleria = $_POST["idGaleria"];
	$editar -> ajaxEditarGaleria();

}
