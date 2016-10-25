<?php

class ProductoTController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('productost', array('only' => 'productost') );
       
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function productost () {
		$productost = ProductoT::all();
		return View::make("dashboard.productot.productost")->with(array("productost" => $productost));
	}


	public function productostForm () {
		return View::make("dashboard.productot.productostForm");
	}


	public function productostSave () {
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
			$c = new ProductoT();
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
			if($c->save())

			{

			return Redirect::route("productost")
                    ->with('msg', 'Datos guardados con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("productost")->withErrors($validar);
		}
		} else {
			return Redirect::to(URL::route('productostForm'))->withErrors($validar);
		}
	}


	public function productostMostrarForm($id)
	{
		$productost = ProductoT::find($id);
	  
		return View::make("dashboard.productot.productostMostrarForm")->with(array("productost" => $productost));
	}


	public function productostEditarForm ($id) {
		$productost = ProductoT::find($id);
		return View::make("dashboard.productot.productostFormEditar")->with(array("productost" => $productost));
	}


	public function productostEditar () {
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
			$c                   = ProductoT::find(Input::get("id"));
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
			if($c->save())

			{

			return Redirect::route("productost")
                    ->with('msg', 'Datos editados con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("productost")->withErrors($validar);
		}
		} 
	}


	public function productostEliminar ($id) {
		ProductoT::find($id)->delete();
		return Redirect::route("productost");
	}

}