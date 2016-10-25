<?php

class ComprasController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('compras', array('only' => 'compras') );

    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


    public function compras()
    {
 		$usuario=Vendedor::where("user_id","=",Auth::user()->id)->first();
 		$resultado=DB::table('assigned_roles')->where('user_id','=',Auth::user()->id)->first();

       if ($resultado->role_id==2) {
        $compras  = Compras::where("compras.vendedor","=",$usuario->id)
                             ->join("articulo_compra","articulo_compra.compra","=","compras.id")
        					 ->join("articulos","articulos.id","=","articulo_compra.articulo")
        					 ->join("almacenes","almacenes.id","=","compras.almacen_id")
        					 ->join("vendedores","vendedores.id","=","compras.vendedor")
        					 ->join("cotizacion","cotizacion.id","=","compras.cotizacion")
        					 ->join("clientes","clientes.id","=","cotizacion.cliente")
        					 ->join("proveedores","proveedores.id","=","compras.proveedor")
        					 ->groupBy("articulo_compra.compra")
        					 ->select(DB::raw("almacenes.nombre as almacen_nombre, proveedores.nombre as pn,clientes.nombre as cn,cotizacion,compras.anticipo,compras.orden,vendedores.nombre as vn,compras.*,sum(articulo_compra.cantidad) as can,sum(articulo_compra.precio_unitario) as totala"))
        					 ->get();
        $maquileros = Maquilero::all();

		if($compras->count() >0){
		foreach ($compras as $compra) {
			$proveedor = Proveedor::where("id","=",$compra->proveedor)->get();
			$articulos = Articulos::where("id","=",$compra->articulo)->get();
			$armacenes = Almacen::where("id","=",$compra->almacen_id)->get();
			 }

		return View::make("dashboard.compras.compras")
		->with(array("compras" => $compras))
		->with(array("proveedor" => $proveedor))
		->with(array("almacenes" => $armacenes))
		->with(array("articulos" => $articulos))
		->with(array("maquileros" => $maquileros))
		->with(array("resultado" => $resultado));

		}

		else{

		/*return View::make("dashboard.compras.compras")
		->with(array("compras" => $compras));*/
		return Redirect::to(URL::route("cotizacion"));

		}
	 }

	 else{
	 	$compras    = Compras::join("articulo_compra","articulo_compra.compra","=","compras.id")
        					 ->join("articulos","articulos.id","=","articulo_compra.articulo")
        					 ->join("vendedores","vendedores.id","=","compras.vendedor")
        					 ->join("almacenes","almacenes.id","=","compras.almacen_id")
        					 ->join("cotizacion","cotizacion.id","=","compras.cotizacion")
        					 ->join("clientes","clientes.id","=","cotizacion.cliente")
        					 ->join("proveedores","proveedores.id","=","compras.proveedor")
        					 ->groupBy("articulo_compra.compra")
        					 ->select(DB::raw("almacenes.nombre as almacen_nombre, proveedores.nombre as pn,clientes.nombre as cn,cotizacion,compras.anticipo,compras.orden,vendedores.nombre as vn,compras.*,sum(articulo_compra.cantidad) as can,sum(articulo_compra.precio_unitario) as totala"))
        					 ->get();
        $maquileros = Maquilero::all();

		if($compras->count() >0){
		foreach ($compras as $compra) {
			$proveedor = Proveedor::where("id","=",$compra->proveedor)->get();
			$articulos = Articulos::where("id","=",$compra->articulo)->get();
			$armacenes = Almacen::where("id","=",$compra->almacen_id)->get();
			 }

		return View::make("dashboard.compras.compras")
		->with(array("compras" => $compras))
		->with(array("proveedor" => $proveedor))
		->with(array("almacenes" => $armacenes))
		->with(array("articulos" => $articulos))
		->with(array("maquileros" => $maquileros))
		->with(array("resultado" => $resultado));


		}

		else{

		return View::make("dashboard.compras.compras")
		->with(array("compras" => $compras));

		}



	 }
	}


	public function comprasMaquilarForm ($id) {
		$maquileros = Maquilero::all();
		$datos= $id;
		$c = ArticuloCompra::where("compra","=",$id)->sum("costoimpresion");

		return View::make("dashboard.compras.cmaquilarForm")
			->with(array("maquileros" => $maquileros))
			->with(array("c" => $c))
			->with(array("datos" => $datos));

	}


	public function cmaquilarSave () {
		
			$id   = Input::get("id");
			$mqid = Input::get("maquilero");
			$mq   = Maquilero::find($mqid);

			$c = new ComprasMaquilero();
			$c->id_maquilero           = Input::get("maquilero");
			$c->costo 				   = Input::get("costo");
			$c->fecha       		   = Input::get("fechaentrega");
			$c->id_compras       	   = Input::get("id");
			if(Input::file('file') != null) {
				$name = Input::file("file")->getClientOriginalName();
				Input::file("file")->move("maquilar/".$id."/",$name);
				$c->file = $name;
			}
			if($c->save()){
			$cc = Compras::find($id);
			$cc->maquila_status = 2;
			$cc->save();	
			return View::make("dashboard.compras.enviarEmailMaquila")->with(array("cm" => $c->id,"mq" => $mq,"id" => $id,"file" => $c->file));
			/*return Redirect::route("compras")
                    ->with('msg', 'Datos guardados con exito.')
                    ->with('class', 'success'); }*/
                }

                    else {
			Input::flash();
			return Redirect::route("compras")->withErrors($validar);
		}
		} 

	public function comprasForm () {
		$proveedores=Proveedor::all();
		$articulos = Articulos::all();
		$almacenes = Almacen::all();
		return View::make("dashboard.compras.comprasForm")->with(array("proveedores" => $proveedores))
		->with(array("articulos" => $articulos))
		->with("almacenes",$almacenes);
	}


	public function comprasSave () {
			$data = Input::all();
			$reglas = array(
			 		"proveedor" => "required",
			 		//"almacen" => "required",
			 		"articulo"  => "required",
			 		"descripcion" => "required",
			 		//"color" => "required",
			 		//"precio_unitario" => "required|min:1",
			 		"cantidad" => "required|min:1",
			 		"subtotal" => "required",
			 		//"descuento" => "required",
			 		//"subtotal_descuento" => "required",
			 		"iva" => "required",
			 		"total" => "required",
			 		//"observaciones" => "required"
 				);
			$mensajes = array("proveedor.required" => "Requerido");
			$validar = Validator::make($data,$reglas,$mensajes);
			if($validar->passes()) {
			$c = new Compras();
			$c->vendedor 				= Auth::user()->id;
			$c->proveedor 				= Input::get("proveedor");
			$c->articulo 				= Input::get("articulo");
			$c->almacen_id				= Input::get("almacen");
			$c->descripcion			    = Input::get("descripcion");
			$c->color			  		= Input::get("color");
			$c->precio_unitario 		= Input::get("precio_unitario");
			$c->cantidad			 	= Input::get("cantidad");
			$c->subtotal 				= Input::get("subtotal");
			$c->descuento 				= Input::get("descuento");
			$c->subtotal_descuento 		= Input::get("subtotal_descuento");
			$c->iva 				    = Input::get("iva");
			$c->total 					= Input::get("total");
			//$c->fecha 					=  date("Y-m-d");
			$c->fecha 					=  date("d-m-Y g:i:s"); 
			$c->status 					= 1; 
			$c->observaciones 			= Input::get("observaciones");
			$images= Input::file('images');

			if ($images) {

				foreach($images as $image) {

					if ($image) {

										$public_filename= $image->getClientOriginalName();
										$filename 		= uniqid().'_'.str_random(6).'_'.$image->getClientOriginalName();


										$c->filename_public	= $public_filename;
										$c->filename			= $filename;
										$destinationPath= public_path().'/uploads/';
										$image->move($destinationPath, $c->filename);


								}
					}
				}

			if($c->save()){
			 //cotizacionCompraForm
			 return Redirect::to(URL::route("comprasMostrarForm")."/".$c->id)
                    ->with('msg', 'Datos de la compra guardados con éxito.')
                    ->with('class', 'success');


			}else {

			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron editados.')
                    ->with('class', 'error');

		}
		} else {
			$id  = Input::get('id');
			return Redirect::to(URL::route('comprasForm'))->withErrors($validar);
		}
	}

	public function comprasSaveCotizacion () {
		$data = Input::all();
			$reglas = array(
			 		"proveedor" => "required",
			 		//"almacen" => "required",
			 		"articulo"  => "required",
			 		"descripcion" => "required",
			 		//"color" => "required",
			 		//"precio_unitario" => "required|min:1",
			 		"cantidad" => "required|min:1",
			 		"subtotal" => "required",
			 		//"descuento" => "required",
			 		//"subtotal_descuento" => "required",
			 		"iva" => "required",
			 		"total" => "required",
			 		//"observaciones" => "required"
 				);
			$mensajes = array("proveedor.required" => "Requerido");
			$validar = Validator::make($data,$reglas,$mensajes);
			$id = Input::get("id");
			if($validar->passes()) {
			$c = Compras::find($id);
			$c->proveedor 				= Input::get("proveedor");
			$c->articulo 				= Input::get("articulo");
			$c->almacen_id 				= Input::get("almacen");
			$c->descripcion			    = Input::get("descripcion");
			$c->color			  		= Input::get("color");
			//$c->precio_unitario 		= Input::get("precio_unitario");
			$c->cantidad			 	= Input::get("cantidad");
			$c->subtotal 				= Input::get("subtotal");
			//$c->descuento 				= Input::get("descuento");
			//$c->subtotal_descuento 		= Input::get("subtotal_descuento");
			$c->iva 				    = Input::get("iva");
			$c->total 					= Input::get("total");
//			$c->fecha 					=  date("Y-m-d");
			$c->fecha 					=  date("d-m-Y g:i:s"); 
			$c->status 					= 2; 
			$c->save();
			return Redirect::to(URL::route('compras'));
		} else {
			return Redirect::to(URL::route('cotizacionCompraForm'))->withErrors($validar);
		}
	}

	public function comprasMostrarForm($id)
	{
		$compras = Compras::where("compras.id","=",$id)
						  ->join("almacenes","almacenes.id","=","compras.almacen_id")
						  ->select(DB::raw("proveedor,articulo,almacen_id,descripcion,color,precio_unitario,cantidad,subtotal,descuento,subtotal_descuento,iva,total,fecha,observaciones,filename_public,filename,compras.id as id,persona_contacto,nombre,pais,municipio,colonia,calle,email,telefono,colonia,numinterior,cp"))
						  ->get();

		$proveedor = Proveedor::where("id","=",$compras[0]['proveedor'])->first();
		$articulos = ArticuloCompra::where("compra","=",$id)->get();

		return View::make("dashboard.compras.comprasMostrarForm")
		->with(array("compras" => $compras))
		->with(array("proveedor" => $proveedor))
		->with(array("articulos" => $articulos))
		->with(array("id" => $id));
	}

	public function comprasmodificarForm(){
		$id = Input::get("id");
		$compras = Compras::where('id','=',$id)
		->join('proveedores','proveedores.id','=','compras.proveedor')
		->get();
		//->get()->toArray();
		  $provee = Proveedor::where('id','=',$compras->proveedor)->toArray();
			//$articulo = Articulos::first()->get()->toArray();
			  //$almacen = Almacen::first()->get()->toArray();

        return Response::json(array(
                        'success'   => true,
                        'compras'   => $compras,
                        'provee' => $provee
                        //'articulo' => $articulo,
                       // 'almacen' => $almacen
                        ),200);

	}

	public function comprasEditarForm ($idz) {
		$compras = Compras::find($id);
			$provee = Proveedor::first();
				$articulo = Articulos::first();
					$almacen = Almacen::first();

		$proveedores = Proveedor::all();
		$articulos = Articulos::all();
		$almacenes = Almacen::all();
		return View::make("dashboard.compras.comprasFormEditar")
		->with(array("compras" => $compras))
		->with(array("proveedores" => $proveedores))
		->with(array("provee" => $provee))
		->with(array("almacenes" => $almacenes))
		->with(array("almacen" => $almacen))
		->with(array("articulo" => $articulo))
		->with(array("articulos" => $articulos));
	}


	public function comprasEditar () {
		$c = Compras::find(Input::get("id"));
			$c->proveedor 				= Input::get("proveedor");
			$c->almacen_id 				= Input::get("almacen");
			$c->articulo 				= Input::get("articulo");
			$c->descripcion			    = Input::get("descripcion");
			$c->color			  		= Input::get("color");
			$c->precio_unitario 		= Input::get("precio_unitario");
			$c->cantidad			 	= Input::get("cantidad");
			$c->subtotal 				= Input::get("subtotal");
			$c->descuento 				= Input::get("descuento");
			$c->subtotal_descuento 		= Input::get("subtotal_descuento");
			$c->iva 				    = Input::get("iva");
			$c->total 					= Input::get("total");
			//$c->fecha 					=  date("Y-m-d");
			$c->fecha 					=  date("d-m-Y g:i:s"); 
			$c->observaciones 			= Input::get("observaciones");
			$c->save();
			return Redirect::route("compras");
	}




	public function comprasEliminar ($id) {
		Compras::find($id)->delete();
		return Redirect::route("compras");
	}

