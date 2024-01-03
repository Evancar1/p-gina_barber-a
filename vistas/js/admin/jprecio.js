

/* ==================================================
PREVISUALIZADOR DE IMAGEN DE PRECIO
================================================== */

$(".nuevoFotoP").change(function(){
    let imagen = this.files[0];
    /* ==========================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPE OPNG
    ========================================== */

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevoFotoP").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else if(imagen["size"] > 2000000){
        $(".nuevoFotoP").val("");
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
            $(".previsualizarP").attr("src",rutaImagen);
        })
    }
});

/*=============================================
EDITAR PRECIO
=============================================*/
$(".tabla_precio").on("click", ".btnEditarPrecio", function(){

	var idPrecio = $(this).attr("idPrecio");
	var datos = new FormData();
	datos.append("idPrecio", idPrecio);

	$.ajax({

		url:"ajax/precio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdPrecio").val(respuesta["id_precio"]);
			$("#editarCodigoP").val(respuesta["codigo"]);

			$("#editarServicioP").val(respuesta["id_servicio"]);
			$("#editarServicioP").html(respuesta["titulos"]);

			if(respuesta["imagen"] != ""){
				$(".previsualizarEditarP").attr("src", respuesta["imagen"]);
			}else{
				$(".previsualizarEditarP").attr("src", "vistas/img/precio/default/default.png");
			}

			$("#fotoActualP").val(respuesta["imagen"]);
			$("#editarTituloP").val(respuesta["titulop"]);
			$("#editarDescripcionP").val(respuesta["descripcion"]);
			$("#editarPrecio").val(respuesta["precio"]);

		}

	});

})

/*=============================================
ELIMINAR PRECIO
=============================================*/
$(".tabla_precio").on("click", ".btnEliminarPrecio", function(){

	var idPrecio = $(this).attr("idPrecio");
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
  
		  window.location = "index.php?ruta=admin-precio&idPrecio="+idPrecio+"&codigo="+codigo+"&imagen="+imagen;
	
		}
	});
  
  
  })
  