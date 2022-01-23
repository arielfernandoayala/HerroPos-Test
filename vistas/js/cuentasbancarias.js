/*=============================================
EDITAR RUBRO Egresos
Nombre del boton: btnEditarRubroEgresos
=============================================*/
$(".tablas").on("click", ".btnEditarCuentaBancaria", function(){


	//console.log("Entra a btn editar cuenta bancaria js")


	//Almaceno el atributor que en este caso es la ID
	var idCuentaBancaria = $(this).attr("idCuentaBancaria");

	//Solicitamos a ajax una respuesta
	var datos = new FormData();
	//console.log(datos);

	//Pasamos una varaiable POST que llamo idRubroIngreso y le doy el valor que capturo en la variable idRubroIngreso , es decir, la ID
	datos.append("idCuentaBancaria", idCuentaBancaria);

	//console.log("El id seleciconado es", idCuentaBancaria);

	$.ajax({
		url: "ajax/cuentasbancarias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		//console.log("la respuesta en el js: respuesta",respuesta);

     		$("#editarTitular").val(respuesta["titular"]);
     		$("#editarBanco").val(respuesta["banco"]);
     		$("#editarCbu").val(respuesta["cbu"]);

     		$("#editarNroCuenta").val(respuesta["numerodecuenta"]);
     		$("#editarAlias").val(respuesta["alias"]);
     		$("#editarTipoDeCta").html(respuesta["tipo"]);

     	},
     	error: function(respuesta){
     		console.log("Respuesta por error en contas bancarias js",respuesta);
     	}

	});
	
	//console.log("Ejecuto ajax");


})

/*=============================================
ELIMINAR RUBRO Egresos
Nombre del boton: btnEliminarRubroEgresos
=============================================*/
$(".tablas").on("click", ".btnEliminarCuentaBancaria", function(){

	 var idCuentaBancaria = $(this).attr("idCuentaBancaria");

	 swal({
	 	title: '¿Está segur@?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar categoría!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=cuentasbancarias&idCuentaBancaria="+idCuentaBancaria;

	 	}

	 })

})


/*=============================================
SUBIENDO LA FOTO DEL BANCO
=============================================
$(".nuevaFotoBanco").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})
*/