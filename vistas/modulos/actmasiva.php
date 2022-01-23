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
        <h5>ACTUALIZAR LISTA DE PRECIOS DE FORMA MASIVA</h5>
        <form > <!--action="doFacturar.php" method="POST"-->

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Detalles </h3>
            </div>

            <div class="box-body">
              <div class="row">

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Proveedor</label>
                    <select class="form-control" id="actMasivaProveedor" name="actMasivaProveedor" >
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

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control" id="actMasivaCategoria" name="actMasivaCategoria" >
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

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Sub-categoria</label>
                    <select class="form-control" id="actMasivaSubC" name="actMasivaSubC" >
                      <?php

                      //$item = null;
                      //$valor = null;

                     // $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                      //foreach ($categorias as $key => $value) {
                        
                      //  echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                     // }

                      ?>
                    </select>
                  </div>
                </div>


                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Lista de precios</label>
                    <input class="form-control" id="actMasivaLista" name="actMasivaLista"  />
                  </div>
                </div>


              </div>
              <!-- /.row1 -->
              <div class="row">
                
                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Coeficiente</label>
                    <input class="form-control" id="actMasivaCoef" name="actMasivaCoef"  />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Iva</label>
                    <input class="form-control" id="actMasivaIva" name="actMasivaIva"  />
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>Rentabilidad %</label>
                    <input class="form-control" id="actMasivaRent" name="actMasivaRent"  />
                  </div>
                </div>



              </div>
              <!-- END /.row2 -->

              <!-- /.row3 -->
              <div class="row">
                
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Incremento precio de lista</label>
                    <input class="form-control" id="actMasivaPLista" name="actMasivaPLista" placeholder="Ej: 17,35" />
                  </div>
                </div>

              </div>





              </div>
              <!-- END /.row3 -->  



              <div>

              <hr>

              </div>
              <!-- /.row of products --> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box box-primary -->


        <div class="box-footer">

            <button  class="btn btn-block btn-primary" id="btnActMasiva" name="btnActMasiva">MODIFICAR LISTA</button>

        </div>

        </form>



        </div>



      </div>
      
    </div>

  </section>

</div>