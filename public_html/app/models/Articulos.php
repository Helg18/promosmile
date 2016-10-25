<?php  
class Articulos extends Eloquent {
	
	protected $table = "articulos";
	protected $fillable = array('id');
    protected $primaryKey = 'id';
    
	public function Images()
    {
        return $this->hasMany('Images');
    }
	
	
    public function User()
    {
        return $this->belongsTo('User');
    }

    public function Proveedores()
    {
        return $this->belongsTo('Proveedor', 'proveedor');
    }

}
?>