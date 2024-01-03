


/*=============================================
ELIMINAR PRECIO
=============================================*/
$(".tabla_suscriptor").on("click", ".btnEliminarSuscriptor", function(){

	var idSuscriptor = $(this).attr("idSuscriptor");
  
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
  
		  window.location = "index.php?ruta=admin-suscriptor&idSuscriptor="+idSuscriptor;
	
		}
	});
  
  
  })
  