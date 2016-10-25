<?php

class CotizacionController extends BaseController {
	public $estatus = 1;
	public $sub = 0;

    public function __construct()
    {
        $this->beforeFilter('cotizacion', array('only' => 'cotizacion') );
       
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function cotizacion () {
 		
 		$usuario=Vendedor::where("user_id","=",Auth::user()->id)->first();
 		$resultado=DB::table('assigned_roles')->where('user_id','=',Auth::user()->id)->first();

 		if ($resultado->role_id==2) {
 		$cotizacion = Cotizacion::where("cotizacion.vendedor","=",$usuario->id)
 		                        ->join("clientes","clientes.id","=","cotizacion.cliente")
								->join("articulo_cotizacion","articulo_cotizacion.cotizacion","=","cotizacion.id")
								->groupBy("articulo_cotizacion.cotizacion")
								->select(DB::raw("cotizacion.*,clientes.nombre,sum(articulo_cotizacion.total) as total"))
								->get();
		$fecha = date("Y-m-d");
		$f = strtotime("-2 day", strtotime($fecha) );
		$ff = date("Y-m-d",$f);
		$restric= Prospectos::where('vendedor','=',Auth::user()->id)->whereBetween('fecha',array($ff,$fecha) )->count();
		
		return View::make("dashboard.cotizacion.cotizacion")
		->with(array("cotizacion" => $cotizacion))
		->with(array("restric" => $restric))
		->with(array("resultado" => $resultado))
		->with(array("usuario" => $usuario));
 		}
 		else{
		$cotizacion = Cotizacion::join("clientes","clientes.id","=","cotizacion.cliente")
								->join("articulo_cotizacion","articulo_cotizacion.cotizacion","=","cotizacion.id")
								->groupBy("articulo_cotizacion.cotizacion")
								->select(DB::raw("cotizacion.*,clientes.nombre,sum(articulo_cotizacion.total) as total"))
								->get();
		$restric= Prospectos::where('vendedor','=',Auth::user()->id)->where('fecha','=',date("Y-m-d"))->count();
		return View::make("dashboard.cotizacion.cotizacion")
		->with(array("cotizacion" => $cotizacion))
		->with(array("restric" => $restric))
		->with(array("resultado" => $resultado));

    }
	}


	public function cotizacionForm () {

		$clientes = Cliente::all();
		$articulos = Articulos::all();
		$proveedores = Proveedor::all();
		$almacenes = Almacen::all();
		$cc = Color::all();
 		return View::make("dashboard.cotizacion.cotizacionForm")
				   ->with(array("proveedores" => $proveedores))
				   ->with(array("clientes" => $clientes))
				   ->with(array("articulos" => $articulos))
				   ->with(array("almacenes" => $almacenes))
				   ->with(array("cc" => $cc));

	}


	public function cotizacionSave () {
		$vendedor=Vendedor::where("user_id","=",Auth::user()->id)->first();

			if (empty($vendedor)) {
			$count = Input::get('costo1');
			if(count($count) > 0) {

			$c = new Cotizacion();
			//$c->vendedor 				= Auth::user()->id; lo desactive porque en la bd que tengo no esta este campo
			$c->cliente 				= Input::get("cliente");
			$c->proveedor 				= Input::get("proveedor");
			$c->vendedor 				= Auth::user()->id;
			$c->almacen 				= 1;
			/*quitar de tabla desde aqui
			$c->articulo 				= Input::get("articulo");
			$c->descripcion			    = Input::get("descripcion");
			$c->costo_unitario 			= Input::get("costo_unitario");
			$c->margen_utilidad 		= Input::get("margen_utilidad");
			$c->precio_unitario 		= Input::get("precio_unitario");
			$c->cantidad			 	= Input::get("cantidad");
			//hasta aquí (van en otra tabla) */
			$c->subtotal 				= Input::get("subtotal");
			$c->status 					= 1;	 
			//$c->descuento 				= Input::get("descuento");
			//$c->subtotal_descuento 		= Input::get("subtotal_descuento");
			$c->iva 				    = Input::get("iva");
			$c->total 					= Input::get("total");
			
			$c->fecha 					=  date("d-m-Y g:i:s"); 
			$c->observaciones 			= Input::get("observaciones");
			//$c->costoimpresion 			= Input::get("costoimpresion");		
			//$c->tipoimpresion 			= Input::get("impresion");	
			//$c->infoimpresion 			= Input::get("infoimpresion");	
			$exist_sub			   		=	Input::get('count_sub');

					
			if($c->save()){

			  if($exist_sub == 1 ){
				
				$sub_categorias	    =	Input::get('subcategorias');
				$sub_categorias2	=	Input::get('subcategorias2');
				$descripcion     	=	Input::get('descripcion1');
				$color     			=	Input::get('color1');
				$costo_unitario  	=	Input::get('costo1');
				$margen_utilidad	=	Input::get('margen_utilidad1');
				$precio_unitario	=	Input::get('precio_unitario1');
				$totale 			= 	Input::get("totale");
				$costoimpresion 	=   Input::get("costoimpresion");		
				$tipoimpresion 		=   Input::get("tipoimpresion");	
				$infoimpresion 		=   Input::get("infoimpresion");
				$placas             =   Input::get("placas");
				$proveedores	    =   Input::get("proveedores");



				$contador= count($sub_categorias2);

					for($i=0; $i<$contador; $i++){
					$subcategorias					= 	new Articulocotizaciones;	
					$subcategorias->cotizacion 	    = 	$c->id;	
					$subcategorias->articulo 	    = 	$sub_categorias[$i];
					$subcategorias->cantidad		= 	$sub_categorias2[$i];
					$subcategorias->descripcion    	= 	$descripcion[$i];
					$subcategorias->color    		= 	$color[$i];
					$subcategorias->costo_unitario  = 	$costo_unitario[$i];
					$subcategorias->margen_utilidad = 	$margen_utilidad[$i];
					$subcategorias->precio_unitario = 	$precio_unitario[$i];
					$subcategorias->total 			= 	$totale[$i];	
					$subcategorias->costoimpresion 	=   $costoimpresion[$i];		
					$subcategorias->tipoimpresion 	=   $tipoimpresion[$i];	
					$subcategorias->infoimpresion 	=   $infoimpresion[$i];
					$subcategorias->placas			=   $placas[$i];
					$subcategorias->proveedor_id 	=   $proveedores[$i];

					$subcategorias->save();
					}
			  }
			}
				
		if(Input::get("enviar")== 1)

		{ 
				
	  $cliente = Cliente::find($c->cliente);
	  $imagen = Images::where("productos_id","=",$c->articulo)->first();
      
      $vista = (string) View::make("dashboard.cotizacion.email")->with(array("venta" => $c,"cliente" => $cliente, "imagen" => $imagen));
		//return PDF::load(utf8_decode($vista), 'A4', 'portrait')->show();
	  $this->id = $c->id;
      $this->mail = $cliente->email;
      $this->nombre = $cliente->nombre;

      $this->guardarPdf($c->id,$vista);
          $this->email();

           return Redirect::to(URL::route("cotizacion"))
                    ->with('msg', 'Datos  guardados con éxito y enviados.')
                    ->with('class', 'success');

	 }
         else
         {

       return Redirect::to(URL::route("cotizacionMostrarForm")."/".$c->id)
                    ->with('msg', 'Datos  guardados con éxito.')
                    ->with('class', 'success');
                    }
       } else {
       	Session::flash("msj",true);
       	return Redirect::to(URL::route("cotizacionMostrarForm")."/".$c->id);
       }
    }
    else{
    	$count = Input::get('costo1');
			if(count($count) > 0) {

			$c = new Cotizacion();
			//$c->vendedor 				= Auth::user()->id; lo desactive porque en la bd que tengo no esta este campo
			$c->cliente 				= Input::get("cliente");
			$c->proveedor 				= Input::get("proveedor");
			$c->vendedor 				= $vendedor->id;
			$c->almacen 				= Input::get("almacen");
			/*quitar de tabla desde aqui
			$c->articulo 				= Input::get("articulo");
			$c->descripcion			    = Input::get("descripcion");
			$c->costo_unitario 			= Input::get("costo_unitario");
			$c->margen_utilidad 		= Input::get("margen_utilidad");
			$c->precio_unitario 		= Input::get("precio_unitario");
			$c->cantidad			 	= Input::get("cantidad");
			//hasta aquí (van en otra tabla) */
			$c->subtotal 				= Input::get("subtotal");
			$c->status 					= 1;	 
			//$c->descuento 				= Input::get("descuento");
			//$c->subtotal_descuento 		= Input::get("subtotal_descuento");
			$c->iva 				    = Input::get("iva");
			$c->total 					= Input::get("total");
			
			$c->fecha 					=  date("d-m-Y g:i:s"); 
			$c->observaciones 			= Input::get("observaciones");
			//$c->costoimpresion 			= Input::get("costoimpresion");		
			//$c->tipoimpresion 			= Input::get("impresion");	
			//$c->infoimpresion 			= Input::get("infoimpresion");	
			$exist_sub			   		=	Input::get('count_sub');

					
			if($c->save()){

			  if($exist_sub == 1 ){
				
				$sub_categorias	    =	Input::get('subcategorias');
				$sub_categorias2	=	Input::get('subcategorias2');
				$descripcion     	=	Input::get('descripcion1');
				$color     			=	Input::get('color1');
				$costo_unitario  	=	Input::get('costo1');
				$margen_utilidad	=	Input::get('margen_utilidad1');
				$precio_unitario	=	Input::get('precio_unitario1');
				$totale 			= 	Input::get("totale");
				$costoimpresion 	=   Input::get("costoimpresion");		
				$tipoimpresion 		=   Input::get("tipoimpresion");	
				$infoimpresion 		=   Input::get("infoimpresion");
				$placas				=   Input::get("placas");	
				$proveedores	    =   Input::get("proveedores");


				$contador= count($sub_categorias2);

					for($i=0; $i<$contador; $i++){
					$subcategorias					= 	new Articulocotizaciones;	
					$subcategorias->cotizacion 	    = 	$c->id;	
					$subcategorias->articulo 	    = 	$sub_categorias[$i];
					$subcategorias->cantidad		= 	$sub_categorias2[$i];
					$subcategorias->descripcion    	= 	$descripcion[$i];
					$subcategorias->color    		= 	$color[$i];
					$subcategorias->costo_unitario  = 	$costo_unitario[$i];
					$subcategorias->margen_utilidad = 	$margen_utilidad[$i];
					$subcategorias->precio_unitario = 	$precio_unitario[$i];
					$subcategorias->total 			= 	$totale[$i];	
					$subcategorias->costoimpresion 	=   $costoimpresion[$i];		
					$subcategorias->tipoimpresion 	=   $tipoimpresion[$i];	
					$subcategorias->infoimpresion 	=   $infoimpresion[$i];
					$subcategorias->placas		 	=   $placas[$i];
					$subcategorias->proveedor_id 	=   $proveedores[$i];

					$subcategorias->save();
					}
			  }
			}
				
		if(Input::get("enviar")== 1)

		{ 
				
	  $cliente = Cliente::find($c->cliente);
	  $imagen = Images::where("productos_id","=",$c->articulo)->first();
      
      $vista = (string) View::make("dashboard.cotizacion.email")->with(array("venta" => $c,"cliente" => $cliente, "imagen" => $imagen));
		//return PDF::load(utf8_decode($vista), 'A4', 'portrait')->show();
	  $this->id = $c->id;
      $this->mail = $cliente->email;
      $this->nombre = $cliente->nombre;

      $this->guardarPdf($c->id,$vista);
          $this->email();

           return Redirect::to(URL::route("cotizacion"))
                    ->with('msg', 'Datos  guardados con éxito y enviados.')
                    ->with('class', 'success');

	 }
         else
         {
        
       return Redirect::to(URL::route("cotizacionMostrarForm")."/".$c->id)
                    ->with('msg', 'Datos  guardados con éxito.')
                    ->with('class', 'success');
                    }
       } else {
       	Session::flash("msj",true);
       	return Redirect::to(URL::route("cotizacionMostrarForm")."/".$c->id);
       }
    }

	}

	 public function email () {
      Mail::send('emails.cotizacion', array("cliente" => $this->nombre,"msj" => nl2br($this->msj)), function($message)
      {
          //$message->from('Testphp001@gmail.com', 'test');
          if (empty($this->cc)) {
              $message->to($this->mail, $this->nombre)->subject($this->subject); 
              }
          else{
               $message->to($this->mail, $this->nombre)->subject($this->subject)->cc($this->cc);
               } 
          $message->from($this->mail, 'Promosmile');
          $message->attach("../pdf/cotizaciones/".$this->id.".pdf",array("as" => "Cotización#".$this->id.".pdf","mime"=> "application/pdf"));
      });
    }
    public function guardarPdf ($id,$vista) {
      if (!is_dir("../pdf/cotizaciones")) {
          mkdir("../pdf/cotizaciones",0755, true);
      }
      File::put("../pdf/cotizaciones/".$id.".pdf", PDF::load(utf8_decode($vista), 'A4', 'portrait')->output());
      //$vista = (string) View::make("dashboard.ventas.email");
      //return PDF::load(utf8_decode($vista), 'A4', 'portrait')->show();
    }
    
    public function enviarEmailCliente()
	{
      $id=Input::get("id");
	  $c = Cotizacion::find($id);
	 $ca = Articulocotizaciones::where("cotizacion","=",$id)
								  ->join("articulos","articulos.id","=","articulo_cotizacion.articulo")
								  ->groupBy("articulo_cotizacion.id")
								  ->select(DB::raw("articulo_cotizacion.*,articulos.imagen"))
								  ->get();
      

      $cliente = Cliente::where("id","=",$c->cliente)->first();
      
      $vista = (string) View::make("dashboard.cotizacion.cotizacionPdf")->with(array("ca" => $ca,"cotizacion" => $c,"cliente" => $cliente));
	  //return PDF::load($vista, 'A4', 'portrait')->show();
	 
      $this->id = $c->id;
      $this->mail = $cliente->email;
      $this->nombre = $cliente->nombre;
      $this->subject = Input::get("asunto");
      $this->msj = Input::get("mensaje");
      $this->cc = Input::get("cc");

      $this->guardarPdf($c->id,$vista);
      $this->email();
      
      if($c->status < 4){
      	$c->status = 3;
      	$c->save();
      }
           return Redirect::to(URL::route("cotizacion"))
                    ->with('msg', 'Datos enviados.')
                    ->with('class', 'success');
 }


	public function cotizacionMostrarForm($id)
	{
		$cotizacion = Cotizacion::find($id);
		$ca = Articulocotizaciones::where("cotizacion","=",$id)
								  ->join("articulos","articulos.id","=","articulo_cotizacion.articulo")
								  ->groupBy("articulo_cotizacion.id")
								  ->select(DB::raw("articulo_cotizacion.*,articulos.imagen"))
								  ->get();
		$cliente = Cliente::where("id","=",$cotizacion->cliente)->get();
	    $imagen = Images::where("productos_id","=",$cotizacion->articulo)->first();
	  
		return View::make("dashboard.cotizacion.cotizacionMostrarForm")
		->with(array("cotizacion" => $cotizacion))
		->with(array("cliente" => $cliente))
		//->with(array("imagen" => $imagen))
		->with(array("ca" => $ca));
	}


	public function cotizacionMostrarPdf($id)

	{
		$cotizacion = Cotizacion::find($id);
		$ca = Articulocotizaciones::where("cotizacion","=",$id)
								  ->join("articulos","articulos.id","=","articulo_cotizacion.articulo")
								  ->groupBy("articulo_cotizacion.id")
								  ->select(DB::raw("articulo_cotizacion.*,articulos.imagen"))
								  ->get();
		$cliente = Cliente::where("id","=",$cotizacion->cliente)->first();
		//$imagen = Images::where("productos_id","=",$cotizacion->articulo)->first();
		$vista = (string) View::make("dashboard.cotizacion.cotizacionPdf")
					 ->with(array("cotizacion" => $cotizacion))
					 ->with(array("ca" => $ca))
					 ->with(array("cliente" => $cliente));
    	return PDF::load(utf8_encode(utf8_decode($vista)), 'A4', 'portrait')->show("Cotización#".$id);
	}


	public function cotizacionEditarForm ($id) {

		
		$clientes = Cliente::all();
		$ac = Articulocotizaciones::find($id);
		$articulos = Articulos::where("proveedor","=",$ac->proveedor_id)->get();
		$proveedores = Proveedor::all();
		$cotizacion = Cotizacion::find($ac->cotizacion);
		$proveedor1 = Proveedor::find($ac->proveedor_id);

		$cc = Color::all();
		return View::make("dashboard.cotizacion.cotizacionFormEditar")
		->with(array("clientes" => $clientes))
		->with(array("articulos" => $articulos))
		->with(array("cotizacion" => $ac))
		->with(array("ccc" => $cotizacion))
		->with(array("proveedores" => $proveedores))
		->with(array("cc" => $cc))
		->with(array("proveedor1" => $proveedor1));
	}


	public function cotizacionEditar () {
	
			$c = Cotizacion::find(Input::get("id"));
			$c->cliente 				= Input::get("cliente");
			$c->articulo 				= Input::get("articulo");
			$c->descripcion			    = Input::get("descripcion");
			$c->costo_unitario 			= Input::get("costo_unitario");
			$c->margen_utilidad 		= Input::get("margen_utilidad");
			$c->precio_unitario 		= Input::get("precio_unitario");
			$c->cantidad			 	= Input::get("cantidad");
			$c->subtotal 				= Input::get("subtotal");
			//$c->descuento 				= Input::get("descuento");
			//$c->subtotal_descuento 		= Input::get("subtotal_descuento");
			$c->iva 				    = Input::get("iva");
			$c->total 					= Input::get("total");
			$c->observaciones 			= Input::get("observaciones");
			$c->costoimpresion 			= Input::get("costoimpresion");		
			$c->tipoimpresion 			= Input::get("impresion");	
			$c->infoimpresion 			= Input::get("infoimpresion");
			$c->save();
			return Redirect::route("cotizacion");
	
	}


	public function cotizacionEliminar ($id) {
		Cotizacion::find($id)->delete();
		return Redirect::route("cotizacion");
	}




public function cotizacionCompraForm($id)
	{
		$cc = Compras::find($id);
		$proveedor = Proveedor::find($cc->proveedor);
		$articulos = ArticuloCompra::where("compra","=",$id)
										 ->join("articulos","articulos.id","=","articulo_compra.articulo")
										 ->select(DB::raw("articulo_compra.*,articulos.nombre,articulos.imagen"))
										 ->get();
		$almacenes = Almacen::all();
		return View::make("dashboard.compras.comprasArticulos")->with(array("proveedor" => $proveedor,"cc" => $cc,"almacenes" => $almacenes,"articulos" => $articulos,"id" => $id));
	}

	public function cotizacionPedirForm ($id) {
		return View::make("dashboard.cotizacion.pedir")->with(array("id" => $id));
	}
	public function cotizacionPedirSave () {

		
		$vendedor=Vendedor::where("user_id","=",Auth::user()->id)->first();
		$id = Input::get("id");
		$data = Input::all();
		$reglas = array(
				//"anticipo" => "required",
				//"orden"    => "required",
				"fecha"    => "required"
			);
		$mensaje = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensaje);
		if($validar->passes()) {
		$c = Cotizacion::find($id);
			$name = (!empty(Input::file("orden"))) ? Input::file("orden")->getClientOriginalName() : "";
			$anticipo = (!empty(Input::file("anticipo"))) ? Input::file("anticipo")->getClientOriginalName() : "";
			$num = count(Input::file("logotipo"));
			 
			//$articulos = Articulos::where("id","=",$c->articulo)->first();
			$articulos1 = Articulocotizaciones::where("cotizacion","=",$id)
											 ->groupBy("proveedor_id")
											 ->get();
			$c->orden = $name;
			$c->anticipo = $anticipo;
			$c->fecha_pedido = Input::get("fecha");
			if($c->status == 1)
			{$c->status = 2;}
			if($c->status == 3)
			{$c->status = 4;}

			$c->save();

			if (Input::file("orden") != null) {
				Input::file("orden")->move("../ordenes/".$id,$name);
			}
			if(Input::file("anticipo") != null) {
				Input::file("anticipo")->move("../ordenes/".$id,$anticipo);
			}

			/*if($num > 0)	{
				$ob = Input::get("observaciones");
				$lo = Input::file("logotipo");
				for ($i = 0; $i < $num; $i++) {
					if(!empty($lo[$i])) {
						$pl = new Logotipos();
						$pl->pedido_id = $id;
						$pl->imagen = $lo[$i]->getClientOriginalName();
						$pl->observacion = $ob[$i];
				  		$pl->save();
				  		$lo[$i]->move("logotipos/".$id,$lo[$i]->getClientOriginalName());
				  	}
				}
			}*/

			foreach ($articulos1 as $art) {
			$articulos = Articulocotizaciones::where("cotizacion","=",$id)
											 ->where("proveedor_id","=",$art->proveedor_id)
											 ->get();
			$compra = new Compras();
			if (empty($vendedor)) {
			$compra->vendedor= $c->vendedor;				
			//$compra->proveedor = $articulos->proveedor;
			//$compra->articulo  = $c->articulo;
			$compra->cotizacion = $id;
			$compra->almacen_id = 1;
			//$compra->descripcion = $c->descripcion;
			//$compra->precio_unitario = $c->precio_unitario;
			//$compra->cantidad = $c->cantidad;
			//$compra->subtotal = $c->subtotal;
			//$compra->iva 	  = $c->iva;
			//$compra->total    = $c->total;
			$compra->orden = $name;
			$compra->anticipo = $anticipo;
			$compra->proveedor = $art->proveedor_id;
			$compra->fecha 	  = date("d-m-Y");
			$compra->status   = 1;
			$compra->save();
			
			foreach($articulos as $a){
				$ac = new ArticuloCompra();
				$ac->compra = $compra->id;
				$ac->articulo = $a->articulo;       
				$ac->cantidad = $a->cantidad;       	
				$ac->descripcion = $a->descripcion;
				$ac->color = $a->color;    
				$ac->costo_unitario  = $a->costo_unitario; 	
				$ac->margen_utilidad = $a->margen_utilidad; 
				$ac->precio_unitario =  $a->precio_unitario; 
				$ac->costoimpresion  = $a->costoimpresion;
				$ac->tipoimpresion   = $a->tipoimpresion;
				$ac->infoimpresion   = $a->infoimpresion;
				$ac->total = $a->total;
				$ac->save();
				$this->sub = $a->precio_unitario*$a->cantidad;
			}
			
			//if ($this->estatus == 1) {
				$vv = Vendedor::find($c->vendedor);
				
				if(!empty($vv)){
					$n = $vv->meta_logro + $this->sub;
					$vv->meta_logro = $n;
					$vv->save();
					//$this->estatus = 2;
				}	
			  //}
			
			} else { 
			$compra->vendedor= $vendedor->id;				
			//$compra->proveedor = $articulos->proveedor;
			//$compra->articulo  = $c->articulo;
			$compra->almacen_id = 1;
			$compra->cotizacion = $id;
			//$compra->descripcion = $c->descripcion;
			//$compra->precio_unitario = $c->precio_unitario;
			//$compra->cantidad = $c->cantidad;
			//$compra->subtotal = $c->subtotal;
			//$compra->iva 	  = $c->iva;
			//$compra->total    = $c->total;
			$compra->orden = $name;
			$compra->anticipo = $anticipo;
			$compra->proveedor = $art->proveedor_id;
			$compra->fecha 	  = date("d-m-Y");
			$compra->status   = 1;
			$compra->save();
			
			foreach($articulos as $a){
				$ac = new ArticuloCompra();
				$ac->compra = $compra->id;
				$ac->articulo = $a->articulo;       
				$ac->cantidad = $a->cantidad;       	
				$ac->descripcion = $a->descripcion;
				$ac->color = $a->color;    
				$ac->costo_unitario = $a->costo_unitario; 	
				$ac->margen_utilidad = $a->margen_utilidad; 
				$ac->precio_unitario =  $a->precio_unitario; 
				$ac->costoimpresion  = $a->costoimpresion;
				$ac->tipoimpresion   = $a->tipoimpresion;
				$ac->infoimpresion   = $a->infoimpresion;
				$ac->total = $a->total;
				$ac->save();
				$this->sub = $a->precio_unitario*$a->cantidad;
			}  
			
				//if($this->estatus == 1) {
				$vv = Vendedor::find($c->vendedor);
				
				if(!empty($vv)){
					
					$n = $vv->meta_logro + $this->sub;
					$vv->meta_logro = $n;
					$vv->save();
					//$this->estatus = 2;
					
				}
			//}
			
		} 	
	  }
		return Redirect::to(URL::route('compras'));
	} else {
		return Redirect::to(URL::route('cotizacionPedirForm')."/".$id)->withErrors($validar);
	}
 }

