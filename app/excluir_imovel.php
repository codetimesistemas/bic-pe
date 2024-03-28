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

date_default_timezone_set('America/Recife');

if (isset($_GET["id_imovel"])) {

    $id_imovel = $_GET['id_imovel'];
    $id_corretor = $_GET['id_corretor'];
    
    $queryExluirImovel = "UPDATE corretor_imovel SET isActive = 0
    WHERE id_imovel = $id_imovel AND id_corretor = $id_corretor";   
    $resultExcluirImovel = mysqli_query($conn,$queryExluirImovel) or die(mysqli_error($conn));     

    if(mysqli_affected_rows($conn) != 0){

    echo "<script type='text/javascript'>alert('Imóvel foi removido com sucesso!');location.href='../painel/cadastro_imovel.php';</script>";
    
    }else{

        echo "<script type='text/javascript'>alert('Não foi possível remover seu imóvel.');window.history.go(-1);</script>";

    }
}    
    
?>