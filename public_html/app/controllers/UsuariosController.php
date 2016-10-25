<?php

class UsuariosController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('usuarios', array('only' => 'usuarios') );
       
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function usuarios () {
		$usuarios = User::all();
		return View::make("dashboard.usuarios.usuarios")->with(array("usuarios" => $usuarios));
	}


	public function usuariosForm () {
		return View::make("dashboard.usuarios.usuariosForm");
	}


	public function usuariosSave () {
		$input = Input::all();
        $input['password'] = Hash::make($input['password']);//hacemos un hash de la contraseña
        
        $user = User::create($input);
        //$user->attachRole(Role::find(Input::get('rol')));
  
			return Redirect::route("usuarios")
                    ->with('msg', 'Datos guardados con exito.')
                    ->with('class', 'success'); 

                  
	}


	public function usuariosMostrarForm($id)
	{
		$usuarios = User::find($id);
	  
		return View::make("dashboard.usuarios.usuariosMostrarForm")->with(array("usuarios" => $usuarios));
	}


	public function usuariosEditarForm ($id) {
		$usuarios = User::find($id);
		return View::make("dashboard.usuarios.usuariosFormEditar")->with(array("usuarios" => $usuarios));
	}


	public function usuariosEditar () {
		
			$c = User::find(Input::get("id"));
			$c->first_name = Input::get("first_name");
			$c->last_name = Input::get("last_name");
			$c->username = Input::get("username");
			$c->email = Input::get("email");
			if($c->save())

			{

			return Redirect::route("usuarios")
                    ->with('msg', 'Datos de usuario editados con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("usuarios")->withErrors($validar);
		}
		
	}
	public function usuariosEliminar ($id) {
		User::find($id)->delete();
		return Redirect::route("usuarios");
	}
	public function rolUsuario () {
		$usuarios = User::join("assigned_roles","users.id","=","assigned_roles.user_id")
						->get();
		$ids = [];
		foreach($usuarios as $u) {
			$ids[] = $u->user_id;
		}
		$usuarios1 = User::whereNotIn("id",$ids)->get();
		$roles = Role::all();
		return View::make("role.asignarRol")->with(array("usuarios" => $usuarios,"usuarios1" => $usuarios1,"roles" => $roles));
	}
	public function asignarRol () {
		$user = Input::get("user");
		$rol  = Input::get("rol");
		$c = AssignedRole::where("user_id","=",$user)->count();
		if($c > 0) {
			AssignedRole::where("user_id","=",$user)->update(array(
							"role_id" => $rol
						));
		} else {
			$a = new AssignedRole();
			$a->user_id = $user;
			$a->role_id = $rol;
			$a->save();
		}
		return $c;
	}
}