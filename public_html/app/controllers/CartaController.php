<?php  
class CartaController extends BaseController {


    public function __construct()
    {
        $this->beforeFilter('carta', array('only' => 'carta') );
       
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function carta () {
			$carta = Carta::all();
		return View::make("dashboard.carta.carta")->with(array("carta" => $carta));
	}

	public function cartaEditarForm ($id) {
		$carta = Carta::find($id);
		return View::make("dashboard.carta.cartaFormEditar")->with(array("carta" => $carta));
	}
	public function cartaSave () {
		
			$c = Carta::find(Input::get("id"));
			$c->mensaje = Input::get("mensaje");
			
			if($c->save())

			{

			return Redirect::route("prospectos")
                    ->with('msg', 'Carta de presentación editada con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("carta")->withErrors($validar);
		}
		  }
	public function archivoSave (){


			$imagenes = Carta::find(Input::get("id"));
			$images= Input::file('images');
		
			if ($images) {

				foreach($images as $image) {

					if ($image) {
     
										$public_filename= $image->getClientOriginalName();
										$filename 		= $image->getClientOriginalName();
										
								
										$imagenes->filename_public	= $public_filename;
										$imagenes->filename			= $filename;
										$destinationPath= public_path().'/uploads/';
										$image->move($destinationPath, $imagenes->filename);

																	
										

								}
					}
				}
			
	if($imagenes->save())

			{

			return Redirect::route("carta")
                    ->with('msg', 'Carta de presentación editada con exito.')
                    ->with('class', 'success'); }

                    else {
			Input::flash();
			return Redirect::route("carta")->withErrors($validar);
		}

			return Redirect::route("carta");
		 
		

	}






}

?>