

/* ==================================================
PREVISUALIZADOR DE IMAGEN DE SERVICIO
================================================== */

$(".nuevoFotoS").change(function(){
    let imagen = this.files[0];
    /* ==========================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPE OPNG
    ========================================== */

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevoFotoS").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else if(imagen["size"] > 2000000){
        $(".nuevoFotoS").val("");
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
            $(".previsualizarS").attr("src",rutaImagen);
        })
    }
});

/*=============================================
EDITAR SERVICIO
=============================================*/
$(".tabla_servicio").on("click", ".btnEditarServicio", function(){
	var idServicio = $(this).attr("idServicio");
	var datos = new FormData();
	datos.append("idServicio", idServicio);

	$.ajax({

		url:"ajax/servicio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdServicio").val(respuesta["id_servicio"]);
			$("#editarCodigoS").val(respuesta["codigo"]);

			if(respuesta["imagen"] != ""){
				$(".previsualizarEditarS").attr("src", respuesta["imagen"]);
			}else{
				$(".previsualizarEditarS").attr("src", "vistas/img/servicio/default/default.png");
			}

			$("#fotoActualS").val(respuesta["imagen"]);
			$("#editarTituloS").val(respuesta["titulos"]);
			$("#editarTextoS").val(respuesta["texto"]);

		}

	});

})

/*=============================================
ELIMINAR SERVICIO
=============================================*/
$(".tabla_servicio").on("click", ".btnEliminarServicio", function(){

	var idServicio = $(this).attr("idServicio");
	var imagen = $(this).attr("imagen");
	var codigo = $(this).attr("codigo");
  
	Swal.fire({
	  title: "¿Está seguro de borrar el servicio?",
	  text: "Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: !0,
	  confirmButtonColor: "#34c3af",
	  cancelButtonColor: "#f46a6a",
	  confirmButtonText: "Si, eliminar!",
	}).then(function (result) {
	  if(result.value){
  
		  window.location = "index.php?ruta=admin-servicio&idServicio="+idServicio+"&codigo="+codigo+"&imagen="+imagen;
	
		}
	});
  
  
  })
  