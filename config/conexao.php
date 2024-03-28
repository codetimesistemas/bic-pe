<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "bicpe";


	$conn = mysqli_connect($host,$usuario,$senha,$banco);


	if(!$conn){

		echo "Falha na conexão com o banco de dados";

	}

?>