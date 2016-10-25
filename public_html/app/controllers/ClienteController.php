<?php

class ClienteController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('clientes', array('only' => 'clientes'));
       
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function clientes () {
 
		
		$resultado=DB::table('assigned_roles')->where('user_id','=',Auth::user()->id)->first();
        if ($resultado->role_id==1) {
		     $clientes = Cliente::all(); 
		     return View::make("dashboard.clientes.clientes")->with(array("clientes" => $clientes,"resultado" => $resultado));
        }
        else{
        $usuario=Vendedor::where("user_id","=",Auth::user()->id)->first();
		$clientes = Cliente::where("vendedor","=",$usuario->id)->get(); 
		return View::make("dashboard.clientes.clientes")->with(array("clientes" => $clientes,"resultado" => $resultado));
	        }
	}


	public function clientesForm () {
		return View::make("dashboard.clientes.clientesForm");
	}


	public function clientesSave () {

		$usuario=Vendedor::where("user_id","=",Auth::user()->id)->first();
		$data = Input::all();
		$reglas = array(
				"nombre" => "required",
				"contacto" => "required",
				"telefono" => "required",
				"email" => "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
			$c = new Cliente();
			$c->nombre = Input::get("nombre");
			$c->persona_contacto = Input::get("contacto");
			$c->rfc = Input::get("rfc");
			$c->calle = Input::get("calle");
			$c->numinterior = Input::get("numinterior");
			$c->numexterior = Input::get("numexterior");
			$c->colonia = Input::get("colonia");
			$c->cp = Input::get("cp");
			$c->pais = Input::get("pais");
			$c->municipio = Input::get("municipio");
			$c->email = Input::get("email");
			$c->telefono = Input::get("telefono");
			$c->vendedor = $usuario->id;
			$c->save();
			if($c->save())
			{

			return Redirect::route("clientes")
                    ->with('msg', 'Datos guardados con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("clientes")->withErrors($validar);
		}

		} else {
			Input::flash();
			return Redirect::to(URL::route('clientesForm'))->withErrors($validar);
		}
	}
	public function clientesSaveNew () {
			$c = new Cliente();
			$c->nombre = Input::get("nombre");
			$c->persona_contacto = Input::get("contacto");
			$c->email = Input::get("mail");
			$c->telefono = Input::get("tlf");
			$c->save();
			$cc = Cliente::all();
			return Response::json(array(
					"cc" => $cc
				));
	}

	public function clientesMostrarForm($id)
	{
		$cliente = Cliente::find($id);
	  
		return View::make("dashboard.clientes.clientesMostrarForm")->with(array("cliente" => $cliente));
	}

	public function clientesHistorial ($id) 
	{
		$cliente = Cliente::find($id);
		$cotizacion = Cotizacion::where("cliente","=",$id)
								->join("articulo_cotizacion","articulo_cotizacion.cotizacion","=","cotizacion.id")
								->groupBy("articulo_cotizacion.cotizacion")
								->select(DB::raw("cotizacion.*,sum(articulo_cotizacion.total) as total"))
								->get(); 
		//$compras = Compras::where("cliente","=",$id)->get(); 
		$productos = Articulos::all();

		return View::make("dashboard.clientes.clientesHistorial")->with(array("cotizacion" => $cotizacion))
																->with(array("cliente" => $cliente));	
																//->with(array("compras" => $compras));													
	}

	public function clientesEditarForm ($id) {
		$cliente = Cliente::find($id);
		return View::make("dashboard.clientes.clientesFormEditar")->with(array("cliente" => $cliente));
	}


	public function clientesEditar () {
		$data = Input::all();
		$reglas = array(
				"nombre" => "required",
				"contacto" => "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
			$c = Cliente::find(Input::get("id"));
			$c->nombre = Input::get("nombre");
			$c->persona_contacto = Input::get("contacto");
			$c->rfc = Input::get("rfc");
			$c->calle = Input::get("calle");
			$c->numinterior = Input::get("numinterior");
			$c->numexterior = Input::get("numexterior");
			$c->colonia = Input::get("colonia");
			$c->cp = Input::get("cp");
			$c->pais = Input::get("pais");
			$c->municipio = Input::get("municipio");
			$c->email = Input::get("email");
			$c->telefono = Input::get("telefono");
			if($c->save())

			{

			return Redirect::route("clientes")
                    ->with('msg', 'Datos de cliente editados con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("clientes")->withErrors($validar);
		}

		} 
	}
	public function clientesEliminar ($id) {
		Cliente::find($id)->delete();
		return Redirect::route("clientes");
	}
}