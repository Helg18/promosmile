<?php

class ProveedorController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('proveedores', array('only' => 'proveedores') );
       
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function proveedores () {
		$proveedores = Proveedor::all();
		return View::make("dashboard.proveedores.proveedores")->with(array("proveedores" => $proveedores));
	}


	public function proveedoresForm () {
		return View::make("dashboard.proveedores.proveedoresForm");
	}


	public function proveedoresSave () {
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
				"telefono" => "required",
				"descuento"=> "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) { 
			$em = Input::get("email");
			$c = new Proveedor();
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
			$c->email            = $em[0];
			$c->telefono         = Input::get("telefono");
			$c->descuento        = Input::get("descuento");

			if($c->save())

			{
				if(count($em) > 0) {
					foreach($em as $key => $value) {
						$pe = new ProveedorEmail();
						$pe->proveedor_id = $c->id;
						$pe->email = $em[$key];
						$pe->save();
					}
				}
			return Redirect::route("proveedores")
                    ->with('msg', 'Datos guardados con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("proveedores")->withErrors($validar);
		}
		} else {
			Input::flash();
			return Redirect::to(URL::route('proveedoresForm'))->withErrors($validar);
		}
	}


	public function proveedoresMostrarForm($id)
	{
		$proveedor = Proveedor::find($id);
	  
		return View::make("dashboard.proveedores.proveedoresMostrarForm")->with(array("proveedor" => $proveedor));
	}


	public function proveedoresEditarForm ($id) {
		$proveedor = Proveedor::find($id);
		return View::make("dashboard.proveedores.proveedoresFormEditar")->with(array("proveedor" => $proveedor));
	}


	public function proveedoresEditar () {
		$data = Input::all();
		$reglas = array(
				"nombre" => "required",
				"contacto" => "required",
				"rfc" => "required",
				"calle" => "required",
				"numinterior" => "required",
				"numexterior" => "required",
				"colonia" => "required",
				"cp" => "required",
				"pais" => "required",
				"municipio" => "required",
				"email" => "required",
				"telefono" => "required",
				"descuento" => "required"

			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
			$c                   = Proveedor::find(Input::get("id"));
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
			$c->descuento         = Input::get("descuento");

			if($c->save())

			{

			return Redirect::route("proveedores")
                    ->with('msg', 'Datos de proveedor editados con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("proveedores")->withErrors($validar);
		}
		} 
	}


	public function proveedoresEliminar ($id) {
		Proveedor::find($id)->delete();
		return Redirect::route("proveedores");
	}

}