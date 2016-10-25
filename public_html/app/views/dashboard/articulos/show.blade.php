@extends ('dashboard.layouts.default')

@section('title')
  Articulo
@stop

@section('pagina')
  <h1>Articulo</h1>
@stop

@section('contenido')
<link rel="stylesheet" href="{{asset('assets/css/styless.css')}}">
    <fieldset>
      <p class="text-primary text-large">
      <strong> {{$productos->nombre}}</strong><br>
      </p>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
       
          <div id="page">
            <div id="gallery">
              <div id="panel">
                <img   id="largeImage" src="{{asset('uploads/images/'.$img->filename)}}"/>
                  <div id="description">Imágenes</div>
              </div>

              <div id="thumbs">
                @foreach($imagenes as $imagen)
                  <img  src="{{asset('uploads/images/'.$imagen->filename)}}" />
                @endforeach
              </div>
            </div>

          </div>
          </div>
        </div>
        

        <div class="col-md-6">
          <div class="col-sm-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h4 class="panel-title">Detalles</h4>
                  <div class="panel-tools">
                    <!--<a data-original-title="Refresh" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-refresh" href="#"><i class="ti-reload"></i></a>-->
              </div>
            </div>
            <div class="panel-body no-padding partition-dark-primary">
              <div class="col-md-12 partition-light-primary no-padding">
                <div class="padding-15">
                  <p>
                    Descripción: <strong>{{$productos->descripcion}}</strong><br>
                    Proveedor: <strong>{{$productos->proveedor}}</strong><br>
                  </p>
                </div>
              </div>
              <div class="col-md-12 no-padding">
                <div class="padding-15">
                  <p>
                   
                </div>
                </p>
              </div>
            </div>
          </div>
        </div>
     



</table>
    
    
  </div>
  </fieldset>

<div class="col-md-11">                       
  <div class="form-group">
    <a href="{{URL::route('see.productos')}}" class="btn btn-wide btn-warning">Regresar</a>
  </div>
</div>



@stop

@section('js')
<script>

$('#thumbs').delegate('img','click', function(){
  $('#largeImage').attr('src',$(this).attr('src').replace('thumb','large'));
  $('#description').html($(this).attr('alt'));
});

</script>

@stop