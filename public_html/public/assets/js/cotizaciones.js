var total,cantidad,sub,precio,iva,ivap;
function subTotal () {
	cantidad = $('#cantidad').val() || 0;
  	precio = $("#precio").val() || 0;
  	sub = cantidad*precio;
  	iva = sub*0.16;
  	total = sub + iva;

    $("#subtotal").val(sub);
  	$("#subtotal_e").val(sub);
  	$("#iva").val(iva);
  	$("#iva_e").val(iva);
  	$("#total").val(total);
  	$("#total_e").val(total);
}
$(document).ready(function(){
  $('#cantidad').keyup(function(){
  		subTotal();
  });
  $('#precio').keyup(function(){
  		subTotal();
  });
  $("#descuento").keyup(function(){
    if ($(this).val() > 0) { 
    subTotal();
    var d = $(this).val();
    var s =  $("#subtotal_e").val();
    var des = (d*s)/100;
    var sub = s-des;
    var iva = sub*0.16;
    var total = sub+iva;
    $("#subtotal").val(sub);
    $("#subtotal_e").val(sub);
    $("#iva").val(iva);
    $("#iva_e").val(iva);
    $("#total").val(total);
    $("#total_e").val(total);
    console.log(s+" - "+d);
  } else {
    subTotal();
  }
  });
    $("#ivap").change(function(){
    if($("#ivap").val() == 2) {
      $("#iva").val(0);
      $("#iva_e").val(0);
      //$("#subtotal").val();
      $("#total").val($("#subtotal").val());
      $("#total_e").val($("#subtotal").val());
    } else {
      $("#iva").val(iva);
      $("#iva_e").val(iva);
      $("#total").val(total);
      $("#total_e").val(total);
    }
  });
  $("#conceptovalue").change(function(){
    //alert($("#conceptovalue option:selected").attr("data-uni"));
    var unidad = $("#conceptovalue option:selected").attr("data-uni");
    $("#unidad_e").val(unidad);
    $("#unidad").val(unidad);
  });
});

