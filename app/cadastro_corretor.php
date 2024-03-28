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

    //$nivel_necessario = 2;

    //Valida variável da sessão do usuário
    //if(!isset($_SESSION['AdminID']) || ($_SESSION['AdminTipo'] != $nivel_necessario)){

        //Destrói a sessão caso a validação seja negativa...
       // session_destroy();

        //...e redireciona o usuário para o início do site
       // header("Location: ../config/login.php");
    //}


	if(isset($_POST['cadastrar'])){

		//Prevenindo SQL injection
		$nome_corretor = mysqli_real_escape_string($conn,$_POST['nome_corretor']);
		$creci_corretor = 'CRECI-PE '. mysqli_real_escape_string($conn,$_POST['creci_corretor']);
		$telefone1_corretor = mysqli_real_escape_string($conn,$_POST['telefone1_corretor']);
		$telefone2_corretor = mysqli_real_escape_string($conn,$_POST['telefone2_corretor']);
		$email_corretor = mysqli_real_escape_string($conn,$_POST['email_corretor']);
		$senha_corretor = mysqli_real_escape_string($conn,$_POST['senha_corretor']);
		$options = [
		    'cost' => 12,
		];		
		$hash = password_hash($senha_corretor,PASSWORD_BCRYPT,$options);
		//echo $hash;
		//die;
		

	$sqlCorretor = "INSERT INTO corretor(nome_corretor,creci_corretor,telefone1_corretor,telefone2_corretor,email_corretor,senha_corretor) VALUES('$nome_corretor','$creci_corretor','$telefone1_corretor','$telefone2_corretor','$email_corretor','$hash')";
	$insereCorretor = mysqli_query($conn,$sqlCorretor);

	if(!$inserir){

		echo "<script type='text/javascript'>alert('Não foi possível realizar o seu cadastro. Tente novamente mais tarde.');window.history.go(-1);</script>";


		}else{

			echo "<script type='text/javascript'>alert('Cadastro realizado com sucesso!');location.href='../login.php';</script>";

	}

	mysqli_close($conn);

	}
 
?>