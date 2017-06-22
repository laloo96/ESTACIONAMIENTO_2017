/**
 var timeStart = new Date("Mon Jan 01 2007 11:00:00 GMT+0530").getTime();
var timeEnd = new Date("Mon Jan 01 2007 11:30:00 GMT+0530").getTime();
var hourDiff = timeEnd - timeStart; //in ms
var secDiff = hourDiff / 1000; //in s
var minDiff = hourDiff / 60 / 1000; //in minutes
var hDiff = hourDiff / 3600 / 1000; //in hours
var humanReadable = {};
humanReadable.hours = Math.floor(hDiff);
humanReadable.minutes = minDiff - 60 * humanReadable.hours;
console.log(humanReadable); //{hours: 0, minutes: 30}
 */



function DisplayFormIngreso()
{
        $("#es").empty();
                           
            var html = "<input type='text' name='marca' id='marca' placeholder='Marca'>";
                html += "<input type='text' name='color' id='color' placeholder='Color'>";
                html += "<input type='text' name='patente' id='patente' placeholder='Patente'>";
                html += "<input type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar' onclick='AgregarAuto()'>"; 
            
        $(html).appendTo("#es");
}


function DisplayTablaSalida()
{
		$("#es").empty();
		
		$.ajax({
		type:"get", 
		dataType:"json", 
		url:"http://localhost:8080/TP_ESTACIONAMIENTO2017/autosLive",
		crossDomain: true,
		async:true,
		})
		.done(function(valor){

			var html = '<table class="table table-bordered table-responsive"><thead class="thead-inverse"><tr><th>Marca</th>'+
						'<th>Color</th><th>Patente</th><th>Hora Entrada</th><th>Tiempo Transcurrido (HS)</th><th>Retirar</th></tr></thead><tbody>';
				
				for (var i = 0; i < valor.length; i++) {

					//Split timestamp into [ Y, M, D, h, m, s ]
					var t = valor[i].entrada.split(/[- :]/);

					// Apply each element to the Date function
					var horaDeEntrada = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);

					//horaDeEntrada.setHours = horaDeEntrada.getHours() + 3;
					//Hora actual.
					var horaActual = new Date();
					
					//Devuelve en milisegundos y lo divido por el valor de una hora en milisegundos.
					
					var hourDiff = horaActual - horaDeEntrada;

					var hDiff = hourDiff / 3600 / 1000; 

					var horasTranscurridasINT = Math.floor(hDiff);
					

				    html += '<td>' + valor[i].marca + '</td>';
				    html += '<td>' + valor[i].color + '</td>';
				    html += '<td>' + valor[i].patente + '</td>';
					html += '<td>' + valor[i].entrada + '</td>';
					html += '<td>' + horasTranscurridasINT + '</td>';
					//html += '<td>' + CalcularImporte(horasTranscurridasINT) + '</td>';
					html += '<td>' + '<a class="btn btn-primary btn-md" onclick="RetirarAuto('+valor[i].id+')">Retirar Auto</a>' + '</td>';    
				    html += "</tr>";
				}
				html += '</tbody></table>';

				$(html).appendTo("#es");

		})		
		.fail(function(jqXHR, textStatus, errorThrown){
			alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		})
}

/*
function CalcularImporte(horasYmin)
{

}*/

/*
* Argega el auto pasado.
*/
function AgregarAuto()
{
    var datos = "marca=" + $("#marca").val() + "&color=" + $("#color").val()+ "&patente=" + $("#patente").val() + "&op=ingreso";

		$.ajax({
		type:"POST", 
		dataType:"Text", 
		url:"http://localhost:8080/TP_ESTACIONAMIENTO2017/ingresarAuto",
		crossDomain: true,
		data:datos,
		async:true,
		})
		.done(function(valor){

			console.log("ingreso");
			/*if (condition) {

			}*/

		})		
		.fail(function(jqXHR, textStatus, errorThrown){
			alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		})
}

/*
* Llama a la api que elimina el auto pasado por id.
*/
function RetirarAuto(idAEliminar)
{
		$.ajax({
		type:"DELETE", 
		dataType:"json", 
		url:"http://localhost:8080/TP_ESTACIONAMIENTO2017/egresar",
		crossDomain: true,
		data:{
			id: idAEliminar
		},
		async:true,
		})
		.done(function(valor){

			if (valor == "ok") {
				DisplayTablaSalida();
			}
			else
			{
				alert("Ha ocurrido un error");
				window.location.href="miPagina.php";
			}

		})		
		.fail(function(jqXHR, textStatus, errorThrown){
			alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		})
}