<?php
	$friendlyName=$_POST["appFriendlyName"];
	$appPublicKey=$_POST["appPublicKey"];
	require("SDK/TangoFacturaServicioFacturacion.php");
	//URL a la cual redireccionará Tango factura una vez que se conceda autorización a la aplicación. 
	//Tanto la URL como el nombre del parámetro son totalmente arbitrarios
	$CallbackURL = "http://".$_SERVER["HTTP_HOST"]."/Axoft/SDKPHP/authorized.php?code=";
	$AuthorizationURL = TangoFacturaServicioFacturacion::GetAuthorizeAppUrl($appPublicKey, $friendlyName, $CallbackURL);
	header('Location: '.$AuthorizationURL);
?>