@extends ('dashboard.layouts.default')

@section ('titlePage')
  Proveedores
@stop
@section ('cssPage')
  
@stop

@section('pagina')
  <h2>Ver Proveedores</h2>
@stop

@section ('contenido')
 
  <div class="row">
    <div class="col-md-6">  
      <fieldset>
          <legend>
            Información 
          </legend>
              <div class="form-group">
                <div class="col-md-8">
                  
                  <!--
                  <input  name="categoria" placeholder="" class="form-control" type="text" value="{{Input::old('categoria')}}">
                  -->
                  <table class="table table-condensed">
                                <thead>
                                  <tr>
                                    <th colspan="3"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Nombre:</td>
                                    <td>
                                     {{$proveedores->nombre }} 
                                    </td>
                                  </tr>
                                   <tr>
                                    <td>Contacto:</td>
                                    <td>
                                     {{$proveedores->contacto }} 
                                    </td>
                                  </tr>
                                   <tr>
                                    <td>Teléfono:</td>
                                    <td>
                                     {{$proveedores->telefono }} 
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Correo:</td>
                                    <td>
                                     {{$proveedores->correo}}
                                    </td>
                                  </tr>
                      
                                </tbody>
                              </table>

                </div>       
              </div>
              
      </fieldset>
    </div>
   
            
    </div>
  

 <div class="col-md-12">                       
        <a href="{{URL::route('see.proveedores')}}" class="btn btn-wide btn-success pull-right">Regresar</a>
      </div>




@stop
