<?php

class ControladorReserva
{
	/* =======================================
    REGISTRO DE RESERVA
    ======================================= */

	static public function ctrCrearReserva()
	{

		if (isset($_POST["nuevoNombreR"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreR"])) {


				$tabla = "reserva";


				$datos = array(
                    "id_precio" => $_POST["nuevoPrecioR"],
                    "nombre" => $_POST["nuevoNombreR"],
                    "correo" => $_POST["nuevoCorreoR"],
					"telefono" => $_POST["nuevoTelefonoR"],
					"fecha" => $_POST["nuevoFechaR"],
					"hora" => $_POST["nuevoHoraR"],
					"mensaje" => $_POST["nuevoMensajeR"]
				);
              
				$respuesta = ModeloReserva::mdlIngresarReserva($tabla, $datos);

                if ($respuesta == "ok") {

					echo '<script>

							Swal.fire({
								title: "¡Reservado con exito!",
								text: "Has click para cerrar",
								icon: "success",
								confirmButtonColor: "#0576b9",
							}).then(function(result){

									if(result.value){
									
										window.location = "admin-reservas";

									}

								});
						

						</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "admin-reservas";

						}

					});
				

				</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR RESERVA
    ======================================== */

	static public function ctrMostrarReserva($item, $valor)
	{
		$tablaP = "precio";
		$tablaR = "reserva";

		$respuesta = ModeloReserva::mdlMostrarReserva($tablaP, $tablaR, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR RESERVA
	============================================= */

	static public function ctrEditarReserva()
	{

		if (isset($_POST["editarNombreR"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreR"])) {

				$tabla = "reserva";


				$datos = array(
					"id_reserva" => $_POST["editarIdReserva"],
                    "nombre" => $_POST["editarNombreR"],
                    "correo" => $_POST["editarCorreoR"],
                    "telefono" => $_POST["editarTelefonoR"],
					"id_precio" => $_POST["editarReserva"],
					"fecha" => $_POST["editarFechaR"],
					"hora" => $_POST["editarHoraR"],
					"mensaje" => $_POST["editarMensajeR"]
				);

				$respuesta = ModeloReserva::mdlEditarReserva($tabla, $datos);
                
				if ($respuesta == "ok") {

					echo '<script>
			   
                            Swal.fire({
                                title: "¡Los datos de la reserva han sido editados con éxito!",
                                text: "Has click para cerrar",
                                icon: "success",
                                confirmButtonColor: "#0576b9",
                            }).then(function(result){

                                    if(result.value){
                                    
                                        window.location = "admin-reservas";

                                    }

                                });
                        

                        </script>';
				}
                
			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El nombre del reserva no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-reservas";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR RESERVA
	======================================== */

	static public function ctrBorrarReserva(){
		if(isset($_GET["idReserva"])){
			$tabla = "reserva";
			$datos = $_GET["idReserva"];

			$respuesta = ModeloReserva::mdlBorrarReserva($tabla, $datos);
			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡Los datos de la reserva han sido borrados con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-reservas";

						}

					});
			

			</script>';

			}
		}
	}
}
