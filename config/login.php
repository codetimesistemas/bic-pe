<?php
	//Iniciando uma nova sessão, caso não já exista uma aberta
	if(!isset($_SESSION)) session_start();
		
	require "conexao.php";

	//Verifica se o formulário de login foi preenchido
	if((!empty($_POST)) AND (empty($_POST['email_corretor'])) OR (empty($_POST['senha_corretor']))){


		$_SESSION["login_error"] = "Informe seu e-mail e senha";

		header("Location: ../login.php"); exit;


	}else{	

	//Prevenindo SQL injection		
	$email_corretor = mysqli_real_escape_string($conn,$_POST['email_corretor']);

	$senha_corretor = mysqli_real_escape_string($conn,$_POST['senha_corretor']);

	//Validando os dados informados pelo usuário
	$sql = "SELECT id_corretor, nome_corretor, email_corretor, senha_corretor FROM corretor LIMIT 1";

	$query = mysqli_query($conn,$sql);
	//Alocando os dados encontrados na variável $row
	$row = mysqli_fetch_assoc($query);
    $email_corr = $row['email_corretor'];
    $senha_corr = $row['senha_corretor'];

	if($email_corretor === $email_corr || (crypt($senha_corretor, $senha_corr) === $senha_corr)){	

		//Iniciando uma nova sessão, caso não exista
		if(!isset($_SESSION)) session_start();

		//Salvando os dados encontrados na sessão iniciada
		$_SESSION['CorretorID'] = $row['id_corretor'];

		$_SESSION['CorretorEmail'] = $row['email_corretor'];

		$_SESSION['CorretorSenha'] = $row['senha_corretor'];

		$_SESSION['CorretorNome']  = $row['nome_corretor'];

		//$_SESSION['CorretorSexo']  = $resultado['sexo_corretor'];

		//Redirecionando o corretor para área restrita
		//header("Location: restrito.php");
		header("Location: ../painel/principal.php");	


	}else{		

		echo("Error description: " . $mysqli -> error);
		exit;

		//Mensagem de erro caso os dados sejam inválidos
		$_SESSION["login_error"] = "E-mail ou senha inválidos";

		header("Location: ../login.php"); exit;		

	}

	mysqli_close($conn);

}

?>