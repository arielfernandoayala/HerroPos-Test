<?php
require_once "conexion.php";

	class APIResult{
		//Type: Array(DetalleError)
		public $Error;
		
		//Type: Int
		public $CodigoError;
		
		//Type: StdClass. Su contenido depende del método invocado
		public $Data;
		
		public static function FromJsonString($str){
			$obj = json_decode($str);
			$result = new APIResult();
			$result->Error = array();
			if (property_exists($obj, "Error")){
				foreach($obj->Error as $err){
					$result->Error[]=DetalleError::FromStdObject($err);
				}
				$result->CodigoError = $obj->CodigoError;
			} else if (property_exists($obj, "errorGetData") && $obj->errorGetData != null && $obj->errorGetData != ""){
				$err = new DetalleError();
				$err->Mensaje = $obj->errorGetData;
				$err->Nivel = 0;
				$result->Error[]=$err;
			}
			
			$result->Data = $obj->Data;
			return $result;
		}
	}
	
	class DetalleError{
		public $Mensaje;
		
		public $Nivel;
		
		public static function FromStdObject($obj){
			$result = new DetalleError();
			$result->Mensaje = $obj->Mensaje;
			$result->Nivel = $obj->Nivel;
			return $result;
		}
	}
	
	class ListarMovimientoResult{
		public $MovimientoId;
		public $MovimientoFecha;
		public $MovimientoLetra;
		public $ClienteCodigo;
		public $ClienteCodigoAlternativo;
		public $ClienteNombre;
		public $ClienteDireccion;
		public $ClienteEmail;
		public $Total;
		
		//Estado de autorización de comprobante
		//2: Pendiente de CAE
		//3: Rechazado
		public $EstadoId;
		public $MovimientoDescripcion;
		
		//Type: Array(MovimientoCuota)
		public $MovimientoCuotas;
		
		public $Renglones;
		
		public static function FromStdObject($obj){
			$result = new ListarMovimientoResult();
			$result->MovimientoId = $obj->MovimientoFecha;
			$result->MovimientoFecha = $obj->MovimientoFecha;
			$result->MovimientoLetra = $obj->MovimientoLetra;
			$result->ClienteCodigo = $obj->ClienteCodigo;
			$result->ClienteCodigoAlternativo = $obj->ClienteCodigoAlternativo;
			$result->ClienteNombre = $obj->ClienteNombre;
			$result->ClienteDireccion = $obj->ClienteDireccion;
			$result->ClienteEmail = $obj->ClienteEmail;
			$result->Total = $obj->Total;
			$result->EstadoId = $obj->EstadoId;
			$result->MovimientoDescripcion = $obj->MovimientoDescripcion;
			$result->MovimientoCuotas = array();
			foreach($obj->MovimientoCuotas as $cuota){
				$result->MovimientoCuotas[] = MovimientoCuota::FromStdObject($cuota);
			}
			$result->Renglones = array();
			foreach($obj->Renglones as $renglon){
				$result->Renglones[] = MovimientoRenglon::FromStdObject($renglon);
			}
			
			return $result;
		}
	}
	
	class MovimientoRenglon{
		public $ProductoCodigo;
		public $ProductoNombre;
		public $ProductoDescripcion;
		public $Cantidad;
		public $Precio;
		public $Bonificacion;
		//Type: Array(MovimientoRenglonDetalleAlicuota)
		public $DetalleAlicuotas;
		
		public static function FromStdObject($obj){
			$result = new MovimientoRenglon();
			$result->ProductoCodigo = $obj->ProductoCodigo;
			$result->ProductoNombre = $obj->ProductoNombre;
			$result->ProductoDescripcion = $obj->ProductoDescripcion;
			$result->Cantidad = $obj->Cantidad;
			$result->Precio = $obj->Precio;
			$result->Bonificacion = $obj->Bonificacion;
			$result->DetalleAlicuotas = array();
			if (!empty($obj->DetalleAlicuotas)){
				foreach ($obj->DetalleAlicuotas as $DetalleAlicuota){
					$result->DetalleAlicuotas[] = MovimientoRenglonDetalleAlicuota::FromStdObject($DetalleAlicuota);
				}	
			}			
			
			return $result;
		}
	}
	
	class MovimientoImpuesto{
		public $Nombre;
		public $Alicuota;
		public $BaseImponible;
		public $Importe;
		
		public static function FromStdObject($obj){
			$result = new MovimientoImpuesto();
			$result->Nombre = $obj->Nombre;
			$result->Alicuota = $obj->Alicuota;
			$result->BaseImponible = $obj->BaseImponible;
			$result->Importe = $obj->Importe;
			return $result;
		}
	}
	
	
	class MovimientoRenglonDetalleAlicuota{
		public $ImpuestoID;
		public $ImpuestoNombre;
		public $AlicuotaPorcentaje;
		public $AlicuotaCodigo;
		
		public static function FromStdObject($obj){
			$result = new MovimientoRenglonDetalleAlicuota();
			$result->ImpuestoID = $obj->ImpuestoID;
			$result->ImpuestoNombre = $obj->ImpuestoNombre;
			$result->AlicuotaPorcentaje = $obj->AlicuotaPorcentaje;
			$result->AlicuotaCodigo = $obj->AlicuotaCodigo;
			return $result;
		}
	}
	
	class MovimientoCuota{
		public $CuotaMovimientoId;
		public $CuotaMovimientoDescripcion;
		public $CuotaMovimientoImporte;
		public $CuotaMovimientoVencimiento;
		public $CuotaMovimientoSaldo;
		
		public static function FromStdObject($obj){
			$result = new MovimientoCuota();
			$result->CuotaMovimientoId = $obj->MovimientoCuotaId;
			$result->CuotaMovimientoDescripcion = $obj->MovimientoCuotaDescripcion;
			$result->CuotaMovimientoImporte = $obj->MovimientoCuotaImporte;
			$result->CuotaMovimientoVencimiento = $obj->MovimientoCuotaDescripcion;
			$result->CuotaMovimientoSaldo = $obj->MovimientoCuotaSaldo;
			return $result;
		}
	}
	
	class MovimientoEncabezado{
		public $EmpresaNombreLegal;
        public $EmpresaNombreComercial;
        public $EmpresaMail;
        public $EmpresaDireccion;
        public $EmpresaTelefono;
        public $EmpresaTipoResponsable;
        public $Letra;
        public $TipoComprobanteCodigo;
        public $MovimientoDescripcion;
        public $MovimientoFecha;
        public $EmpresaCUIT;
        public $EmpresaNumeroIngresosBrutos;
        public $EmpresaFechaInicioActividades;
		
		public static function FromStdObject($obj){
			$result = new MovimientoEncabezado();
			$result->EmpresaNombreLegal = $obj->EmpresaNombreLegal;
			$result->EmpresaNombreComercial = $obj->EmpresaNombreComercial;
			$result->EmpresaMail = $obj->EmpresaMail;
			$result->EmpresaDireccion = $obj->EmpresaDireccion;
			$result->EmpresaTelefono = $obj->EmpresaTelefono;
			$result->EmpresaTipoResponsable = $obj->EmpresaTipoResponsable;
			$result->Letra = $obj->Letra;
			$result->TipoComprobanteCodigo = $obj->TipoComprobanteCodigo;
			$result->MovimientoDescripcion = $obj->MovimientoDescripcion;
			$result->MovimientoFecha = $obj->MovimientoFecha;
			$result->EmpresaCUIT = $obj->EmpresaCUIT;
			$result->EmpresaNumeroIngresosBrutos = $obj->EmpresaNumeroIngresosBrutos;
			$result->EmpresaFechaInicioActividades = $obj->EmpresaFechaInicioActividades;
			return $result;
		}
	}
	
	//Clase utilizada para crear un movimiento en Tango factura
	class FacturarModel{
		
		function __construct(){
			$this->ClienteDireccionExtendida = new ClienteDireccionExtendida();
			$this->DetallesMovimiento = array();
		}
		
		
		public $Letra;
		public $ClienteCodigo;
		public $ClienteNombre;
		public $ClienteDireccion;
		//Type: ClienteDireccionExtendida
		public $ClienteDireccionExtendida;
		public $ClienteEmail;
		public $ClienteTipoDocumento;
		public $ClienteNumeroDocumento;
		//Type: Array(DetalleFacturarModel)
		public $DetallesMovimiento;
		public $CategoriaImpositivaCodigo;
		public $FechaComprobante;
		public $FechaServicioDesde;
		public $FechaServicioHasta;
		public $Observacion;
		//1-Factura
		//2-Crédito
		//Válido únicamente para proceso de creación por lotes
		public $TipoComprobante;
		
		//Perfil comprobante a utilizar. 
		public $PerfilComprobanteID;
		
		//Se utiliza para enviar el objeto al servidor de Tango factura
		//El parámetro $index indica que el modelo es parte de un array, y ocupa la posición indicada por el mismo
		//Si se están utilizando los proceso de creación de un solo comprobante, este parámetro no debe especificarse
		public function asArray($index = null){
			$data = array();
			$anteponer = "";
			if (isset($index)){
				$anteponer = "Movimientos[" . $index . "].";
			}			
			
			$data[$anteponer . "Letra"] = $this->Letra;
			$data[$anteponer . "ClienteCodigo"] = $this->ClienteCodigo;
			$data[$anteponer . "ClienteDireccion"] = $this->ClienteDireccion;
			$data[$anteponer . "ClienteEmail"] = $this->ClienteEmail;
			$data[$anteponer . "ClienteNombre"] = $this->ClienteNombre;
			$data[$anteponer . "ClienteNumeroDocumento"] = $this->ClienteNumeroDocumento;
			$data[$anteponer . "ClienteTipoDocumento"] = $this->ClienteTipoDocumento;
			$data[$anteponer . "CategoriaImpositivaCodigo"] = $this->CategoriaImpositivaCodigo;
			if (isset($this->PerfilComprobanteID)){
				$data[$anteponer . "PerfilComprobanteID"] = $this->PerfilComprobanteID;
			}
			if (isset($this->TipoMovimiento)){
				$data[$anteponer . "TipoMovimiento"] = $this->TipoMovimiento;
			}
			
			$data[$anteponer . "Observacion"] = $this->Observacion;
			
			if ($this->ClienteDireccionExtendida != null){
				$data[$anteponer . "ClienteDireccionExtendida.Calle"] = isset($this->ClienteDireccionExtendida->Calle) ? $this->ClienteDireccionExtendida->Calle : ""; 
				$data[$anteponer . "ClienteDireccionExtendida.Numero"] = $this->ClienteDireccionExtendida->Numero;
				$data[$anteponer . "ClienteDireccionExtendida.Piso"] = $this->ClienteDireccionExtendida->Piso;
				$data[$anteponer . "ClienteDireccionExtendida.Departamento"] = $this->ClienteDireccionExtendida->Departamento;
				$data[$anteponer . "ClienteDireccionExtendida.Localidad"] = $this->ClienteDireccionExtendida->Localidad;
				$data[$anteponer . "ClienteDireccionExtendida.Provincia"] = $this->ClienteDireccionExtendida->Provincia;
				$data[$anteponer . "ClienteDireccionExtendida.CodigoPostal"] = $this->ClienteDireccionExtendida->CodigoPostal;
			} else {
				$data[$anteponer . "ClienteDireccionExtendida.Calle"] = "";
			}
			
			$i=0;
			foreach ($this->DetallesMovimiento as $DetalleMovimiento){
				$data[$anteponer . "DetallesMovimiento[".$i."].Cantidad"] = $this->DetallesMovimiento[$i]->Cantidad;
				$data[$anteponer . "DetallesMovimiento[".$i."].Precio"] = $this->DetallesMovimiento[$i]->Precio;
				$data[$anteponer . "DetallesMovimiento[".$i."].ProductoCodigo"] = $this->DetallesMovimiento[$i]->ProductoCodigo;
				$data[$anteponer . "DetallesMovimiento[".$i."].ProductoDescripcion"] = $this->DetallesMovimiento[$i]->ProductoDescripcion;
				$data[$anteponer . "DetallesMovimiento[".$i."].ProductoNombre"] = $this->DetallesMovimiento[$i]->ProductoNombre;
				$data[$anteponer . "DetallesMovimiento[".$i."].Bonificacion"] = $this->DetallesMovimiento[$i]->Bonificacion;
				
				
				if ($DetalleMovimiento->DetalleAlicuotas != null){
					$j = 0;
					foreach($DetalleMovimiento->DetalleAlicuotas as $DetalleAlicuota){
						$data[$anteponer . "DetallesMovimiento[".$i."].DetalleAlicuotas[".$j."].AlicuotaCodigo"] = $DetalleAlicuota->AlicuotaCodigo;
						$data[$anteponer . "DetallesMovimiento[".$i."].DetalleAlicuotas[".$j."].AlicuotaPorcentaje"] = $DetalleAlicuota->AlicuotaPorcentaje;
						$j++;
					}
				}
				
				$i++;
			}
			
			return $data;
		}
	}
	
	class ClienteDireccionExtendida{
		public $Calle;
		public $Numero;
		public $Piso;
		public $Departamento;
		public $Localidad;
		public $CodigoPostal;
		public $Provincia;
		
		public function __toString(){
			return json_encode($this);
		}
		
		public function GetAsString(){
			$ret = $this->Calle;
			if (isset($this->Numero) && $this->Numero != ""){
				$ret=$ret." ".$this->Numero;
			}
			if (isset($this->Piso) && $this->Piso != ""){
				$ret=$ret." ".$this->Piso;
			}
			if (isset($this->Departamento) && $this->Departamento != ""){
				$ret=$ret." ".$this->Departamento;
			}
			if (isset($this->Localidad) && $this->Localidad != ""){
				$ret=$ret." ".$this->Localidad;
			}
			if (isset($this->CodigoPostal) && $this->CodigoPostal != ""){
				$ret=$ret." ".$this->CodigoPostal;
			}
			if (isset($this->Provincia) && $this->Provincia != ""){
				$ret=$ret." ".$this->Provincia;
			}
			return $ret;
			
		}
		
		public static function FromStdObject($obj){
			$result = new ClienteDireccionExtendida();
			$result->Calle = $obj->Calle;
			$result->Numero = $obj->Numero;
			$result->Piso = $obj->Piso;
			$result->Departamento = $obj->Departamento;
			$result->Localidad = $obj->Localidad;
			$result->CodigoPostal = $obj->CodigoPostal;
			$result->Provincia = $obj->Provincia;
			return $result;
		}
	}
	
	class DetalleFacturarModel{
		public $ProductoCodigo;
		public $ProductoNombre;
		public $ProductoDescripcion;
		public $Precio;
		public $Bonificacion;
		//Type: Array(FacturacionDetalleAlicuota)
		public $DetalleAlicuotas;
		
		public function __toString(){
			return json_encode($this, JSON_FORCE_OBJECT);
		}
	}
	
	//Se utiliza para determinar los impuestos y alícuotas aplicadas a un renglón de un comprobante
	class FacturacionDetalleAlicuota{
		public $AlicuotaCodigo;
		public $AlicuotaPorcentaje;
		public function __toString(){
			return json_encode($this);
		}
	}
	
	//Resultado de creación de comprobante
	class FacturarResultModel{
		public $CAE;
		public $VencimientoCAE;
		public $MovimientoId;
		public $UrlDetalle;
		public $UrlPDF;
		public $UrlArchivosRg2485;
		public $Electronico;
		public $EstadoId;
		public $Grabado;
		public $Subtotal;
		public $Total;
		public $TotalIva;
		public $TotalOtrosImpuestos;
		public $FechaVencimiento;
		public $FechaEmision;
		public $Descripcion;
		public $ObservacionLegal;
		public $Letra;
		public $Numero;
		public $ClienteCodigo;
		public $ClienteRazonSocial;
		public $FormaPago;
		public $UrlCodigoBarras;
		public $NumeroCodigoBarras;
		//Type: array[MovimientoRenglon]
		public $Renglones;
		//Type: array[MovimientoImpuesto]
		public $Impuestos;
		//Type: array[MovimientoCuota]
		public $Cuotas;
		//Type: MovimientoEncabezado
		public $Encabezado;
		
		public static function FromStdObject($obj){
			$result = new FacturarResultModel();
			$result->CAE = $obj->CAE;
            $result->VencimientoCAE = $obj->VencimientoCAE;
            $result->MovimientoId = $obj->MovimientoId;
            $result->UrlDetalle = $obj->UrlDetalle;
            $result->UrlPDF = $obj->UrlPDF;
            $result->UrlArchivosRg2485 = $obj->UrlArchivosRg2485;
            $result->Electronico = $obj->Electronico;
            $result->EstadoId = $obj->EstadoId;
            $result->Grabado = $obj->Grabado;
            $result->Subtotal = $obj->Subtotal;
            $result->Total = $obj->Total;
            $result->TotalIva = $obj->TotalIVA;
            $result->TotalOtrosImpuestos = $obj->TotalOtrosImpuestos;
            $result->FechaVencimiento = $obj->FechaVencimiento;
            $result->FechaEmision = $obj->FechaEmision;
            $result->Descripcion = $obj->Descripcion;
			$result->ObservacionLegal = $obj->ObservacionesLegales;
			$result->Letra = $obj->Letra;
			$result->Numero = $obj->Numero;
            $result->ClienteCodigo = $obj->ClienteCodigo;
            $result->ClienteRazonSocial = $obj->ClienteRazonSocial;
			$result->FormaPago = $obj->FormaPago;
			$result->UrlCodigoBarras = $obj->UrlCodigoBarras;
			$result->NumeroCodigoBarras = $obj->NumeroCodigoBarras;
			
			$result->Encabezado = MovimientoEncabezado::fromStdObject($obj->Encabezado);
			
			$result->Renglones = array();
			foreach($obj->Renglones as $renglon){
				$result->Renglones[] = MovimientoRenglon::FromStdObject($renglon);
			}
			
			$result->Impuestos = array();
			foreach($obj->Impuestos as $impuesto){
				$result->Impuestos[] = MovimientoImpuesto::FromStdObject($impuesto);
			}
			
			$result->Cuotas = array();
			foreach($obj->Cuotas as $cuota){
				$result->Cuotas[] = MovimientoCuota::FromStdObject($cuota);
			}
			
			return $result;
		}
	}
	
	class Email{
		public $TipoEmail;
		public $Email;
		
		public static function FromStdObject($obj){
			$result = new Email();
			$result->TipoEmail = $obj->TipoEmail;
			$result->Email = $obj->Email;
			return $result;
		}
	}
	
	class Cliente{
		public $ClienteId;
		public $ClientePerfil;
		public $ClienteCodigo;
		public $ClienteCodigoAlternativo;
		public $ClienteNombre;
		public $ClienteTipoDocumento;
		public $ClienteNumeroDocumento;
		public $ClientePerfilImpositivoCodigo;
		
		//Type: ClienteDireccionExtendida
		public $ClienteDireccion;
		//Type: Array[Email]
		public $ClienteEmail;
		
		function __construct(){
			$this->ClienteEmail = array();
			$this->ClienteDireccion = new ClientedireccionExtendida();
		}
		
		public static function FromStdObject($obj){
			$result = new Cliente();
			$result->ClienteId = $obj->ClienteId;
			$result->ClientePerfil = $obj->ClientePerfil;
			$result->ClienteCodigo = $obj->ClienteCodigo;
			$result->ClienteCodigoAlternativo = $obj->ClienteCodigoAlternativo;
			$result->ClienteNombre = $obj->ClienteNombre;
			$result->ClienteTipoDocumento = $obj->ClienteTipoDocumento;
			$result->ClienteNumeroDocumento = $obj->ClienteNumeroDocumento;
			$result->ClientePerfilImpositivoCodigo = $obj->ClientePerfilImpositivoCodigo;
			

			if ($obj->ClienteDireccion != null){
				$result->ClienteDireccion->Numero = $obj->ClienteDireccion->Numero;
				$result->ClienteDireccion->Calle = $obj->ClienteDireccion->Calle;
				$result->ClienteDireccion->Piso = $obj->ClienteDireccion->Piso;
				$result->ClienteDireccion->Departamento = $obj->ClienteDireccion->Departamento;
				$result->ClienteDireccion->CodigoPostal = $obj->ClienteDireccion->CodigoPostal;
				$result->ClienteDireccion->Localidad = $obj->ClienteDireccion->Localidad;
				$result->ClienteDireccion->Provincia = $obj->ClienteDireccion->Provincia;
			}
			
			foreach($obj->ClienteEmail as $email){
				$result->ClienteEmail[] = Email::FromStdObject($email);
			}
		
			return $result;
		}
		
		public function asArray(){
			$data = array();
			$data["ClienteID"] = $this->ClienteId;
			$data["ClientePerfil"] = $this->ClientePerfil;
			$data["ClienteCodigo"] = $this->ClienteCodigo;
			$data["ClienteCodigoAlternativo"] = $this->ClienteCodigoAlternativo;
			$data["ClienteNombre"] = $this->ClienteNombre;
			$data["ClienteTipoDocumento"] = $this->ClienteTipoDocumento;
			$data["ClienteNumeroDocumento"] = $this->ClienteNumeroDocumento;
			$data["CategoriaImpositiva"] = $this->ClientePerfilImpositivoCodigo;
			if (isset($this->ClienteDireccion)){
				$data["ClienteDireccion.Calle"] = $this->ClienteDireccion->Calle;
				$data["ClienteDireccion.Numero"] = $this->ClienteDireccion->Numero;
				$data["ClienteDireccion.Piso"] = $this->ClienteDireccion->Piso;
				$data["ClienteDireccion.Departamento"] = $this->ClienteDireccion->Departamento;
				$data["ClienteDireccion.Localidad"] = $this->ClienteDireccion->Localidad;
				$data["ClienteDireccion.CodigoPostal"] = $this->ClienteDireccion->CodigoPostal;
				$data["ClienteDireccion.Provincia"] = $this->ClienteDireccion->Provincia;
			}
			if (isset($this->ClienteEmail)){
				$i = 0;
				foreach ($this->ClienteEmail as $email){
					$data["ClienteEmail[".$i."].Email"] = $email->Email;
					$data["ClienteEmail[".$i."].TipoEmail"] = $email->TipoEmail;
					$i++;
				}
			}
			return $data;
		}
	}

	class Concepto{
		
		function __construct(){
			$this->ProductoImagenes = array();
		}
		public $ProductoId;
		// Perfil del concepto. Valores posibles: 1 - Venta | 2 - Compra | 3 - Compra/Venta. 
		public $ProductoPerfil;
		public $ProductoCodigo;
		public $ProductoCodigoAlternativo;
		public $ProductoNombre;
		public $ProductoDescripcion;
		public $ProductoPrecioFinal;
		public $ProductoPrecioFinalCompra;
		public $ProductoPublicado;
		public $ProductoImagenes;
		public $ProductoTipo;

		public static function FromStdObject($obj){
			$result = new Concepto();
			$result->ProductoId = $obj->ProductoId;
			$result->ProductoPerfil = $obj->ProductoPerfil;
			$result->ProductoCodigo = $obj->ProductoCodigo;
			$result->ProductoCodigoAlternativo = $obj->ProductoCodigoAlternativo;
			$result->ProductoNombre = $obj->ProductoNombre;
			$result->ProductoDescripcion = $obj->ProductoDescripcion;
			$result->ProductoPrecioFinal = $obj->ProductoPrecioFinal;
			$result->ProductoPrecioFinalCompra = $obj->ProductoPrecioFinalCompra;
			$result->ProductoPublicado = $obj->ProductoPublicado;
			$result->ProductoTipo = $obj->ProductoId;
			if ($obj->ProductoImagenes != null){
				foreach ($obj->ProductoImagenes as $img){
					$result->ProductoImagenes[] = $img;
				}
			}

			return $result;
		}
	}

	class TipoDocumento{
		public $TipoDocumentoCodigo;
		public $TipoDocumentoDescripcion;
		public static function FromStdObject($obj){
			$result = new TipoDocumento();
			$result->TipoDocumentoCodigo = $obj->TipoDocumentoCodigo;
			$result->TipoDocumentoDescripcion = $obj->TipoDocumentoDescripcion;
			return $result;
		}
	}

	class CategoriaImpositiva{
		public $CategoriaImpositivaCodigo;
		public $CategoriaImpositivaDescripcion;
		public static function FromStdObject($obj){
			$result = new CategoriaImpositiva();
			$result->CategoriaImpositivaCodigo = $obj->CategoriaImpositivaCodigo;
			$result->CategoriaImpositivaDescripcion = $obj->CategoriaImpositivaDescripcion;
			return $result;
		}
	}

	class DatosContribuyente{
		public $RazonSocial;
		public $CategoriaImpositivaCodigo;
		public $ClienteCodigo;
		public $Direccion;
		public $Localidad;
		public $CodigoPostal;
		public $Provincia;
		public $NroDocumento;
		public $Email;
		public $Error;
	}
	
	class ClienteResult{
		public $ClienteID;
		public $LinkDePago;
		
		public static function FromStdObject($obj){
			$result = new ClienteResult();
			$result->ClienteID = $obj->ClienteID;
			return $result;
		}
	}
	
	class CrearLoteMovimientosResult{
		//Type: Array(FacturarResultModel)
		public $FacturarResultModel;
		
		public $AutorizacionExitosa;
		//Indica si pudo realizarse la conexión con el servicio de AFIP para obtener CAE
		
		function __construct(){
			$FacturarResultModel = array();
		}
	}
	
	//Modelo de Perfil de facturación
	class PerfilFacturacion{
		public $Id;
		public $Descripcion;
		public static function FromStdObject($obj){
			$result = new PerfilFacturacion();
			$result->Id = $obj->Id;
			$result->Descripcion = $obj->Descripcion;
			return $result;
		}
	}
?>