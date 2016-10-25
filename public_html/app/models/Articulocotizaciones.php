<?php  
class Articulocotizaciones extends Eloquent {
	
	protected $table = "articulo_cotizacion";
	protected $fillable = array('id', 'cotizacion');
    protected $primaryKey = 'id';
    
	
    public function Cotizacion()
    {
        return $this->belongsTo('Cotizacion', 'cotizacion');
    }
   public function Articulos()
	{
		return $this->belongsTo('Articulos', 'articulo');
	}

}
?>