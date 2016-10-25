@extends ('dashboard.layouts.default')

@section ('title')
Registro de Proveedores
@stop
@section ('css')
{{HTML::style("assets/vendor/jquery-file-upload/css/jquery.fileupload-ui.css")}}
@stop

@section('pagina')
<h2>Registro de Proveedores </h2>
@stop

@section ('contenido')


<!--PAGE CONTENT BEGINS-->

<!---alert mensajes --->
@if(Session::has('msg'))
<div class="alert alert-{{ Session::get('class') }}">
    <button type="button" class="close" data-dismiss="alert">
        <i class="icon-remove"></i>
    </button>
    {{ Session::get('msg')}}
    <br/>
</div>
@endif
@if ($errors->has())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">
        <i class="icon-remove"></i>
    </button>
    @if ($errors->has('images')) ¡Atención! Solo se permiten archivos de tipo: jpg,gif,jpeg,png.<br> @endif  							
</div>
@endif	

<div class="alert alert-error" id="alert" style="display:none">
    <button type="button" class="close" data-dismiss="alert">
        <i class="icon-remove"></i>
    </button>
    Los cambios no fueron realizados, intente de nuevo
    <br/>
</div>
<!---/.alert mensajes -->

<!-- START FORM -->
<form id="" method="post" action="{{URL::route('post.create.proveedores')}}" class="form-horizontal">
  <input name="csrf_token" type="hidden" value="{{csrf_token()}}">
        <fieldset>
            <div class="col-md-4">
                <label class="control-label">
                    Username <span class="symbol required"></span>
                </label>
                <input type="text" maxlength="15" required placeholder="Introducir Username" class="form-control" name="username"/>
            </div>

            <div class="col-md-4">
                <label class="control-label">
                    Contraseña <span class="symbol required"></span>
                </label>
                <input type="password" maxlength="15" required placeholder="Introducir Contraseña" class="form-control" name="password"/>
            </div>

            <div class="col-md-4">
                <label class="control-label">
                    Confirmar Contraseña <span class="symbol required"></span>
                </label>
                <input type="password" maxlength="15" required placeholder="Introducir Nuevamente la Contraseña" class="form-control" name="password_confirmation"/>
            </div>

            <div class="col-md-4">
                <label class="control-label">
                    Nombre <span class="symbol required"></span>
                </label>
                <input type="text" maxlength="15" required placeholder="Introducir nombre" class="form-control" name="nombre"/>
            </div>

            <div class="col-md-4">
                <label class="control-label">
                    Contacto <span class="symbol required"></span>
                </label>
                <input type="text"  maxlength="15" required placeholder="Introducir contacto" class="form-control" name="contacto"/>
            </div>

             <div class="col-md-4">
                <label class="control-label">
                    Teléfono (10 digitos)<span class="symbol required"></span>
                </label>
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-phone"></i> </span> 
                        <input type="text"  maxlength="10" required placeholder="Introducir contacto" class="form-control" name="telefono"/>
                </div>
            </div>

              <div class="col-md-4">
                <label class="control-label" for="form-field-mask-2">
                    Correo <small class="symbol required"></small>
                </label>  
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-mail">@</i> </span>
                    <input type="email" required maxlength="60" required placeholder="Correo electrónico" id="correo" name="correo" class="form-control">
                </div>
            </div>     
        </fieldset>  

  
          <div class="col-md-12">                       
            <div class="form-group">
              <a href="{{URL::route('see.proveedores')}}" class="btn btn-wide btn-success pull-right">Regresar</a>
              <button type="submit" name="" class="btn btn-wide btn-primary pull-right">Guardar</button>  
            </div>
          </div>


</form>

<!-- end: FORM -->

@stop
@section('js')


@stop
