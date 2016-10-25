<?php

class Cotizacion extends Eloquent {
	protected $table = "cotizacion";

	public function Articulos()
	{
		return $this->belongsTo('Articulos', 'articulo');
	}

	public function Articulocotizaciones()
    {
    	return $this->belongsTo('Articulocotizaciones','cotizacion');
    }
}

