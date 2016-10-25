
function leyenda () {
		  $("#signo").click(function (e) {
		  	$("body").append(mensaje);
		  	  $("#leyenda").css({
		  	  			"top": (e.pageY-50)+"px",
		  	  			"left": (e.pageX+30)+"px"
		  	  		}).fadeIn("slow");
		  	});
		  	$("body").on("mouseleave","#leyenda",function(){
		  			console.log("ok");
		  			$(this).remove();
		  	});
		  }
		  /*$("#signo").hover(
		  	function(e){
		  	  console.log("OK");
		  	  $("body").append(mensaje);
		  	  $("#leyenda").css({
		  	  			"top": (e.pageY-50)+"px",
		  	  			"left": (e.pageX+30)+"px"
		  	  		}).fadeIn("slow");
		  	},
		  	function () {
		  		$("#leyenda").remove();
		  	} 
		  );
		  $("#signo").mousemove(function(e){
		  	$("#leyenda").css({
		  	  			"top": (e.pageY-50)+"px",
		  	  			"left":(e.pageX+30)+"px"
		  	  		})
		  	.fadeIn("slow");
		  });
		}*/

$(document).ready(function(){
    mensaje = "";
    colores_cantidad = 0;
	colores = "";
	removidos = [];
	$("#articulo").change(function(){
		var val = $(this).val();
		if (val != "") {
			$.ajax({
				url: $("#articulo").attr("data-url"),
				type: "post",
				data: {
					_token: $("#token").val(),
					id: $(this).val(),	
				},
				dataType: "json",
				success: function(data) {
					$("#descripcion").val(data.descripcion);
				}
			});
		}
	});
	$("#impresion").change(function(){
		
		var val = $(this).val();
		if(val == "Serigrafia") {
			mensaje = "<p id='leyenda'><span class='titulo'>Serigrafía en bolígrafo de plástico<br>\
					   <span class='costo'>50 piezas $3.00</span>  \
					   <span class='costo'>100 piezas $1.50</span> \
					   <span class='costo'>500 piezas $0.60 </span>\
					   <span class='costo'>1000 piezas $0.30   </span></span>\
					   <span class='titulo'>VARIOS Tazas de cerámica, termos de plástico, termo metálico, libretas, LLAVEROS, ETC.</span>\
					   <span class='costo'>50 piezas $4.00</span> \
					   <span class='costo'>100 piezas $2.00</span> \
					   <span class='costo'>500 piezas $1.50  </span> \
					   <span class='costo'>1000 piezas $1.00</span> \
					   <span class='costo'>Tintas extra el mismo costo.</span> \
					   <span class='titulo'>Serigrafía en bol. Metálica Bolígrafos ECO Boligrafos metalicos y de carton</span>\
					   <span class='costo'>50 piezas $4.00</span> \
					   <span class='costo'>100 piezas $2.00</span> \
					   <span class='costo'>500 piezas $0.80</span> \
					   <span class='costo'>1000 piezas $0.45</span> \
					   <span class='costo'>Tintas extra el mismo costo.</span> \
					   <span class='titulo'>TEXTILEJ. PARAGUAS, PLAYERAS, GORRAS, MORRALES, BOLSAS, ETC.</span>\
					   <span class='costo'>50 piezas $6.00 por tinta</span> \
					   <span class='costo'>100 piezas 3 pesos por tinta</span> \
					   <span class='costo'>500 2 pesos por tinta</span> \
					   <span class='costo'>1000 a 1.5 pesos por tinta</span> \
					   </p>";
			$("#ii").html("Tintas");
			$("#cii").css({"display":"block"});
			$("#signo").show();
		}
		if(val == "Tempografia") {
			mensaje = "<p id='leyenda'><span class='titulo'>Tempograía<br> <span class='costo'>50 piezas $2.00</span> <span class='costo'>100 a 500 piezas $1.00</span><span class='costo'>600 a 1000 piezas $0.50</span> <span class='costo'>Costo de placa $150.00</span></span></p>";
			$("#ii").html("Tintas");
			$("#cii").css({"display":"block"});
			$("#div-placas").show();
		} else {
			$("#div-placas").hide();
		}
		if(val == "Grabado") {
			$("#ii").html("Tintas");
			$("#cii").css({"display":"none"});
		} 
		if(val == "Bordado") {
			$("#ii").html("Hilos");
			$("#cii").css({"display":"block"})
		}
		if(val == "Sublimado") {
			$("#ii").html("Hilos");
			$("#cii").css({"display":"none"})
		}
		if(val == "Sand Blast") {
			$("#ii").html("Tintas");
			$("#cii").css({"display":"block"})
		}
		if(val == "Termograbado") {
			$("#ii").html("Tintas");
			$("#cii").css({"display":"none"})
		}
		if(val == "Sin impresion") {
			$("#ii").html("Tintas");
			$("#cii").css({"display":"none"});
			$("#infoimpresion").val("");
			$("#costoimpresion").val("");
		}
		if(val == "Serigrafia" || val == "Tempografia") {
			$("#signo").show();
		} else {
			$("#signo").hide();
		}
		if(val == 'Sin impresion') {
			$("#kostoimpresion").css({"display":"none"});
		} else {
			$("#kostoimpresion").css({"display":"block"});
		}
	});
	$("#check").change(function(){
		console.log("OK");
		if($("#check").prop("checked")) {
			$("#placas").css({"visibility":"yes"});
		} else {
			$("#placas").css({"visibility":"hidden"});
		}
	});
	$("#infoimpresion").keypress(function(){
		   vali = $(this).val();
			console.log(vali);
			$("#infoimpresion").keyup(function(){
				if(parseInt($("#infoimpresion").val()) > 9) {
					$(this).val(vali);
					return false;
				}
			});
	});
	$("#color").change(function(){
		if($(this).val() != 0) {
			$("#c_cantidad").show();
			$("#add_color").show();
		} else {
			$("#c_cantidad").hide();
			$("#add_color").hide();
		}
	});
	$("#boton_add").click(function(){
		var valor = $("#color_cantidad").val();
		var color = $("#color").val();
		colores_cantidad += parseInt(valor);
		colores += color+":"+valor+",";
		$("#color_cantidad").val(null);
		$("#c_cantidad").hide();
		$("#add_color").hide();
		$("#colores").append("<div class='col-sm-3'><input class=' pull-left col-sm-8' type='text' disabled value='"+color+":"+valor+"'><a href='javascript:void(0)' class='remover btn btn-danger pull-right'>X</a></div>");
		$("#colorh").val(colores);
		$("#color option:selected").remove();
		$("#color > #cero").prop("selected",true);
		$("#select2-color-container").attr("title","color...");
		$("#select2-color-container").text("color...");
		removidos.push(color);
		console.log(colores_cantidad);
	});
	$("body").on("click","i#edit",function(){
		var ci  = $(this).siblings("input.costoimpresion").val();
		var des = $(this).siblings("input.descripcion").val();
		var can = $(this).siblings("input.cantidad").val();
		var mu  = $(this).siblings("input.margen_utilidad").val();
		var cos = $(this).siblings("input.costo").val();
		var pre = $(this).siblings("input.precio_unitario").val();
		var total = $(this).siblings("input.total").val();
		var iva = $(this).siblings("input.iva").val();
		var sub = $(this).siblings("input.sub").val();
		var color1 = $(this).siblings("input.color").val();
		var ccc = $(this).siblings("input.colores_cantidad").val();
		
		colores_cantidad = ccc;
 		colores = color1;
 		var color2 = color1.split(",");
 		$('#descripcion').val(des); 
 		$('#costo_unitario').val(cos);
 		$('#margen_utilidad').val(mu);
 		$('#precio_unitario').val(pre);
 		$('#cantidad').val(can);
 		$('#total').val(total);
 		$("#iva").val(iva);
 		$("#subtotal").val(sub);
		for (var i = 0 in color2) {
			if(color2[i] != "") {
			$("#colores").append("<div class='col-sm-3'><input class=' pull-left col-sm-8' type='text' disabled value='"+color2[i]+"'><a href='javascript:void(0)' class='remover btn btn-danger pull-right'>X</a></div>");
			}
		}
		$(this).parent().remove();
	});
	$("#sut").click(function(){
		var v = $("#cliente").val();
		if(v == 0) {
			  $("#alerta_cantidad").html("Seleccione un cliente");
   			  $("#alerta_cantidad").show();
    		  $(document).scrollTop(0);
    		  setTimeout(function(){
      			$("#alerta_cantidad").hide()
   		},5000);
    	return false;	
      }
	});
	$("body").on("click","a.remover",function(){
		var val = $(this).siblings("input").val();
		var c = val.split(":");
		var cc = colores.split(",");
		colores = "";
		for (var i = 0 in cc) {
			if(cc[i] != val && cc[i] != ""){
			   colores += cc[i]+",";
			}
		}
		console.log(colores_cantidad)
		$(this).parent().remove();
		colores_cantidad -= c[1];
		$("#color").append("<option value='"+c[0]+"'>"+c[0]+"</option>");
		$("#colorh").val(colores);
		console.log(c[1]);
	});
	leyenda();
});