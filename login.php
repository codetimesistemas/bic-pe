<?php

//Iniciando uma nova sessão, caso não já exista uma aberta
if(!isset($_SESSION)) session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login BIC-PE</title>
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
				<form class="login100-form validate-form" method="post" action="config/login.php">
					<span class="login100-form-title p-b-43">
						Login to enjoy!
					</span>					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email_corretor">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="senha_corretor">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<!--<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>							
						</div>-->
						<div class="txt2">
							Don't have an account? <a href="" data-toggle="modal" data-target="#myModal">Register</a>
						</div>

						<div>
							<a href="redefinir_senha.php" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
					<!--<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Don't have an account? <a href="" data-toggle="modal" data-target="#myModal">Register</a>
						</span>
					</div>-->

					<!--<div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>-->
				</form>

				<div class="login100-more" style="background-image: url('resources/images/bg-01.jpg');">
				</div>

				 <!--Início modal cadastro corretores-->
			    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
			      <div class="modal-dialog" role="document">
			        <div class="modal-content">
			          <div style="background-color: #003399;" class="modal-header">
			            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			            <h4 style="font-size: 21px; color: #FFFFFF;" class="modal-title text-center" id="gridSystemModalLabel">Cadastro</h4>
			          </div>
			          <div class="modal-body">
			             <form method="post" action="app/cadastro_corretor.php">              

			                  <div class="form-group">
			                    <label style="color: #222222;" for="nome_corretor" class="control-label">Nome:</label>
			                    <input type="text" class="form-control" name="nome_corretor" id="nome_corretor" maxlength="70" required="required" autofocus/>                             
			                  </div> 

			                  <div class="form-group">
			                    <label style="color: #222222;" for="creci_corretor" class="control-label">Creci:</label>
			                    <input type="text" class="form-control" name="creci_corretor" id="creci_corretor" maxlength="20" required="required" autofocus/>                             
			                  </div> 

			                  <div class="form-group">
			                    <label style="color: #222222;" for="telefone1_corretor" class="control-label">Telefone 1:</label>
			                    <input type="text" class="form-control" name="telefone1_corretor" id="telefone1_corretor" maxlength="15" required="required" autofocus/>           
			                  </div>

			                  <div class="form-group">
			                    <label style="color: #222222;" for="telefone2_corretor" class="control-label">Telefone 2:</label>
			                    <input type="text" class="form-control" name="telefone2_corretor" id="telefone2_corretor" maxlength="15" autofocus/>                             
			                  </div>			                  

			                  <!-- <div class="form-group">
			                    <label style="color: #222222;" for="sexo_usuario" class="control-label">Sexo:</label>                    
			                    <select class="form-control" name="sexo_usuario" id="sexo_usuario" required="required">
			                      <option value="">Selecione</option>
			                      <option value="Feminino">Feminino</option>
			                      <option value="Masculino">Masculino</option>                      
			                    </select> 
			                  </div> -->			                                 

			                   <div class="form-group">
			                    <label style="color: #222222;" for="email_corretor" class="control-label">E-mail:</label>
			                    <input type="email" class="form-control" name="email_corretor" id="email_corretor" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="required"/>                             
			                  </div>   

			                   <div class="form-group">
			                    <label style="color: #222222;" for="senha_corretor" class="control-label">Senha:</label>
			                    <input type="password" class="form-control" name="senha_corretor" id="senha_corretor" pattern=".{8,}" title="Mínimo de 8 digitos" maxlength="8" required="required"/>                             
			                  </div>                         

			                  <div class="modal-footer">
			                    <button type="button" class="btn btn-modal-fechar" data-dismiss="modal">Fechar</button>
			                    <button type="submit" class="btn btn-modal-submeter" name="cadastrar">Cadastrar</button>                   
			                  </div>              
			                </form>
			          </div>
			        </div><!-- /.modal-content -->
			      </div><!-- /.modal-dialog -->
			    </div><!-- /.modal -->
			    <!-- /Fim modal cadastro corretores-->
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