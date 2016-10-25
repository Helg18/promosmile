
  	@foreach(Carta::all() as $cartas)

  	@if($genero=="Femenino")
  	<p>Hola estimada: {{$name}} </p>

  	@else

	<p>Hola estimado: {{$name}} </p>

  	@endif


 
     {{$cartas->mensaje}}
  
  
	@endforeach
  