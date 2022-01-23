$(".tablas").on("click", ".btnVerEnMapa", function(){

	console.log("ingresa al js");

	var latitudYlongitud = $(this).attr("ubicacionEntrega");

	window.location = "index.php?ruta=mapa&latitudYlongitud="+latitudYlongitud;


})


/*=============================================
ACTUALIZAR ESTADO ENTREGA
=============================================*/
$(".tablas").on("click", ".btnActualizarEstado", function(){

	var idVentaAsociada = $(this).attr("idVentaAsociada");

	var datos = new FormData();
	datos.append("idVentaAsociada", idVentaAsociada);

	//console.log(idVentaAsociada);

	$.ajax({
		url: "ajax/estadoentregas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		//console.log(respuesta);

     		$("#inputActEstEntrega").val(respuesta["estado_entrega"]);
     		$("#idVtaAsoc").val(respuesta["id"]);

     	},
     	error: function(respuesta){

        //console.log("Error en js  entregas, ",respuesta);

    }



	});
	//console.log("ejecuto el js");


})