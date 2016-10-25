<?php
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\MimeType;

class ArticulosController extends BaseController {
	
	/**
     *  Productos Model
     * @var productos
     */
    protected $productos;
   
  /**
     * Inject the models.
     * @param  productos $productos
     */
    public function __construct(Articulos $productos)
    {
        parent::__construct();
        $this->productos = $productos;
    }
	
	/**
	 * Returns all CRequest.
	 *
	 * @return View
	 */
	public function articulos()

	{

		$articulos=Articulos::where('id', '>', 0)->get();
        //$articulos = $articulos->toJson();
		//descomentar solo para corregir urls
		/*foreach ($articulos as $articulo)
		{
			$this->corregirUrl($articulo->imagen,$articulo->nombre);
		}*/
		return View::make('dashboard/articulos/create',compact('articulos'));
	}

    public function articulo_especifico(){
        $id = Input::get("id");
        $especific = Articulos::where('id','=',$id)->get()->toArray();
        return Response::json(array(
                        'success'   => true,
                        'records'   => $especific
                        ),200);
    }
	
	public function articulosLoad () {
		$id = Input::get("id");
		$pro = Proveedor::find($id);
        $ar = Articulos::where("proveedor","=",$id)->get();
		return Response::json(array(
				"ar" => $ar,
                "pro" => $pro
			));
	}

	public function getCreate()
	{
		
	 define('DEBUG', false);                     // Debug mode
     define('PS_SHOP_PATH', 'http://promosmile.mx/tienda/');   // Root path of your PrestaShop store
     define('PS_WS_AUTH_KEY', '0K11ASSBLBLOU4Y4H6M261XEKHIADRVM'); // Auth key (Get it in your Back Office)

     try
    {
     $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);

    
     $opt= array('resource' => 'products', 'display'=>'full','limit'    => '5000,500');  
     $xml= $webService->get($opt);
     $resources= $xml->children()->children(); 

      $i=0;
     foreach ($resources as $key => $resource)
     {
            $proveedorMayus= strtolower($resource->supplier_reference);
          	$proveedor= Proveedor::where("nombre","=",$proveedorMayus)->orWhere("nombre","=","Proveedor")->get();
            $articulo= Articulos::where("id","=",$resource->id)->orWhere("nombre","=","Articulo")->get();
            
            //devuelve el nombre del proveedor
            //$this->getNombreProveedorApi($resource->id,PS_SHOP_PATH,PS_WS_AUTH_KEY,DEBUG);
            
            if(count($articulo) > 0) {
				break;
			}

			else{

            if(count($proveedor) > 0) {
				$pro = $proveedor[0]['id'];
			}
			elseif (empty($proveedorMayus)) {
    			$Proveedor_nueva= new Proveedor;
                $Proveedor_nueva->nombre = 'Proveedor';
                $Proveedor_nueva->save();
                $pro = $Proveedor_nueva->id;
					
			}  
			else {
				$Proveedor_nueva= new Proveedor;
                $Proveedor_nueva->nombre = $proveedorMayus;
                $Proveedor_nueva->save();
                $pro = $Proveedor_nueva->id;
					
			}
            $a = new Articulos();
            $a->id = $resource->id;
			$a->nombre = $resource->name->language[0][0];
			$a->proveedor =$pro;
			$a->descripcion = $resource->name->language[0][0];
			$a->imagen='http://0K11ASSBLBLOU4Y4H6M261XEKHIADRVM:@promosmile.mx/tienda/api/images/products/'.$resource->id.'/'.$resource->associations->images->image[0]->id;
			$a->save(); 
             $i +=1;

             }

     }
             return Redirect::to('articulos')
                    ->with('msg', 'Articulos actualizados.')
                    ->with('class', 'success');
     
 
     }
     catch (PrestaShopWebserviceException $e)
     {
     $trace = $e->getTrace();
     if ($trace[0]['args'][0] == 404) echo 'Bad ID';
      else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
     else echo 'Other error';
     }

