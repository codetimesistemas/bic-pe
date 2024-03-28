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

$id_corretor = $_SESSION['CorretorID'];
$buscar_cidades = "SELECT id_cidade, nome_cidade FROM cidades";
$lista_cidades = mysqli_query($conn,$buscar_cidades);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BIC-PE</title>
    <!-- Required meta tags always come first -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Album - Photo Collection Template , Responsive Bootstrap 4 template , bootstrap 4 starter template, bootstrap4 template, Album template, Photography Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" lang="en" content="Simple Bootstrap 4 Photography template , Responsive and Modern HTML5 Template made from bootstrap 4.">
    <meta name="keywords" lang="en" content="photography template, bootstrap 4 template,bootstrap 4 album template, responsive bootstrap 4 template, bootstrap 4, bootstraping, bootstrap4, oribitthemes, othemes">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" type="image/png" href="../resources/images/icons/favicon.ico" />
    <meta name="description" content="">
    <!--Font Awesome-->
    <link rel="stylesheet" href="resources/dist/font-awesome/css/font-awesome.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="resources/css/main.min.css">
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">

    //carrega o select de estado
    $(document).ready(function() {  

        $('#cidade').on('change', function() {
            $.ajax({
                type:'POST',                
                url: 'select_bairros.php',                
                dataType: 'html',
                data: {'id_cidade': $('#cidade').val()},
                // Antes de carregar os registros, mostra para o usuário que está
                // sendo carregado
                beforeSend: function(xhr) {
                    $('#bairro').html('<option value="">Carregando...</option>');                    
                    $('#bairro').attr('disabled', 'disabled');                
                    
                },
                // Após carregar, disponibiliza os dados no select de procedimentos e
                // no select de valor
                success: function(data) {
                    if ($('#cidade').val() !== '') {
                        // Adiciona o retorno no campo, habilita e da foco
                        $('#bairro').html('<option value="">Selecione</option>');                        
                        $('#bairro').append(data);                 
                        $('#bairro').removeAttr('disabled');                                             
                    } else {
                        $('#bairro').html('<option value="">Bairro</option>');                       
                        $('#bairro').attr('disabled', 'disabled');                        
                    }
                }
            });
        }); 
    });
    
</script>
</head>

