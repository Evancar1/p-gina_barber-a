<?php

require_once "../controladores/reserva.controlador.php";
require_once "../modelos/reserva.modelo.php";

class AjaxReserva{

	/*=============================================
	EDITAR RESERVAS
	=============================================*/	

	public $idReserva;

	public function ajaxEditarReserva(){

		$item = "id_reserva";
		$valor = $this->idReserva;

        $respuesta = ControladorReserva::ctrMostrarReserva($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR RESEVRAS 
=============================================*/
if(isset($_POST["idReserva"])){

	$editar = new AjaxReserva();
	$editar -> idReserva = $_POST["idReserva"];
	$editar -> ajaxEditarReserva();

}
