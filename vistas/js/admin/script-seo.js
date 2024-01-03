

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tabla_seo").on("click", ".btnEditarSeo", function(){
	var idSeo = $(this).attr("idSeo");
	
	var datos = new FormData();
	datos.append("idSeo", idSeo);

	$.ajax({

		url:"ajax/seo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdSeo").val(respuesta["id_seo"]);

			$("#editarDescripcionSeo").val(respuesta["meta_desc"]);
			$("#editarPalabraClaveSeo").val(respuesta["meta_palabra_clave"]);
			$("#editarNombreAutor").val(respuesta["meta_autor"]);

		}

	});

})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tabla_seo").on("click", ".btnEliminarSeo", function(){

	var idSeo = $(this).attr("idSeo");
  
	Swal.fire({
	  title: "¿Está de borrar los datos del SEO de la tienda?",
	  text: "Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: !0,
	  confirmButtonColor: "#34c3af",
	  cancelButtonColor: "#f46a6a",
	  confirmButtonText: "Si, eliminar!",
	}).then(function (result) {
	  if(result.value){
  
		  window.location = "index.php?ruta=admin-seo&idSeo="+idSeo;
	
		}
	});
  
  
  })
  