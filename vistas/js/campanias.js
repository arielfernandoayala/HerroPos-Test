/*=============================================
EDITAR RUBRO Egresos
Nombre del boton: btnEditarRubroEgresos
=============================================*/
$(".tablas").on("click", ".btnEditarPublicidad", function(){


	//console.log("Entra a btn editar cuenta bancaria js")


	//Almaceno el atributor que en este caso es la ID
	var idPublicidad = $(this).attr("idPublicidad");
	console.log("id = ", idPublicidad);

	//Solicitamos a ajax una respuesta
	var datos = new FormData();
	//console.log(datos);

	//Pasamos una varaiable POST que llamo idRubroIngreso y le doy el valor que capturo en la variable idRubroIngreso , es decir, la ID
	datos.append("idPublicidad", idPublicidad);

	//console.log("El id seleciconado es", idCuentaBancaria);

	$.ajax({
		url: "ajax/campanias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		//console.log("la respuesta en el js: respuesta",respuesta);

     		$("#editarFechaInicio").val(respuesta["fecha_inicio"]);
     		$("#editarFechaFin").val(respuesta["fecha_fin"]);
     		$("#editarMedioPublicidad").val(respuesta["medio"]);
     		$("#editarResumen").val(respuesta["resumen"]);
     		$("#editarCostoPublicidad").val(respuesta["costo"]);
     		$("#editarResultadosPublicidad").html(respuesta["resultados"]);
            $("#idEditarPublicidad").val(respuesta["id"])

     	},
     	error: function(respuesta){
     		console.log("Errror: respuesta",respuesta);
     	}

	});
	
	//console.log("Ejecuto ajax");


})

