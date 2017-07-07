//porque no aparece la session.

function DisplayFormAltaEmpleado()
{
        $("#es").empty();
                           
            var html = "<input type='text' name='nombre' id='nombre' placeholder='Nombre'>";
                html += "<input type='text' name='apellido' id='apellido' placeholder='Apellido'>";
                html += "<select name='turno' id='turno'>"+
                            "<option value='1'>Mañana</option>"+
                            "<option value='2'>Tarde</option>"+
                            "<option value='3'>Noche</option>"+
                        "</select>";
                html += "<select name='rol' id='rol'>"+
                            "<option value='1'>Empleado</option>"+
                            "<option value='2'>Admin</option>"+
                        "</select>";
                html += "<input type='text' name='usuario' id='usuario' placeholder='usuario'>";
                html += "<input type='password' name='pass' id='pass' placeholder='Contraseña'>";
                html += "<input type='button' name='btnRegistrarEmp' id='btnRegistrarEmp' value='Guardar' onclick='AgregarEmpleado()'>"; 
            
        $(html).appendTo("#es");
}

function DisplayFormGestionarEmpleados()
{
    $("#es").empty();
        var html = "<a href='#'>Buscar empleados:</a></br>";
        html += "<input type='text' name='nombre' id='nombre' placeholder='Nombre'>";
        html += "<input type='text' name='apellido' id='apellido' placeholder='Apellido'>"; 
        html += "<input type='button' name='btnGestionarEmpleados' id='btnGestionarEmpleados' value='Buscar' onclick='GestionarEmpleados()'>"; 
    
    $(html).appendTo("#es");

    MostrarTodosLosEmpleados();
}

function AgregarEmpleado()
{   
     $("#tabla").empty();

     var datos = "nombre=" + $("#nombre").val() + 
                "&apellido=" + $("#apellido").val() + 
                "&turno=" + $("#turno").val() + 
                "&usuario=" + $("#usuario").val() + 
                "&password=" + $("#pass").val() +
                "&rol=" + $("#rol").val();
    	
        $.ajax({
		type:"POST", 
		dataType:"text", 
		url:"http://localhost:8080/TP_ESTACIONAMIENTO2017/nuevoempleado",
		crossDomain: true,
        data:datos,
		async:true,
		})
		.done(function(valor){
			
           console.log(valor);
			
            if (valor == "ok") {
				alert("Empleado agregado con exito!");
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

function GestionarEmpleados()
{
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    
    $.ajax({
		type:"get", 
		dataType:"json", 
		url:"http://localhost:8080/TP_ESTACIONAMIENTO2017/dameXempleado?nombre="+nombre+"&apellido="+apellido,
		crossDomain: true,
		async:true,
		})
		.done(function(empleados){

			if (empleados !== null) {
				TablaEmpleados(empleados);
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

function TablaEmpleados(empleados)
{
    var estadoToString;
    var rolToString;
    var turnoToString;

    $("#tabla").empty();

    var html = '<table class="table table-bordered table-responsive">'+
                '<thead class="thead-inverse">'+
                    '<tr>'+
                        '<th>Nombre</th>'+
                        '<th>Apellido</th>'+
                        '<th>Turno</th>'+
                        '<th>Usuario</th>'+
                        '<th>Estado</th>'+
                        '<th>Rol</th>'+
                        '<th>Acciones</th>'+
                    '</tr>'+
                '</thead>'
                '<tbody>';

        for (var i = 0; i < empleados.length; i++) {

            switch (empleados[i].rol) {
                case 1:
                    rolToString = "Empleado";
                    break;         
                default:
                    rolToString = "Admin";
                    break;
            }

            switch (empleados[i].turno) {
                case 1:
                    turnoToString = "Mañana";
                    break;
                case 2:
                    turnoToString = "Tarde";
                    break;
                case 3:
                    turnoToString = "Noche";
                    break;
            }

            switch (empleados[i].estado) {
                case 1:
                    estadoToString = "Activo";
                    break;
                case 2:
                    estadoToString = "Suspendido";
                    break;
            }

            html += '<td>' + empleados[i].nombre + '</td>';
				    html += '<td>' + empleados[i].apellido + '</td>';
				    html += '<td>' + turnoToString + '</td>';
					html += '<td>' + empleados[i].usuario + '</td>';
                    html += '<td>' + estadoToString + '</td>';
                    html += '<td>' + rolToString + '</td>';

            html += '<td>' + '<a class="btn btn-danger btn-md" onclick="EliminarEmpleado(\''+empleados[i].nombre+'\',\''+ empleados[i].apellido+'\')">Eliminar</a>';
            if (empleados[i].estado == 1) {
                html += '<a class="btn btn-warning btn-md" onclick="ActualizarEstado(\''+empleados[i].usuario+'\','+empleados[i].estado+')">Suspender</a>' + '</td>';  
            }
            else{
                html += '<a class="btn btn-success btn-md" onclick="ActualizarEstado(\''+empleados[i].usuario+'\','+empleados[i].estado+')">Reincorporar</a>' + '</td>'; 
            }
            html += "</tr>";        

        }

        html += '</tbody></table>';

				$(html).appendTo("#tabla");
}

function ActualizarEstado(usuario,estado)
{   
    var pregunta;
    if(estado == 1)
    {
        pregunta = "¿Seguro que desea suspender al usuario "+usuario+"?";
    }
    else
        pregunta = "¿Seguro que desea reincorporar al usuario "+usuario+"?";

    if(confirm(pregunta))
    {
        $.ajax({
            type:"PUT", 
            dataType:"json", 
            url:"http://localhost:8080/TP_ESTACIONAMIENTO2017/actualizarestado?usuario="+usuario+"&estado="+estado,
            crossDomain: true,
            async:true,
            })
            .done(function(valor){

                if (valor == "ok") {
                    console.log("exito");
                    MostrarTodosLosEmpleados();
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
}

function MostrarTodosLosEmpleados()
{
    $.ajax({
		type:"get", 
		dataType:"json", 
		url:"http://localhost:8080/TP_ESTACIONAMIENTO2017/traertodoslosempleados",
		crossDomain: true,
		async:true,
		})
		.done(function(empleados){

			if (empleados !== null) {
				TablaEmpleados(empleados);
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

function EliminarEmpleado(nombre,apellido)
{
    if(confirm("¿Esta seguro que desea eliminar?")) {
        
        $.ajax({
            type:"delete", 
            dataType:"text", 
            url:"http://localhost:8080/TP_ESTACIONAMIENTO2017/eliminarempleado?nombre="+nombre+"&apellido="+apellido,
            crossDomain: true,
            async:true,
            })
            .done(function(valor){

                if (valor == "ok") {
                    alert("Se elimino correctamente");
                    MostrarTodosLosEmpleados();
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
}
