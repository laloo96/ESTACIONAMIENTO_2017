
function LogOut()
{	
		var option = "op=logout";

		$.ajax({
		type:"POST", 
		dataType:"Text", 
		url:"./php/verificarlogin.php",
		data:option,
		async:true,
		})
		.done(function(valor){

			if (valor == "ok")
			{
				window.location.href = "login.php";
			}
			else
			{
				console.log("error");
			}
		})		
		.fail(function(jqXHR, textStatus, errorThrown){
			alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		})
}

function LogIn()
{	
		var datos = "usuario=" + $("#usuario").val() + "&password=" + $("#password").val() + "&op=login";

		$.ajax({
		type:"POST", 
		dataType:"Text", 
		url:"./php/verificarlogin.php",
		data:datos,
		async:true,
		})
		.done(function(valor){

			
			$("#resultado").empty();
			
			console.log(valor);

			if (valor == "ok")
			{
				window.location.href = "miPagina.php";
			}
			else
			{	
				
				var html = "<div class='alert alert-danger'>";
				  	html += "<strong>Error!</strong> Usuario o contraseña incorrectos.</div>";
				
				$(html).appendTo("#resultado");
			}
			
		})		
		.fail(function(jqXHR, textStatus, errorThrown){
			alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		})
}