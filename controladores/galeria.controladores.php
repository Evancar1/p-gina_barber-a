<?php

class ControladorGaleria
{
	/* =======================================
    REGISTRO DE GALERIA
    ======================================= */

	static public function ctrCrearGaleria()
	{

		if (isset($_POST["nuevoCodigoG"])) {

				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigoG"])) {

					/*=============================================
					VALIDAR IMAGEN
					=============================================*/
	

					$ruta = "";

					if(isset($_FILES["nuevoFotoG"])){

						$file_name = $_FILES['nuevoFotoG']['name'];
						$temp_name = $_FILES['nuevoFotoG']['tmp_name'];

						$directorio = "";
						
						$directorio = "vistas/img/galeria/".$_POST["nuevoCodigoG"];

						mkdir($directorio, 0755);

						if($_FILES["nuevoFotoG"]["type"] == "image/png" || $_FILES["nuevoFotoG"]["type"] == "image/jpeg"){

							$ruta = "vistas/img/galeria/".$_POST["nuevoCodigoG"]."/".$file_name;

							move_uploaded_file($temp_name,$ruta);
						}
					}
	
					$tabla = "galeria";
	
	
					$datos = array(
						"codigo" => $_POST["nuevoCodigoG"],
						"imagen" => $ruta
					);
				  
					$respuesta = ModeloGaleria::mdlIngresarGaleria($tabla, $datos);
	
					if ($respuesta == "ok") {
	
						echo '<script>
	
									Swal.fire({
										title: "¡La foto fue guardado con éxito!",
										text: "Has click para cerrar",
										icon: "success",
										confirmButtonColor: "#0576b9",
									}).then(function(result){
	
											if(result.value){
											
												window.location = "admin-galeria";
	
											}
	
										});
								
	
								</script>';
					}
				} else {
					echo '<script>
	
									Swal.fire({
										title: "¡El código no puede ir vacio o llevar caracteres especiales!",
										text: "Has click para cerrar",
										icon: "success",
										confirmButtonColor: "#0576b9",
									}).then(function(result){
	
											if(result.value){
											
												window.location = "admin-galeria";
	
											}
	
										});
								
	
								</script>';
				}

		}
	}

	/* ========================================
    MOSTRAR GALERIA
    ======================================== */

	static public function ctrMostrarGaleria($item, $valor)
	{
		$tabla = "galeria";
		$respuesta = ModeloGaleria::mdlMostrarGaleria($tabla, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR GALERIA
	============================================= */

	static public function ctrEditarGaleria()
	{

		if (isset($_POST["editarCodigoG"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigoG"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActualG"];


				if(isset($_FILES["editarFotoG"])){
					
					$file_name = $_FILES['editarFotoG']['name'];
					$temp_name = $_FILES['editarFotoG']['tmp_name'];
					
					$directorio = "vistas/img/galeria/".$_POST["editarCodigoG"];

					mkdir($directorio, 0755);

					if($_FILES["editarFotoG"]["type"] == "image/png" || $_FILES["editarFotoG"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/galeria/".$_POST["editarCodigoG"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}

				$tabla = "galeria";


				$datos = array(
					"id" => $_POST["editarIdGaleria"],
                    "codigo" => $_POST["editarCodigoG"],
					"imagen" => $ruta
				);

				$respuesta = ModeloGaleria::mdlEditarGaleria($tabla, $datos);
                
				if ($respuesta == "ok") {

					echo '<script>
			   
                            Swal.fire({
                                title: "¡La foto de edito con éxito!",
                                text: "Has click para cerrar",
                                icon: "success",
                                confirmButtonColor: "#0576b9",
                            }).then(function(result){

                                    if(result.value){
                                    
                                        window.location = "admin-galeria";

                                    }

                                });
                        

                        </script>';
				}
                
			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El código no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-galeria";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR GALERIA
	======================================== */

	static public function ctrBorrarGaleria(){
		if(isset($_GET["idGaleria"])){
			$tabla = "galeria";
			$datos = $_GET["idGaleria"];
			if($_GET["imagen"]!=""){
				unlink($_GET["imagen"]);
				rmdir('vistas/img/galeria/'.$_GET["codigo"]);
			}

			$respuesta = ModeloGaleria::mdlBorrarGaleria($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡La imagen fue borrado con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-galeria";

						}

					});
			

			</script>';

			}
		}
	}
}