public function email () {
      Mail::send('emails.compras', array("proveedor" => $this->nombre,"msj" => nl2br($this->msj)), function($message)
      {
          //$message->from('Testphp001@gmail.com', 'test');
          if (empty($this->cc)) {
              $message->to($this->mail, $this->nombre)->subject("OC#".$this->id); 
              }
          else{
               $message->to($this->mail, $this->nombre)->subject("OC#".$this->id)->cc($this->cc);
               } 
          $message->from($this->mail, 'Promosmile');
          $message->attach("../pdf/compras/".$this->id.".pdf",array("as" => "Compra#".$this->id.".pdf","mime"=> "application/pdf"));
      });
    }
    public function guardarPdf ($id,$vista) {
      if (!is_dir("../pdf/compras")) {
          mkdir("../pdf/compras",0755, true);
      }
      File::put("../pdf/compras/".$id.".pdf", PDF::load(utf8_decode($vista), 'A4', 'portrait')->output());
      //$vista = (string) View::make("dashboard.ventas.email");
      //return PDF::load(utf8_decode($vista), 'A4', 'portrait')->show();
    }



public function enviarEmailProveedor()
	{
	   $id=Input::get("id");
	   $c     =    Compras::where("compras.id","=",$id)
						  ->join("almacenes","almacenes.id","=","compras.almacen_id")
						  ->select(DB::raw("proveedor,articulo,almacen_id,descripcion,color,precio_unitario,cantidad,subtotal,descuento,subtotal_descuento,iva,total,fecha,observaciones,filename_public,filename,compras.id as id,persona_contacto,nombre,pais,municipio,colonia,calle,email,telefono,colonia,numinterior,cp"))
						  ->get();
		$articulos = ArticuloCompra::where("compra","=",$id)->get();
	   	$almacen= Almacen::where("id","=",$c[0]['proveedor'])->first();
		$proveedor = Proveedor::where("id","=",$c[0]['proveedor'])->first();
		//$descuento= $c->subtotal - $c->subtotal_descuento;
      	$emails = ProveedorEmail::where("proveedor_id","=",$proveedor->id)->select(array("email"))->get();
      	$array = array_pluck($emails, 'email');

      $vista = (string) View::make("dashboard.compras.comprasPdf")->with(array("articulos" => $articulos,"compras" => $c,"proveedor" => $proveedor, "almacen" => $almacen));
	  //return PDF::load(utf8_decode($vista), 'A4', 'portrait')->show();
	  //$vista = "<h1>Compra...</h1>";
	  $this->id = $c[0]['id'];
      $this->mail = (count($array) > 0) ? $array : $proveedor->email;
      $this->nombre = $proveedor->nombre;
      $this->subject = Input::get("asunto");
      $this->msj = Input::get("mensaje");
      $this->cc = Input::get("cc");

      $this->guardarPdf($c[0]['id'],$vista);
      $this->email();
      $cc = Compras::find($id);
      if ($cc->status < 3) {
      	$cc->status = 3;
      	$cc->save();
  	  }
           return Redirect::to(URL::route("compras"))
                    ->with('msg', 'Datos enviados.')
                    ->with('class', 'success');
 }


