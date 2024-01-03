<?php

class ControladorServicio
{
	/* =======================================
    REGISTRO DE SERVICIO
    ======================================= */

	static public function ctrCrearServicio()
	{

		if (isset($_POST["nuevoTitulosS"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTitulosS"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/


				$ruta = "";

				if(isset($_FILES["nuevoFotoS"])){

					$file_name = $_FILES['nuevoFotoS']['name'];
					$temp_name = $_FILES['nuevoFotoS']['tmp_name'];

					$directorio = "";
					
					$directorio = "vistas/img/servicio/".$_POST["nuevoCodigoS"];

					mkdir($directorio, 0755);

					if($_FILES["nuevoFotoS"]["type"] == "image/png" || $_FILES["nuevoFotoS"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/servicio/".$_POST["nuevoCodigoS"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}


				$tabla = "servicio";


				$datos = array(
                    "codigo" => $_POST["nuevoCodigoS"],
					"imagen" => $ruta,
					"titulos" => $_POST["nuevoTitulosS"],
					"texto" => $_POST["nuevoDescripcionS"]
				);

                $respuesta = ModeloServicio::mdlIngresarServicio($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

								Swal.fire({
									title: "¡Datos del servicio han sido guardados con exito!",
									text: "Has click para cerrar",
									icon: "success",
									confirmButtonColor: "#0576b9",
								}).then(function(result){

										if(result.value){
										
											window.location = "admin-servicio";

										}

									});
							

							</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El titulos del servicio no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "admin-servicio";

						}

					});
				

				</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR SERVICIO
    ======================================== */

	static public function ctrMostrarServicio($item, $valor)
	{
		$tabla = "servicio";

        $respuesta = ModeloServicio::mdlMostrarServicio($tabla, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR SERVICIO
	============================================= */

	static public function ctrEditarServicio()
	{

		if (isset($_POST["editarIdServicio"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTituloS"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActualS"];


				if(isset($_FILES["editarFotoS"])){
					
					$file_name = $_FILES['editarFotoS']['name'];
					$temp_name = $_FILES['editarFotoS']['tmp_name'];
					
					$directorio = "vistas/img/servicio/".$_POST["editarCodigoS"];

					mkdir($directorio, 0755);

					if($_FILES["editarFotoS"]["type"] == "image/png" || $_FILES["editarFotoS"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/servicio/".$_POST["editarCodigoS"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}

				$tabla = "servicio";


				$datos = array(
					"id_servicio" => $_POST["editarIdServicio"],
					"codigo" => $_POST["editarCodigoS"],
					"imagen" => $ruta,
					"titulos" => $_POST["editarTituloS"],
					"texto" => $_POST["editarTextoS"]
				);

                $respuesta = ModeloServicio::mdlEditarServicio($tabla, $datos);
				if ($respuesta == "ok") {

					echo '<script>
			   
											 Swal.fire({
												 title: "¡Los datos del servicio han sido editados con éxito!",
												 text: "Has click para cerrar",
												 icon: "success",
												 confirmButtonColor: "#0576b9",
											 }).then(function(result){
			   
													 if(result.value){
													 
														 window.location = "admin-servicio";
			   
													 }
			   
												 });
										 
			   
										 </script>';
				}
			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El titulos del servicio no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-servicio";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR SERVICIO
	======================================== */

	static public function ctrBorrarServicio(){
		if(isset($_GET["idServicio"])){
			$tabla = "servicio";
			$datos = $_GET["idServicio"];
			if($_GET["imagen"]!=""){
				unlink($_GET["imagen"]);
				rmdir('vistas/img/servicio/'.$_GET["codigo"]);
			}

            $respuesta = ModeloServicio::mdlBorrarServicio($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡Los datos del servicio han sido borrados con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-servicio";

						}

					});
			

			</script>';

			}
		}
	}
}
