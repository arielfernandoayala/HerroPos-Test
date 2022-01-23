/*=============================================
EDITAR RUBRO Egresos
Nombre del boton: btnEditarUbicaciones
=============================================*/
$(".tablas").on("click", ".btnEditarUbicaciones", function(){


	console.log("Entra a btn ubicacion")


	//Almaceno el atributor que en este caso es la ID
	var idUbicaciones = $(this).attr("idUbicaciones");

	//Solicitamos a ajax una respuesta
	var datos = new FormData();
	//console.log(datos);

	//Pasamos una varaiable POST que llamo idRubroIngreso y le doy el valor que capturo en la variable idRubroIngreso , es decir, la ID
	datos.append("idUbicaciones", idUbicaciones);

	//console.log("El id seleciconado es", idUbicaciones);

	$.ajax({
		url: "ajax/ubicaciones.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		console.log("ubiaciones js l33 dice: ",respuesta);

     		$("#editarUbicaciones").val(respuesta["ubicaciones"]);
     		$("#idUbicaciones").val(respuesta["id"]);

     	},
     	error: function(respuesta){
     		//console.log("respuesta",respuesta);
     	}

	});
	
	//console.log("Ejecuto ajax");


})

/*=============================================
ELIMINAR RUBRO Egresos
Nombre del boton: btnEliminarUbicaciones
=============================================*/
$(".tablas").on("click", ".btnEliminarUbicaciones", function(){

	 var idUbicaciones = $(this).attr("idUbicaciones");

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

	 		window.location = "index.php?ruta=ubicaciones&idUbicaciones="+idUbicaciones;

	 	}

	 })

})