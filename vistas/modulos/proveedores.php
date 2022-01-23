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
      
      Administrar proveedores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar proveedores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
          
          Agregar proveedor

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Proveedor</th>
           <th>CUIT</th>
           <th>Telefonos</th>
           <th>Domicilio</th>
           <th>email</th>
           <th>Referente</th>
           <th>Web</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $Proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

          foreach ($Proveedores as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text">'.$value["razon_social"].'</td>
                    <td class="text">'.$value["cuit"].'</td>
                    <td class="text">'.$value["tel"].'</td>
                    <td class="text">'.$value["domicilio"].'</td>
                    <td class="text">'.$value["email"].'</td>
                    
                    <td class="text">'.$value["referente"].'</td>
                    <td class="text">'.$value["web"].'</td>
                    


                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarProveedor" idProveedor="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarProveedor"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
MODAL AGREGAR PROVEEDOR
======================================-->

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            


                <!-- ENTRADA PARA LA RAZON SOCIAL -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o">*</i></span> 

                        <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Razon Social" required>

                    </div>

               </div>



                <!-- ENTRADA PARA LA CUIT -->
                <div class="form-group">   
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o">*</i></span> 

                        <input type="text" class="form-control input-lg" name="nuevaCuitProveedor" placeholder="Ingresar CUIT" required>

                    </div>

                </div>



                <!-- ENTRADA PARA EL DOMICILIO -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o">*</i></span> 

                        <input type="text" class="form-control input-lg" name="nuevoDomicilioProveedor" placeholder="Ingresar domicilio" required>

                    </div>

               </div>

                <!-- ENTRADA PARA EL CP -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="nuevoCpProveedor" placeholder="Ingresar código postal" >

                    </div>

               </div>

                <!-- ENTRADA PARA LA CUIDAD -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o">*</i></span> 

                        <input type="text" class="form-control input-lg" name="nuevaCuidadProveedor" placeholder="Ingresar cuidad" required>

                    </div>

               </div>

                <!-- ENTRADA PARA LA PROVINCIA -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o">*</i></span> 

                        <input type="text" class="form-control input-lg" name="nuevaProvinciaProveedor" placeholder="Ingresar provincia" required>

                    </div>

               </div>

                <!-- ENTRADA PARA EL TELEFONO -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o">*</i></span> 

                        <input type="text" class="form-control input-lg" name="nuevoTelefonoProveedor" placeholder="Ingresar telefono" required>

                    </div>

               </div>

                <!-- ENTRADA PARA LA REFERENTE -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="nuevoReferenteProveedor" placeholder="Ingresar referente" >
        
                    </div>

                </div>
                
                <!-- ENTRADA PARA WEB -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="nuevaWebProveedor" placeholder="Ingresar url" >

                    </div>

                </div>    

                <!-- ENTRADA PARA EL EMAIL -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="nuevoEmailProveeedor" placeholder="Ingresar email" >

                    </div>

                </div>

             </div><!--end box body-->

        </div><!--end modal body-->


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" value="crearProveedor">Guardar proveedor</button>

        </div>

        <?php

          $crearProveedor = new ControladorProveedores();
          $crearProveedor -> ctrCrearProveedor();

        ?>

      </form> <!-- end form-->

    </div><!--end modal content-->

  </div><!--end modal dialog-->

</div><!--end modal-->

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar proveedor</h4>

        </div>

       <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            


                <!-- ENTRADA PARA LA RAZON SOCIAL -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarProveedor" id="editarProveedor"  required>

                        <input type="hidden"  name="idProveedor" id="idProveedor" required>

                    </div>

               </div>



                <!-- ENTRADA PARA LA CUIT -->
                <div class="form-group">   
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarCuitProveedor" id="editarCuitProveedor"  required>

                    </div>

                </div>



                <!-- ENTRADA PARA EL DOMICILIO -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarDomicilioProveedor" id="editarDomicilioProveedor" required>

                    </div>

               </div>

                <!-- ENTRADA PARA EL CP -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarCpProveedor" id="editarCpProveedor" >

                    </div>

               </div>

                <!-- ENTRADA PARA LA CUIDAD -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarCuidadProveedor" id="editarCuidadProveedor" placeholder="ciudad" required>

                    </div>

               </div>

                <!-- ENTRADA PARA LA PROVINCIA -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarProvinciaProveedor" id="editarProvinciaProveedor" required>

                    </div>

               </div>

                <!-- ENTRADA PARA EL TELEFONO -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarTelefonoProveedor" id="editarTelefonoProveedor" required>

                    </div>

               </div>

                <!-- ENTRADA PARA LA REFERENTE -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarReferenteProveedor" id="editarReferenteProveedor" required>
        
                    </div>

                </div>
                
                <!-- ENTRADA PARA WEB -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarWebProveedor" id="editarWebProveedor" >

                    </div>

                </div>    

                <!-- ENTRADA PARA EL EMAIL -->
                <div class="form-group">
                    
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa-circle-o"></i></span> 

                        <input type="text" class="form-control input-lg" name="editarEmailProveeedor" id="editarEmailProveeedor" >

                    </div>

                </div>

             </div><!--end box body-->

        </div><!--end modal body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          $editarProveedor = new ControladorProveedores();
          $editarProveedor -> ctrEditarProveedor();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarProveedor = new ControladorProveedores();
  $borrarProveedor -> ctrBorrarProveedor();

?>


