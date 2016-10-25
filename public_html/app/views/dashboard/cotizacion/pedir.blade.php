@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
    <link href="{{asset('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet" media="screen">
@stop

@section("pagina")
	<h2>Pedir compra </h2>
@stop

@section("contenido")


<form id="form" autocomplete="off" enctype="multipart/form-data"  method="post"  action="{{URL::route('cotizacionPedirSave')}}" class="form-horizontal">

 <input name="_token" id="token" type="hidden" value="{{csrf_token()}}">
 <input type="hidden" name="id" value="{{$id}}">
  <div class="container-fluid container-fullw bg-white">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>
            Pedir compra
          </legend>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep">Anticipo del Cliente {{$errors->first('anticipo')}}</label>
              <div class="col-sm-7">
 				         <input type="file" class="form-control" name="anticipo">            
              </div>
          </div> 
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Orden de compra {{$errors->first('orden')}}</label>
              <div class="col-sm-7">
                <div class="input-group">
                  <input type="file" class="form-control" name="orden">
                  <span class="input-group-addon"></span>
                </div>
              </div> 
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label" for="inputnombrep"> Fecha {{$errors->first('fecha')}}</label>
              <div class="col-sm-4">
                <p class="input-group input-append datepicker1 date col-md-8">
                     <input type="text" name="fecha" id="fecha" data-id="fecha" data-fecha="" placeholder=""  class="form-control"/>
                     <span class="input-group-btn">
                       <button type="button" class="btn btn-default">
                         <i class="glyphicon glyphicon-calendar"></i>
                       </button> </span>
                    </p>
              </div>
              <!--<div class="col-sm-3">
                <a id="addLogo" class="btn btn-success">Agregar Logotipo</a>
              </div>-->
          </div>
        
          <div id="logotipos"></div>
         
          <div class="col-md-12">                       
            <div class="form-group">
              <a class="btn btn-wide btn-warning pull-right" href="{{URL::route('cotizacion')}}" >Regresar</a>

              <button value"2" name="guardar"  type="submit" class="btn btn-wide btn-primary pull-right">
                Guardar
              </button>
            </div>
          </div>
          </fieldset>
</form>


		
@stop

@section("js")
  
    <script src="{{asset('assets/vendor/maskedinput/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/vendor/autosize/autosize.min.js')}}"></script>
    <script src="{{asset('assets/vendor/selectFx/classie.js')}}"></script>
    <script src="{{asset('assets/vendor/selectFx/selectFx.js')}}"></script>
    <script src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/form-elements.js')}}"></script> 

<script src="{{asset('assets/js/cotizacion.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
          FormElements.init();
          $("#form").submit(function () {
            var fecha = $("#fecha").val();
            var ff = fecha.split("/");
            var i = new Date();
            var f = new Date(ff[2],ff[1]-1,ff[0]);
            var dd = ((f-i)/84600)/1000;
            console.log(fecha);
            if (dd < 5) {  
              var e = confirm("La fecha seleccionada es menor a 5 dias");
              console.log(e);
              return e;
            } else {
              console.log("< "+dd);
              return true;
            }
          });
          $("#addLogo").click(function(){
              $("#logotipos").append("<div class='form-group'><label class='col-sm-2 control-label' for=''>Logotipo </label><div class='col-sm-7'><div class='input-group'><input type='file' class='form-ntrol' name='logotipo[]'></div></div></div><div class='form-group'><label class='col-sm-2 control-label' for=''> Observaciones</label><div class='col-sm-7'><div class='input-group col-sm-12'><input type='text' class='form-control' name='observaciones[]'></div></div></div>");
          });
      });
</script>

<script type="text/javascript">
    /*Calendar.setup({
      inputField: "fecha",
      ifFormat:   "%d/%m/%Y",
      weekNumbers: false,
    displayArea: "fecha_usuario",
    daFormat:    "%A, %d de %B de %Y"
    });*/
  </script>
@stop