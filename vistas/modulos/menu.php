<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		/*===============================================================================================
		  INICIO Y USUARIOS
		=================================================================================================*/

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

		}

		/*===============================================================================================
		  CATEGORIAS  
		=================================================================================================*/

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Categorias</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="categorias">
							
							<i class="fa fa-circle-o"></i>
							<span>Familias</span>

						</a>

					</li>';

					if($_SESSION["perfil"] == "Administrador"){

					echo '<li>

						<a href="rubroingresos">
							
							<i class="fa fa-circle-o"></i>
							<span>Rubro ingresos</span>

						</a>

					</li>

					<li>

						<a href="rubroegresos">
							
							<i class="fa fa-circle-o"></i>
							<span>Rubro egresos</span>

						</a>

					</li>

					<li>

						<a href="ubicaciones">
							
							<i class="fa fa-circle-o"></i>
							<span>Ubicaciones</span>

						</a>

					</li>

					<li>

						<a href="cuentasbancarias">
							
							<i class="fa fa-circle-o"></i>
							<span>Cuentas bancarias</span>

						</a>

					</li>

					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span>Gastos fijos</span>

						</a>

					</li>

					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span>Personal</span>

						</a>

					</li>';

					}

				

			echo '</ul>'
		;}


		/*===============================================================================================
		  PRODUCTOS  
		=================================================================================================*/


		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-cubes"></i>
					
					<span>Productos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="productos">

							<i class="fa fa-circle-o"></i>
							<span>Productos</span>

						</a>

					</li>';

					if($_SESSION["perfil"] == "Administrador"){

					echo '<li>

						<a href="actualizar-productos">
							
							<i class="fa fa-circle-o"></i>
							<span>Act P.Lista</span>

						</a>

					</li>


					<li>

						<a href="actprod1">
							
							<i class="fa fa-circle-o"></i>
							<span>Stock-Ubicación</span>

						</a>

					</li>


					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span>-</span>

						</a>

					</li>';

					}

			echo '</ul>'
		;}


		/*===============================================================================================
		  CLIENTES
		=================================================================================================*/

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-users"></i>
					
					<span>Clientes</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="clientes">
							
							<i class="fa fa-circle-o"></i>
							<span>Lista de clientes</span>

						</a>

					</li>';

					if($_SESSION["perfil"] == "Administrador"){

					echo '<li>

						<a href="cobranza-clientes">
							
							<i class="fa fa-circle-o"></i>
							<span>Generar recibo</span>

						</a>

					</li>

					<li>

						<a href="cc-cliente">
							
							<i class="fa fa-circle-o"></i>
							<span>CC Cliente</span>

						</a>

					</li>

					<li>

						<a href="imprecibos">
							
							<i class="fa fa-circle-o"></i>
							<span>Imp recibos</span>

						</a>

					</li>';

				}

				

			echo '</ul>'
		;}




		/*===============================================================================================
		  PEDIDOS
		=================================================================================================*/

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-edit"></i>
					
					<span>Pedidos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span>Confirmar entrega</span>

						</a>

					</li>';

					if($_SESSION["perfil"] == "Administrador"){

					echo '<li>

						<a href="estado-entregas">
							
							<i class="fa fa-circle-o"></i>
							<span>Entregas pendientes</span>

						</a>

					</li>

					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear pedido</span>

						</a>

					</li>

					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span>Pedidos pendientes</span>

						</a>

					</li>';

				}

				

			echo '</ul>'
		;}


		/*===============================================================================================
		  PROVEEDORES
		=================================================================================================*/

		if($_SESSION["perfil"] == "Administrador" ){

			echo '<li>

				<a href="proveedores">

					<i class="fa fa-industry"></i>
					<span>Proveedores</span>

				</a>

			</li>';

		}



		/*===============================================================================================
		  VENTAS
		=================================================================================================*/


		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-shopping-cart"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="presupuestoRapido">
							
							<i class="fa fa-circle-o"></i>
							<span>Presupuesto rapido</span>

						</a>

					</li>

					<li>

						<a href="ordenpresup">
							
							<i class="fa fa-circle-o"></i>
							<span>OD Pesupuesto</span>

						</a>

					</li>

					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span>Ver presup. Rapidos</span>

						</a>

					</li>
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>
					
					<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>';

				

				echo '</ul>

			</li>';

		}

		/*===============================================================================================
		  PUBLICIDAD
		=================================================================================================*/

			echo '<li>

				<a href="publicidad">

					<i class="fa fa-rss-square"></i>
					<span>Publicidad</span>

				</a>

			</li>';

		

		/*===============================================================================================
		  CAJA Y BANCO
		=================================================================================================*/
						

		if($_SESSION["perfil"] == "Administrador" ){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-bank"></i>
					
					<span>Caja y banco</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span style="font-weight: bold">Caja diaria</span>

						</a>

					</li>

					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span style="color:red ; font-weight: bold">Generar EGRESO</span>

						</a>

					</li>

					<li>

						<a href="enproceso">
							
							<i class="fa fa-circle-o"></i>
							<span style="color:green ; font-weight: bold">Gnerar INGRESO</span>

						</a>

					</li>

					<li>

						<a href="liquidar-cobros">
							
							<i class="fa fa-circle-o"></i>
							<span>Liq. Ventas</span>

						</a>

					</li>

					<li>

						<a href="chequera">
							
							<i class="fa fa-circle-o"></i>
							<span>Chequera</span>

						</a>

					</li>';

				}echo '</ul>

			</li>';



		?>

		</ul>

	 </section>

</aside>