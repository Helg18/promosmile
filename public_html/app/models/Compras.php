<?php

class Compras extends Eloquent {
	protected $table = "compras";

	public function Articulos()
	{
		return $this->belongsTo('Articulos', 'articulo');
	}
	public function Vendedor()
	{
		return $this->belongsTo('Vendedor', 'vendedor');
	}
}