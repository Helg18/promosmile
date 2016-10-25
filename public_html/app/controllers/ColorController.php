<?php  
class ColorController extends BaseController {
	public function color () {
		$c = Color::all();
		return View::make("dashboard.color.lista")->with(array("c" => $c));
	}
	public function colorSave () {
		$data = Input::all();
		$reglas = array(
				"color" => "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			); 
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
			$c = new Color();
			$c->color = Input::get("color");
			$c->save();
			return Redirect::to(URL::route('color'));
		} else {
			Input::flash();
			return Redirect::to(URL::route('color'))->withErrors($validar);
		}
	}
	public function colorEditForm ($id) {
		$c = Color::find($id);
		return View::make("dashboard.color.edit")->with(array("c" => $c));
	}
	public function colorEdit () {
		$data = Input::all();
		$id = Input::get("id");
		$reglas = array(
				"color" => "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			); 
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
			$c = Color::find($id);
			$c->color = Input::get("color");
			$c->save();
			return Redirect::to(URL::route('color'));
		} else {
			Input::flash();
			return Redirect::to(URL::route('colorEditForm')."/".$id)->withErrors($validar);
		}
	}
	public function colorDelete ($id) {
		Color::find($id)->delete();
		return Redirect::to(URL::route('color'));
	}
	public function colorSaveAjax () {
		$c = new Color();
		$c->color = Input::get("color");
		$c->save();
		$cc = Color::all();
		return Response::json(array(
				"cc" => $cc
			));
	}
}
?>