/*=============================================
GUARDAR ATRIBUTOS Y EJECUTAR AJAX
=============================================*/
$(".tablas").on("click", ".btnCrearCobranzaClientev1", function(){
  
  //Limpio el html del campo de las ventas asociadas al cargar el html
  $('#vtaRecibov1').empty();

  var idCobranzav1 = $(this).attr("idCobranzav1"); //capturamos el atributito id cliente
  var docCobranzav1 = $(this).attr("docCobranzav1"); //capturamos el atributito documento cliente
  //console.log("idcobranzav1: ",idCobranzav1);
  //console.log(docCobranzav1);
  $("#docCobranzav1").val(docCobranzav1);
  $("#idCobranzav1").val(idCobranzav1);


	var datos1 = new FormData();
	datos1.append("idCobranzav1", idCobranzav1);

	$.ajax({
		url: "ajax/cobranzaclientes.ajax.php",
		method: "POST",
      	data: datos1,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		console.log("Ejecuto ajax:", respuesta);

     		for (i = 0; i < respuesta.length ; i++){ 
			     $('#vtaRecibov1').append($('<option>',
			     {
			        value: respuesta[i]["id"],
			        text : respuesta[i]["codigo"]+'-$'+respuesta[i]["total"] 
			    }));
			}


     	},error: function(respuesta){

        console.log("Error en js  cobranzaclientes.js, ",respuesta);

    }

	});



	//console.log("fuera de ajax");

})


/*=============================================
CALCULAR SALDO RESTANTE
=============================================*/
$("#nuevoImporteRecibov1").on("change", function(){

	$("#nuevoImporteRecibov1").empty()

	var docCobranzav1 = $("#docCobranzav1").val();
	var datos2 = new FormData();
	datos2.append("docCobranzav1", docCobranzav1);


	$.ajax({
		url: "ajax/cobranzaclientes.ajax.php",
		method: "POST",
      	data: datos2,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){



     		var nuevoSaldo = respuesta["clientes_saldo"] - $("#nuevoImporteRecibov1").val();

     		$("#inpSaldoRestante").val(nuevoSaldo.toFixed(2));

     		//console.log("Ejecuto ajax2:", respuesta);



     	},error: function(respuesta){

        console.log("Error en js  cobranzaclientes.js ajax2, ",respuesta);

    }

	});

})




/*=============================================
METODOS DE PAGO EN RECIBOv1
=============================================*/