	public function getArticulos () {
		
	$eleccion= Input::get('eleccion');
	

	$articulos = Articulos::all();			
			
	return Response::json($articulos);		

	}
	public function articulosCotizacion ($id) {
		$articulos = Articulocotizaciones::where("cotizacion","=",$id)
										 ->join("articulos","articulos.id","=","articulo_cotizacion.articulo")
										 ->select(DB::raw("articulo_cotizacion.*,articulos.nombre"))
										 ->get();
		return View::make("dashboard.cotizacion.cotizacionArticulos")->with(array("articulos" => $articulos));
	}
	public function articulosCotizacionEditar () {
		$data   = Input::all();
		$reglas = array(
				"cliente"         => "required",
				"articulo"        => "required",
				"descripcion"     => "required",
				"color"     	  => "required",
				"costo_unitario"  => "required",
				"margen_utilidad" => "required",
				"precio_unitario" => "required",
				"cantidad"		  => "required",
				"subtotal"    	  => "required",
				"iva"			  => "required",
				"total" 		  => "required"
			); 
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$mensajes,$reglas);
		$id  = Input::get("id");
		$cid = Input::get("cid");
		if($validar->passes()) {
			$a = Articulocotizaciones::find($id);
			$a->articulo       	= Input::get("articulo");
			$a->cantidad       	= Input::get("cantidad");
			$a->descripcion    	= Input::get("descripcion");
			$a->color    	    = Input::get("colorh");
			$a->costo_unitario 	= Input::get("costo_unitario");
			$a->costoimpresion  = Input::get("costoimpresion");
			$a->margen_utilidad = Input::get("margen_utilidad");
			$a->precio_unitario = Input::get("precio_unitario");
			$a->total 			= Input::get("total");
			$a->tipoimpresion   = Input::get("impresion");
			$a->infoimpresion   = Input::get("infoimpresion");
			$a->placas 			= Input::get("placas");
			$a->save();
			return Redirect::to(URL::route('articulos.cotizacion')."/".$cid);
 		} else {
 			return Redirect::to(URL::route("articulos.cotizacion.editar")."/".$id);
		}
	}
	public function cuentasCobrar () {
		$c = Cotizacion::where("status","=",4)
						->join("clientes","clientes.id","=","cotizacion.cliente")
						->join("articulo_cotizacion","articulo_cotizacion.cotizacion","=","cotizacion.id")
						->groupBy("articulo_cotizacion.cotizacion")
						->select(DB::raw("cotizacion.*,clientes.nombre,sum(articulo_cotizacion.total) as total"))
						->get();
		return View::make("dashboard.cotizacion.cuentasCobrar")->with("cotizacion",$c);
	}
	public function cuentaCobrarForm ($id) {
		$c = Cotizacion::where("cotizacion.id","=",$id)
					   ->join("articulo_cotizacion","articulo_cotizacion.cotizacion","=","cotizacion.id")
					   ->select(DB::raw('cotizacion.pagado,sum(articulo_cotizacion.total) as total'))
					   ->first();
		return View::make("dashboard.cotizacion.cuentaCobrarForm")->with(array("c" => $c,"id" => $id));
	}
	public function cuentaCobrar () {
		$data = Input::all();
		$reglas = array(
				"monto" => "required|numeric"
			);
		$mensajes = array(
				"required" => "Campo requerido",
				"numeric"  => "Solo valores numericos"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		$id = Input::get("id");
		if ($validar->passes()) {
			$monto = Input::get("monto");
			$c = Cotizacion::find($id);
			$c->pagado = ($c->pagado+$monto);
			$c->save();
			return Redirect::to(URL::route('cuentasCobrar'));
		} else {
			return Redirect::to(URL::route('cuentaCobrarForm')."/".$id)->withErrors($validar);
		}
	}
}