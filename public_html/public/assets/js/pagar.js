$(document).ready(function(){
	$("#p").click(function(){
		if (parseInt($("#pago").val()) > parseInt($("#deuda").val())) {
			alert("El pago es mayor que la deuda");
			console.log($("#pago").val()+" - "+$("#deuda").val());
			return false;
		} else {
			return true;
		}
	});
});