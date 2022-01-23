<?php
	
	require("TangoFacturaModel.php");
	
	class TangoFacturaServicioFacturacion {
		private $ApplicationPublicKey;
		private $UserIdentifier;
		private $Username;
		private $Password;
		
		
		function __construct($ApplicationPublicKey, $Username, $Password, $UserIdentifier){
			$this->ApplicationPublicKey = $ApplicationPublicKey;
			$this->UserIdentifier = $UserIdentifier;
			$this->Username = $Username;
			$this->Password = $Password;
		}
		
		static function GetBaseURL(){
			return "http://www.tangofactura.com";
		}
		
		function GetAPIUrl(){
			return $this->GetBaseURL()."/Services/Facturacion/";
		}
		
		function GetProvisioningUrl(){
			return $this->GetBaseURL()."/Provisioning/GetAuthToken";
		}
		
		
		function GetAuthToken(){
			if (!function_exists('curl_version')){
				throw new Exception("Para utilizar la SDK de Tango factura es necesario instalar cURL");
			}

			$postData = array();
			$postData["UserName"]=$this->Username;
			$postData["Password"]=$this->Password;
			$url = $this->GetProvisioningUrl();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			$result = curl_exec($ch);
			curl_close($ch);
			$token = str_replace("\"", "", $result);
			return $token;
		}
		
		function Ejecutar($metodo, $postData = array()){
			if (!function_exists('curl_version')){
				throw new Exception("Para utilizar la SDK de Tango factura es necesario instalar cURL");
			}
			$postData["ApplicationPublicKey"]=$this->ApplicationPublicKey;
			$postData["UserIdentifier"]=$this->UserIdentifier;			
			$postData["Token"] = $this->GetAuthToken();
			
			$url = $this->GetAPIUrl().$metodo;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
			$result = curl_exec($ch);
			curl_close($ch);
			//Se transforma el string en un objeto de tipo APIResult
			return APIResult::FromJsonString($result);
		}
		
		//Url para autorizar el acceso de una cuenta de Tango factura a una aplicación ya creada
		//Params:
		//ApplicationPublicKey: 
		//AppUsername: nombre que se muestra al usuario en la pantalla de autorización. 
		//Callback: URL a la que redireccionará Tango factura con el UserIdentifier. El parámetro se pasará concatenado al final de este parámetro.
		//          Entonces, la URL pasada debe ser de la forma http://www.somedomain.com/callback?uid=
		static function GetAuthorizeAppUrl($ApplicationPublicKey, $AppUsername, $Callback){
			return TangoFacturaServicioFacturacion::GetBaseURL()."/PGR/UsuarioSistema/AuthorizeApplication?AppSecret=".urlencode($ApplicationPublicKey)."&UserName=".$AppUsername."&Permission=195&hideHeader=1&UrlReturn=".urlencode($Callback);
		}
		
		static function GetCreateAppUrl(){
			return TangoFacturaServicioFacturacion::GetBaseURL()."/PGR/Aplicaciones/Create";
		}

		//Verifica que el resultado obtenido no tenga error
		function CheckResultData($apiResult){
			if ($apiResult->CodigoError == 0){
				return true;
			}
			
			$errores = "";
			for ($i=0; $i<count($apiResult->Error); $i++){
				$errores = $errores . " | " . $apiResult->Error[$i]->Mensaje;
			}
			
			throw new Exception($errores);
			
			return false;
		}
		
		//Permite listar los movimientos creados en Tango factura
		//Type: ListarMovimientoResult
		function ListarMovimientos(){
			$data = array();
			$data["Tope"] = 10;
			$apiResult = $this->Ejecutar("ListarMovimientos", $data);
			
			if ($this->CheckResultData($apiResult)){
				$movimientos = array();
				foreach ($apiResult->Data as $movimiento) {
					$movimientos[] = ListarMovimientoResult::FromStdObject($movimiento);
				}
				return $movimientos;
			}
		}
		
		//Permite crear un comprobante en Tango factura
		//Params
		//$facturarModel: FacturarModel
		//Type: FacturarResultModel
		function CrearFactura($facturarModel){
			$data = $facturarModel->asArray();
			$apiResult = $this->Ejecutar("CrearFactura", $data);
			if ($this->CheckResultData($apiResult)){
				return FacturarResultModel::FromStdObject($apiResult->Data);
			}
		}

		//Crea una nota de crédito en Tango factura
		//Params
		//$facturarModel: FacturarModel
		//Type: FacturarResultModel
		function CrearCreditoACuenta($facturarModel){
			$data = $facturarModel->asArray();
			$apiResult = $this->Ejecutar("CrearCreditoACuenta", $data);
			if ($this->CheckResultData($apiResult)){
				return FacturarResultModel::FromStdObject($apiResult->Data);
			}
		}
		
		//Crea una nota de débito en Tango factura
		//Params
		//$facturarModel: FacturarModel
		//Type: FacturarResultModel
		function CrearDebito($facturarModel){
			$data = $facturarModel->asArray();
			$apiResult = $this->Ejecutar("CrearDebito", $data);
			if ($this->CheckResultData($apiResult)){
				return FacturarResultModel::FromStdObject($apiResult->Data);
			}
		}
		
		//Permite listar los clientes de Tango factura
		//Type: Array(Cliente)
		function ListarClientes($filtro = ""){
			$data = array();
			$data["Filtro"] = $filtro;
			$apiResult = $this->Ejecutar("ListarClientes", $data);
			$result = array();
			if ($this->CheckResultData($apiResult)){
				foreach ($apiResult->Data as $cliente){
					$result[] = Cliente::FromStdObject($cliente);
				}
			}
			return $result;
		}

		//Permite listar los productos/servicios de Tango factura
		//Type: Array(Concepto)
		function ListarProductos($filtro = "", $conCodigoAlternativo = false, $publicados = false){
			$data = array();
			$data["Filtro"] = $filtro;
			$apiResult = $this->Ejecutar("ListarProductos", $data);
			$result = array();
			if ($this->CheckResultData($apiResult)){
				foreach ($apiResult->Data as $cliente){
					$result[] = Concepto::FromStdObject($cliente);
				}
			}
			return $result;
		}

		//Permite listar los tipos de documento existentes en Tango factura
		//Type: Array(TipoDocumento)
		function ListarTiposDocumento(){
			$apiResult = $this->Ejecutar("ListarTiposDocumento");
			$result = array();
			if ($this->CheckResultData($apiResult)){
				foreach ($apiResult->Data as $tipoDoc){
					$result[] = TipoDocumento::FromStdObject($tipoDoc);
				}
			}
			return $result;
		}
		
		//Permite listar las provincias existentes en Tango factura
		//Type: Array(string)
		function ListarProvincias(){
			$apiResult = $this->Ejecutar("ListarProvincias");
			$result = array();
			if ($this->CheckResultData($apiResult)){
				return $apiResult->Data;
			}
			
		}
		
		//Permite listar las categorias impositivas existentes en Tango factura. Se corresponden con las categorías impositivas de AFIP
		//Type: Array(CategoriaImpositiva)
		function ListarCategoriasImpositivas(){
			$apiResult = $this->Ejecutar("ListarCategoriasImpositivas");
			$result = array();
			if ($this->CheckResultData($apiResult)){
				foreach($apiResult->Data as $categoriaImpositiva){
					$result[] = CategoriaImpositiva::FromStdObject($categoriaImpositiva);
				}
			}
			return $result;
		}

		//Obtiene la información de un contribuyente por tipo y número de documento
		//Si el cliente existe en Tango factura, se devuelve la información existente en el sistema
		//Si el cliente no existe en Tango factura, el tipo de documento es CUIT, y el numero de cuit es válido, 
		//se devuelven los datos registrados en el padrón de AFIP
		//Type: DatosContribuyente
		function ObtenerCategoriaImpositivaContribuyente($tipoDocumento, $nroDocumento){
			$data = array();
			$data["TipoDocumentoCodigo"] = $tipoDocumento;
			$data["NroDocumento"] = $nroDocumento;
			$apiResult = $this->Ejecutar("ObtenerDatosContribuyente", $data);
			$result = new DatosContribuyente();
			if ($this->CheckResultData($apiResult)){
				//var_dump($apiResult->Data);
				if (sizeof($apiResult->Error) > 0){
					$result->Error = $apiResult->Error[0]->Mensaje;
				} else if ($apiResult->Data->idPersona == 0){
					$result->Error = "No se encontró información para este tipo y número de documento";
				} else {
					$result->NroDocumento = $apiResult->Data->idPersona;
					$result->ClienteCodigo = $apiResult->Data->ClienteCodigo;
					$result->RazonSocial = $apiResult->Data->nombre;
					$result->Email = $apiResult->Data->ClienteEmail;
					$result->Direccion = $apiResult->Data->domicilioFiscal->direccion;
					$result->Localidad = $apiResult->Data->domicilioFiscal->localidad;
					$result->CodigoPostal = $apiResult->Data->domicilioFiscal->codPostal;
					$result->Provincia = $apiResult->Data->domicilioFiscal->idProvincia;
					
					if ($apiResult->Data->PerfilImpositivoCodigo != null){
						$result->CategoriaImpositivaCodigo = $apiResult->Data->PerfilImpositivoCodigo;
					} else {
						$categorias = $this->ListarCategoriasImpositivas();
						$categoriaMT = null;
						$categoriaRI = null;
						$categoriaEX = null;
						foreach ($categorias as $categoria){
							if ($categoria->CategoriaImpositivaDescripcion == "Responsable Monotributo"){
								$categoriaMT = $categoria;
							}
							if ($categoria->CategoriaImpositivaDescripcion == "Responsable Inscripto"){
								$categoriaRI = $categoria;
							}
							if ($categoria->CategoriaImpositivaDescripcion == "Exento"){
								$categoriaEX = $categoria;
							}
						}
						foreach ($apiResult->Data->impuestos as $idImpuesto){
							if ($idImpuesto >= 20 && $idImpuesto <=24){
								$result->CategoriaImpositivaCodigo = $categoriaMT->CategoriaImpositivaCodigo;
							} else if ($idImpuesto == 30){
								
								$result->CategoriaImpositivaCodigo = $categoriaRI->CategoriaImpositivaCodigo;
							} else if ($idImpuesto == 32){
								
								$result->CategoriaImpositivaCodigo = $categoriaEX->CategoriaImpositivaCodigo;
							}

						}
					}
					
				}	
			}
			return $result;
		}
		
		
		//Crea un cliente en Tango factura.
		//Params
		//$cliente: ClienteModel
		//Type: ClienteResult
		function CrearCliente($cliente){
			$data = $cliente->asArray();
			
			$apiResult = $this->Ejecutar("CrearCliente", $data);
			if ($this->CheckResultData($apiResult)){
				return ClienteResult::FromStdObject($apiResult->Data);
			}
		}
		
		//Modifica un cliente en Tango factura.
		//Requiere que ClienteID sea el otorgado por Tango factura
		//Params
		//$cliente: ClienteModel
		//Type: ClienteResult
		function ModificarCliente($cliente){
			$data = $cliente->asArray();
			
			$apiResult = $this->Ejecutar("ModificarCliente", $data);
			if ($this->CheckResultData($apiResult)){
				return ClienteResult::FromStdObject($apiResult->Data);
			}
		}
		
		///Obtiene la información de un comprobante a partir de su identificador
		//Requiere que MovimientoID sea el otorgado por Tango factura
		//Params
		//$MovimientoID: int
		//Type: ClienteResult
		function ObtenerInfoMovimiento($MovimientoID){
			$data = array();
			$data["movimientoID"] = $MovimientoID;
			$apiResult = $this->Ejecutar("ObtenerInfoMovimiento", $data);
			if ($this->CheckResultData($apiResult)){
				return FacturarResultModel::FromStdObject($apiResult->Data);
			}
		}
		
		///Obtiene la información de un comprobante a partir de su Código de autorización electrónico (CAE)
		//Params
		//$CAE: long
		//Type: ClienteResult
		function ObtenerInfoMovimientoPorCAE($CAE){
			$data = array();
			$data["CAICAE"] = $CAE;
			$apiResult = $this->Ejecutar("ObtenerInfoMovimiento", $data);
			if ($this->CheckResultData($apiResult)){
				return FacturarResultModel::FromStdObject($apiResult->Data);
			}
		}
		
		//Proceso de creación de comprobantes por lotes
		//$facturarModel: array(FacturarModel)
		//$esPrimerLote: bool. Indica si el lote es el primero que se envía. De esta forma, a partir del segundo lote de una tanda, 
		//puede reutilizarse el Login Ticket otorgado por AFIP
		//Type: CrearLoteMovimientosResult
		function CrearLoteMovimientos($arrayFacturarModel, $esPrimerLote = false){ 
			$data = array();
			$i = 0;
			foreach ($arrayFacturarModel as $facturarModel){
				$data = array_merge($data, $facturarModel->asArray($i));
				$i++;
			}
			$data["EsPrimerLote"] = $esPrimerLote;
			
			$apiResult = $this->Ejecutar("CrearLoteMovimientos", $data);
			
			if ($this->CheckResultData($apiResult)){
				$result = new CrearLoteMovimientosResult();
				$result->AutorizacionExitosa = $apiResult->Data->AutorizacionExitosa;
				foreach($apiResult->Data->movimientos as $facturarResult){
					$result->FacturarResultModel[] = FacturarResultModel::FromStdObject($facturarResult);
				}
				return $result;
			}
		}
		
		//Lista los prefiles 
		//Type: array(PerfilFacturacion)
		function ListarPerfilesFacturacion(){
			$apiResult = $this->Ejecutar("ListarPerfilesFacturacion", $data);
			$result = array();
			if ($this->CheckResultData($apiResult)){
				foreach ($apiResult->Data as $perfil){
					$result[] = PerfilFacturacion::FromStdObject($perfil);
				}
				return $result;
			}
		}
	}
	

?>