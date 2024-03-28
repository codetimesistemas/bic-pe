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

    $infraestruturaArr = $_POST['infraestrutura'] ? $_POST['infraestrutura'] : array();
    $infraExistente = implode(",", $infraestruturaArr);

    $lazerArr = $_POST['lazer'] ? $_POST['lazer'] : array();
    $lazerExistente = implode(",", $lazerArr);

    $id_corretor = $_POST['id_corretor'];
    $data_publicacao = date('Y-m-d');
    $tipo_imovel = $_POST['tipo_imovel'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $qtd_quartos = $_POST['qtd_quartos'];
    $qtd_suites = $_POST['qtd_suites'];
    $qtd_banheiros = $_POST['qtd_banheiros'];
    $qtd_salas = $_POST['qtd_salas'];
    $qtd_vagas_garagem = $_POST['qtd_vagas_garagem'];
    $ano_construcao_imovel = $_POST['ano_construcao_imovel'];
    $area_total_imovel = $_POST['area_total_imovel'];
    $area_util_imovel = $_POST['area_util_imovel'];
    $valor_condominio = $_POST['valor_condominio'];
    $proposito_imovel = $_POST['proposito_imovel'];
    $valor_aluguel_imovel = $_POST['valor_aluguel_imovel'];
    $valor_venda_imovel = $_POST['valor_venda_imovel'];
    $valor_iptu = $_POST['valor_iptu'];
    $mobiliado = $_POST['mobiliado'];
    $aceita_animais = $_POST['aceita_animais'];
    $status_documento_imovel = $_POST['status_documento_imovel'];    
    $link_corretor_imovel = $_POST['link_corretor_imovel'];    
    $infraestrutura = $infraExistente;
    $lazer = $lazerExistente;
    $arquivos = $_FILES['imagem'];

     /*Validações básicas
      Validando quantidade máxima de arquivos*/
    if (count($arquivos['name']) > 5){

        echo "<script type='text/javascript'>alert('O máximo são 5 fotos');window.history.go(-1);</script>";            
        
    }else{            

            $sqlImovel = "INSERT INTO `imovel`(`bairro_imovel`, `cidade_imovel`, `tipo_imovel`, `qtd_quartos`, `qtd_suites`, `qtd_banheiros`, `qtd_salas`, `qtd_vagas_garagem`, `area_total_imovel`, `area_util_imovel`, `valor_condominio`, `valor_aluguel_imovel`, `valor_venda_imovel`,`valor_iptu`, `status_documento_imovel`, `ano_construcao_imovel`, `proposito_imovel`,`infraestrutura`, `lazer`, `mobiliado`, `aceita_animais`) VALUES ('$bairro','$cidade','$tipo_imovel','$qtd_quartos','$qtd_suites','$qtd_banheiros','$qtd_salas','$qtd_vagas_garagem','$area_total_imovel','$area_util_imovel','$valor_condominio','$valor_aluguel_imovel','$valor_venda_imovel','$valor_iptu','$status_documento_imovel','$ano_construcao_imovel','$proposito_imovel','$infraestrutura','$lazer','$mobiliado','$aceita_animais')";
            $insereImovel = mysqli_query($conn,$sqlImovel);
            $last_id = mysqli_insert_id($conn); 


            if(mysqli_affected_rows($conn) != 0 ){   

            $diretorio = "../painel/resources/imagens/$last_id/";
            mkdir($diretorio, 0755);  
            //var_dump($arquivo);                  
            $i = 0;
            for($i = 0; $i < count($arquivos['name']); $i++){    

                $destino = $diretorio . $arquivos['name'][$i];
                if(move_uploaded_file($arquivos['tmp_name'][$i], $destino)){ 
                $nome_arquivo[$i] = $arquivos['name'];
                $nome_arquivo_implode = implode(',',$nome_arquivo[$i]);                
                }
            }                     
            
            $sqlCorretorImovel="INSERT INTO `corretor_imovel`(`id_corretor`, `id_imovel`, `imagem`,`data_publicacao`,`titulo`,`link_corretor_imovel`) VALUES ('$id_corretor','$last_id','$nome_arquivo_implode','$data_publicacao','$titulo','$link_corretor_imovel')";
            $insereCorretorImovel=mysqli_query($conn,$sqlCorretorImovel);                
            

                if(mysqli_affected_rows($conn) != 0){

                echo "<script type='text/javascript'>alert('Seu imóvel foi cadastrado com sucesso!');location.href='../painel/cadastro_imovel.php';</script>";
                
                }else{

                    echo "<script type='text/javascript'>alert('Não foi possível cadastrar seu imóvel. Tente novamente mais tarde.');window.history.go(-1);</script>";

                }
            }    
        }
    } 
?>