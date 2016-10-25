<!--Main Menu-->
<div class="sidebar app-aside" id="sidebar">
  <div class="sidebar-container perfect-scrollbar">
    <nav>
    	<div class="navbar-title">
              <span>Menu</span>
            </div>
  <ul class="main-navigation-menu">
	<li class="{{Route::currentRouteName() == ('home') ? 'active' : '' }}">
                <a href="{{URL::route('home')}}">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-home"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Inicio </span>
										</div>
									</div>
								</a>
              </li>
		<!--<li class="{{Route::currentRouteName() == ('home') ? 'active open' : '' }}
				   {{Route::currentRouteName() == ('home') ? 'active open' : '' }}
				   {{Route::currentRouteName() == ('home') ? 'active open' : '' }}">
        	<a href="javascript:void(0)">
        		<div class="item-content">
        			<div class="item-media">
						<i class=" ti-notepad"></i>
					</div>
					<div class="item-inner">
							<span class="title"> Proyecto </span><i class="icon-arrow"></i>
 					</div>
        		</div>
        	</a>
			<ul class="sub-menu">
				
				<li class="{{Route::currentRouteName() == ('home') ? 'active' : '' }}}">
					<a  href="{{URL::route('home')}}">
						<i class="glyphicon glyphicon-plus"></i> <span>Proyectos</span></a>
				</li>
				<li class="{{Route::currentRouteName() == ('home') ? 'active' : '' }}}">
					<a  href="{{URL::route('home')}}">
						<i class="glyphicon glyphicon-th-list"></i> <span>Lista</span></a>
				</li>
				<li class="{{Route::currentRouteName() == ('home') ?   'active' : '' }}">
					<a  href="{{URL::route('home')}}">
						<i class="glyphicon glyphicon-plus"></i> <span>Amortizaciones</span></a>
				</li>
			</ul>

			</li>-->
 @if(Entrust::can('ver_prospectos'))
		<li class="{{Route::currentRouteName() == ('prospectos') ? 'active open' : '' }}">
        	<a href="{{URL::route('prospectos')}}">
        		<div class="item-content">
        			<div class="item-media">
        				<i class="fa fa-user-plus"></i>
						<span>Prospectos</span>
					</div>
        		</div>
        	</a>
        </li>
@endif


@if(Entrust::can('ver_carta'))
        <li class="{{Route::currentRouteName() == ('carta') ? 'active open' : '' }}">
        	<a href="{{URL::route('carta')}}">
        		<div class="item-content">
        			<div class="item-media">
						<i class="ti-write"></i>
						<span>Carta de presentación</span>
					</div>
        		</div>
        	</a>
        </li>
@endif


@if(Entrust::can('catalogos'))
<li class="{{Route::currentRouteName() == ('clientes') ? 'active open' : '' }}
           {{Route::currentRouteName() == ('proveedores') ? 'active open' : '' }}
           {{Route::currentRouteName() == ('maquileros') ? 'active open' : '' }}
           {{Route::currentRouteName() == ('see.productos') ? 'active open' : '' }}
           {{Route::currentRouteName() == ('almacenLista') ? 'active open' : '' }}">
            <a href="javascript:void(0)">
                <div class="item-content">
                    <div class="item-media">
                        <i class=" ti-notepad"></i>
                    </div>
                    <div class="item-inner">
                            <span class="title"> Catalogos </span><i class="icon-arrow"></i>
                    </div>
                </div>
            </a>
            <ul class="sub-menu">
           @if(Entrust::can('ver_clientes'))
            <li class="{{Route::currentRouteName() == ('clientes') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('clientesForm') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('clientesEditarForm') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('clientesMostrarForm') ? 'active open' : '' }}">
                  <a href="{{URL::route('clientes')}}">
                    <div class="item-content">
                        <div class="item-media">
                        <i class="fa fa-users"></i>
                            <span>Clientes</span>
                        </div>
                     </div>
                 </a>
            </li>
            @endif 

            @if(Entrust::can('ver_proveedores'))
                <li class="{{Route::currentRouteName() == ('proveedores') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('proveedoresForm') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('proveedoresEditarForm') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('proveedoresMostrarForm') ? 'active open' : '' }}">
                 <a href="{{URL::route('proveedores')}}">
                    <div class="item-content">
                        <div class="item-media">
                            <i class="fa fa-users"></i>
                            <span>Proveedores</span>
                        </div>
                    </div>
                </a>
                </li>
            @endif
           @if(Entrust::can('ver_maquileros'))
            <li class="{{Route::currentRouteName() == ('maquileros') ? 'active open' : '' }}">
                 <a href="{{URL::route('maquileros.index')}}">
                    <div class="item-content">
                        <div class="item-media">
                         <i class="fa fa-truck"></i>
                         <span>Maquileros</span>
                        </div>
                    </div>
                 </a>
            </li>
           @endif
            @if(Entrust::can('ver_articulos'))
            <li class="{{Route::currentRouteName() == ('see.productos') ? 'active open' : '' }}">
                <a href="{{URL::route('see.productos')}}">
                    <div class="item-content">
                        <div class="item-media">
                            <i class="fa fa-cart-plus"></i>
                            <span>Articulos</span>
                        </div>
                    </div>
                </a>
             </li>
            @endif

             @if(Entrust::can('ver_articulos'))
             <li>
        <a href="{{URL::route('almacenLista')}}" >
                <div class="item-content">
                    <div class="item-media">
                      <i class="fa fa-building"></i>
                        <span class="title"> Almacenes </span>
                    </div>
              </div>
        </a>
        </li>
         @endif
          @if(Entrust::can('ver_articulos'))
        <li>
        <a href="{{URL::route('color')}}" >
                <div class="item-content">
                    <div class="item-media">
                            <i class="fa fa-paint-brush"></i>
                        <span class="title"> Color </span>
                    </div>
              </div>
        </a>
        </li>
 @endif
    </ul>
