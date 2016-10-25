<?php  
class ProspectosController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('prospectos', array('only' => 'prospectos') );
       
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */



	public function prospectos () {
		$prospectos = Prospectos::all();
		$restric= Prospectos::where('vendedor','=',Auth::user()->id)->where('fecha','=',date("Y-m-d"))->count();
		return View::make("dashboard.prospectos.prospectos")->with(array("prospectos" => $prospectos))->with(array("restric" => $restric));
	}

	public function prospectosForm () {
		return View::make("dashboard.prospectos.prospectosForm");
	}

/*
	

public function enviar (){
Mail::send('dashboard.prospectos.message', array('name' => 'Rusbel'), function ($message){
    $message->to('rusbelvl@hotmail.com', 'Rusbel Vargas')-> subject('Prueba Promosmile');
});

	

}

*/

public function prospectosSave()
	{


		$correos=Prospectos::where("email","=",Input::get("email"))->count();
		if($correos >=1)
		{
			 return Redirect::to('prospectos')
                    ->with('msg', 'Ya se ha enviado un email a este prospecto.')
                    ->with('class', 'warning');

			}

			else {

		$data = Input::all();
		$reglas = array(
				"nombre" => "required",
				"telefono" => "required",
				"compania" => "required",
				"puesto" => "required",
				"email" => "required"
			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
		$c = new Prospectos();
			$c->nombre = Input::get("nombre");
			$c->genero = Input::get("genero");
			$c->compania = Input::get("compania");
			$c->email = Input::get("email");
			$c->telefono = Input::get("telefono");
			$c->puesto = Input::get("puesto");
			$c->fecha =  date("Y-m-d"); 
			$c->vendedor = Auth::user()->id;
			$c->save();

			$data = array
				(
				'name'		=>	Input::get("nombre"),
				'genero'		=>	Input::get("genero"),
				'email'		=>	'prueba.proyectos.email@gmail.com',
				'subject'	=>	'Prueba',
				'msg'		=>	'Hola'
				);
				$fromEmail	=	Input::get("email");
				$fromName	=	'Promosmile';
				Mail::send('dashboard.prospectos.message', $data, function($message) use ($data,$fromName, $fromEmail)
				{
					$message->to($fromEmail, $fromName);
					$message->from($fromEmail, $fromName);
					$message->subject('Promosmile');
					$message->attach(asset('uploads/'.Carta::first(array('filename'))->filename));
					
				});
			
           return Redirect::to('prospectos')
                    ->with('msg', 'Email enviado con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("prospectosForm")->withErrors($validar);
		}
	
	}
         }



public function prospectosEditarForm ($id) {
		$prospectos = Prospectos::find($id);
		return View::make("dashboard.prospectos.prospectosFormEditar")->with(array("prospectos" => $prospectos));
	}

public function prospectosEditar () {
		$data = Input::all();
		$reglas = array(
				"nombre" => "required",
			);
		$mensajes = array(
				"required" => "Campo requerido"
			);
		$validar = Validator::make($data,$reglas,$mensajes);
		if($validar->passes()) {
			$c                   = Prospectos::find(Input::get("id"));
			$c->nombre = Input::get("nombre");
			$c->genero = Input::get("genero");
			$c->compania = Input::get("compania");
			$c->email = Input::get("email");
			$c->telefono = Input::get("telefono");
			$c->puesto = Input::get("puesto");
			$c->save();
			return Redirect::route("prospectos");
		} else {
			Input::flash();
			return Redirect::to(URL::route("prospectosEditarForm")."/".Input::get("id"))->withErrors($validar);
		}
	}


public function prospectosMostrarForm($id)
	{
		$prospectos = Prospectos::find($id);
	  
		return View::make("dashboard.prospectos.prospectosMostrarForm")->with(array("prospectos" => $prospectos));
	}

	public function prospectosEliminar ($id) {
			Prospectos::find($id)->delete();
				return Redirect::route("prospectos");
	}
}
?>