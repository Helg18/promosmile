var con = 0;
function run () {
	mensaje = document.getElementById("mensaje");
	num = 0;
	soltar = document.getElementById("soltar");
	soltar.addEventListener("dragenter",function(e){e.preventDefault();},false);
	soltar.addEventListener("dragover",function(e){e.preventDefault();},false);
	soltar.addEventListener("drop",soltado,false);
}
function soltado (e) {
	e.preventDefault();
	archivos = e.dataTransfer.files;
	if (archivos.length)
	{
		for (var i = 0; i < archivos.length; i++)
		{
			soltar.innerHTML += "<p>Archivo: "+archivos[i].name+" <progress value='0' max='100'></progress></p>";
		}
	}
	subir();
}
function subir (e) {
	++con;
	http = new XMLHttpRequest();
	var file = new FormData();
		file.append("file",archivos[num]);
		file.append("_token",$("#data").attr('data-token'));
		file.append("num",con);
	var	upload = http.upload;
		upload.addEventListener("progress",progreso,false); 
		upload.addEventListener("load",cargado,false);
		http.open("POST",$("#data").attr("data-url"));
		http.send(file);
}
function progreso (e) {
	if (e.lengthComputable)
	{
		var hijo = num+1;
		var por = parseInt(e.loaded/e.total*100);
			barra = soltar.querySelector("p:nth-child("+ hijo +") > progress");
			barra.value = por;
			barra.innerHTML = por+"%";
	}
}
function cargado (e) {
	if (num < archivos.length)
	{
		num++
		subir();
	} else {
		num = 0;
		soltar.innerHTML = "";
		block();
	}
}
function block () {
	mensaje.style.display = "block";
	setTimeout(function(){mensaje.style.display = "none";},3000);
}
window.addEventListener("load",run,false);