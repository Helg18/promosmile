@extends("dashboard.layouts.default")

@section("title")
	Asignar Rol
@stop

@section("css")
@stop

@section("pagina")
	<h2>Asignar Rol</h2>
@stop

@section("contenido")
	 <div style="display:none;" class="progress progress-striped active" id="barra">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> Procesando...
        </div>
     </div>

	<table class="table" data-token="{{csrf_token()}}" data-url="{{URL::route('asignarRol')}}">
		<tr>
			<th>
				Usuario
			</th>
			<th>
				E-mail
			</th>
			<th>
				Opciones
			</th>
		</tr>
		@foreach($usuarios as $u)
			@if($u->role_id != 1)
			<tr>
				<td>{{$u->username}}</td>
				<td>{{$u->email}}</td>
				<td>
					<select data-uid="{{$u->user_id}}" name="" class="rol" id="">
						<option value="rol">Rol</option>
						@foreach($roles as $r)
							@if($r->id != 1)
								@if($r->id == $u->role_id)
									<option selected value="{{$r->id}}">{{$r->name}}</option>
								@else
									<option  value="{{$r->id}}">{{$r->name}}</option>
								@endif
							@endif
						@endforeach
					</select>
				</td>
			</tr>
			@endif
		@endforeach

		@foreach($usuarios1 as $u1)
			<tr>
				<td>{{$u1->username}}</td>
				<td>{{$u1->email}}</td>
				<td>
					<select data-uid="{{$u1->id}}" name="" class="rol" id="">
						<option value="rol">Rol</option>
						@foreach($roles as $r)
							@if($r->id != 1)
								<option value="{{$r->id}}">{{$r->name}}</option>
							@endif
						@endforeach
					</select>
				</td>
			</tr>
		@endforeach
	</table>
@stop

@section("js")
<script>
	$(document).ready(function(){
		$(".rol").change(function(){
			//alert($(this).val()+" - "+$(this).attr("data-uid"));
			$("#barra").show();
			$.ajax({
				url: $(".table").attr("data-url"),
				type: "post",
				data: {
					_token: $(".table").attr("data-token"),
					user: $(this).attr("data-uid"),
					rol:  $(this).val() 
				},
				dataType: "json",
				success: function(data) {
					console.log("OK");
					$("#barra").hide();
				}
			});
		});
	});
</script>
@stop