

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Actualizador rapido 1
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Actualizador rapido 1</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

          <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="inputActProd1" name="inputActProd1">
              <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalActProd1" id="codActProd1" name="codActProd1">BUSCAR</button>
              </span>
          </div>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalActProd1" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Descripcion</span> 

                <input type="text" class="form-control input-lg" name="actProd1Descripcion" id="actProd1Descripcion"  required>

              </div>

            </div>

             <!-- ENTRADA PARA EL STOCK -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Stock</span> 

                <input type="number" style="background-color : #FFB900 " class="form-control input-lg" name="actProd1Stock" id="actProd1Stock"  required>
                <input type="hidden"  name="idActProd1" id="idActProd1" >

              </div>

            </div>

          <!-- ID UBICACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">ID-Ubicación</span> 

                <input type="number" class="form-control input-lg" name="actProd1Ubicacion" id="actProd1Ubicacion"  required>
                

              </div>

            </div>

           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Ubicación</span> 

                <input type="text" class="form-control input-lg" name="descUbicacion" id="descUbicacion"  readonly>           

              </div>

            </div>

            <hr>

          <!-- PRECIO CONTADO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">P.Contado</span> 

                <input type="number" class="form-control input-lg" name="actPContado" id="actPContado" readonly  >
                
              </div>

            </div>

          <!-- PRECIO LISTA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">P.Lista</span> 

                <input type="number" class="form-control input-lg" name="actPLista" id="actPLista" readonly  >
                
              </div>

            </div>

            <!-- TABLA CUOTAS -->

            <div class="form-group">

              <div class="col-xs-12 ">
                
                <table class="table">

                  <thead>

                    <tr>
                      <th></th>  
                      <th></th>

                    </tr>

                  </thead>

                  <tbody>
                  
                    <tr>
                      
                      <td style="width: 50%"> 

                        <div class="form-group">
              
                           <div class="input-group">
                    
                              <span class="input-group-addon">3 x </span> 

                              <input type="number" class="form-control input-lg" name="act3Ctas" id="act3Ctas"  readonly>
                      
                            </div>

                        </div>

                      </td>

                      <td style="width: 50%">

                        <div class="form-group">
              
                           <div class="input-group">
                    
                              <span class="input-group-addon">6 x </span> 

                              <input type="number" class="form-control input-lg" name="act6Ctas" id="act6Ctas"  readonly>
                      
                            </div>

                        </div>

                      </td>

                    </tr>

                    <tr>
                      
                      <td style="width: 50%">

                        <div class="form-group">
              
                           <div class="input-group">
                    
                              <span class="input-group-addon">12 x </span> 

                              <input type="number" class="form-control input-lg" name="act12Ctas" id="act12Ctas"  readonly>
                      
                            </div>

                        </div>

                      </td>

                      <td style="width: 50%">

                        <div class="form-group">
              
                           <div class="input-group">
                    
                              <span class="input-group-addon">18 x </span> 

                              <input type="number" class="form-control input-lg" name="act18Ctas" id="act18Ctas"  readonly>
                      
                            </div>

                        </div> 

                      </td>

                    </tr>

                  </tbody>

                </table>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar modificaciones</button>

        </div>

        <?php

          $guardarActProd1 = new ControladorActProd1();
          $guardarActProd1 -> ctrEditarActProd1();

        ?>

      </form>

    </div>

  </div>

</div>
