<?php 

	//ajax start
    public function getCreate2()
	{
        define('DEBUG', false);                      
        define('PS_SHOP_PATH', 'http://promosmile.mx/tienda/');    
        define('PS_WS_AUTH_KEY', '0K11ASSBLBLOU4Y4H6M261XEKHIADRVM');
        $cantidad = 0;  
        $total_registros = \Request::input('total_registros');
        $limit_inicio = \Request::input('limit_inicio');
        $limit_fin = \Request::input('limit_fin');
        $posicion = \Request::input('posicion');
        $limitPorPagina = 500;

        $response = array(
            'status' => 'success',
            'cantidad'=> $cantidad,
            'total_registros'=> $total_registros,
            'limit_inicio'=> $limit_inicio,
            'limit_fin'=> $limit_fin,
            'posicion'=> $posicion
            );
        return \Response::json($response);

        if($limit_inicio==5350){
            $limit_fin =5692;
        }

        // si no tengo el total de registros
        // realizo la consulta primero solo del total
		if($total_registros==0){
			$cantidad = $this->getCantProductos(PS_SHOP_PATH,PS_WS_AUTH_KEY,DEBUG,$limit_inicio, $limit_fin);
			
			$total_paginas = $this->getTotalPaginas($cantidad,$limitPorPagina);
			 $response = array(
            'status' => 'success',
            'total_registros' => $cantidad,
            'inicio_limit' => 1,
            'fin_limit' => $limitPorPagina,
            'posicion' => $total_paginas,
            );
            unset($cantidad);
        return \Response::json($response);
             
		}else{

			//inicio try
			  try
			  {
			  	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
			  	$opt= array('resource' => 'products', 'display'=>'full','limit' => $limit_inicio.','.$limit_fin);
			  	$xml= $webService->get($opt);
			  	$resources= $xml->children()->children();
			  	unset($xml);
			  	unset($webService);
			  	$i=0;
			  	sleep(1);
			  	
			  	 
			  	if(count($resources)>0 and count($resources)<=501 ){

			  	
			  	foreach ($resources as $key => $resource)
			  	{
			  		$proveedorMayus= strtolower($resource->supplier_reference);
			  		$proveedor= Proveedor::where("nombre","=",$proveedorMayus)->orWhere("nombre","=","Proveedor")->get();
			  		$articulo= Articulos::where("id","=",$resource->id)->orWhere("nombre","=","Articulo")->get();

			  		//devuelve el nombre del proveedor
			  		//$this->getNombreProveedorApi($resource->id,PS_SHOP_PATH,PS_WS_AUTH_KEY,DEBUG);
                    
                    //start tratado de imagenes
			  		$nombre_img=''.$resource->name->language[0][0].'_'.$resource->id.'_'.$resource->associations->images->image[0]->id;
			  		$nombre_img=$this->formato_nombre($nombre_img);
                    $url_imagen="";
			  		$uimg=$this->imagenURL();
			  		$url_imagen = $uimg."ps_".$nombre_img.".jpeg";
			  		
			  		if( !$this->existe_archivo($nombre_img) ){
                        $this->copy_url_remote($resource->id,$resource->associations->images->image[0]->id,$nombre_img);
			  		}
			  		//end tratado de imagenes
			  		
			  		if(count($articulo) > 0) {
			  			//break;
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
			  			$a->imagen=$url_imagen;//'http://0K11ASSBLBLOU4Y4H6M261XEKHIADRVM:@promosmile.mx/tienda/api/images/products/'.$resource->id.'/'.$resource->associations->images->image[0]->id;
			  			$a->save();
			  			$i +=1;
			  		}
		
			  	}//fin foreach
			  	}
			  	$response = array(
			  		'status' => 'success',
			  		'total_registros' => $total_registros,
			  		'inicio_limit' => $limit_inicio,
			  		'fin_limit' => $limit_fin,
			  		'posicion' => $poscion,
			  		);
			  	unset($resources);
			  	unset($proveedorMayus);
			  	unset($proveedor);
			  	unset($articulo);
			  	
			  	return \Response::json($response);
            }
            catch (PrestaShopWebserviceException $e)
            {
            	$trace = $e->getTrace();
            	if ($trace[0]['args'][0] == 404) echo 'Bad ID';
            	else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
            	else echo 'Other error';
            }
			//fin try

		}
  

     

	
	}
	//ajax end



 ?>