public function enviarEmailMaquilero()
	{
	  $this->id = Input::get("id");
      $this->mail = Input::get("email");
      $this->nombre = Input::get("nombre");
      $this->subject = Input::get("asunto");
      $this->msj = Input::get("mensaje");
      $this->cc = Input::get("cc");
      $this->file = Input::get("file");
      $this->ruta = "maquilar/".$this->id."/".$this->file;

      $file = $this->ruta;
      $finfo = finfo_open(FILEINFO_MIME_TYPE); 
      $this->mime = finfo_file($finfo, $file);

      $this->emailMaquila();
           return Redirect::to(URL::route("compras"))
                    ->with('msg', 'Datos enviados.')
                    ->with('class', 'success');
 }
public function emailMaquila () {
      Mail::send('emails.compras', array("proveedor" => $this->nombre,"msj" => $this->msj), function($message)
      {
          //$message->from('Testphp001@gmail.com', 'test');
          if (empty($this->cc)) {
              $message->to($this->mail, $this->nombre)->subject($this->subject); 
              }
          else{
               $message->to($this->mail, $this->nombre)->subject($this->subject)->cc($this->cc);
               } 
          $message->from($this->mail, 'Promosmile');
          $message->attach($this->ruta,array("as" => $this->file,"mime"=> $this->mime));
      });
    }

	public function comprasMostrarPdf($id) {

		$compras = Compras::where("compras.id","=",$id)
						  ->join("almacenes","almacenes.id","=","compras.almacen_id")
						  ->select(DB::raw("proveedor,articulo,almacen_id,descripcion,color,precio_unitario,cantidad,subtotal,descuento,subtotal_descuento,iva,total,fecha,observaciones,filename_public,filename,compras.id as id,persona_contacto,nombre,pais,municipio,colonia,calle,email,telefono,colonia,numinterior,cp"))
						  ->get();
		$articulos = ArticuloCompra::where("compra","=",$id)->get();
		$proveedor = Proveedor::find($compras[0]['proveedor']);
		$descuento = $compras[0]['subtotal'] - $compras[0]['subtotal_descuento'];
		$vista = View::make("dashboard.compras.comprasPdf")->with(array(
					"compras"   => $compras,
					"proveedor" => $proveedor,
					"articulos" => $articulos 
				 ));
    	return PDF::load($vista, 'letter', 'portrait')->show("OC#".$id);

	}
	public function comprasRecibir ($id) {
		$c = Compras::find($id);
		$c->status = 4;
		$c->save();
		return Redirect::to(URL::route('compras'));
	}
	public function comprasEntregado ($id) {
		$c = Compras::find($id);
		$c->status = 6;
		$c->save();
		return Redirect::to(URL::route('compras'));
	}
	public function comprasComrar ($id) {
		$c = Compras::find($id);
		$c->status = 2;
		$c->save();
		return Redirect::to(URL::route('compras'));
	}
	public function compraEditarForm ($id) {
	
		$clientes = Cliente::all();
		$ac = ArticuloCompra::find($id);
		$proveedores = Proveedor::all();
		$cotizacion = Compras::find($ac->compra);
		$articulos = Articulos::where("proveedor","=",$cotizacion->proveedor)->get();
		$proveedor1 = Proveedor::find($cotizacion->proveedor);

		$cc = Color::all();
		return View::make("dashboard.compras.comprasFormEditar")
		->with(array("clientes" => $clientes))
		->with(array("articulos" => $articulos))
		->with(array("cotizacion" => $ac))
		->with(array("ccc" => $cotizacion))
		->with(array("proveedores" => $proveedores))
		->with(array("cc" => $cc))
		->with(array("proveedor1" => $proveedor1));;
		
	}
	public function articulosCompraEditar () {
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
			$a = ArticuloCompra::find($id);
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
			$a->placas		    = Input::get("placas");
			$a->save();
			return Redirect::to(URL::route('cotizacionCompraForm')."/".$cid);
 		} else {
 			return Redirect::to(URL::route("compraEditarForm")."/".$id);
		}
	}
	public function asignarAlmacen() {
		$id = Input::get("id");
		$c  = Compras::find($id);
		$c->almacen_id = Input::get("almacen");
		$c->save();
		return Response::json(array(
				"estado" => 1
			));
	}
	public function MostrararOrden($compra) {
	   $c = Compras::find($compra);
	   $file = '../ordenes/'.$c->cotizacion."/".$c->orden;
       $finfo = finfo_open(FILEINFO_MIME_TYPE); 
       $mime = finfo_file($finfo, $file);
       $content = file_get_contents( $file ) ;
       return Response::make( $content , 200 , array( 'content-type' => $mime ) ) ;
	}
	public function MostrararAnticipo($compra) {
	   $c = Compras::find($compra);
	   $file = '../ordenes/'.$c->cotizacion."/".$c->anticipo;
       $finfo = finfo_open(FILEINFO_MIME_TYPE); 
       $mime = finfo_file($finfo, $file);
       $content = file_get_contents( $file ) ;
       return Response::make( $content , 200 , array( 'content-type' => $mime ) ) ;
	}
	public function vistaPrevia($id) {
	   $c = ComprasMaquilero::find($id);
	   $file = 'maquilar/'.$c->id_compras."/".$c->file;
       $finfo = finfo_open(FILEINFO_MIME_TYPE); 
       $mime = finfo_file($finfo, $file);
       $content = file_get_contents( $file ) ;
       return Response::make( $content , 200 , array( 'content-type' => $mime ) ) ;
	}
	public function logotipos ($id) {
		$l = Logotipos::where("pedido_id","=",$id)->get();
		return View::make("dashboard.compras.logotipos")->with(array("l" => $l,"id" => $id));
	}
	public function addLogo () {
		$num = count(Input::file("logotipo"));
		$id = Input::get("id");
		if($num > 0)	{
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
      			$this->id = $id;
      			Mail::send('emails.logotipos', array("id" => $this->id), function($message)
      			{
          			
               		$message->to("diseno@promosmile.com.mx", "Hugo Ramirez")->subject("Logotipos");
          			
      			});
				return Redirect::to(URL::route('logotipo')."/".$id);
			} else {
				return Redirect::to(URL::route('logotipo')."/".$id);
			}
	}
	public function descargarLogo ($p,$l) {
		$lo = Logotipos::find($l);
		$ruta = "logotipos/".$p."/".$lo->imagen;
		return Response::download($ruta);
	}
	public function eliminarLogtipo ($id) {
		$l = Logotipos::find($id);
		$id = $l->pedido_id;
		$l->delete();
		return Redirect::to(URL::route('logotipo')."/".$id);
	}
	public function cuentasPagar () {
		$compras  = Compras::where("compras.status",">=",3)
                             ->join("articulo_compra","articulo_compra.compra","=","compras.id")
        					 ->join("articulos","articulos.id","=","articulo_compra.articulo")
        					 ->join("vendedores","vendedores.id","=","compras.vendedor")
        					 ->join("cotizacion","cotizacion.id","=","compras.cotizacion")
        					 ->join("clientes","clientes.id","=","cotizacion.cliente")
        					 ->join("proveedores","proveedores.id","=","compras.proveedor")
        					 ->groupBy("articulo_compra.compra")
        					 ->select(DB::raw("compras.pagado,proveedores.nombre as pn,clientes.nombre as cn,cotizacion,compras.anticipo,compras.orden,vendedores.nombre as vn,compras.*,sum(articulo_compra.cantidad) as can,sum(articulo_compra.precio_unitario) as totala"))
        					 ->get();
        return View::make("dashboard.compras.cuentasPagar")->with(array("compras" => $compras));
	}
	public function cuentaPagarForm ($id) {
		$c = Compras::where("compras.id","=",$id)
					->join("articulo_compra","articulo_compra.compra","=","compras.id")
					->select(DB::raw("compras.pagado,sum(articulo_compra.cantidad) as cantidad,sum(articulo_compra.precio_unitario) as total"))
					->first();
		return View::make("dashboard.compras.cuentaPagarForm")->with(array("c" => $c,"id" => $id));			
	}
	public function cuentaPagar () {
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
			$c = Compras::find($id);
			$c->pagado = ($c->pagado+$monto);
			$c->save();
			return Redirect::to(URL::route('cuentasPagar'));
		} else {
			return Redirect::to(URL::route('cuentaPagarForm')."/".$id)->withErrors($validar);
		}
	}
		public function entregas () {
		$compras  = Compras::where("compras.status",">=",4)
                             ->join("articulo_compra","articulo_compra.compra","=","compras.id")
        					 ->join("articulos","articulos.id","=","articulo_compra.articulo")
        					 ->join("vendedores","vendedores.id","=","compras.vendedor")
        					 ->join("cotizacion","cotizacion.id","=","compras.cotizacion")
        					 ->join("clientes","clientes.id","=","cotizacion.cliente")
        					 ->join("proveedores","proveedores.id","=","compras.proveedor")
        					 ->groupBy("articulo_compra.compra")
        					 ->select(DB::raw("compras.pagado,proveedores.nombre as pn,clientes.nombre as cn,cotizacion,compras.anticipo,compras.orden,vendedores.nombre as vn,compras.*,sum(articulo_compra.cantidad) as can,sum(articulo_compra.precio_unitario) as totala"))
        					 ->get();
        return View::make("dashboard.compras.entregas")->with(array("compras" => $compras));
	}
	public function entregasFechaForm ($id) {
		return View::make("dashboard.compras.fechaForm")->with('id',$id);
	}
	public function entregasFecha () {
		$data = Input::all();
		$reglas = array(
				"fecha" => "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		$id = Input::get("id");
		if($validar->passes()) {
			$c = Compras::find($id);
			$c->fecha_entrega = Input::get('fecha');
			$c->save();
			return Redirect::to(URL::route('entregas'));
		} else {
			return Redirect::to(URL('entregasFechaForm')."/".$id)->withErrors($validar);
		}
	}
}
