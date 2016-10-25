<?php

class VendedorController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('vendedores', array('only' => 'vendedores') );
       
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function vendedores () {
		$vendedores = Vendedor::all();
		return View::make("dashboard.vendedores.vendedores")->with(array("vendedores" => $vendedores));
	}


	public function vendedoresForm () {
		return View::make("dashboard.vendedores.vendedoresForm");
	}


	public function vendedoresSave () {
	
        $confirmar=User::where("email","=",Input::get("email"))->first();
        if (empty($confirmar)) {
        $data = Input::all();
        $mensajes = array(
                "required"           => "Campo requerido",
                //"password.confirmed" => "No coincide",
            );
        $reglas = array(
        		"nombre"             => "required",
                "apellidopaterno"    => "required",
                "apellidomaterno"    => "required",
                "email"              => "required",
                "password"           => "required",
                "meta"               => "required"
                //"confirmarpassword"  => "required",                
            );

        $validar = Validator::make($data,$reglas,$mensajes);
        if($validar->passes()) {
            $user = new User();
            $user->username            = Input::get("email");
            $user->first_name          = Input::get("nombre");
            $user->last_name           = Input::get("apellidopaterno");
            $user->email               = Input::get("email");
            $user->password            = Hash::make(Input::get("password"));
            $user->save();
            $rol = new AssignedRole();
            $rol->user_id = $user->id;
            $rol->role_id = 2;
            $rol->save();
            $vendedores = new Vendedor();
            $vendedores->nombre          =  Input::get('nombre');
            $vendedores->apellidopaterno =  Input::get('apellidopaterno');
            $vendedores->apellidomaterno =  Input::get('apellidomaterno');
            $vendedores->email           =  Input::get('email');
            $vendedores->telefono        =  Input::get('telefono');
            $vendedores->user_id         =  $user->id;
            $vendedores->meta            =  Input::get('meta');
        
       if($vendedores->save()){ 
           return Redirect::route("vendedores")
                   ->with('msg', 'Datos guardados con exito.')
                   ->with('class', 'success'); }

           else {Input::flash();
                    return Redirect::route("vendedores")->withErrors($validar);}
        }
        
        else {return Redirect::to(URL::route('vendedoresForm'))->withErrors($validar); }

        }

        else{
             return Redirect::route("vendedores")
                  ->with('msg', 'El vendedor ya existe.')
                  ->with('class', 'success'); }
    }


	public function vendedoresMostrarForm($id)
	{
		$vendedor     = Vendedor::find($id);
		$compras      = Compras::where("vendedor","=",$id)->get();
		$cotizaciones = Cotizacion::where("vendedor","=",$id)->get();
        return View::make("dashboard.vendedores.vendedoresMostrarForm")->with(
        array("vendedor" => $vendedor))
        ->with(array("compras" => $compras))
        ->with(array("cotizaciones" => $cotizaciones));
    }


    public function vendedoresEditarForm ($id) {
        $vendedor = Vendedor::find($id);
        return View::make("dashboard.vendedores.vendedoresFormEditar")->with(
        array("vendedor" => $vendedor));   
    }

        
    public function vendedoresEditar () {
   		  
            $vendedor=Vendedor::find(Input::get("id"));
            $user = User::find("$vendedor->user_id");
            $user->first_name   = Input::get("nombre");
            $user->email        = Input::get("email");
            $user->save();
			$c = Vendedor::find(Input::get("id"));
			$c->nombre          = Input::get("nombre");
			$c->apellidopaterno = Input::get("apellidopaterno");
			$c->apellidomaterno = Input::get("apellidomaterno");
			$c->email           = Input::get("email");
            $c->telefono = Input::get("telefono");
			if($c->save())

			{

			return Redirect::route("vendedores")
                    ->with('msg', 'Datos de vendedor editados con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("vendedores")->withErrors($validar);
		}
		
	}
	
public function vendedoresEliminar ($id) {

       $vendedor=Vendedor::find($id);
       User::where("id","=",$vendedor->user_id)->first()->delete();
       Vendedor::find($id)->delete();
       return Redirect::route("vendedores");
   }
}