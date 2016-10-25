<?php  
class AlmacenController extends Controller {
	public function almacenCrearForm () {
		return View::make("dashboard.almacenes.almacenCrearForm");
	}
	public function almacenCrear () {
	$data = Input::all();
		$reglas = array(
				"nombre" => "required",
				"contacto" => "required",
				"rfc" => "required",
				"calle" => "required",
				"numinterior" => "required",
				//"numexterior" => "required",
				"colonia" => "required",
				//"cp" => "required",
				"pais" => "required",
				"municipio" => "required",
				"email" =>  "required",
				"telefono" => "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
			$c = new Almacen();
			$c->nombre           = Input::get("nombre");
			$c->persona_contacto = Input::get("contacto");
			$c->rfc              = Input::get("rfc");
			$c->calle            = Input::get("calle");
			$c->numinterior      = Input::get("numinterior");
			$c->numexterior      = Input::get("numexterior");
			$c->colonia          = Input::get("colonia");
			$c->cp               = Input::get("cp");
			$c->pais             = Input::get("pais");
			$c->municipio        = Input::get("municipio");
			$c->email            = Input::get("email");
			$c->telefono         = Input::get("telefono");
			$c->save();
			return Redirect::to(URL::route('almacenLista'));
		} else {
			Input::flash();
			return Redirect::to(URL::route('almacenCrearForm'))->withErrors($validar);
		}
			
	}
	public function almacenCrearAjax () {
	

			$c = new Almacen();
			$c->nombre           = Input::get("nombre");
			$c->persona_contacto = Input::get("contacto");
			$c->rfc              = Input::get("rfc");
			$c->calle            = Input::get("calle");
			$c->numinterior      = Input::get("numinterior");
			$c->numexterior      = Input::get("numexterior");
			$c->colonia          = Input::get("colonia");
			$c->cp               = Input::get("cp");
			$c->pais             = Input::get("pais");
			$c->municipio        = Input::get("municipio");
			$c->email            = Input::get("email");
			$c->telefono         = Input::get("telefono");
			$c->save(); 
			$a = Almacen::all();
		return Response::json(array(
				"a" => $a
			));
			
	}
	public function almacenLista () {
		$almacenes = Almacen::all();
		return View::make("dashboard.almacenes.almacenesLista")->with(array("almacenes" => $almacenes));
	}
	public function almacenEditarForm ($id) {
		$almacen = Almacen::find($id);
		return View::make("dashboard.almacenes.almacenEditarForm")->with(array("almacen" => $almacen));
	}	
	public function almacenEditar() {
		$data = Input::all();
		$reglas = array(
				"nombre" => "required",
				"contacto" => "required",
				"rfc" => "required",
				"calle" => "required",
				"numinterior" => "required",
				//"numexterior" => "required",
				"colonia" => "required",
				//"cp" => "required",
				"pais" => "required",
				"municipio" => "required",
				"email" =>  "required",
				"telefono" => "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
			$c = Almacen::find(Input::get("id"));
			$c->nombre           = Input::get("nombre");
			$c->persona_contacto = Input::get("contacto");
			$c->rfc              = Input::get("rfc");
			$c->calle            = Input::get("calle");
			$c->numinterior      = Input::get("numinterior");
			$c->numexterior      = Input::get("numexterior");
			$c->colonia          = Input::get("colonia");
			$c->cp               = Input::get("cp");
			$c->pais             = Input::get("pais");
			$c->municipio        = Input::get("municipio");
			$c->email            = Input::get("email");
			$c->telefono         = Input::get("telefono");
			$c->save();
			return Redirect::to(URL::route('almacenLista'));
		} else {
			Input::flash();
			$id = Input::get('id');
			return Redirect::to(URL::route('almacenEditarForm')."/".$id)->withErrors($validar);
		}
	}
	public function almacenEliminar ($id) {
		$c = Compras::where("almacen_id","=",$id)->get();
		if(count($c) > 0) {
			Session::flash("msj","El almacén tiene ordenes de compras relacinadas...");
		} else {
			Almacen::find($id)->delete();
		}
		return Redirect::to(URL::route('almacenLista'));
	}
	public function almacenVer ($id) {
		$almacen = Almacen::find($id);
		return View::make("dashboard.almacenes.almacenVer")->with("almacen",$almacen);
	}
}
?>