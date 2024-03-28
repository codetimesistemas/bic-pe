<?php
	require_once "conexao.php";

	//Iniciando uma nova sessão, caso não já exista uma aberta
	if(!isset($_SESSION)) session_start();

	if(!isset($_SESSION['CorretorID'])){

        //Destrói a sessão caso a validação seja negativa...
        session_destroy();

        //...e redireciona o usuário para o início do site
        header("Location: ../login.php");
    }	

	//Verificando se o formulário de recuperação de senha foi preenchido
	if((!empty($_POST)) AND (empty($_POST['email_corretor']))){


		$_SESSION["login_error"] = "Informe seu e-mail";

		header("Location: ../redefinir_senha.php"); exit;


	}else{

	//Prevenindo SQL injection
	$email_corretor = mysqli_real_escape_string($conn,$_POST['email_corretor']);


	//Validando os dados informados pelo usuário
	$sql = "SELECT id_corretor,nome_corretor,email_corretor,senha_corretor FROM corretor WHERE email_corretor = '$email_corretor' LIMIT 1";

	$query = mysqli_query($conn,$sql);


	if(mysqli_num_rows($query) != 1){

		//Mensagem de erro caso os dados sejam inválidos
		$_SESSION["login_error"] = "Usuário não encontrado";

		header("Location: ../redefinir_senha.php"); exit;


	}else{

		//Alocando os dados encontrados na variável $resultado
		$resultado = mysqli_fetch_assoc($query);
		$email = $resultado['email_corretor'];
		$nome = $resultado['nome_corretor'];		
		$token = sha1($resultado['id_corretor'] . $resultado['senha_corretor']);
		

		if (filter_var($email, FILTER_VALIDATE_EMAIL)):
			// receiver email address
			$to = $email;
			
			// prepare header
			$header = 'From: ' . 'contato.codetime@gmail.com' . "\r\n";			
			// $header .= 'Cc:  ' . 'example@domain.com' . "\r\n";
			// $header .= 'Bcc:  ' . 'example@domain.com' . "\r\n";
			$header .= 'X-Mailer: PHP/' . phpversion();
			
			// Contact Subject
			$subject = 'Recuperação de senha';
			
			// Contact Message
			$message = "Clique no link ou copie e cole no navegador para redefinir a sua senha: http://www.bicpe.com.br/config/alterar_senha.php?token=$token";

			// Send contact information	
			$mail = mail( $to, $subject , $message, $header );			
					
			if(!$mail):

			$_SESSION["login_error"] = "E-mail não enviado";
			header("Location: ../redefinir_senha.php");			

			else:

			$_SESSION["login_sucess"] = "E-mail de recuperação enviado!";
			header("Location: ../login.php");
			

		endif;
		endif;					

	}	

}

?>