<?phpsession_start()?>
<!DOCTYPE html>
<html>
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Estacionamiento 2017</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="js/nexologin.js"></script>
</head>

<body>

		<div class="container">
			<div class="row main">
					<div class="panel-heading">

		            </div> 
				<div class="main-login main-center">
							
								<!--Usuario-->
							<label for="usuario" class="cols-sm-2 control-label">Usuario</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
									<input  type="text" class="form-control" name="usuario" id="usuario"  placeholder="Enter your Username" required/>
								</div>
							</div>  
										
							<!--Password-->
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" required/>
								</div>
							</div>
							
						<div class="form-group">
							<button type="button" onclick="LogIn()" class="btn btn-primary btn-lg btn-block login-button">Ingresar</button>
						</div>
					
						<div id="resultado">
							
						</div>
				</div>
			</div>
		</div>

</body>
</html>