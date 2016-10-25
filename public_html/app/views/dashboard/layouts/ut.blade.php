<?php
 /*
 |--------------------------------------------------
 | Project   : public_html
 |--------------------------------------------------
 | Developer : Ruben Mc.
 | System    : Tanker
 | Package   : ut.blade.php
 | Date      : 1/11/2016 : 6:50 PM
 */
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
  <title>@yield('title')</title>
  <meta charset="utf-8" />

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('assets/css/calendar-blue.css')}}">

    <!-- AL FINAL ESTILO MAESTRO!!! -->
    {{HTML::style('assets/css/rmc.css')}}


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
 	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
 	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 	<![endif]-->

  </head>

  <body>
  <section id="header" class="darkgrey">
  <nav class="navbar navbar-default nopaos navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="{{URL::route('miperfil')}}" id="logo-header" class="navbar-brand credlogo"><img src="{{asset('assets/images/logo-header.png')}}" alt="Logo" class="img-responsive" ></a>
          </div>
          <div class="navbar-collapse collapse" id="navbar">

            <div class="col-sm-4 col-md-5 col-lg-7">
                <div class="formulariosearch">
                    <form class="">
                          <div class="input-group">
                            <input class="form-control" placeholder="Buscar..." type="text" name="s"> <span class="input-group-btn specialsearch"> <button type="submit" class="btn btn-search botonbuscar"><i class="fa fa-search"></i></button></span>
                          </div>
                    </form>
                </div>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                    Categorias <i class="fa fa-shopping-cart"></i> <i class="fa fa-arrow-down"></i>
                  </a>
                  <ul class="dropdown-menu">
                      @foreach($categorias as $categoria)
                      <li><a href="{{URL::route('category')}}/{{ $categoria->id }}">{{$categoria->name}}</a></li>
                      @endforeach
                  </ul>
                </li>

                <li class="dropdown">
                  <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                    Herramientas <i class="fa fa-cogs"></i>
                  </a>
                  <ul class="dropdown-menu">
                        <li><a href="{{URL::route('mi.cuenta.perfil')}}/{{Auth::user()->id}}"><i class="fa fa-user"></i> Mi Perfil</a></li>
                        <li><a href="{{URL::route('carro')}}"><i class="fa fa-shopping-cart"></i> Mi Carrito</a></li>
                        <li><a href="{{URL::to('dashboard/mi-cuenta/pedidos/'.Auth::user()->id) }}"><i class="fa fa-shopping-bag"></i> Mis Compras</a> </li>
                     

                        <li><a href="{{URL::route('miCredito')}}"><i class="fa fa-usd"></i> Mi Credito</a></li>
                        <!-- Add AUTH for admins or others -->
                            <!-- Add menu segun sea quien sea -->
                        <!-- Next leave it as it is... -->
                        <li class="divider" role="separator"></li>
                        <li><a href="#"><i class="fa fa-question-circle"></i> FAQ's</a></li>
                        <li><a href="{{url()}}/user/logout">Salir <i class="fa fa-power-off" style="color: red;"></i></a></li>
                    </ul>
                </li>
            </ul>
          </div>
        </div>
      </nav>
  </section>

<section id="slider-banner" class="hidden">
    <div class="container">
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="sls">
                <img src="{{asset('assets/images/slide1.png')}}" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contenido" class="contenido">
    <div class="container altura-special">
         @section('contenido')
                 @show
    </div>
</section>


<section id="the-end" class="footer">
    <div class="container">
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="text-center">
                    Powered by: <a href="http://www.789.mx/" target="_blank" title="789MX" role="button">789.MX</a>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

@yield('js')


</body>
</html>