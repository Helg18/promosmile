<?php  
class ArticuloCompra extends Eloquent {

	protected $table = "articulo_compra";
	protected $fillable = array('id', 'compra');
    protected $primaryKey = 'id';

        public function Compra()
    {
        return $this->belongsTo('Compras', 'compra');
    }
   public function Articulos()
	{
		return $this->belongsTo('Articulos', 'articulo');
	}
}
?>