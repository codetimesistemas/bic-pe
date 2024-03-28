<?php

	//Inicia a sessão

	session_start();



	//Destrói a sessão e limpa valores salvos

	session_destroy();



	//Redireciona o usuário para a página inicial do site

	header("Location: ../login.php");

?>