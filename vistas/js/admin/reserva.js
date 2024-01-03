
/*=============================================
EDITAR RESERVA
=============================================*/
$(".tabla_reserva").on("click", ".btnEditarReserva", function(){
	var idReserva = $(this).attr("idReserva");
	var datos = new FormData();
	datos.append("idReserva", idReserva);

	$.ajax({

		url:"ajax/reserva.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdReserva").val(respuesta["id_reserva"]);
			$("#editarNombreR").val(respuesta["nombre"]);
			$("#editarCorreoR").val(respuesta["correo"]);
			$("#editarTelefonoR").val(respuesta["telefono"]);

			$("#editarReserva").val(respuesta["id_precio"]);
			$("#editarReserva").html(respuesta["titulop"]);

			$("#editarFechaR").val(respuesta["fecha"]);
			$("#editarHoraR").val(respuesta["hora"]);

			$("#editarMensajeR").val(respuesta["mensaje"]);

		}

	});

})

/*=============================================
ELIMINAR RESERVA
=============================================*/
$(".tabla_reserva").on("click", ".btnEliminarReserva", function(){

	var idReserva = $(this).attr("idReserva");
  
	Swal.fire({
	  title: "¿Está seguro de borrar la reserva?",
	  text: "Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: !0,
	  confirmButtonColor: "#34c3af",
	  cancelButtonColor: "#f46a6a",
	  confirmButtonText: "Si, eliminar!",
	}).then(function (result) {
	  if(result.value){
  
		  window.location = "index.php?ruta=admin-reservas&idReserva="+idReserva;
	
		}
	});
  
  
  })
  