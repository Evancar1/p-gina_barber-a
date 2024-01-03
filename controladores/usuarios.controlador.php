<?php

class ControladorUsuarios
{
	/*  =====================================
    INGRESO DE USUARIOS
    ===================================== */

	static public function ctrIngresoUsuario()
	{
		if (isset($_POST["ingresarCorreo"])) {
			if ($_POST["ingresarCorreo"]) {
				$encriptar = crypt($_POST["ingresarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";
				$item = "correo_usuario";
				$valor = $_POST["ingresarCorreo"];

				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

				if ($respuesta["correo_usuario"] == $_POST["ingresarCorreo"] && $respuesta["password_usuario"] == $encriptar) {
					if ($respuesta["estado_usuario"] == 1) {

						$_SESSION["iniciarSession"] = "ok";
						$_SESSION["id_usuario"] = $respuesta["id_usuario"];
						$_SESSION["nombre_usuario"] = $respuesta["nombre_usuario"];
						$_SESSION["correo_usuario"] = $respuesta["correo_usuario"];
						$_SESSION["foto_usuario"] = $respuesta["foto_usuario"];
						$_SESSION["perfil_usuario"] = $respuesta["perfil_usuario"];

						/*  =================================================
                        REGISTRAR FECHA PARA SABER EL ÚTIMO LOGIN
                        ================================================= */

						date_default_timezone_set('America/Lima');

						$fecha = date('Y-m-d');
						$hora = date('Y-m-d');

						$fechaActual = $fecha . ' ' . $hora;

						$item1 = "ultimo_login_usuario";
						$valor1 = $fechaActual;

						$item2 = "id_usuario";
						$valor2 = $respuesta["id_usuario"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor2, $item2, $valor2);

						if ($ultimoLogin == "ok") {
							echo '<script>
                                window.location = "admin-inicio";
                            </script>';
						}
					} else {
						echo '<br> <div class="alert-danger">El usuario aún no está activado</div>';
					}
				} else {
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}
			}
		}
	}


	/* =======================================
    REGISTRO DE USUARIO
    ======================================= */

	static public function ctrCrearUsuario()
	{

		if (isset($_POST["nuevoCorreo"])) {

			
			if ($_POST["nuevoNombre"]) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/
				
				$ruta = "";

				if(isset($_FILES["nuevoFoto"])){

					$file_name = $_FILES['nuevoFoto']['name'];
					$temp_name = $_FILES['nuevoFoto']['tmp_name'];

					$directorio = "";
					
					$directorio = "vistas/img/usuarios/".$_POST["nuevoCorreo"];

					mkdir($directorio, 0755);

					if($_FILES["nuevoFoto"]["type"] == "image/png" || $_FILES["nuevoFoto"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/usuarios/".$_POST["nuevoCorreo"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}

				
				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array(
					"nombre_usuario" => $_POST["nuevoNombre"],
					"correo_usuario" => $_POST["nuevoCorreo"],
					"password_usuario" => $encriptar,
					"perfil_usuario" => $_POST["nuevoPerfil"],
					"foto_usuario" => $ruta
				);



				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				echo $respuesta;
				if ($respuesta == "ok") {

					echo '<script>

								Swal.fire({
									title: "¡Se registró con exito!",
									text: "Has click para cerrar",
									icon: "success",
									confirmButtonColor: "#0576b9",
								}).then(function(result){

										if(result.value){
										
											window.location = "admin-usuarios";

										}

									});
							

							</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR USUARIOS
    ======================================== */

	static public function ctrMostrarUsuarios($item, $valor)
	{
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR USUARIO
	============================================= */

	static public function ctrEditarUsuario()
	{

		if (isset($_POST["editarCorreo"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/


				$ruta = $_POST["fotoActual"];


				if(isset($_FILES["editarFoto"])){
					
					$file_name = $_FILES['editarFoto']['name'];
					$temp_name = $_FILES['editarFoto']['tmp_name'];
					
					$directorio = "vistas/img/usuarios/".$_POST["editarCorreo"];

					mkdir($directorio, 0755);

					if($_FILES["editarFoto"]["type"] == "image/png" || $_FILES["editarFoto"]["type"] == "image/jpeg"){

						$ruta = "vistas/img/usuarios/".$_POST["editarCorreo"]."/".$file_name;

						move_uploaded_file($temp_name,$ruta);
					}
				}


				$tabla = "usuarios";

				if ($_POST["editarPassword"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {


						echo '<script>

							  Swal.fire({
								  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-usuarios";

									  }

								  });
						  

						  </script>';

						return;
					}
				} else {

					$encriptar = $_POST["passwordActual"];
				}

				$datos = array(
					"nombre_usuario" => $_POST["editarNombre"],
					"correo_usuario" => $_POST["editarCorreo"],
					"password_usuario" => $encriptar,
					"perfil_usuario" => $_POST["editarPerfil"],
					"foto_usuario" => $ruta
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
				echo $respuesta;
				if ($respuesta == "ok") {

					echo '<script>
			   
											 Swal.fire({
												 title: "¡El usuario ha sido editado con éxito!",
												 text: "Has click para cerrar",
												 icon: "success",
												 confirmButtonColor: "#0576b9",
											 }).then(function(result){
			   
													 if(result.value){
													 
														 window.location = "admin-usuarios";
			   
													 }
			   
												 });
										 
			   
										 </script>';
				}
			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El nombre no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-usuarios";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR USUARIO
	======================================== */

	static public function ctrBorrarUsuario(){
		if(isset($_GET["idUsuario"])){
			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];
			if($_GET["fotoUsuario"]!=""){
				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["correo"]);
			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡El usuario ha sido borrado con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-usuarios";

						}

					});
			

			</script>';

			}
		}
	}
}