</li>
@endif
@if(Entrust::can('ver_vendedores'))
        <li class="{{Route::currentRouteName() == ('vendedores') ? 'active open' : '' }}">
        	<a href="{{URL::route('vendedores')}}">
        		<div class="item-content">
        			<div class="item-media">
        				<i class="fa fa-suitcase"></i>
						<span>Vendedores</span>
					</div>
        		</div>
        	</a>
        </li>
@endif

  @if(Entrust::can('ver_articulos'))
 <li class="{{Route::currentRouteName() == ('imagenesLista') ? 'active open' : '' }}">
            <a href="{{URL::route('imagenesLista')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class="fa  ti-image"></i>
                        <span>Imagenes</span>
                </div>
            </div>
        </a>
    </li>
 @endif
@if(Entrust::can('ver_cotizacion'))
        <li class="{{Route::currentRouteName() == ('cotizacion') ? 'active open' : '' }}">
            <a href="{{URL::route('cotizacion')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class="fa fa-pencil-square-o"></i>
                        <span>Cotizacíon</span>
                    </div>
                </div>
            </a>
        </li>
@endif

@if(Entrust::can('ver_compras'))
        <li class="{{Route::currentRouteName() == ('compras') ? 'active open' : '' }}">
            <a href="{{URL::route('compras')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class="fa fa-gift"></i>
                        <span>Pedidos</span>
                    </div>
                </div>
            </a>
        </li>
@endif 
       @if(Entrust::can('cuentas_cobrar'))
        <li class="{{Route::currentRouteName() == ('cuentasCobrar') ? 'active open' : '' }}">
            <a href="{{URL::route('cuentasCobrar')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class=" ti-notepad"></i>
                        <span class="title">  Cuentas por cobrar </span>
                    </div>  
                </div>
            </a>
        </li>  
       @endif
       @if(Entrust::can('cuentas_pagar'))
        <li class="{{Route::currentRouteName() == ('cuentasPagar') ? 'active open' : '' }}">
            <a href="{{URL::route('cuentasPagar')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class=" ti-notepad"></i>
                        <span class="title">  Cuentas por pagar </span>
                    </div>  
                </div>
            </a>
        </li> 
       @endif
        @if(Entrust::can('programacion_entregas'))
         <li class="{{Route::currentRouteName() == ('entregas') ? 'active open' : '' }}">
            <a href="{{URL::route('entregas')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class=" ti-notepad"></i>
                        <span class="title">  Programación de entregas </span>
                    </div>  
                </div>
            </a>
        </li> 
        @endif


@if(Entrust::can('ver_productost'))
        <li class="{{Route::currentRouteName() == ('productost') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('productostForm') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('productostEditarForm') ? 'active open' : '' }}
                   {{Route::currentRouteName() == ('productostMostrarForm') ? 'active open' : '' }}">
            <a href="{{URL::route('productost')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class="ti-truck"></i>
                        <span>Producto Terminado</span>
                    </div>
                </div>
            </a>
        </li>
@endif


  @if(Entrust::can('ver_usuarios'))
         <li class="{{Route::currentRouteName() == ('usuarios') ? 'active open' : '' }}">
           <a href="{{URL::route('usuarios')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class="ti-user"></i>
                        <span>Usuarios</span>
                    </div>
                </div>
            </a>
        </li>
 @endif

  @if(Entrust::can('ver_roles'))
          <li class="{{Route::currentRouteName() == URL::to('roles') ? 'active open' : '' }}">
            <a href="{{URL::to('roles')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class="fa fa-male"></i>        
                        <span>Roles</span>
                    </div>
                </div>
            </a>
        </li>
   @endif

       <li class="{{Route::currentRouteName() == URL::to('logout') ? 'active open' : '' }}">
            <a href="{{URL::to('logout')}}">
                <div class="item-content">
                    <div class="item-media">
                        <i class="fa fa-close"></i>
                        <span>Salir</span>
                    </div>
                </div>
            </a>
        </li>
        <!-- end Roles-->     
        

        
      </ul>
    </li>
  </ul>
     </nav>
  </div>
</div>
<!--/MainMenu-->