    /* echo"<iframe width='1' height='1' frameborder='0' scrolling='no' hidden=FALSE src='http://0K11ASSBLBLOU4Y4H6M261XEKHIADRVM@promosmile.mx/tienda/api/images/products/20/62'>
        <img width='1' height='1' src='http://0K11ASSBLBLOU4Y4H6M261XEKHIADRVM@promosmile.mx/tienda/api/images/products/20/62'  style='display=none' />
       </iframe>";
*/
	
	}


	//ajax start
  public function getCreate2()
	{
     define('DEBUG', false);                     // Debug mode
     define('PS_SHOP_PATH', 'http://promosmile.mx/tienda/');   // Root path of your PrestaShop store
     define('PS_WS_AUTH_KEY', '0K11ASSBLBLOU4Y4H6M261XEKHIADRVM'); // Auth key (Get it in your Back Office)
     require_once(__DIR__.'/PSWebServiceLibrary.php');
     $cantidad = 0;  
     $total_registros = \Request::input('total_registros');
     $limit_inicio = \Request::input('limit_inicio');
     $limit_fin = \Request::input('limit_fin');
     $posicion = \Request::input('posicion');
     $limitPorPagina = 500;
     $response='';
     $i = 0;


    try {
      $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
      $opt['resource'] = 'products';
      //$opt['display'] = 'full';
      if (isset($_GET['id']))
      $opt['id'] = (int)$_GET['id'];

      $xml = $webService->get($opt);

      $resources = $xml->children()->children();

      $cantidad = count($resources);

    }
    catch (PrestaShopWebserviceException $e){
      $trace = $e->getTrace();
      if ($trace[0]['args'][0] == 404) echo 'Bad ID';
      else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
      else echo 'Other error<br />'.$e->getMessage();
    }

    echo "total_registros -> ".$total_registros."<br>";
    echo "limit_inicio -> ".$limit_inicio."<br>";
    echo "limit_fin -> ".$limit_fin."<br>";
    echo "posicion -> ".$posicion."<br>";
    echo "limitPorPagina -> ".$limitPorPagina."<br>";
    echo "response -> ".$response."<br>";
    echo "cantidad -> ". $cantidad ."<br>";


    foreach ($resources as $key => $resource) {
      //var_dump($resource);
      //echo "resource: ".$key->id." ||<br>";
      $proveedorMayus= strtolower($resource->supplier_reference);
      echo "ProveedorMayus: ".$proveedorMayus." <br>";
      echo "resource: ".$resource->attributes()." ||<br>";
    }







	}
	//ajax end
	

	public function postCreate()
	{
		 define('DEBUG', false);                     // Debug mode
     define('PS_SHOP_PATH', 'http://promosmile.mx/tienda/');   // Root path of your PrestaShop store
     define('PS_WS_AUTH_KEY', '0K11ASSBLBLOU4Y4H6M261XEKHIADRVM'); // Auth key (Get it in your Back Office)

     try
    {
     $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
     $opt = array('resource' => 'products', 'display'=>'full','limit'    => '1,5'); 
      
     $xml = $webService->get($opt);
     $resources = $xml->children()->children(); 
     foreach ($resources as $key => $resource3)
    {
     $images3[] = array(
     	                    
     	                   $resource3->id.'' => $this->callCurlGet($resource3->id,$resource3->associations->images->image[0]->id,PS_WS_AUTH_KEY)
     	
     	                );
     }

     $opt2 = array('resource' => 'products', 'display'=>'full','limit'    => '5,5'); 
     $xml2 = $webService->get($opt2);
     $resources2 = $xml2->children()->children(); 
     foreach ($resources2 as $key => $resource2)
    {
      $images2[] = array(
     	                    
     	                   $resource2->id.'' => $this->callCurlGet($resource2->id,$resource2->associations->images->image[0]->id,PS_WS_AUTH_KEY)
     	
     	                );
     }
     
     }
     catch (PrestaShopWebserviceException $e)
     {
     $trace = $e->getTrace();
     if ($trace[0]['args'][0] == 404) echo 'Bad ID';
      else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
     else echo 'Other error';
     }

    /* echo"<iframe width='1' height='1' frameborder='0' scrolling='no' hidden=FALSE src='http://0K11ASSBLBLOU4Y4H6M261XEKHIADRVM@promosmile.mx/tienda/api/images/products/20/62'>
        <img width='1' height='1' src='http://0K11ASSBLBLOU4Y4H6M261XEKHIADRVM@promosmile.mx/tienda/api/images/products/20/62'  style='display=none' />
       </iframe>";
*/
     return View::make('dashboard/articulos/create',compact('resources','images3','resources2','images2'));
     
	
	}
	public function saveImage () {
		if (empty(Input::get('total_reg'))) {
			$pagina= '';
			  
		}else{
			$total_reg= Input::get('total_reg');
		}
		if (empty(Input::get('pagina'))) {
			$pagina= 1;
			 return View::make('dashboard/articulos/index',compact('pagina','total_reg'));
		}

		else
			 {
			 	$pagina= Input::get('pagina');
			 return View::make('dashboard/articulos/index',compact('pagina','total_reg'));


			 }

	}

	public function getShow($id)

	{
		
		$productos = Articulos::find($id);
		$imagenes = Images::where('productos_id','=',$id)->orderBy('order')->get();
		$img = Images::where('productos_id','=',$id)->orderBy('order')->first();

		return View::make('dashboard/articulos/show',compact('productos','imagenes','img'));
		
	}



	 public function getEdit($id)
    {
    	 $productos 	= Articulos::find($id);
		 $proveedores = Proveedor::all();

		return View::make('dashboard/articulos/edit',compact('productos','proveedores'));
  
	}

	public function postEdit($id)
	{

		$productos = Articulos::find($id);

		$productos->nombre		 = Input::get('nombre');
		$productos->descripcion  = Input::get('descripcion');
		$productos->proveedor	 = Input::get('proveedor');
	

		if($productos->update(['id'])){
		
			return Redirect::to('articulos')
                    ->with('msg', 'Datos del articulo editados con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron editados.')
                    ->with('class', 'error');

		}
	}

 
	 public function getDelete($id)
    {
       $productos = Articulos::find($id);


       	if($productos->delete()){

		return Redirect::back()
                    ->with('msg', 'Producto eliminado con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! El producto no pudo ser eliminado.')
                    ->with('class', 'error');

		}
	

 }
 public function editImage ($id) {

	$productos = Articulos::find($id);
 	$img = Images::where("productos_id","=",$id)
 				 ->orderBy("order")
 				 ->select("id","filename","order")
 			     ->get();
 	$num = count($img);
 	return View::make("dashboard.articulos.editImage",compact('productos'))->with(array("num" => $num,"imgs" => $img,"id" => $id));
 }
 public function editImagePos () {
   try {
 	$data = Input::get("data");
 	$array = explode(",",$data);
 	foreach ($array as $pos) {
 		$pp = explode(".",$pos);
 		Images::where("id",$pp[0])->update(array("order" => $pp[1]));
 	}
  	return Response::json(array(
  			"estado" => 1
  		));
  }catch (Exception $e) {
  	 return Response::json(array(
  			"estado" => 2
  		));
  }
 }
 public function deleteImage ($id) {
 	$p = Images::find($id);
 	Images::where("id","=",$id)->delete();
 	return Redirect::to(URL::route('editImage')."/".$p->productos_id);
 }
 public function descripcion () {
 	$id = Input::get("id");
 	$a = Articulos::find($id);
 	return Response::json(array(
 			"descripcion" => $a->descripcion
 		));
 }

 public function callCurlGet($id_pro,$id_img,$key){   
        //ruta servidor remoto
       // $key = 'ZH182SN3R8A3738DFZMXQGZSMLYEW6N5';
        $url = (string)"http://".$key.":@promosmile.mx/tienda/api/images/products/".$id_pro."/".$id_img;

        return $url;
    }

   public  function getCantProductos($path,$key,$debug,$desde, $hasta){
     $webService = new PrestaShopWebservice($path, $key, $debug);
     $opt['resource'] = 'products';   
     $opt['display']  = '[id]';   
     if(!empty($hasta) and $hasta!=0){
        if(empty($desde)){
           $desde = 1;
        }
        //$opt['limit']    = $desde.','.$hasta; 

     } 
     
     $xml = $webService->get($opt);
     
     $resources = $xml->products->children();
     unset($xml); 
     unset($webService); 
     return count($resources);
 }

 public function getTotalPaginas($totalRegistos,$perpage){

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

    public function copy_url_remote($id_pro,$id_img,$nombre_img){
    echo $url="http://promosmile.mx/tienda/api/images/products/".$id_pro."/".$id_img;
    $path=getcwd();
    $urldestino=$path."/uploads/prestashop/ps_".$nombre_img.".jpeg";
    $ch=curl_init($url);
    $fs_archivo=fopen($urldestino,"w");
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_BINARYTRANSFER,1);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
    curl_setopt($ch,CURLOPT_USERPWD,'0K11ASSBLBLOU4Y4H6M261XEKHIADRVM:');
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt ($ch,CURLOPT_FILE,$fs_archivo);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,15);
    $postResult=curl_exec($ch);
    fclose($fs_archivo);
    curl_close($ch);
    unset($fs_archivo);
    unset($ch);}
    
    public function formato_nombre($value)
    {
    	$value = str_replace(" ", "_", $value);
    	$value = strtolower($value);
    	$value = $this->limpiaCadena_r($value);
    	return $value;
    }

    public function existe_archivo($nombre_img)
    {
    	$path=getcwd();
    	$urldestino=$path."/uploads/prestashop/ps_".$nombre_img.".jpeg";
    	if (file_exists($urldestino)) {
    		return true; //si existe
    	} else {
    		return false;
    	}
    }

    public function imagenURL(){
    	//$url="http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
    	//$url = explode("/public", $url);
    	//$urli = $url[0]."/public/uploads/prestashop/";
    	$urli = "../public/uploads/prestashop/";
    	return $urli;
    }

    public function limpiaCadena_r($s) {
		$s = preg_replace("/á|à|â|ã|ª/","a",$s);
		$s = preg_replace("/Á|À|Â|Ã/","A",$s);
		$s = preg_replace("/é|è|ê/","e",$s);
		$s = preg_replace("/É|È|Ê/","E",$s);
		$s = preg_replace("/í|ì|î/","i",$s);
		$s = preg_replace("/Í|Ì|Î/","I",$s);
		$s = preg_replace("/ó|ò|ô|õ|º/","o",$s);
		$s = preg_replace("/Ó|Ò|Ô|Õ/","O",$s);
		$s = preg_replace("/ú|ù|û/","u",$s);
		$s = preg_replace("/Ú|Ù|Û/","U",$s);
		$s = str_replace(" ","_",$s);
		$s = str_replace("ñ","n",$s);
		$s = str_replace("Ñ","N",$s);
		$s = preg_replace('/[^a-zA-Z0-9_.-]/', '', $s);
		return $s;
	}

	public function corregirUrl($url,$nombre_producto){
          //aplicar esta funcion solo cuando las rutas esten malas
		$v_buscar = 'public';
		$pos = strpos($url, $v_buscar);

		if ($pos === false) {

			$url1 = explode("/products/", $url);
			$url2 = explode("/", $url1[1]);
			$id_produc=$url2[0];
			$id_imagen=$url2[1];
			//start tratado de imagenes
			$nombre_img=''.$nombre_producto.'_'.$id_produc.'_'.$id_imagen;
			$nombre_img=$this->formato_nombre($nombre_img);
			$url_imagen="";
			$uimg=$this->imagenURL();
			$url_imagen = $uimg."ps_".$nombre_img.".jpeg";

			if( !$this->existe_archivo($nombre_img) ){
				$this->copy_url_remote($id_produc,$id_imagen,$nombre_img);
			}
			//end tratado de imagenes
			//$a = new Articulos();
			$a=articulos::find($id_produc);
			$a->imagen=$url_imagen;
			$a->save();
		}
	}

	public function getNombreProveedorApi($id_producto,$path,$key,$debug){
		$webService = new PrestaShopWebservice($path, $key, $debug);
		$opt['resource'] = 'products';
		$opt['display'] =  'full';
		$opt['filter[id]'] =''.$id_producto.'';
		$opt['limit']    = '1'; 

		$xml = $webService->get($opt);
		$resources = $xml->products->children();
		foreach ($resources as $key => $resource)
         {
         	$data_resource[] = array('proveedor' => $resource->supplier_reference);break;
         }
		unset($xml);
		unset($webService);
		return $data_resource[0]['proveedor'];
	}


}
?>