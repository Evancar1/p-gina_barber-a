<?php

require_once "../controladores/empresa.controlador.php";
require_once "../modelos/empresa.modelos.php";

class AjaxEmpresa{

	/*=============================================
	EDITAR EMPRESA
	=============================================*/	

	public $idEmpresa;

	public function ajaxEditarEmpresa(){

		$item = "id";
		$valor = $this->idEmpresa;

        $respuesta = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR EMPRESA
=============================================*/
if(isset($_POST["idEmpresa"])){

	$editar = new AjaxEmpresa();
	$editar -> idEmpresa = $_POST["idEmpresa"];
	$editar -> ajaxEditarEmpresa();

}
