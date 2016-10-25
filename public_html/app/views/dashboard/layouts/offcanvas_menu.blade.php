<!--OffCanvas Menu -->

<!-- Tabs -->
<div id="off-sidebar" class="sidebar">
	<div class="sidebar-wrapper">
  <ul class="nav nav-tabs nav-justified">
	<li class="active"><a href="#userbar-one" data-toggle="tab"></a></li>
  </ul>
  <div class="tab-content"> 
	
	<!--User Primary Panel-->
	<div class="tab-pane active" id="userbar-one">
	  <div class="main-info">
		<div class="user-img">
			<i style="font-size:4em;" class="glyphicon glyphicon-user"></i>
			<!--<img src="{{asset('uploads/users/default.png')}}" alt="User Picture" />-->
			
		</div>
	
	
		<div class="list-group-item goaway">Usuario: {{Auth::user()->username}}</div>
		<div class="list-group-item goaway">E-mail: {{Auth::user()->email}}</div>
	  </div>
		<div class="empthy"></div>
		<!--<a href="#" class="list-group-item goaway"><i class="entypo-user"></i>Perfil</a>-->
		<a href="{{url()}}/logout" class="list-group-item goaway"><i class="fa fa-power-off"></i>Salir</a> </div>
	</div>
	</div>
</div>
	<!--User Chat Panel-->

	<!--User Tasks Panel-->
	
<!-- /tabs --> 

<!-- /Offcanvas user menu--> 
