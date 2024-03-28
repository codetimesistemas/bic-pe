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


if (isset($_POST["enviar"])) {
    
    $arquivos = $_FILES['imagem'];
     /*Validações básicas
      Validando quantidade máxima de arquivos*/
    if (count($arquivos['name']) > 5){

        echo "<script type='text/javascript'>alert('O máximo são 5 fotos.');window.history.go(-1);</script>";            
        
    }else{  

        $diretorio = "../painel/resources/imagens/";
        //mkdir($diretorio, 0755);                           
        //exit;
        //$cont = array_filter($arquivos['name']);
        $i = 0;
        for($i = 0; $i < count($arquivos['name']); $i++){     

            $destino = $diretorio . $arquivos['name'][$i]; 
            if(move_uploaded_file($arquivos['tmp_name'][$i], $destino)){

            $nome_arquivo[$i] = $arquivos['name'];
            //var_dump($nome_arquivo[$i]);
            //exit;     
            $nome_arquivo_implode = implode(', ',$nome_arquivo[$i]);
            //echo $nome_arquivo_implode;
            //exit; 
            }                                       
        }

        $sqlImagem="INSERT INTO `imagem`(`nome_imagem`) VALUES ('$nome_arquivo_implode')";
        $insereImagem=mysqli_query($conn,$sqlImagem);            
    
        if(mysqli_affected_rows($conn) != 0){

        echo "<script type='text/javascript'>alert('Seu imóvel foi cadastrado com sucesso!');location.href='../painel/teste1.php';</script>";
        
            }else{

                echo "<script type='text/javascript'>alert('Não foi possível cadastrar seu imóvel. Tente novamente mais tarde.');window.history.go(-1);</script>";   

            }              
        }
    } 
?>