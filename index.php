<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/rubroingresos.controlador.php";
require_once "controladores/rubroegresos.controlador.php";
require_once "controladores/cuentasbancarias.controlador.php";
require_once "controladores/ubicaciones.controlador.php";
require_once "controladores/presupuestoRapido.controlador.php";
require_once "controladores/cobranzaclientes.controlador.php";
require_once "controladores/proveedores.controlador.php";
require_once "controladores/actualizar.productos.controlador.php";
require_once "controladores/act.prod1.controlador.php";
require_once "controladores/chequera.controlador.php";
require_once "controladores/publicidad.controlador.php";
require_once "controladores/imprecibo.controlador.php";
require_once "controladores/TangoFacturaServicioFacturacion.php";
require_once "controladores/estadosentrega.controlador.php";
require_once "controladores/liquidarcobros.controlador.php";
require_once "controladores/cccliente.controlador.php";
require_once "controladores/actmasivo.controlador.php";



require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/rubroingresos.modelo.php";
require_once "modelos/rubroegresos.modelo.php";
require_once "modelos/cuentasbancarias.modelo.php";
require_once "modelos/ubicaciones.modelo.php";
require_once "modelos/presupuestoRapido.modelo.php";
require_once "modelos/cobranzaclientes.modelo.php";
require_once "modelos/proveedores.modelo.php";
require_once "modelos/actualizar.productos.modelo.php";
require_once "modelos/act.prod1.modelo.php";
require_once "modelos/chequera.modelo.php";
require_once "modelos/publicidad.modelo.php";
require_once "modelos/imprecibo.modelo.php";
require_once "modelos/TangoFacturaModel.php";
require_once "modelos/estadosentrega.modelo.php";
require_once "modelos/liquidarcobros.modelo.php";
require_once "modelos/cccliente.modelo.php";
require_once "modelos/actmasivo.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();