<?php


require_once "../controladores/seo.controlador.php";
require_once "../modelos/seo.modelo.php";

class AjaxSEO{

	/*=============================================
	EDITAR SEO
	=============================================*/	

	public $idSeo;

	public function ajaxEditarSEO(){

		$item = "id_seo";
		$valor = $this->idSeo;

        $respuesta = ControladorSEO::ctrMostrarSEO($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR SEO
=============================================*/
if(isset($_POST["idSeo"])){

	$editar = new AjaxSEO();
	$editar -> idSeo = $_POST["idSeo"];
	$editar -> ajaxEditarSEO();

}
