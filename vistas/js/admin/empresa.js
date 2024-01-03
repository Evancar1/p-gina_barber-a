/* ==================================================
PREVISUALIZADOR DE IMAGEN DE USUARIO
================================================== */

$(".nuevoFotoE").change(function(){
    let imagen = this.files[0];
    /* ==========================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPE OPNG
    ========================================== */

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevoFoto").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else if(imagen["size"] > 2000000){
        $(".nuevoFoto").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen no debe pesar más de 2MB!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else{
        let datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            let rutaImagen = event.target.result;
            $(".previsualizarE").attr("src",rutaImagen);
        })
    }
});

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tabla_empresa").on("click", ".btnEditarEmpresa", function(){
	var idEmpresa = $(this).attr("idEmpresa");
	
	var datos = new FormData();
	datos.append("idEmpresa", idEmpresa);

	$.ajax({

		url:"ajax/empresa.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdEmpresa").val(respuesta["id"]);

			if(respuesta["icono"] != ""){
				$(".previsualizarEditarE").attr("src", respuesta["icono"]);
			}else{
				$(".previsualizarEditarE").attr("src", "vistas/img/usuarios/default/automatico.png");
			}

			$("#fotoActualE").val(respuesta["icono"]);
			$("#editarNombreE").val(respuesta["nombre"]);
			$("#editarTelefonoE").val(respuesta["telefono"]);
			$("#editarDireccionE").val(respuesta["direccion"]);
			$("#editarHorarioE").val(respuesta["horario"]);
			$("#editarCorreoE").val(respuesta["correo"]);
			$("#editarLinkFacebookE").val(respuesta["link_facebook"]);
			$("#editarLinkYoutubeE").val(respuesta["link_youtube"]);


		}

	});

})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tabla_empresa").on("click", ".btnEliminarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");
	var fotoEmpresa = $(this).attr("fotoEmpresa");
	var nombre = $(this).attr("nombre");
  
	Swal.fire({
	  title: "¿Está seguro de borrar el los detalles de la empresa?",
	  text: "Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: !0,
	  confirmButtonColor: "#34c3af",
	  cancelButtonColor: "#f46a6a",
	  confirmButtonText: "Si, eliminar!",
	}).then(function (result) {
	  if(result.value){
  
		  window.location = "index.php?ruta=admin-empresa&idEmpresa="+idEmpresa+"&nombre="+nombre+"&fotoEmpresa="+fotoEmpresa;
	
		}
	});
  
  
  })
  