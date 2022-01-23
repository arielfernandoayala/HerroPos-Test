<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar cuentas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Cuentas bancarias</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCuentaBancaria">
          
          Agregar cuenta

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           
           <th>Titular</th>
           <th>Banco</th>
           <th>Tipo</th>
           <th>Nro Cta</th>
           <th>CBU</th>
           <th>Alias</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $cuenta = ControladorCuentasBancarias::ctrMostrarCuentasBancarias($item, $valor);

       foreach ($cuenta as $key => $value){
         
          echo ' <tr>
                  
                  <td>'.$value["titular"].'</td>
                  <td>'.$value["banco"].'</td>';
                  echo '<td>'.$value["tipo"].'</td>
                        <td>'.$value["numerodecuenta"].'</td>
                        <td>'.$value["cbu"].'</td>';

                  echo '<td>'.$value["alias"].'</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarCuentaBancaria" idCuentaBancaria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCuentaBancaria"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarCuentaBancaria" idCuentaBancaria="'.$value["id"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
        }


        ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CUENTA
======================================-->

<div id="modalAgregarCuentaBancaria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post"> <!--enctype="multipart/form-data"-->

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cuenta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL TITULAR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">TITULAR: </span> 

                <input type="text" class="form-control input-lg" name="nuevoTitular" placeholder="Ingresar titular" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL BANCO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">BANCO: </span> 

                <input type="text" class="form-control input-lg" name="nuevoBanco" placeholder="Ingresar banco" id="nuevoBanco" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CBU -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">CBU: </span> 

                <input type="text" class="form-control input-lg" name="nuevoCbu" placeholder="Ingresar CBU" required>

              </div>

            </div>

            <!-- ENTRADA PARA ALIAS -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">ALIAS: </span> 

                <input type="text" class="form-control input-lg" name="nuevoAlias" placeholder="Ingresar alias" required>

              </div>

            </div>

            <!-- ENTRADA PARA NUMERO CUENTA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Nro DE CTA: </span> 

                <input type="text" class="form-control input-lg" name="nuevoNroCta" placeholder="Ingresar numero cta" required>

              </div>

            </div>

            <!-- ENTRADA PARA TIPO DE CUENTA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">TIPO DE CTA: </span> 

                <select class="form-control input-lg" name="nuevoTipoCuenta">
                  
                 

                  <option value="Cuenta corriente">Cuenta corriente</option>

                  <option value="Caja de ahorro">Caja de ahorro</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO >

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFotoBanco" name="nuevaFotobanco">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cuenta</button>

        </div>

        <?php

          $crearCuenta = new ControladorCuentasBancarias();
          $crearCuenta -> ctrCrearCuentaBancaria();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CUENTA BANCARIA
======================================-->

<div id="modalEditarCuentaBancaria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" ><!--enctype="multipart/form-data"-->

        <!--=====================================
        CABEZAL DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cuenta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL TITULAR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">TITULAR: </span> 

                <input type="text" class="form-control input-lg" id="editarTitular" name="editarTitular" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL BANCO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">BANCO: </span> 

                <input type="text" class="form-control input-lg" id="editarBanco" name="editarBanco" value="" >

              </div>

            </div>

            <!-- ENTRADA PARA CBU -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">CBU</span> 

                <input type="text" class="form-control input-lg" name="editarCbu" placeholder="" id="editarCbu" value="" readonly>

                <input type="hidden" name="idCuentaBancaria" id="idCuentaBancaria" required >

              </div>

            </div>

            <!-- ENTRADA PARA TIPO DE CUENTA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">TIPO DE CTA: </span> 

                <select class="form-control input-lg" name="editarTipoDeCta">
                  
                  <option value="" id="editarTipoDeCta"></option>

                  <option value="Cuenta corriente">Cuenta corriente</option>

                  <option value="Caja de ahorro">Caja de ahorro</option>

                </select>

              </div>

            </div>

             <!-- ENTRADA PARA NUMERO DE CUENTA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Nro DE CUENTA: </span> 

                <input type="text" class="form-control input-lg" id="editarNroCuenta" name="editarNroCuenta" placeholder="Escriba el nro de cuenta">

                <input type="hidden" id="nroCtaActual" name="nroCtaActual">

              </div>

            </div>

            <!-- ENTRADA PARA ALIAS -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">ALIAS: </span> 

                <input type="text" class="form-control input-lg" id="editarAlias" name="editarAlias" placeholder="Escriba el alias CABEZA">

                <input type="hidden" id="aliasActual" name="aliasActual">

              </div>

            </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar cuenta</button>

        </div>

     <?php

          $editarTitular = new ControladorCuentasBancarias();
          $editarTitular -> ctrEditarCuentaBancaria();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borraCuentaBancaria = new ControladorCuentasBancarias();
  $borraCuentaBancaria -> ctrBorrarCuentaBancaria();

?> 


