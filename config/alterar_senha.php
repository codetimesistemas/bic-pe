<?php
	require_once "../config/conexao.php";

	//Iniciando uma nova sessão, caso não já exista uma aberta
	if(!isset($_SESSION)) session_start();

	if(!isset($_SESSION['CorretorID'])){

        //Destrói a sessão caso a validação seja negativa...
        session_destroy();

        //...e redireciona o usuário para o início do site
        header("Location: ../login.php");
    }	

	//Verificando se o formulário de login foi preenchido
	if((!empty($_POST)) AND (empty($_POST['email_corretor'])) OR (empty($_POST['senha_corretor'])) OR (empty($_POST['token']))){

		$_SESSION["login_error"] = "Dados incorretos!";

		header("Location: ../redefinir_senha.php"); exit;

	}else{

	//Prevenindo SQL injection
	$token = mysqli_real_escape_string($conn,$_POST['token']);
	$email_corretor = mysqli_real_escape_string($conn,$_POST['email_corretor']);
	$senha_corretor = mysqli_real_escape_string($conn,$_POST['senha_corretor']);
	$options = [
		    'cost' => 12,
		];		
	$hash = password_hash($senha_corretor,PASSWORD_BCRYPT,$options);

	//Validando os dados informados pelo usuário

	$sql = "SELECT id_corretor, email_corretor, senha_corretor FROM corretor WHERE email_corretor = '$email_corretor' LIMIT 1";
	$query = mysqli_query($conn,$sql);


	if(mysqli_num_rows($query) != 1){

		//Mensagem de erro caso os dados sejam inválidos

		$_SESSION["login_error"] = "Usuário não encontrado!";

		header("Location: ../login.php"); exit;

	}else{

		//Alocando os dados encontrados na variável $resultado		
		$resultado = mysqli_fetch_assoc($query);
		$id = $resultado['id_corretor']; 		
		$token_correto = sha1($resultado['id_corretor'] . $resultado['senha_corretor']);		

		if($token != $token_correto){

			echo "<script type='text/javascript'>alert('Não foi possível recuperar a senha. Chave expirada!');location.href='../redefinir_senha.php';</script>";				

		}else{
			
			$sqlU = "UPDATE corretor SET senha_corretor = '$hash' WHERE id_admin = '$id'";
			$result = mysqli_query($conn,$sqlU);

			if(!$result){

				echo "<script type='text/javascript'>alert('Senha não redefinida!');location.href='../redefinir_senha.php';</script>";

			}else{
				
				echo "<script type='text/javascript'>alert('Sua senha foi redefinida com sucesso!');location.href='../login.php';</script>";
			}
			
		}

	}

}


?>