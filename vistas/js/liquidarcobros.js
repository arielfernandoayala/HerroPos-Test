/*=============================================
REGISTRAR COBRO
=============================================*/
$(".tablas").on("click", ".btnLiquidarRec", function(){

	var idRecALiquidar = $(this).attr("idRecALiquidar");
  console.log("ID A LIQUIDAR:",idRecALiquidar);

	var datos = new FormData();
	datos.append("idRecALiquidar", idRecALiquidar);

	$.ajax({
		url: "ajax/liquidarcobros.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		//$("#editarCategoria").val(respuesta["categoria"]);
        //console.log("Importe:",respuesta["importe"]);
     		$("#idRecALiquidar").val(respuesta["id"]);
        
        $("#nuevoLiqRec").attr({
          "max" : respuesta["importe"],        // No perminte ingresar un numero mayor al original del recibo
          "min" : 0          // No permite poner numeros negativos
       })

     	}, error: function(respuesta){

        console.log("Error en js   ",respuesta);

    }

	});



})
