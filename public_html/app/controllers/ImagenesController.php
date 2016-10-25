<?php  
class ImagenesController extends BaseController {
	public function Imagenes() {
		return View::make("dashboard.imagenes.cargarImagenes");
	}
	public function imagenesLista () {
		$imagenes = Images::all();
		return View::make("dashboard.imagenes.imagenesLista")->with(array("imagenes" => $imagenes));
	}
}
?>