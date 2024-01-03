<?php

class ControladorPrecio
{
	/* =======================================
    REGISTRO DE PRECIO
    ======================================= */

	static public function ctrCrearPrecio()
	{

		if (isset($_POST["nuevoCodigoP"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloP"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/


				$ruta = "";

				if(isset($_FILES["nuevoFotoP"])){

					$file_name = $_FILES['nuevoFotoP']['name'];
					$temp_name = $_FILES['nuevoFotoP']['tmp_name'];

					$directorio = "";
					
					$directorio = "vistas/img/precio/".$_POST["nuevoCodigoP"];

					mkdir($directorio, 0755);

					if($_FILES["nuevoFotoP"]["type"] == "image/png" || $_FILES["nuevoFotoP"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/precio/".$_POST["nuevoCodigoP"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}


				$tabla = "precio";


				$datos = array(
                    "codigo" => $_POST["nuevoCodigoP"],
                    "id_servicio" => $_POST["nuevoServicio"],
					"imagen" => $ruta,
					"titulop" => $_POST["nuevoTituloP"],
					"descripcion" => $_POST["nuevoDescripcionP"],
					"precio" => $_POST["nuevoPrecio"]
				);
              
                $respuesta = ModeloPrecio::mdlIngresarPrecio($tabla, $datos);

                if ($respuesta == "ok") {

					echo '<script>

							Swal.fire({
								title: "¡Datos del precio han sido guardados con exito!",
								text: "Has click para cerrar",
								icon: "success",
								confirmButtonColor: "#0576b9",
							}).then(function(result){

									if(result.value){
									
										window.location = "admin-precio";

									}

								});
						

						</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El titulo del servicio no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "admin-precio";

						}

					});
				

				</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR PRECIO
    ======================================== */

	static public function ctrMostrarPrecio($item, $valor)
	{
		$tablaS = "servicio";
		$tablaP = "precio";

        $respuesta = ModeloPrecio::mdlMostrarPrecio($tablaS, $tablaP, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR PRECIO
	============================================= */

	static public function ctrEditarPrecio()
	{

		if (isset($_POST["editarIdPrecio"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTituloP"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActualP"];


				if(isset($_FILES["editarFotoP"])){
					
					$file_name = $_FILES['editarFotoP']['name'];
					$temp_name = $_FILES['editarFotoP']['tmp_name'];
					
					$directorio = "vistas/img/precio/".$_POST["editarCodigoP"];

					mkdir($directorio, 0755);

					if($_FILES["editarFotoP"]["type"] == "image/png" || $_FILES["editarFotoP"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/precio/".$_POST["editarCodigoP"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}

				$tabla = "precio";


				$datos = array(
					"id_precio" => $_POST["editarIdPrecio"],
                    "codigo" => $_POST["editarCodigoP"],
					"id_servicio" => $_POST["editarServicioP"],
					"imagen" => $ruta,
					"titulop" => $_POST["editarTituloP"],
					"descripcion" => $_POST["editarDescripcionP"],
					"precio" => $_POST["editarPrecio"]
				);

                $respuesta = ModeloPrecio::mdlEditarPrecio($tabla, $datos);
                
				if ($respuesta == "ok") {

					echo '<script>
			   
                            Swal.fire({
                                title: "¡Los datos del precio han sido editados con éxito!",
                                text: "Has click para cerrar",
                                icon: "success",
                                confirmButtonColor: "#0576b9",
                            }).then(function(result){

                                    if(result.value){
                                    
                                        window.location = "admin-precio";

                                    }

                                });
                        

                        </script>';
				}
                
			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El titulo del servicio no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-precio";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR PRECIO
	======================================== */

	static public function ctrBorrarPrecio(){
		if(isset($_GET["idPrecio"])){
			$tabla = "precio";
			$datos = $_GET["idPrecio"];
			if($_GET["imagen"]!=""){
				unlink($_GET["imagen"]);
				rmdir('vistas/img/precio/'.$_GET["codigo"]);
			}

            $respuesta = ModeloPrecio::mdlBorrarPrecio($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡Los datos del precio han sido borrados con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-precio";

						}

					});
			

			</script>';

			}
		}
	}
}
