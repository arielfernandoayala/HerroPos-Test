<div class="content-wrapper">

  <section class="content-header">
    
    <ol class="breadcrumb">    
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>   
      <li class="active">Factura</li>  
    </ol>

  </section>

  <section class="content">

    <div class="action">

      <div class="description">
        <h5>Verificar y completar datos de cliente:</h5>
        <form action="doFacturar.php" method="POST">

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Detalles de factura</h3>
            </div>

            <div class="box-body">
              <div class="row">

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Tipo de comprobante</label>
                    <select class="form-control" id="TipoComprobante" name="TipoComprobante" required>
                      <option value="1">Factura</option>
                      <option value="2">Cr&eacute;dito</option>
                      <option value="3">D&eacute;bito</option>
                    </select>  
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Letra:</label>
                    <select class="form-control" id="Letra" name="Letra" required>
                      <option value="B">B</option>
                      <option value="A">A</option>
                      <option value="C">C</option>
                    </select>
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Perfil impositivo::</label>
                    <select class="form-control" id="ClientePerfilImpositivo" name="ClientePerfilImpositivo" required>
                      <option value="CF">Consumidor final</option>
                      <option value="RI">Responsable inscripto</option>
                      <option value="MT">Responsable monotributo</option>
                      <option value="EX">Exento</option>
                    </select>
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Tipo Documento:</label>
                    <select class="form-control" id="ClienteTipoDocumento" name="ClienteTipoDocumento">
                      <option value="1">D.N.I.</option>
                      <option value="2">C.U.I.T.</option>
                      <option value="3">C.I.</option>
                      <option value="4">L.E.</option>
                      <option value="5">L.C.</option>
                      <option value="6">C.U.I.L.</option>
                    </select>
                  </div>
                </div>

              </div>
              <!-- /.row1 -->
                <?php

                    $item = "id";
                    $valor = $_GET["idVenta"];

                    $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];


                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

              echo '<div class="row">
                
                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Codigo Cliente</label>
                    <input class="form-control" id="ClienteCodigo" name="ClienteCodigo" value="'.$cliente["id"].'" readonly />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Razón social:</label>
                    <input class="form-control" id="ClienteRazonSocial" name="ClienteRazonSocial" value="'.$cliente["nombre"].'" />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Número documento:</label>
                    <input class="form-control" id="ClienteNumeroDocumento" name="ClienteNumeroDocumento" value="'.$cliente["documento"].'" />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" id="ClienteEmailFactura" name="ClienteEmailFactura" value="'.$cliente["email"].'" />
                  </div>
                </div>

              </div>

              <!-- END /.row2 -->

              <!-- /.row3 -->
              <div class="row">
                
                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Calle:</label>
                    <input class="form-control" id="ClienteDirExtCalle" name="ClienteDirExtCalle" value="'.$cliente["calle"].'" />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Numero</label>
                    <input class="form-control" id="ClienteDirExtNro" name="ClienteDirExtNro" value="'.$cliente["numero"].'" />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Piso:</label>
                    <input class="form-control" id="ClienteDirExtPiso" name="ClienteDirExtPiso" value="'.$cliente["piso"].'" />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Departamento:</label>
                    <input class="form-control" id="ClienteDirExtDepartamento" name="ClienteDirExtDepartamento" value="'.$cliente["departamento"].'" />
                  </div>
                </div>

              </div>

              <!-- END /.row3 -->

              <!-- /.row4 -->
              <div class="row">
                
                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Localidad:</label>
                    <input class="form-control" id="ClienteDirExtLocalidad" name="ClienteDirExtLocalidad" value="'.$cliente["localidad"].'" />
                  </div>
                </div>

                <div class="col-xs-2">
                  <div class="form-group">
                    <label>Codigo Postal:</label>
                    <input class="form-control" id="ClienteDirExtCP" name="ClienteDirExtCP" value="'.$cliente["cod_postal"].'" />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Provincia:</label>
                    <input class="form-control" id="ClienteDirExtProvincia" name="ClienteDirExtProvincia" value="'.$cliente["provincia"].'"  />
                  </div>
                </div>                
                <div class="col-xs-4">
                  <div class="form-group">
                    <label>Domicilio registrado en sistema</label>
                    <input class="form-control" id="ClienteFacturaDomicilioActual" name="ClienteFacturaDomicilioActual" value="'.$cliente["direccion"].'" readonly />
                  </div>
                </div>';

                ?>



              </div>
              <!-- END /.row4 -->  

              <!--div class="row">
                
                <div class="col-xs-2">
                  <div class="form-group">
                    <label>Cod Producto</label>
                    <input class="form-control" id="ConceptoCodigo" name="ConceptoCodigo" />
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Detalle prodcuto:</label>
                    <input class="form-control" id="ConceptoNombre" name="ConceptoNombre" />
                  </div>
                </div>

                <div class="col-xs-2">
                  <div class="form-group">
                    <label>Cantidad:</label>
                    <input class="form-control" id="ConceptoCantidad" name="ConceptoCantidad" />
                  </div>
                </div>

                <div class="col-xs-2">
                  <div class="form-group">
                    <label>Precio:</label>
                    <input class="form-control" id="ConceptoImporte" name="ConceptoImporte" />
                  </div>
                </div>

              </div-->

              <div>

              <hr>


                  <?php

                    $item = "id";
                    $valor = $_GET["idVenta"];

                    $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                    $totalFactura = number_format($venta["total"],2);

                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];


                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];

                    $canalDeVta = $venta["id_canal_venta"];


                $listaProducto = json_decode($venta["productos"], true);

                //var_dump($listaProducto);

                echo '<input type="number" style="display: none"  id="idVentaAFacturar" name="idVentaAFacturar" value="'.$_GET["idVenta"].'">';

                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";
                  $precioUnitario = number_format($value["precio"],2);
                  $precioTotal = number_format($value["total"],2);

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
                  
                  echo '<div class="row">

                          <div class="col-xs-2">
                            <div class="form-group">
                              <label>Codigo:</label>
                              <input type="number" class="form-control idLineaFactura"  value="'.$value["id"].'" readonly required>
                            </div>
                          </div>
            
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Detalle:</label>
                              <input type="text" class="form-control descripcionLineaFactura" value="'.$value["descripcion"].'" readonly required>
                            </div>
                          </div>

                          <div class="col-xs-2">
                            <div class="form-group">
                              <label>Precio Unit:</label>
                              <input type="number" class="form-control precioUnitLineaFactura" value="'.$value["precio"].'" readonly required>
                            </div>
                          </div>

                          <div class="col-xs-2">
                            <div class="form-group">
                              <label>Cantidad:</label>
                              <input type="number" class="form-control cantidadLineaFactura" value="'.$value["cantidad"].'" readonly required>
                            </div>
                          </div>

                          <div class="col-xs-2">
                            <div class="form-group">
                              <label>Precio:</label>
                              <input type="number" class="form-control totalLineaFactura"  value="'.$value["total"].'" readonly required>
                            </div>
                          </div>

                      </div>';
                }

                    echo '<hr><br> <br> 

                      <div class="row ">

                        <div class="col-xs-2">
                            <div class="form-group">
                              <h4>
                                  <label>Modificacion %</label>
                                  <input type="number" class="form-control totalLineaFactura"  value="'.$venta["venta_porcentaje"].'" readonly required>
                                </h4> 
                            </div>

                        </div>

                        <div class="col-xs-4">
                          <div class="form-group">
                          <h4>
                            <label>TOTAL FACTURA:</label>
                            <input type="number" class="form-control totalFactura "  value="'.$venta["total"].'" readonly required>
                           </h4> 
                          </div>
                        </div>

                       </div>';


                ?>



              </div>
              <!-- /.row of products --> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box box-primary -->
        </form>
         <!-- /form factura -->


        <a class="btn btn-block btn-primary" href="#" onclick="createSingle(); return false;">Crear comprobante</a>
        <!--a class="button" href="#" onclick="createBatch(); return false;">Crear 10 facturas (Creación por comprobante)</a-->
      </div>
      
    </div>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
      function submit(){
        $("form").submit();
      }
      
      function createSingle(){
        $("form").attr("action","doFacturar");
        submit();
      }
      
      function createBatch(){
        $("form").attr("action","doFacturarBatch");
        submit();
      }
    </script>




  </section>

</div>