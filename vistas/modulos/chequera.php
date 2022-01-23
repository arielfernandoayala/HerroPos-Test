<?php

if($_SESSION["perfil"] != "Administrador" ){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Chequera
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Chequera</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalGenerarCheque">
          
          Generar cheque

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           

           <th>Cuit</th>
           <th>Razon Social</th>
           <th>Banco</th>
           <th>Numero</th>
           <th>Importe</th>
           <th>Fecha Ven</th>
           <th>Comentario</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = "doc_receptor";
          $valor = null;

          $cheques = ControladorChequera::ctrMostrarCheques($item, $valor);

          foreach ($cheques as $key => $value) {
           
            echo ' <tr>

                    <td class="text-uppercase">'.$value["cuit_emisor"].'</td>

                    <td class="text-uppercase">'.$value["razon_soc_emisor"].'</td>

                    <td class="text-uppercase">'.$value["banco_chq"].'</td>

                    <td class="text-uppercase">'.$value["nro_chq"].'</td>

                    <td class="text-uppercase">'.$value["importe"].'</td>

                    <td class="text-uppercase">'.$value["fecha_ven_chq"].'</td>

                    <td class="text-uppercase">'.$value["comentario"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarChq" idCheque="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarChq"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarChq" idCheque="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                        }

                      echo '</div>  

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
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalGenerarCheque" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Generar cheque</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

                        <!-- ENTRADA PARA EL CUIT EMISOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nvoChqCuit" value="201676083" readonly required>

              </div>

            </div>

                        <!-- ENTRADA PARA LA RAZON SOCIAL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nvoChqRazonSoc" value="Francescutti Claudia" required readonly>

              </div>

            </div>

                        <!-- SELECT PARA EL BANCO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nvoChqBco" placeholder="Banco" required>

              </div>

            </div>

                        <!-- ENTRADA PARA EL NRO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nvoChqNro" placeholder="Ingresar el nro" required>

              </div>

            </div>

                        <!-- ENTRADA PARA EL IMPORTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" name="ncoChqImporte" placeholder="Ingresar importe" required>

              </div>

            </div>

                        <!-- ENTRADA PARA LA FEHCA DE VENCIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="date" class="form-control input-lg" name="nvoChqFecha" required>

              </div>

            </div>

                        <!-- ENTRADA PARA ALGUN COMENTARIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nvoChqComentario" placeholder="Ingrese un comentario" >

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cheque</button>

        </div>

        <?php

          $generarCheque = new ControladorChequera();
          $generarCheque -> ctrCrearCheque();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR CHEQUE
======================================-->


<div id="modalEditarChq" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cheque</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
                                    <!-- ENTRADA PARA ID DEL REGISTRO, USADO PARA UPDATE -->
            
            <div class="form-group">

                <input type="hidden" class="form-control input-lg" name="editIdchq" id="editIdchq" >

            </div>

                        <!-- ENTRADA PARA EL CUIT EMISOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editChqCuit" id="editChqCuit"   required>

              </div>

            </div>

                        <!-- ENTRADA PARA LA RAZON SOCIAL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editChqRazonSoc" id="editChqRazonSoc" required >

              </div>

            </div>

                        <!-- SELECT PARA EL BANCO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editChqBco" id="editChqBco" placeholder="Banco" required>

              </div>

            </div>

                        <!-- ENTRADA PARA EL NRO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editChqNro" id="editChqNro" placeholder="Ingresar el nro" required>

              </div>

            </div>

                        <!-- ENTRADA PARA EL IMPORTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" name="editChqImporte" id="editChqImporte" placeholder="Ingresar importe" required>

              </div>

            </div>

                        <!-- ENTRADA PARA LA FEHCA DE VENCIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="date" class="form-control input-lg" name="editChqFecha" id="editChqFecha" required>

              </div>

            </div>

                        <!-- ENTRADA PARA ALGUN COMENTARIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editChqComentario" id="editChqComentario" placeholder="Ingrese un comentario" >

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cheque</button>

        </div>

        <?php

          $editarCheque = new ControladorChequera();
          $editarCheque -> ctrEditarCheque();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCheque = new ControladorChequera();
  $borrarCheque -> ctrBorrarCheque();

?>


