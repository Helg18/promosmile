@extends ('dashboard.layouts.default')

@section ('title')
  Editar Imagenes
@stop
@section ('css')
  
@stop
@section('pagina')
  <h2>Editar Imagenes</h2>
@stop
@section ('contenido')
  <form id="form" method="post" action="{{URL::route('saveImage')}}" enctype="multipart/form-data">
    <input type="hidden" name="num" value="{{$num+1}}">
    <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="data" value="1">
    <fieldset>
      <div class="form-group">
              <div class="col-sm-10">
               <span class="btn btn-wide btn-default btn-squared fileinput-button"> <i class="glyphicon glyphicon-plus"> </i> 
        <span> Presionar aquí para seleccionar Imágenes... </span>
                  <input  type="file" name="file"  multiple id="file2" />                
                </span>{{$errors->first('file')}}
              </div>
              <button class="pull-right btn btn-primary">Agregar</button>
          </div>
    </fieldset>
  </form>
  <table class="table" id="tabla" data-url="{{URL::route('editImagePos')}}">
    <tr>
      <th>Imagen</th>
      <th>Orden</th>
      <th></th>
      <th>Opciones</th>
    </tr>
    @foreach($imgs as $img)
    <tr>
      <td>
        <img src="{{asset('/uploads/images')}}/{{$img->filename}}" alt="" width="50px" height="50px">
      </td>
      
      <td>
        
        <select id="{{$img->id}}" class="seleccionar">
          <option value="{{$img->order}}">{{$img->order}}</option>
          @for($i = 1; $i <= $num; $i++)
            @if($i != $img->order)
              <option value="{{$i}}">{{$i}}</option>
            @endif
          @endfor
        </select>
      </td>
      <td>
        
      </td>
      <td>
        <a href="{{URL::route('deleteImage')}}/{{$img->id}}" class="btn btn-danger">X</a>
      </td>
    </tr>
    @endforeach
  </table>
  <div class="alert " id="alerta"></div>
  <a  href="{{ URL::to('articulos/edit/'.$productos->id) }}"   class="btn btn-wide btn-success pull-right">Regresar</a>
  <button id="actualizar" class="pull-right btn btn-primary">Actualizar</button>
@stop
@section("js")
  <script src="{{asset('assets/js/imagenes.js')}}"></script>
@stop
