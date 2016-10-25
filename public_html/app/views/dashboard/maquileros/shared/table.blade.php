<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Persona Contacto</th>
        <th>Fecha de Registro</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
 @foreach($maquileros as $maquilero)
    <tr>
        <td>{{$maquilero->nombre}}</td>
        <td>{{$maquilero->persona_contacto}}</td>
         <td>
            <?php $date = date_create($maquilero->created_at); ?>
            {{date_format($date,"d-m-Y")}}
        </td>


        <td width="21%" align="center">
            <a href="{{ route('maquileros.show', $maquilero->id)}}" class="label label-primary"><i class="fa fa-search"></i> Ver</a>
            <a href="{{ route('maquileros.edit', $maquilero->id)}}" class="label label-warning"><i class="fa fa-pencil"></i> Editar</a>
            <a href="{{ route('maquileros.delete', $maquilero->id)}}" onclick="return confirmar('accion.html')" class="label label-danger"><i class="fa fa-trash-o"></i> Eliminar</a>
        </td>
    </tr>
 @endforeach
 </tbody>
</table>
