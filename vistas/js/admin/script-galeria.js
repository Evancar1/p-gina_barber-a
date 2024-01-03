
/* ==================================================
PREVISUALIZADOR DE IMAGEN DE GALRIA
================================================== */

$(".nuevoFotoG").change(function(){
    let imagen = this.files[0];
    /* ==========================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPE OPNG
    ========================================== */

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevoFotoG").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else if(imagen["size"] > 2000000){
        $(".nuevoFotoG").val("");
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
            $(".previsualizarG").attr("src",rutaImagen);
        })
    }
});

/*=============================================
EDITAR PRECIO
=============================================*/
$(".tabla_galeria").on("click", ".btnEditarGaleria", function(){
	var idGaleria = $(this).attr("idGaleria");
	var datos = new FormData();
	datos.append("idGaleria", idGaleria);

	$.ajax({

		url:"ajax/galeria.ejax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdGaleria").val(respuesta["id"]);
			$("#editarCodigoG").val(respuesta["codigo"]);

			if(respuesta["imagen"] != ""){
				$(".previsualizarEditarG").attr("src", respuesta["imagen"]);
			}else{
				$(".previsualizarEditarG").attr("src", "vistas/img/galeria/default/default.png");
			}

			$("#fotoActualG").val(respuesta["imagen"]);

		}

	});

})

/*=============================================
ELIMINAR PRECIO
=============================================*/
$(".tabla_galeria").on("click", ".btnEliminarGaleria", function(){

	var idGaleria = $(this).attr("idGaleria");
	var imagen = $(this).attr("imagen");
	var codigo = $(this).attr("codigo");
  
	Swal.fire({
	  title: "¿Está seguro de borrar la foto?",
	  text: "Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: !0,
	  confirmButtonColor: "#34c3af",
	  cancelButtonColor: "#f46a6a",
	  confirmButtonText: "Si, eliminar!",
	}).then(function (result) {
	  if(result.value){
  
		  window.location = "index.php?ruta=admin-galeria&idGaleria="+idGaleria+"&codigo="+codigo+"&imagen="+imagen;
	
		}
	});
  
  
  })
  