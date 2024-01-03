<?php

class ControladorEmpresa
{
	/* =======================================
    REGISTRO DE EMPRESA
    ======================================= */

	static public function ctrCrearEmpresa()
	{

		if (isset($_POST["nuevoNombreE"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreE"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				
				$ruta = "";

				if(isset($_FILES["nuevoFotoE"])){

					$file_name = $_FILES['nuevoFotoE']['name'];
					$temp_name = $_FILES['nuevoFotoE']['tmp_name'];

					$directorio = "";
					
					$directorio = "vistas/img/empresa/".$_POST["nuevoNombreE"];

					mkdir($directorio, 0755);

					if($_FILES["nuevoFotoE"]["type"] == "image/png" || $_FILES["nuevoFotoE"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/empresa/".$_POST["nuevoNombreE"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}

				$tabla = "empresa";


				$datos = array(
					"icono" => $ruta,
					"nombre" => $_POST["nuevoNombreE"],
					"telefono" => $_POST["nuevoTelefonoE"],
					"direccion" => $_POST["nuevoDireccionE"],
					"horario" => $_POST["nuevoHorarioE"],
					"correo" => $_POST["nuevoCorreoE"],
					"link_facebook" => $_POST["nuevoLinkFacebookE"],
					"link_youtube" => $_POST["nuevoLinkYoutubeE"]
				);



                $respuesta = ModeloEmpresa::mdlIngresarEmpresa($tabla,$datos);

				if ($respuesta == "ok") {

					echo '<script>

								Swal.fire({
									title: "¡Datos de la empresa guardados con exito!",
									text: "Has click para cerrar",
									icon: "success",
									confirmButtonColor: "#0576b9",
								}).then(function(result){

										if(result.value){
										
											window.location = "admin-empresa";

										}

									});
							

							</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El nombre de la empresa no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "admin-empresa";

						}

					});
				

				</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR EMPRESA
    ======================================== */

	static public function ctrMostrarEmpresa($item, $valor)
	{
		$tabla = "empresa";

        $respuesta = ModeloEmpresa::mdlMostrarEmpresa($tabla, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR EMPRESA
	============================================= */

	static public function ctrEditarEmpresa()
	{

		if (isset($_POST["editarNombreE"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreE"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/


				$ruta = $_POST["fotoActualE"];


				if(isset($_FILES["editarFotoE"])){
					
					$file_name = $_FILES['editarFotoE']['name'];
					$temp_name = $_FILES['editarFotoE']['tmp_name'];
					
					$directorio = "vistas/img/empresa/".$_POST["editarNombreE"];

					mkdir($directorio, 0755);

					if($_FILES["editarFotoE"]["type"] == "image/png" || $_FILES["editarFotoE"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/empresa/".$_POST["editarNombreE"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}

				$tabla = "empresa";


				$datos = array(
					"id" => $_POST["editarIdEmpresa"],
					"icono" => $ruta,
					"nombre" => $_POST["editarNombreE"],
					"telefono" => $_POST["editarTelefonoE"],
					"direccion" => $_POST["editarDireccionE"],
					"horario" => $_POST["editarHorarioE"],
					"correo" => $_POST["editarCorreoE"],
					"link_facebook" => $_POST["editarLinkFacebookE"],
					"link_youtube" => $_POST["editarLinkYoutubeE"]
				);

				$respuesta = ModeloEmpresa::mdlEditarEmpresa($tabla, $datos);
				if ($respuesta == "ok") {

					echo '<script>
			   
											 Swal.fire({
												 title: "¡Los datos de la empresa han sido editados con éxito!",
												 text: "Has click para cerrar",
												 icon: "success",
												 confirmButtonColor: "#0576b9",
											 }).then(function(result){
			   
													 if(result.value){
													 
														 window.location = "admin-empresa";
			   
													 }
			   
												 });
										 
			   
										 </script>';
				}
			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El nombre de la empresa no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-empresa";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR EMPRESA
	======================================== */

	static public function ctrBorrarEmpresa(){
		if(isset($_GET["idEmpresa"])){
			$tabla = "empresa";
			$datos = $_GET["idEmpresa"];
			if($_GET["fotoEmpresa"]!=""){
				unlink($_GET["fotoEmpresa"]);
				rmdir('vistas/img/empresa/'.$_GET["nombre"]);
			}

			$respuesta = ModeloEmpresa::mdlBorrarEmpresa($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡Los datos de la empresa han sido borrados con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-empresa";

						}

					});
			

			</script>';

			}
		}
	}
}
