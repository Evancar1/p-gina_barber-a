<?php

class ControladorSEO
{
	/* =======================================
    REGISTRO DE SEO
    ======================================= */

	static public function ctrCrearSEO()
	{

		if (isset($_POST["nuevoDescripcionSeo"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreAutor"])) {

				$tabla = "seo";

				$datos = array(
					"meta_desc" => $_POST["nuevoDescripcionSeo"],
					"meta_palabra_clave" => $_POST["nuevoPalabraClaveSeo"],
					"meta_autor" => $_POST["nuevoNombreAutor"]
				);

                $respuesta = ModeloSEO::mdlIngresarSEO($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

								Swal.fire({
									title: "¡Datos del SEO han sido guardados con exito!",
									text: "Has click para cerrar",
									icon: "success",
									confirmButtonColor: "#0576b9",
								}).then(function(result){

										if(result.value){
										
											window.location = "admin-seo";

										}

									});
							

							</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El nombre del autor no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "admin-seo";

						}

					});
				

				</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR SEO
    ======================================== */

	static public function ctrMostrarSEO($item, $valor)
	{
		$tabla = "seo";

        $respuesta = ModeloSEO::mdlMostrarSEO($tabla, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR SEO
	============================================= */

	static public function ctrEditarSEO()
	{

		if (isset($_POST["editarIdSeo"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreAutor"])) {

				$tabla = "seo";


				$datos = array(
					"id_seo" => $_POST["editarIdSeo"],
					"meta_desc" => $_POST["editarDescripcionSeo"],
					"meta_palabra_clave" => $_POST["editarPalabraClaveSeo"],
					"meta_autor" => $_POST["editarNombreAutor"]
				);

                $respuesta = ModeloSEO::mdlEditarSEO($tabla, $datos);
				if ($respuesta == "ok") {

					echo '<script>
			   
											 Swal.fire({
												 title: "¡Los datos del SEO han sido editados con éxito!",
												 text: "Has click para cerrar",
												 icon: "success",
												 confirmButtonColor: "#0576b9",
											 }).then(function(result){
			   
													 if(result.value){
													 
														 window.location = "admin-seo";
			   
													 }
			   
												 });
										 
			   
										 </script>';
				}
			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El autor del SEO no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-seo";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR SEO
	======================================== */

	static public function ctrBorrarSEO(){
		if(isset($_GET["idSeo"])){
			$tabla = "seo";
			$datos = $_GET["idSeo"];

            $respuesta = ModeloSEO::mdlBorrarSEO($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡Los datos del SEO han sido borrados con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-seo";

						}

					});
			

			</script>';

			}
		}
	}
}
