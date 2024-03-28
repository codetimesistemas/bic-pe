<?php
	 require "../config/conexao.php";
    //Iniciando uma nova sessão, caso não já exista uma aberta
    if(!isset($_SESSION)) session_start();

    if(!isset($_SESSION['CorretorID'])){

        //Destrói a sessão caso a validação seja negativa...
        session_destroy();

        //...e redireciona o usuário para o início do site
        header("Location: ../login.php");
    }

    //Valida variável da sessão do usuário
    /*if(!isset($_SESSION['AdminID']) || ($_SESSION['AdminTipo'] != $nivel_necessario)){

        //Destrói a sessão caso a validação seja negativa...
        session_destroy();

        //...e redireciona o usuário para o início do site
        header("Location: login_admin.php");
    }*/
    
	header ('Content-type: text/html; charset=utf-8');

	// Obtem $_POST['cidade'] de maneira mais segura
	$cidadeID = filter_input(INPUT_POST, 'id_cidade',FILTER_VALIDATE_INT);


	$sql = "SELECT b.id_bairro,b.id_cidade,b.nome_bairro FROM bairros AS b INNER JOIN cidades AS c ON b.id_cidade = c.id_cidade WHERE b.id_cidade = '$cidadeID'";
	$query = mysqli_query($conn,$sql);
	

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8" /> 
	<title></title>
</head>
<body>

<?php
	while($row = mysqli_fetch_assoc($query)):
?>
	
	<option value="<?php echo $row['id_bairro']; ?>"><?php echo $row['nome_bairro']; ?></option>

<?php
	endwhile;
?>

</body>
</html>
