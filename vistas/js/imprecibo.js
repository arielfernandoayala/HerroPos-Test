/*==================================================================
=             ABRIR PAGINA PARA IMPRMIR RECIBO SEGUN CLIENTE           =
================================================================*/
$(".tablas").on("click", ".btnVerRecibosv1", function(){
	//capturo variable
	var docCliente = $(this).attr("docRecibov1");

	console.log(docCliente);

	//$("#dtBuscarImpRecibo").val(docCliente);
	//abro pagina
	window.open("/pos-copia-20-8/imprecibos?docCliente="+docCliente);

})

/*=====  End of ABRIR PAGINA PARA IMPRMIR RECIBO SEGUN CLIENTE      ======*/


$(".tablas").on("click", ".btnImpReciboPdf", function(){

	var nroRecibo = $(this).attr("imprRecivoId");

	window.open("extensiones/tcpdf/examples/recibo.php?nroRecibo="+nroRecibo, "_blank");

})
