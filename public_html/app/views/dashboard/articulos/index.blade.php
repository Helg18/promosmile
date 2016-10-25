@extends ('dashboard.layouts.default')

@section ('title')
  Listado de articulos
@stop
@section ('cssPage')
@stop
@section('pagina')
  <h2>Articulos</h2>
@stop
@section ('contenido')
 <?php
set_time_limit(0);
  $start = microtime(true);
define('DEBUG', false);
define('_PS_DEBUG_SQL_', true);
define('_PS_MODE_DEV_', true);
//define(‘_PS_MODE_DEV_’, true);
//define('PS_SHOP_PATH', 'http://localhost/prestashop/api/');
define('PS_SHOP_PATH', 'http://promosmile.mx/tienda/');        // Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', '0K11ASSBLBLOU4Y4H6M261XEKHIADRVM');    // Auth key (Get it in your Back Office) 
 
/*define('DEBUG', false);
define('PS_SHOP_PATH', 'http://pruebarusbelvl.pswebstore.com/');
define('PS_WS_AUTH_KEY', 'ZH182SN3R8A3738DFZMXQGZSMLYEW6N5');*/

 
 function getCantProductos($path,$key,$debug,$desde, $hasta){
     $webService = new PrestaShopWebservice($path, $key, $debug);
     $opt['resource'] = 'products';   
     $opt['display']  = '[id]';   
     if(!empty($hasta) and $hasta!=0){
        if(empty($desde)){
           $desde = 1;
        }
        $opt['limit']    = $desde.','.$hasta; 

     } 
     
     $xml = $webService->get($opt);
     $resources = $xml->products->children(); 
     return count($resources);
 }

 function getTotalPaginas($totalRegistos,$perpage){

        $totalpages=0;
 
        if($totalRegistos % $perpage >0 ){
          $totalpages=($totalRegistos)/$perpage+1;
        }else{
          $totalpages=($totalRegistos)/$perpage;
        }
        $totalpages = floor($totalpages);
        $totalpages = (int)$totalpages;
     return $totalpages;
    }

    function getPaginasLimit($totalRegistos,$posicion,$perpage){

        $hst = $posicion*$perpage;
        $dsd = $hst-($perpage-1);
        if($hst > $totalRegistos) $hst=$totalRegistos;

        $data = array('desde' => $dsd, 'hasta'=>$hst);
     return $data;
    }

    function getDataApi($path,$key,$debug,$limit){


      try
         {
             $webService = new PrestaShopWebservice($path, $key, $debug);
             $desd = $limit['desde'];
             $hast= $limit['hasta'];
             $opt['resource'] = 'products';             
             $opt['display'] = 'full';
             $opt['limit']    ="$desd,$hast";    
             $xml = $webService->get($opt);
             $resources = $xml->products->children();
             return $resources;     
         }
         catch (PrestaShopWebserviceException $e)
         {
        
             $trace = $e->getTrace();
             if ($trace[0]['args'][0] == 404) echo 'Bad ID';
             else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
             else echo 'Other error<br />'.$e->getMessage();
         }
    }

 // aqui doy el valor por defecto
 // para pruebas puse 200 para probar
 // si quieren todos los registros dejar vacio
 $set_desde = 0;
 $set_hasta = 0;
 if(empty($total_reg)){
    $totalRegistos= getCantProductos(PS_SHOP_PATH,PS_WS_AUTH_KEY,DEBUG,$set_desde, $set_hasta);
 }else{
    $totalRegistos=$total_reg;
 }
 echo "<h2>Total de articulos: ".$totalRegistos."</h2>";
 echo "<br>";
 
 // cuantos registros por paginas
 $perpage = 150; 

 //por defecto la posicion es 1 (osea pagina 1)
 // aqui iria $_GET['pag']
 $posicion= $pagina;//$_GET['pag'];

 $resources=NULL;
 $data_resource = NULL;
 
 //obtengo el total de registros en total
 $total_paginas = getTotalPaginas($totalRegistos,$perpage);

 //calculo los limites de la consulta para moverme entre paginas
 $limit = getPaginasLimit($totalRegistos,$posicion,$perpage);
 //echo "<br>".$limit['desde']." - ".$limit['hasta']."<br>";

 //datos consultados
 $resources=getDataApi(PS_SHOP_PATH,PS_WS_AUTH_KEY,DEBUG,$limit);
 //$total = count($resources);
    $i=0;
    foreach ($resources as $key => $resource) if ($i < $perpage)
    {

    
    $data_resource[] = array(
                                'id'        => $resource->id, 
                                'imagen'    => 'http://0K11ASSBLBLOU4Y4H6M261XEKHIADRVM:@promosmile.mx/tienda/api/images/products/'.$resource->id.'/'.$resource->associations->images->image[0]->id, 
                                'nombre'    => $resource->name->language[0][0], 
                                'proveedor' => $resource->supplier_reference 
                                );
    $i +=1;
    }
 

$total = count($data_resource);

 $end = microtime(true);

echo "Paginas: <br>";
$options = '';
$select_op = '';     
for ($i=0; $i < $total_paginas; $i++) { 
      if( ($i+1)==$pagina ){ $select_op = 'selected'; }else{ $select_op = ''; }
      $options .= '<option value="'.($i + 1).'" '.$select_op.'>Pagina '.($i + 1).'</option>';
}
?>
<form action="{{URL::route('pag.articulos')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="total_reg" value="{{$totalRegistos}}" >
  <div class="col-md-4" >
        <div class="form-group">
<?php
 echo "<select class='form-control' name='pagina'>
       ". $options."
      </select>";
?>
    </div>
        </div>

                <input type="submit" class="btn btn-success" value="Actualizar">
            </div>
        </div>
        
<br>
</form>
<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
<thead>
<tr><th>Id</th>
<th>Imagen</th> 
<th>Nombre</th> 
<th>Proveedor</th>
</tr>
</thead>
<tbody>  

@for ($i=0; $i < $total; $i++) 
     <tr><td>{{$data_resource[$i]['id']}}</td> 
     <td align="center"><img width="85" height="60" src="{{$data_resource[$i]['imagen']}}" /></td>
     <td>{{$data_resource[$i]['nombre']}}</td>
     <td>{{$data_resource[$i]['proveedor']}}</td>

</tr>
@endfor
</table>
@stop

@section("js")

@stop