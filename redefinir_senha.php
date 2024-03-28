<?php
	//Iniciando uma nova sessão, caso não já exista uma aberta
	if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Redefinir Senha BIC-PE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="resources/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="resources/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="resources/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="resources/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="resources/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="resources/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="resources/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="resources/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="resources/css/util.css">
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="config/redefinir_senha.php">
					<span class="login100-form-title p-b-43">
						Redefinir Senha
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email_corretor">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>					

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<!--<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>							
						</div>-->
						<div class="txt2">
							Lembrou sua senha? <a href="login.php"><b>LOGIN</b></a>
						</div>						
					</div>							

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="enviar">
							Enviar
						</button>
					</div>
					<p style="font-size: 14px; background: rgba(255,255,255,0.30); border-radius: 5px;" class="text-center text-danger">
	                	<?php 
		                	if(isset($_SESSION['login_error'])){              		
		                		echo $_SESSION['login_error'];
		                		unset($_SESSION['login_error']);
		                		}				                	
	                	?>		                	
	                	</p>
	                	<p style="font-size: 14px; background: rgba(255,255,255,0.30); border-radius: 5px;" class="text-center text-sucess">
	                	<?php 
		                	if(isset($_SESSION['login_sucess'])){              		
		                		echo $_SESSION['login_sucess'];
		                		unset($_SESSION['login_sucess']);	
		                		}			                	
	                	?>		
			         </p>					
				</form>
				<div class="login100-more" style="background-image: url('resources/images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="resources/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="resources/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="resources/vendor/bootstrap/js/popper.js"></script>
	<script src="resources/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="resources/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="resources/vendor/daterangepicker/moment.min.js"></script>
	<script src="resources/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="resources/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="resources/js/main.js"></script>

</body>
</html>