$("#nuevoMetodoPagoRecibov1").change(function(){

	$(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html('');

	var metodo = $(this).val();

	console.log("El valor de metodo es :",metodo);

	if(metodo == "TC"){

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html(

		 	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="nuevoCodigoTransaccionRecibov1" name="nuevoCodigoTransaccionRecibov1"  placeholder="Cod transacción | Nro Tarjeta" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

           	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="entidadRecibov1" name="entidadRecibov1" placeholder="Entidad: (Ej: VISA - Galicia)" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

            '<div class="width=100%" style="padding-left:0px">'+
                        
	             '<div class="input-group">'+
	          
	             ' <select class="form-control" id="cantCuotas" name="cantCuotas" required>'+
	                '<option value="1">1 Cuota</option>'+
	                '<option value="2">2 Cuotas</option>'+
	                '<option value="3">3 Cuotas</option>'+
	                '<option value="4">4 Cuotas</option>'+
	                '<option value="5">5 Cuotas</option>'+
	                '<option value="6">6 Cuotas</option>'+
	                '<option value="7">7-[Ahora 12]</option>'+
	                '<option value="8">8-[Ahora 18]</option>'+
	                '<option value="9">9 Cuotas</option>'+
	                '<option value="10">10 Cuotas</option>'+
	                '<option value="11">11-[Plan Z]</option>'+
	                '<option value="12">12 Cuotas</option>'+
	                '<option value="13">13-[Ahora 3]</option>'+
	                '<option value="14">14 Cuotas</option>'+
	                '<option value="15">15 Cuotas</option>'+
	                '<option value="16">16-[Ahora 6]</option>'+

	              '</select>'+    

	            '</div>'+                     
                  
            '</div>');


	}else if(metodo == "TD"){

		$(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html('');

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html(

		 	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="nuevoCodigoTransaccionRecibov1" name="nuevoCodigoTransaccionRecibov1" name="nuevoCodigoTransaccionRecibov1" placeholder="Cod transacción | Nro Tarjeta" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

           	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="entidadRecibov1" name="entidadRecibov1" placeholder="Entidad: (Ej: VISA - Galicia)" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>');


	}else if(metodo == "TB1" || metodo == "TB2" ){

		$(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html('');

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html(

		 	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="nuevoCodigoTransaccionRecibov1" name="nuevoCodigoTransaccionRecibov1"  placeholder="Cod Operación | CBU | Alias"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>');

	}else if(metodo == "MP1" || metodo == "TP1" ){

		$(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html('');

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html(

		 	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="nuevoCodigoTransaccionRecibov1" name="nuevoCodigoTransaccionRecibov1"  placeholder="Cod Operación" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>');

	}else if(metodo == "CA" || metodo == "CD" ){

		$(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html('');

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html(

		 	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="nuevoCodigoTransaccionRecibov1" name="nuevoCodigoTransaccionRecibov1"  placeholder="Cod de operación" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

            '<div class="width=100%" style="padding-left:0px">'+
                        
	             '<div class="input-group">'+
	          
	             ' <select class="form-control" id="cantCuotas" name="cantCuotas" required>'+
	                '<option value="Z">1 Cuota</option>'+
	                '<option value="2">2 Cuotas</option>'+
	                '<option value="3">3 Cuotas</option>'+
	                '<option value="4">4 Cuotas</option>'+
	                '<option value="5">5 Cuotas</option>'+
	                '<option value="6">6 Cuotas</option>'+
	                '<option value="7">7-Cuotas</option>'+
	                '<option value="8">8-Cuotas</option>'+
	                '<option value="9">9 Cuotas</option>'+
	                '<option value="10">10 Cuotas</option>'+
	                '<option value="11">11-Cotas</option>'+
	                '<option value="12">12 Cuotas</option>'+
	                '<option value="13">13-Cuotas</option>'+
	                '<option value="14">14 Cuotas</option>'+
	                '<option value="15">15 Cuotas</option>'+
	                '<option value="16">16-Cotas</option>'+

	              '</select>'+    

	            '</div>'+                     
                  
            '</div>');

		}else if(metodo == "TN" ){

		$(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html('');

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html(

		 	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="nuevoCodigoTransaccionRecibov1" name="nuevoCodigoTransaccionRecibov1"  placeholder="Cod transacción | Nro Tarjeta" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

            '<div class="width=100%" style="padding-left:0px">'+
                        
	             '<div class="input-group">'+
	          
	             ' <select class="form-control" id="cantCuotas" name="cantCuotas" required>'+
	                '<option value="Z">1 Cuota</option>'+
	                '<option value="2">2 Cuotas</option>'+
	                '<option value="3">3 Cuotas</option>'+
	                '<option value="4">4 Cuotas</option>'+
	                '<option value="5">5 Cuotas</option>'+
	                '<option value="6">6 Cuotas</option>'+
	                '<option value="7">7-[Ahora 12]</option>'+
	                '<option value="8">8-[Ahora 18]</option>'+
	                '<option value="9">9 Cuotas</option>'+
	                '<option value="10">10 Cuotas</option>'+
	                '<option value="11">11-[Plan Z]</option>'+
	                '<option value="12">12 Cuotas</option>'+
	                '<option value="13">13-[Ahora 3]</option>'+
	                '<option value="14">14 Cuotas</option>'+
	                '<option value="15">15 Cuotas</option>'+
	                '<option value="16">16-[Ahora 6]</option>'+

	              '</select>'+    

	            '</div>'+                     
                  
            '</div>');

	}else if(metodo == "CH" ){

		$(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html('');

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html(

		 	'<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="libradorChRecibov1" name="libradorChRecibov1" placeholder="Emisor" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

            '<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="cuitChRecibov1" name="cuitChRecibov1" placeholder="Cuit emisor" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

            '<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="text" min="0" class="form-control" id="bancoChRecibov1" name="bancoChRecibov1" placeholder="Banco" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

            '<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control" id="nroChRecibov1" name="nroChRecibov1" placeholder="Numero" required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

            '</div>'+

            '<div class="width=100%" style="padding-left:0px">'+
                        
                '<div class="input-group">'+'Fecha de vencimiento:'+
                     
                  '<input type="date" min="0" class="form-control" id="fechaChqRecibov1" name="fechaChqRecibov1"  required>'+
                  
                '</div>'+

            '</div>');

	}else{


		$(this).parent().parent().parent().children('.cajasMetodoPagoRecibov1').html('');


	}

	

})





/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodosRecibov1(){

	var listaMetodos = "";

	if($("#nuevoMetodoPagoRecibov1").val() == "Efectivo"){

		$("#listaCanalVentaRecibov1").val("Efectivo");


	}else if($("#nuevoMetodoPagoRecibov1").val() == "CC"){

		$("#listaCanalVentaRecibov1").val("CC");


	}else{

		$("#listaCanalVentaRecibov1").val($("#nuevoMetodoPagoRecibov1").val()+"-"+$("#nuevoCodigoTransaccionRecibov1").val());

		var ver = $("#nuevoCodigoTransaccionRecibov1").val();

		console.log("valro de 'ver':",ver);



	}

}







