<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Orden de presupuesto
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Orden Presupuesto</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-12 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formOrdPresup" action="sendordpresup">

            <div class="box-body">
  
              <div class="box">



                <!--=====================================
                ENTRADA INPUT DE CLIENTE
                ======================================--> 

                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-child"></i></span> 
                    <!--Imprimo el nombre de la varaible de sesion con la que estoy iniciando en el sistema para guardar el id en base de datos en el imput oculto en la siguiente linea-->
                    <input type="text" class="form-control" id="inputClteSendOrdPresup" name="inputClteSendOrdPresup" >

                   <span class="input-group-btn">
                    
                    <button type="button" class="btn btn-info btn-flat"  id="buscarClientePresupRap" name="buscarClientePresupRap">BUSCAR</button>
                  
                   </span>

                  </div>

                </div> 

                <!--=====================================
                NOMBRE VISIBLE DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                    
                    <input class="form-control" name="sendPresupCliente" id="sendPresupCliente" readonly="">
                 
                  </div>
                
                </div>



                <!--EMAIL DESTINO-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon">Destino</span>

                      <div class="input-group">
                              
                        <select class="form-control" id="emailDestino" name="emailDestino" required>
                            <option value="presupuestos@encasade-herrero.com">Presupuestos</option>
                            <option value="-">OD. Trabajo</option>
                            <option value="-">OD. Entrega</option>
                            <option value="ariel@encasade-herrero.com">Sistema</option>
               
                        </select>    

                      </div>
                 
                   </div>
                
                </div>

              <!--TITULO-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon">Titulo</span>
                    
                    <input class="form-control" name="tituloSolicitud" id="tituloSolicitud" >
                 
                   </div>
                
                </div>

                <!--EMAIL-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon">Email</span>
                    
                    <input class="form-control" name="sendPresupEmail" id="sendPresupEmail" >
                 
                   </div>
                
                </div>

              <!--FEHCA PROMESA-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"> Fecha de promesa presupuesto</span>
                    
                    <input type="date" class="form-control" name="fechaPromOrdPresup" id="fechaPromOrdPresup" >
                 
                  </div>
                
                </div>

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon">Detalle</span>
                    
                    <textarea class="form-control" rows="8" name="inputDetSenOrdPresup" id="inputDetSenOrdPresup" placeholder="Detalle"> </textarea>
                 
                  </div>
                
                </div>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Enviar</button>

          </div>

        </form>



        </div>
            
      </div>

    </div>

  </section>

</div>