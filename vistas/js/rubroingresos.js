/*=============================================
EDITAR RUBRO INGRESOS
Nombre del boton: btnEditarRubroIngresos
=============================================*/
$(".tablas").on("click", ".btnEditarRubroIngresos", function(){


	//console.log("Entra a btn editar rubro ingreos")


	//Almaceno el atributor que en este caso es la ID
	var idRubroIngresos = $(this).attr("idRubroIngresos");

	//Solicitamos a ajax una respuesta
	var datos = new FormData();
	//console.log(datos);

	//Pasamos una varaiable POST que llamo idRubroIngreso y le doy el valor que capturo en la variable idRubroIngreso , es decir, la ID
	datos.append("idRubroIngresos", idRubroIngresos);

	//console.log("El id seleciconado es", idRubroIngresos);

	$.ajax({
		url: "ajax/rubroingresos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		//console.log("respuesta",respuesta);

     		$("#editarRubroIngresos").val(respuesta["rubroingresos"]);
     		$("#idRubroIngresos").val(respuesta["id"]);

     	},
     	error: function(respuesta){
     		//console.log("respuesta",respuesta);
     	}

	});
	
	//console.log("Ejecuto ajax");


})

/*=============================================
ELIMINAR RUBRO INGRESOS
Nombre del boton: btnEliminarRubroIngresos
=============================================*/
$(".tablas").on("click", ".btnEliminarRubroIngresos", function(){

	 var idRubroIngresos = $(this).attr("idRubroIngresos");

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

	 		window.location = "index.php?ruta=rubroingresos&idRubroIngresos="+idRubroIngresos;

	 	}

	 })

})