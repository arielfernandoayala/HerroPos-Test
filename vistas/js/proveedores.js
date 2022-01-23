/*=============================================
EDITAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEditarProveedor", function(){

    var idProveedor = $(this).attr("idProveedor");
    
   console.log("idProveedor en JS",idProveedor);

    var datos = new FormData();
    
	datos.append("idProveedor", idProveedor);

	$.ajax({
		url: "ajax/proveedores.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            //console.log("entro a ajaxxxxxxx",respuesta);

             $("#editarProveedor").val(respuesta["razon_social"]);
             $("#editarCuitProveedor").val(respuesta["cuit"]);
             $("#editarDomicilioProveedor").val(respuesta["cp"]);
             $("#editarCpProveedor").val(respuesta["domicilio"]);
             $("#editarCuidadProveedor").val(respuesta["ciudad"]);
             $("#editarProvinciaProveedor").val(respuesta["provincia"]);
             $("#editarTelefonoProveedor").val(respuesta["tel"]);
             $("#editarReferenteProveedor").val(respuesta["referente"]);
             $("#editarWebProveedor").val(respuesta["web"]);
             $("#editarEmailProveeedor").val(respuesta["email"]);
             $("#idProveedor").val(respuesta["id"]); //RECORDAR ESTA LINEA PARA QUE FUNCIONE


     		

         },
         error: function(respuesta){
             console.log("repuesta por error: ", respuesta);
             //console.log(respuesta["razon_social"]); 
         }

    })




})

/*=============================================
ELIMINAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEliminarProveedor", function(){

	 var idProveedor = $(this).attr("idProveedor");

	 swal({
	 	title: '¿Está seguro de borrar el proveedor?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar proveedor!'
	 }).then(function(result){ //result va a guardar lo que diga el usuario (true o false , es de cir 1 o 0)

	 	if(result.value){ //if (true) ejecuta

	 		window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;

	 	}

	 })

})