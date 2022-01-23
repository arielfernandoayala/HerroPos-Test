<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar producto

        </button>


      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">Código</th>
           <th>Imagen</th>
           <th>Descripción</th>
           <th>Proveedor</th>
           <th>Categoría</th>
           <th>Stock</th>
           <th>Precio de venta</th>
           <th>Ult Mod</th>
           <th>Acciones</th>
           
         </tr> 

        </thead>      

       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!--ENTRADA PARA SELECCIONAR EL PROVEEDOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-person"></i></span> 

                <select class="form-control input-lg" id="nuevoProveedor" name="nuevoProveedor" required>
                  
                  <option value="">Selecionar proveedor</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                  foreach ($proveedor as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["razon_social"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>


            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <?php

                    $item = null;
                    $valor = null;
                    $orden = "id";

                    $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                    $cod = count($productos)+1;



                  echo'<input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" value="'.$cod.'"readonly>'

                ?> 

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR LA UBICACION -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaUbicacion" name="nuevaUbicacion" required>
                  
                  <option value="">Selecionar ubicacion</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $ubicacion = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

                  foreach ($ubicacion as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["ubicaciones"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div> 


            <!-- ENTRADA PARA STOCK MAX - MIN -->

             <div class="form-group row">
                
                <!-- ENTRADA PARA STOCK MAX -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-battery-full"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoStockMax" name="nuevoStockMax" step="any" min="0" placeholder="Stock Max" required>

                  </div>

                </div>
                
                <!-- ENTRADA PARA STOCK MIN -->

                <div class="col-xs-6">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-battery-empty"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoStockMin" name="nuevoStockMin" step="any" min="0" placeholder="Stock Min" required>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA STOCK Y PRECIO DOLAR-->

             <div class="form-group row">
                
                <!-- ENTRADA PARA STOCK  -->

                <div class="col-xs-6">
                
                  <div class="input-group">
              
                    <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

                  </div>

                </div>


                
                <!-- ENTRADA PARA EL PRECIO DOLAR -->

                <div class="col-xs-6">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                    <input type="number" class="form-control input-lg"  name="nuevoDolar" id="nuevoDolar" step="any" min="0" placeholder="USD" required>

                  </div>

                </div>

            </div>




            <!-- ENTRADA PARA IVA - COEFICIENTE - NRO LISTA -->

             <div class="form-group row">
                
                <!-- ENTRADA PARA EL IVA -->

                <div class="col-xs-4">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoIva" name="nuevoIva" step="any" min="0" placeholder="iva" required>

                  </div>

                </div>

                <!-- ENTRADA PARA EL COEFICIENTE -->

                <div class="col-xs-4">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-angle-double-right"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoCoeficiente" name="nuevoCoeficiente" step="any" min="0" placeholder="Mod"  >

                  </div>

                </div>
                

                <!-- ENTRADA PARA EL NUMERO DE LISTA -->

                <div class="col-xs-4">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-list-ol"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoNumeroLista" name="nuevoNumeroLista" step="any" min="0" placeholder="Nro Lista" required>

                  </div>

                </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio de compra" required>

                  </div>

                  <br>

                  <!-- ENTRADA PARA INCREMENTADOR -->
                    
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                      <input type="number" class="form-control input-lg" id="nuevoIncrementador" name="nuevoIncrementador" step="any" min="0" placeholder="Incrementador: 17,35" title="Porcentaje a incrementar para llegar el precio de lista" required>
                      
                    </div>

                   <br>

                  <!-- ENTRADA PARA CODIGO DE PRODUCTO DEL PROVEEDOR -->
                    
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                      <input type="text" class="form-control input-lg" id="nuevoCodProductPorv" name="nuevoCodProductPorv" step="any" min="0" placeholder="Cod prod prove" title="Codigo de producto que tiene el proveedor en su lista a fin de facilitar los pedidos" >
                      
                    </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA CONTADO (CALCULADO) -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon">P.C</span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Venta contado" required readonly>

                  </div>
                
                  <br>

                  <!-- ENTRADA PARA EL PRECIO DE LISTA (CALCULADO) -->
                    
                  <div class="input-group">

                    <span class="input-group-addon">P.L.</span> 

                     <input type="number" class="form-control input-lg" id="nuevoPrecioList" name="nuevoPrecioList" readonly>
                        
                  </div>

                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" name="nuevoRentabilidad" min="0"  required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

        <?php

          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto </h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarCategoria" name="editarCategoria" required>
                  
                  <option value="">Selecionar categoria</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categoria as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["id"].'-'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div> 
<!--
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg"  name="editarCategoria"  required>
                  
                  <option id="editarCategoria"></option>

                </select>

              </div>

            </div>

-->

            <!--ENTRADA PARA SELECCIONAR EL PROVEEDOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <select class="form-control input-lg" id="editarProveedor" name="editarProveedor" required>
                  
                  <option value="">Selecionar proveedor</option>

                  <?php

                  $itemEU = null;
                  $valorEU = null;

                  $proveedorEU = ControladorProveedores::ctrMostrarProveedores($itemEU, $valorEU);

                  foreach ($proveedorEU as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["id"].'-'.$value["razon_social"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>
            
            <!--TENER EN CUENTA QUE NO GUARDO EL VALOR -->

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA STOCK Y PRECIO DOLAR-->

             <div class="form-group row">
                
                <!-- ENTRADA PARA STOCK  -->

                <div class="col-xs-6">
                
                  <div class="input-group">
              
                    <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                   <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>
                  </div>

                </div>


                
                <!-- ENTRADA PARA EL PRECIO DOLAR -->

                <div class="col-xs-6">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarDolar" name="editarDolar" step="any" min="0" placeholder="USD" required>

                  </div>

                </div>
  
            </div>

            <!-- ENTRADA PARA LA UBICACION-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarUbicacion" name="editarUbicacion" required>
                  
                  <option value="">Selecionar ubicacion</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $ubicacion = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

                  foreach ($ubicacion as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["id"].'-'.$value["ubicaciones"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div> 

             <!-- ENTRADA PARA STOCK MAX - MIN -->

             <div class="form-group row">
                
                <!-- ENTRADA PARA STOCK MAX -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-battery-full"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarStockMax" name="editarStockMax" step="any" min="0" placeholder="Stock Max" required>

                  </div>

                </div>
                
                <!-- ENTRADA PARA STOCK MIN -->

                <div class="col-xs-6">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-battery-empty"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarStockMin" name="editarStockMin" step="any" min="0" placeholder="Stock Min" required>

                  </div>

                </div>
                
              </div>
              <!-- ENTRADA PARA IVA - COEFICIENTE - NRO LISTA -->

             <!--div class="form-group row">
                
                <!-- ENTRADA PARA EL IVA >

                <div class="col-xs-4">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarIva" name="editarIva" step="any" min="0" placeholder="iva" required>

                  </div>

                </div>

                <!-- ENTRADA PARA EL COEFICIENTE >

                <div class="col-xs-4">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-angle-double-right"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarCoeficiente" name="editarCoeficiente" step="any" min="0" placeholder="Mod" required>

                  </div>

                </div>
                

                <!-- ENTRADA PARA EL NUMERO DE LISTA >

                <div class="col-xs-4">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-list-ol"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarNumeroLista" name="editarNumeroLista" step="any" min="0" placeholder="Nro Lista" required>

                  </div>

                </div>

            </div-->


             <!-- ENTRADA PARA PRECIO COMPRA >

             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA >

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" readonly required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE >

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE >

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" id="editarRentabilidad" name="editaRentabilidad" min="0"  required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

        <?php

          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrEditarProducto();

        ?>      

    </div>

  </div>

</div>

<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>      



