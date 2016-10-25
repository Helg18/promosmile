var unidades;
$(document).ready(function(){
	$.ajax({
		url: $("#load").attr("data-url"),
		type: "post",
		data: {
			_token: $("#load").attr("data-token")
		},
		dataType: "json",
		success: function (data) {
			unidades = data.unidades;
		}
	});
});