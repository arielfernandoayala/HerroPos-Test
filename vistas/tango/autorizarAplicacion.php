<?php
	$friendlyName=$_POST["appFriendlyName"];
	$appPublicKey=$_POST["appPublicKey"];
	require("SDK/TangoFacturaServicioFacturacion.php");
	//URL a la cual redireccionar� Tango factura una vez que se conceda autorizaci�n a la aplicaci�n. 
	//Tanto la URL como el nombre del par�metro son totalmente arbitrarios
	$CallbackURL = "http://".$_SERVER["HTTP_HOST"]."/Axoft/SDKPHP/authorized.php?code=";
	$AuthorizationURL = TangoFacturaServicioFacturacion::GetAuthorizeAppUrl($appPublicKey, $friendlyName, $CallbackURL);
	header('Location: '.$AuthorizationURL);
?>