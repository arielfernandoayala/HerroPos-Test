/*=============================================
EDITAR CHEQUE
=============================================*/
$(".tablas").on("click", ".btnEditarChq", function(){

	var idCheque = $(this).attr("idCheque");
	console.log("idCheque", idCheque);

	var datos = new FormData();
	datos.append("idCheque", idCheque);

	$.ajax({
		url: "ajax/chequera.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editIdchq").val(idCheque);
     		$("#editChqCuit").val(respuesta["cuit_emisor"]);
     		$("#editChqRazonSoc").val(respuesta["razon_soc_emisor"]);
     		$("#editChqBco").val(respuesta["banco_chq"]);
     		$("#editChqNro").val(respuesta["nro_chq"]);
     		$("#editChqImporte").val(respuesta["importe"]);
     		$("#editChqFecha").val(respuesta["fecha_ven_chq"]);
     		$("#editChqComentario").val(respuesta["nvoChqComentario"]);
     		

     	},error: function(respuesta){

        console.log("Error en js  chequera, ",respuesta);

		}



	});

})

/*=============================================
ELIMINAR CHEQUE
=============================================*/
$(".tablas").on("click", ".btnEliminarChq", function(){

	 var idCheque = $(this).attr("idCheque");

	 swal({
	 	title: '¿Elimiar cheque?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar cheque!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=chequera&idCheque="+idCheque;

	 	}

	 })

})