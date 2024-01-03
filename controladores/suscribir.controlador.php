<?php

class ControladorSuscriptor
{
	/* =======================================
    REGISTRO DE SUSCRIPTORES
    ======================================= */

	static public function ctrCrearSuscriptor()
	{

		if (isset($_POST["nuevoCorreoS"])) {

			if ($_POST["nuevoCorreoS"]) {

				$tabla = "suscribirse";

				$datos = array(
                    "correo" => $_POST["nuevoCorreoS"]
				);
              
                $respuesta = ModeloSusccriptor::mdlIngresarSuscriptor($tabla, $datos);

                if ($respuesta == "ok") {

					echo '<script>

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Te suscribiste con éxito",
                            showConfirmButton: false,
                            timer: 1500
                        })
                            

                        setTimeout(function(){
                            window.location = "admin-suscriptor";
                        }, 2000);

						</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡No existe dato!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "admin-suscriptor";

						}

					});
				

				</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR SUSCRIPTORES
    ======================================== */

	static public function ctrMostrarSuscriptor($item, $valor)
	{
		$tabla = "suscribirse";

        $respuesta = ModeloSusccriptor::mdlMostrarSuscriptor($tabla, $item, $valor);

		return $respuesta;
	}


	/* ========================================
	BORRAR SUSCRIPTORES
	======================================== */

	static public function ctrBorrarSuscriptor(){
		if(isset($_GET["idSuscriptor"])){
			$tabla = "suscribirse";
			$datos = $_GET["idSuscriptor"];

            $respuesta = ModeloSusccriptor::mdlBorrarSuscriptor($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡Suscriptor borrado!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-suscriptor";

						}

					});
			

			</script>';

			}
		}
	}
}
