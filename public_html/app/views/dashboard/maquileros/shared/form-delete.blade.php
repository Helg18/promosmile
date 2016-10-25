{{ Form::open(['route' => ['maquileros.destroy', $maquileros], 'method' => 'DELETE']) }}
    <button type="submit" onclick="return confirm('¿Esta seguro?')" class="label label-danger"><i class="fa fa-trash-o"></i> Eliminar</button>
{{ Form::close() }}
