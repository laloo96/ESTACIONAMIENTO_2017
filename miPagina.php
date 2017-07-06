
<?php
session_start();

if(isset($_SESSION["user"]) || isset($_SESSION["admin"]))
{?>
		<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				
					<!-- Latest compiled and minified CSS -->
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

					<!-- jQuery library -->
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

					<!-- Latest compiled JavaScript -->
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

					<style type="text/css" src="css/estilos.css"></style>

					<script type="text/javascript" src="js/nexologin.js"></script>
					
					<script type="text/javascript" src="js/nexoES.js"></script>

					<script type="text/javascript" src="js/nexoABMempleados.js"></script>

			</head>

					<nav class="navbar navbar-default">
							<div class="container-fluid" style="background-color: #DFDEDE">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">      
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										
									</button>
									
									<a class="navbar-brand" href="miPagina.php" >Estacionamiento 24HS</a>    
								</div>

								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
									<ul class="nav navbar-nav">        
											<li><a href="#" onclick="DisplayFormIngreso()">Entrada</a></li>
											<li><a href="#" onclick="DisplayTablaSalida()">Salida</a></li>
											<li><a href="#">Stats Cocheraas</a></li>
											<li><a href="#">Stats Autos</a></li>   
											<li><a href="#">Stats emp</a></li> 
											<li><a href="#" onclick="DisplayFormAltaEmpleado()">AgregarEmp</a></li> 
											<li><a href="#" onclick="DisplayFormGestionarEmpleados()">Gestionar Empleados</a></li> 
											<li><a href="#" >ListaEmpleados</a></li> 
									</ul>
									
										<!--LO QUE VA HACIA LA DEReCHA-->
										<ul class="nav navbar-nav navbar-right">
											<li><a href="#"><span class="glyphicon glyphicon-user"></span > <?php echo $_SESSION["user"]; ?> </a></li>
											<li><a href="" onclick="LogOut()"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
										</ul>  
								</div><!-- /.navbar-collapse -->
							
							</div><!-- /.container-fluid -->
					</nav>
			<!--		<div class="sidebar">
						<h2>
							Menu
						</h2>

						<ul>
							<li><a href="" class="btn btn-primary btn-lg">Estadisticas</a></li>
							<li><a href="" class="btn btn-primary btn-lg">Entradas/Salidas</a></li>
							<li><a href="" class="btn btn-primary btn-lg">Administrar Empleados</a></li>
						</ul>
					</div>
			-->
					<div class="container">
						<body style="background-color: #8b9ebc">
								<div id="es">

								</div>

						</body>
					</div>

					<div class="container">
						<body style="background-color: #8b9ebc">
								<div id="tabla">

								</div>

						</body>
					</div>


					<nav class="navbar navbar-inverse navbar-fixed-bottom">
						<div class="container-fluid" >
							<?php
						echo $_SESSION["user"];
						?>
						</div>
					</nav>
			</html>

<?php
}
else
{
	include("login.php");
}
?>





        
				
				
				
				
				
				
				
				
				<!-- DOPDOWN DE LA DERECHA
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>-->



              <!-- BUSCUDADOR
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>-->
      <!---->