<body> 
<nav class="navbar navbar-expand-custom navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="#"><img src="resources/img/logo_bic_pe_png.png"></a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                <li class="nav-item">
                    <a class="nav-link" href="principal.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Imóveis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastro_imovel.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Cadastro de Imóveis</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0);"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Editar Imóvel</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="../config/logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true">Logout</a>
                </li>
            </ul>
        </div>
    </nav>   
    <main id="main" role="main">
        <section class="jumbotron text-center" id="mainBanner">          
            <div class="container">                
                <h2 class="jumbotron-heading">Edite seus imóveis</h2> 
                <br>               
            <form method="POST" action="../app/cadastro_imovel.php"  enctype="multipart/form-data">
              <div class="form-row">                
                <input type="hidden" name="id_corretor" value="<?php echo $_SESSION['CorretorID'] ?>">
                <div class="col-12 col-md-4">
                <select class="form-control" id="tipo_imovel" name="tipo_imovel">
                    <option value="" selected>Tipo</option>
                    <option value="Apartamento">Apartamento</option>
                    <option value="Casa">Casa</option>
                    <option value="Flat">Flat</option>
               </select>
                </div>
                <div class="col-12 col-md-4">
                  <select class="form-control" id="cidade" name="cidade">
                    <option value="">Cidade</option>
                    <?php while($cada_cidade = mysqli_fetch_array($lista_cidades)): ?>
                    <option value="<?php echo $cada_cidade['id_cidade']; ?>"><?php echo $cada_cidade['nome_cidade']; ?></option>
                    <?php endwhile; ?>
               </select>
                </div>
                <div class="col-12 col-md-4">
                 <select class="form-control" id="bairro" name="bairro" disabled="disabled">                    
                    <option value="">Bairro</option>                    
               </select>
                </div>                
              </div>
              <br>
              <div class="form-row">                
                <div class="col-12 col-md-4">
                <select class="form-control" id="qtd_quartos" name="qtd_quartos">
                    <option value="" selected>Quartos</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
               </select>
                </div>
                <div class="col-12 col-md-4">
                  <select class="form-control" id="qtd_suites" name="qtd_suites">
                    <option value="" selected>Suíte</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
               </select>
                </div>
                <div class="col-12 col-md-4">
                 <select class="form-control" id="qtd_banheiros" name="qtd_banheiros">
                    <option value="" selected>Banheiro</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
               </select>
                </div>  
              </div>
              <br>
              <div class="form-row">                
                <div class="col-12 col-md-4">
                <select class="form-control" id="qtd_salas" name="qtd_salas">
                    <option value="" selected>Sala</option>
                    <option value="1">1</option>
                    <option value="2">2</option>                    
               </select>
                </div>
                <div class="col-12 col-md-4">
                  <select class="form-control" id="qtd_vagas_garagem" name="qtd_vagas_garagem">
                    <option value="" selected>Vaga Garagem</option>
                    <option value="1">1</option>
                    <option value="2">2</option>                    
                  </select>
                </div> 
                <div class="col-12 col-md-4">
                  <select class="form-control" id="qtd_vagas_garagem" name="qtd_vagas_garagem">
                    <option value="Mobiliado">Mobiliado</option>
                    <option value="Não Mobiliado">Não Mobiliado</option>
                    <option value="Semi Mobiliado">Semi Mobiliado</option>                 
                  </select>
                </div>                  
              </div>
              <br>  
              <div class="form-row">  
               <div class="col-12 col-md-4">
                <select class="form-control" id="ano_construcao_imovel" name="ano_construcao_imovel">
                    <option value="" selected>Ano Construção</option>
                    <option value="1974">1974</option>
                    <option value="1975">1975</option>
                    <option value="1976">1976</option>
                    <option value="1977">1977</option>
                    <option value="1978">1978</option>
                    <option value="1979">1979</option>
                    <option value="1980">1980</option>
                    <option value="1981">1981</option>
                    <option value="1982">1982</option>
                    <option value="1983">1983</option>
                    <option value="1984">1984</option>
                    <option value="1985">1985</option>
                    <option value="1986">1986</option>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>                   
               </select>
                </div>                               
                <div class="col-12 col-md-4">
                    <input type="number" class="form-control" id="area_util_imovel" name="area_util_imovel" placeholder="Área Útil">
                </div>
                <div class="col-12 col-md-4">
                    <input type="number" class="form-control" id="area_total_imovel" name="area_total_imovel" placeholder="Área Total">
                </div> 

                                                                   
              </div> 
              <br>             
              <div class="form-row">  
              <div class="col-12 col-md-4">
                  <select  class="form-control" id="proposito_imovel" name="proposito_imovel">
                    <option value="0" selected="">Aluguel</option>
                    <option value="1">Venda</option>                                        
                  </select>
                </div>                  
                <div class="col-12 col-md-4">    
                <div id="valor_aluguel_imovel">               
                    <input  type="number" class="form-control" id="valor_aluguel_imovel" name="valor_aluguel_imovel" placeholder="Valor Aluguel">
                </div> 
                <div id="valor_venda_imovel" style="display:none;">                          
                    <input  type="number" class="form-control" id="valor_venda_imovel" name="valor_venda_imovel" placeholder="Valor Venda">                   
                </div>
                </div>                    
                <div class="col-12 col-md-4">                   
                <input type="number" class="form-control" id="valor_condominio" name="valor_condominio" placeholder="Valor Condomínio">
                </div>                 
                </div>
                <br>
                <div class="form-row">   
                    <!-- <div class="col-12 col-md-6" style="text-align:left">                     
                    <input type="text" class="form-control" id="link_corretor_imovel" name="link_corretor_imovel" placeholder="Informe o link do anúncio">              
                    </div> -->      
                    <div class="col-12 col-md-6">                   
                    <input type="number" class="form-control" id="valor_iptu" name="valor_iptu" placeholder="Valor IPTU">
                </div>                
                    <div class="col-12 col-md-6" style="text-align:left">                     
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Informe um título para o anúncio.">              
                    </div>                                                               
                  </div>  
                  <br>
                <div class="form-row">                                                  
                    <div class="col-12 col-md-12" style="text-align:left">  
                    <label for="file">Escolha até 5 imagens:</label>
                    <input type="file" id="imagem" name="imagem[]" multiple="multiple"  required="required">   
                    </div>                                                                   
                </div>                                  
                  <br>
                  <div class="form-row">
                  <div class="col-12 col-md-3" style="text-align: left;">
                  <legend style="font-size: 16px;">Infraestrutura:</legend>
                  <div class="form-check">                    
                  <input class="form-check-input" type="checkbox" id="infraestrutura" name="infraestrutura[]" value="Elevador">
                  <label class="form-check-label" for="infraestrutura">
                    Elevador
                  </label>
                </div>
                <div class="form-check">                   
                  <input class="form-check-input" type="checkbox" id="infraestrutura" name="infraestrutura[]" value="Bicicletário">
                  <label class="form-check-label" for="infraestrutura">
                    Bicicletário
                  </label>
                </div>
                <div class="form-check">                    
                  <input class="form-check-input" type="checkbox" id="infraestrutura" name="infraestrutura[]" value="Porteiro 24hs">
                  <label class="form-check-label" for="infraestrutura">
                    Porteiro 24hs
                  </label>
                </div>
                <div class="form-check">                   
                  <input class="form-check-input" type="checkbox" id="infraestrutura" name="infraestrutura[]" value="Porteiro Eletrônico">
                  <label class="form-check-label" for="infraestrutura">
                    Porteiro Eletrônico
                  </label>
                </div>
                <div class="form-check">                   
                  <input class="form-check-input" type="checkbox" id="infraestrutura" name="infraestrutura[]" value="Gás encanado">
                  <label class="form-check-label" for="infraestrutura">
                    Gás Encanado
                  </label>
                </div>
                </div> 
                <div class="col-12 col-md-3" style="text-align: left;">
                  <legend style="font-size: 16px;">Lazer:</legend>
                  <div class="form-check">                    
                  <input class="form-check-input" type="checkbox" id="lazer" name="lazer[]" value="Piscina">
                  <label class="form-check-label" for="lazer">
                    Piscina
                  </label>
                </div>
                <div class="form-check">                   
                  <input class="form-check-input" type="checkbox" type="checkbox" id="lazer" name="lazer[]" value="Salão de Festas">
                  <label class="form-check-label" for="lazer">
                    Salão de Festas
                  </label>
                </div>
                <div class="form-check">                    
                  <input class="form-check-input" type="checkbox" type="checkbox" id="lazer" name="lazer[]" value="Quadra de Jogos" >
                  <label class="form-check-label" for="lazer">
                    Quadra de Jogos
                  </label>
                </div>
                <div class="form-check">                   
                  <input class="form-check-input" type="checkbox" type="checkbox" id="lazer" name="lazer[]" value="Playground" >
                  <label class="form-check-label" for="lazer">
                    Playground
                  </label>
                </div>
                </div>                                                                       
                <div class="col-12 col-md-3" style="text-align: left;">
                  <legend style="font-size: 16px;">Aceita Animais:</legend>
                  <div class="form-check">                    
                  <input class="form-check-input" type="radio" value="Não" id="aceita_animais1" name="aceita_animais">
                  <label class="form-check-label" for="aceita_animais1">
                    Não
                  </label>
                </div>
                <div class="form-check">                   
                  <input class="form-check-input" type="radio" value="Sim" id="aceita_animais2" name="aceita_animais">
                  <label class="form-check-label" for="aceita_animais2">
                    Sim
                  </label>
                </div>
                </div>    
                <div class="col-12 col-md-3" style="text-align: left;">
                  <legend style="font-size: 16px;">Status Documentação:</legend>
                  <div class="form-check">                    
                  <input class="form-check-input" type="radio" value="Desconhecido" id="status_documento_imovel1" name="status_documento_imovel">
                  <label class="form-check-label" for="status_documento_imovel1">
                    Desconhecido
                  </label>
                </div>
                <div class="form-check">                   
                  <input class="form-check-input" type="radio" value="OK" id="status_documento_imovel2" name="status_documento_imovel">
                  <label class="form-check-label" for="status_documento_imovel2">
                    OK
                  </label>
                </div>
                </div>                            
              </div>            
              <div class="form-group" style="margin-top: 50px;">
                <div class="col-12 col-md-12" style="text-align: right;">   
                    <button type="submit" name="enviar" class=" btn btn-primary">Enviar</button>
                    <button type="button" class=" btn btn-danger" onclick="location.href='cadastro_imovel.php'">Limpar</button>
                </div>
              </div>
            </form>
            </div>
        </div>
        </section>        
        <a href="#" class="btn btn-primary scrollUp">
            <i class="fa fa-arrow-circle-o-up"></i>
        </a>
    </main>
    <!-- Footer -->
    <footer id="footer" style="height: 70px;">
        <p class="copyright">Made By
            <!--<a target="_blank" title="Orbit Themes" href="http://www.orbitthemes.com">Orbit Themes</a> &copy;-->
            <img class="codetime_logo" src="resources/img/codetime_logo3.png" style="margin-top: 1px;" alt="codetime_logo">
            <span id="currentYear"></span> All Rights Reserved.
        </p>        
    </footer>  
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="resources/dist/jquery/jquery.min.js"></script>
    <script src="resources/dist/popper/popper.min.js" integrity=""></script>
    <script src="resources/dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="resources/js/script.js"></script>
    <script src="resources/js/main.min.js"></script>
</body>
<script type="text/javascript">             

            var select = document.getElementById("proposito_imovel");
            // opções quando o select muda 
            select.onchange = function () {
            var valor = select.options[select.selectedIndex].value;           
            
                if(valor == "0"){  

                    document.getElementById("valor_aluguel_imovel").style.display = 'block';  
                    document.getElementById("valor_venda_imovel").style.display = 'none';                

                }else{

                    document.getElementById("valor_venda_imovel").style.display = 'block';  
                    document.getElementById("valor_aluguel_imovel").style.display = 'none';  

                }
            }                          
    </script> 
</html>