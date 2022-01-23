/*=============================================
EDITAR RUBRO Egresos
Nombre del boton: btnEditarRubroEgresos
=============================================*/
$(".tablas").on("click", ".btnEditarRubroEgresos", function(){


	//console.log("Entra a btn editar rubro ingreos")


	//Almaceno el atributor que en este caso es la ID
	var idRubroEgresos = $(this).attr("idRubroEgresos");

	//Solicitamos a ajax una respuesta
	var datos = new FormData();
	//console.log(datos);

	//Pasamos una varaiable POST que llamo idRubroIngreso y le doy el valor que capturo en la variable idRubroIngreso , es decir, la ID
	datos.append("idRubroEgresos", idRubroEgresos);

	//console.log("El id seleciconado es", idRubroEgresos);

	$.ajax({
		url: "ajax/rubroegresos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		//console.log("respuesta",respuesta);

     		$("#editarRubroEgresos").val(respuesta["rubroegresos"]);
     		$("#idRubroEgresos").val(respuesta["id"]);

     	},
     	error: function(respuesta){
     		//console.log("respuesta",respuesta);
     	}

	});
	
	//console.log("Ejecuto ajax");


})

/*=============================================
ELIMINAR RUBRO Egresos
Nombre del boton: btnEliminarRubroEgresos
=============================================*/
$(".tablas").on("click", ".btnEliminarRubroEgresos", function(){

	 var idRubroEgresos = $(this).attr("idRubroEgresos");

	 swal({
	 	title: '¿Está seguro de borrar la categoría?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar categoría!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=rubroegresos&idRubroEgresos="+idRubroEgresos;

	 	}

	 })

})