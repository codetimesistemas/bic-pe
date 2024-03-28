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
    $buscarCidades = "SELECT id_cidade, nome_cidade FROM cidades";
    $listaCidades = mysqli_query($conn,$buscarCidades);
    
    $buscarImoveisAluguel = "SELECT valor_aluguel_imovel, MIN(valor_aluguel_imovel) minValor,MAX(valor_aluguel_imovel) maxValor FROM imovel WHERE proposito_imovel = 'Aluguel'";
    $resultadoImoveisAluguel = mysqli_query($conn,$buscarImoveisAluguel);
    $rangeValorAluguel = mysqli_fetch_array($resultadoImoveisAluguel);    

    $buscarImoveisVenda = "SELECT MIN(valor_venda_imovel) minValor,MAX(valor_venda_imovel) maxValor FROM imovel WHERE proposito_imovel = 'Venda'";
    $resultadoImoveisVenda = mysqli_query($conn,$buscarImoveisVenda);
    $rangeValorVenda = mysqli_fetch_array($resultadoImoveisVenda);

    $buscarAreaImoveis = "SELECT area_util_imovel, MIN(area_util_imovel) minArea,MAX(area_util_imovel) maxArea FROM imovel WHERE proposito_imovel = 'Aluguel'";
    $resultadoAreaImoveis = mysqli_query($conn,$buscarAreaImoveis);
    $rangeAreaImovel = mysqli_fetch_array($resultadoAreaImoveis);  

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
    
    <!--[if IE]>
      <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
    <![endif]-->
    <!--[if lt IE 9]>
      <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css" rel="stylesheet">
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    //carrega o select de estado
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
                <li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0);"><i class="fas fa-tachometer-alt"></i>Imóveis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastro_imovel.php"><i class="far fa-address-book"></i>Cadastro de Imóveis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);"><i class="far fa-clone"></i>Components</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);"><i class="far fa-calendar-alt"></i>Calendar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);"><i class="far fa-chart-bar"></i>Charts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../config/logout.php"><i class="far fa-copy"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>     
    <main id="main" role="main">
        <section class="jumbotron jumbotron-fluid  text-center" id="mainBanner">
            <div class="container">                    
                </div>
                <h2 class="jumbotron-heading">Busque o imóvel e contacte um parceiro</h2>
                <!--<p class="lead text-muted">Your gallery is an asset to your business. Use it to post examples of your photography, or your school's
                    facilities and students work. Watermark your photos and enable sharing with the social options feature.</p>-->                
            <form method="POST">
            <div class="container"> 
                <p>
                    <button type="submit" name="venda" class="btn btn-primary my-2">VENDA</button>
                    <button type="submit" name="aluguel" class="btn btn-primary my-2">ALUGUEL</button>
                </p>
              <div class="form-row">                
                <div class="col-12 col-md-4">
                <select class="form-control" id="tipo_imovel" name="tipo_imovel">
                    <option value="">Tipo</option>
                    <option value="Apartamento">Apartamento</option>
                    <option value="Casa">Casa</option>
                    <option value="Flat">Flat</option>
               </select>
                </div>
                <div class="col-12 col-md-4">
                  <select class="form-control" id="cidade" name="cidade">
                    <option value="">Cidade</option>
                    <?php while($cada_cidade = mysqli_fetch_array($listaCidades)): ?>
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
                <select class="form-control" id="mobiliado" name="mobiliado">                    
                    <option value="Mobiliado">Mobiliado</option>
                    <option value="Não Mobiliado">Não Mobiliado</option>
                    <option value="Semi Mobiliado">Semi Mobiliado</option>
               </select>
                </div> 
                <div class="col-12 col-md-4">
                <select class="form-control" id="status_documento_imovel" name="status_documento_imovel">       
                    <option value="">Status Documentação</option>             
                    <option value="Desconhecido">Desconhecido</option>
                    <option value="OK">OK</option>
               </select>
                </div> 
                <div class="col-12 col-md-4">
                <select class="form-control" id="aceita_animais" name="aceita_animais">     
                    <option value="">Aceita Animais</option>               
                    <option value="Não">Não</option>
                    <option value="Sim">Sim</option>
               </select>
                </div> 
                </div>
                <br>
                <div class="form-row">
                    <div class="col-12 col-md-3"> 
                         <h6 style="text-align:left;">Quartos</h6>                        
                         <div class="radio-inputs">
                          <label class="radio" for="qtd_quartos1">
                            <input type="radio" value="1" id="qtd_quartos1" name="qtd_quartos" >
                            <span class="name">1</span>
                          </label>
                          <label class="radio" for="qtd_quartos2">
                            <input type="radio" value="2" id="qtd_quartos2" name="qtd_quartos">
                            <span class="name">2</span>
                          </label>                          
                          <label class="radio" for="qtd_quartos3">
                            <input type="radio" value="3" id="qtd_quartos3" name="qtd_quartos">
                            <span class="name">3</span>
                          </label>
                          <label class="radio" for="qtd_quartos4">
                            <input type="radio" value="4" id="qtd_quartos4" name="qtd_quartos">
                            <span class="name">4+</span>
                          </label>
                        </div>
                    </div>
                    <div class="col-12 col-md-3"> 
                         <h6 style="text-align:left;">Suítes</h6>                        
                         <div class="radio-inputs">
                          <label class="radio" for="qtd_suites1">
                            <input type="radio" value="1" id="qtd_suites1" name="qtd_suites" >
                            <span class="name">1</span>
                          </label>
                          <label class="radio" for="qtd_suites2">
                            <input type="radio" value="2" id="qtd_suites2" name="qtd_suites">
                            <span class="name">2</span>
                          </label>                          
                          <label class="radio" for="qtd_suites3">
                            <input type="radio" value="3" id="qtd_suites3" name="qtd_suites">
                            <span class="name">3</span>
                          </label>
                          <label class="radio" for="qtd_suites4">
                            <input type="radio" value="4" id="qtd_suites4" name="qtd_suites">
                            <span class="name">4+</span>
                          </label>
                        </div>
                    </div>
                    <div class="col-12 col-md-3"> 
                         <h6 style="text-align:left;">Banheiros</h6>                        
                         <div class="radio-inputs">
                          <label class="radio" for="qtd_banheiros1">
                            <input type="radio" value="1" id="qtd_banheiros1" name="qtd_banheiros" >
                            <span class="name">1</span>
                          </label>
                          <label class="radio" for="qtd_banheiros2">
                            <input type="radio" value="2" id="qtd_banheiros2" name="qtd_banheiros">
                            <span class="name">2</span>
                          </label>                          
                          <label class="radio" for="qtd_banheiros3">
                            <input type="radio" value="3" id="qtd_banheiros3" name="qtd_banheiros">
                            <span class="name">3</span>
                          </label>                          
                        </div>
                    </div>                    
                    <div class="col-12 col-md-3"> 
                         <h6 style="text-align:left;">Vagas</h6>                        
                         <div class="radio-inputs">
                          <label class="radio" for="qtd_vagas_garagem1">
                            <input type="radio" value="1" id="qtd_vagas_garagem1" name="qtd_vagas_garagem">
                            <span class="name">1</span>
                          </label>
                          <label class="radio" for="qtd_vagas_garagem2">
                            <input type="radio" value="2" id="qtd_vagas_garagem2" name="qtd_vagas_garagem">
                            <span class="name">2</span>
                          </label> 
                          <label class="radio" for="qtd_vagas_garagem3">
                            <input type="radio" value="3" id="qtd_vagas_garagem3" name="qtd_vagas_garagem">
                            <span class="name">3</span>
                          </label>                          
                        </div>
                    </div>
                </div>
                <br>                    
                <div class="form-row">  
                    <div class="col-12 col-md-12">                        
                        <input type="range"  class="form-range" min="<?php echo $rangeValorAluguel['minValor']; ?>" max="<?php echo $rangeValorAluguel['maxValor']; ?>" id="valor_aluguel_imovel" name="valor_aluguel_imovel[]" onInput="$('#rangevalmax').html($(this).val())" style="width: 80%;">  
                          <label for="valor_aluguel_imovel"  class="form-label label-range">Até R$ <span id="rangevalmax"></span></label>                      
                    </div>                    

                </div>
              <div class="form-row">  
                    <div class="col-12 col-md-12">                        
                        <input type="range"  class="form-range" min="<?php echo $rangeAreaImovel['minArea'];?>" max="<?php echo $rangeAreaImovel['maxArea']; ?>" id="area_util_imovel" name="area_util_imovel[]" onInput="$('#rangeareamax').html($(this).val())" style="width: 80%;">
                        <label for="area_util_imovel"  class="form-label label-range">Até <span id="rangeareamax"></span>m²</label>
                    </div>                                      
              </div> 
              <br>
              <div class="form-row">  
                <div class="col-12 col-md-12" style="text-align: right;">
                    <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                    <button type="button" class=" btn btn-danger" onclick="location.href='principal.php'">Limpar</button>
                </div>
              </div>
          </div>
            </form>
            </div>
        </section>
        <?php  
        if(isset($_POST['buscar'])): 

        if(isset($_POST['bairro'])){
            $_POST['bairro'];
        }else{
            $_POST['bairro'] = '';
        } 

        if(isset($_POST['qtd_quartos'])){
            $_POST['qtd_quartos'];            
        }else{
            $_POST['qtd_quartos'] = '';
        } 

        if(isset($_POST['qtd_suites'])){
            $_POST['qtd_suites'];            
        }else{
            $_POST['qtd_suites'] = '';
        } 

        if(isset($_POST['qtd_banheiros'])){
            $_POST['qtd_banheiros'];            
        }else{
            $_POST['qtd_banheiros'] = '';
        } 

        if(isset($_POST['qtd_vagas_garagem'])){
            $_POST['qtd_vagas_garagem'];            
        }else{
            $_POST['qtd_vagas_garagem'] = '';
        }   
          
        $tipo_imovel = $_POST['tipo_imovel'];
        $cidade = $_POST['cidade'];      
        $bairro = $_POST['bairro'];
        $mobiliado = $_POST['mobiliado'];
        $status_documento_imovel = $_POST['status_documento_imovel'];
        $aceita_animais = $_POST['aceita_animais'];
        $qtd_quartos = $_POST['qtd_quartos'];
        $qtd_suites = $_POST['qtd_suites'];
        $qtd_banheiros = $_POST['qtd_banheiros'];
        $qtd_vagas_garagem = $_POST['qtd_vagas_garagem'];
        $area_util_imovel = $_POST['area_util_imovel'];
        $areaUtil = implode('',$area_util_imovel);
        //$valor_venda_imovel = $_POST['valor_venda_imovel'];// ? $_POST['valor_venda_imovel'] : 0.00;
        //  echo $valor_venda_imovel ."<br>";
        // exit;
        $valor_aluguel_imovel = $_POST['valor_aluguel_imovel'];
        $valorAluguel = implode('',$valor_aluguel_imovel);
        
            $verifica = 0;
            if(!empty($_POST['tipo_imovel']) && !empty($_POST['cidade']) && !empty($_POST['bairro']) && !empty($_POST['mobiliado']) &&!empty($_POST['status_documento_imovel']) &&!empty($_POST['aceita_animais']) &&!empty($_POST['qtd_quartos']) &&!empty($_POST['qtd_suites']) &&!empty($_POST['qtd_banheiros']) &&!empty($_POST['qtd_vagas_garagem']) &&!empty($_POST['area_util_imovel']) &&!empty($_POST['valor_aluguel_imovel'])):   

            $buscarImoveis = "SELECT i.id_imovel, i.bairro_imovel, i.cidade_imovel, i.tipo_imovel, i.qtd_quartos, i.qtd_suites, i.qtd_banheiros, i.qtd_salas, i.qtd_vagas_garagem, i.area_total_imovel, i.area_util_imovel, i.valor_condominio, i.valor_aluguel_imovel, i.valor_venda_imovel, i.valor_iptu, i.status_documento_imovel, i.ano_construcao_imovel, i.proposito_imovel, i.infraestrutura, i.lazer, i.mobiliado, i.aceita_animais, ci.id_corretor_imovel, ci.id_corretor, ci.imagem, ci.data_publicacao, ci.data_renovacao, ci.data_bloqueio, ci.titulo, ci.link_corretor_imovel, c.nome_cidade, b.nome_bairro, co.nome_corretor, co.creci_corretor, co.telefone1_corretor, co.telefone2_corretor
                FROM corretor co
                INNER JOIN corretor_imovel ci ON co.id_corretor = ci.id_corretor
                INNER JOIN imovel i  ON ci.id_imovel = i.id_imovel
                INNER JOIN bairros b ON i.bairro_imovel = b.id_bairro
                INNER JOIN cidades c ON c.id_cidade = b.id_cidade  
                WHERE i.tipo_imovel = '$tipo_imovel' AND i.cidade_imovel = '$cidade' AND i.bairro_imovel = '$bairro' AND i.qtd_quartos <= '$qtd_quartos' AND i.qtd_suites <= '$qtd_suites' AND i.qtd_banheiros <= '$qtd_banheiros' AND i.qtd_vagas_garagem <= '$qtd_vagas_garagem' AND i.area_util_imovel <= '$areaUtil' AND i.valor_aluguel_imovel <= $valorAluguel AND i.mobiliado = '$mobiliado' AND i.aceita_animais = '$aceita_animais' AND i.status_documento_imovel = '$status_documento_imovel' AND ci.isActive = 1";
            $listaBuscaImoveis = mysqli_query($conn,$buscarImoveis); 
            $verifica = mysqli_num_rows($listaBuscaImoveis);                     
            endif;
            if($verifica > 0):
         ?>    

            <div class="album py-5 bg-light">
                <div class="container">                
                    <div class="row">
                        <div class="col-md-12" id="collection-heading">
                        <h6 style="text-align: left; margin-left: 5px; margin-bottom: -5px;"><b>Sua pesquisa retornou <?php echo mysqli_num_rows($listaBuscaImoveis);?> Imóveis.</b></h6>
                        </div>
                    </div>
                    <?php 
                        //$i = 1;
                        while($resultadoBusca = mysqli_fetch_array($listaBuscaImoveis)){ 
                            $fotos = explode(",", $resultadoBusca['imagem']);

                            ?>                         
                    <div class="container-card">                      
                        <div class="image-card"> 
                        <div id="carouselExampleIndicators" class="carousel" data-ride="carousel" >    
                              <ol class="carousel-indicators">
                                    <?php 
                                    $controle_ativo = 2;
                                    $controle_num_slide = 1;
                                    foreach ($fotos as $foto) { 
                                    if($controle_ativo == 2){ ?>                                
                                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>                                
                                    <?php $controle_ativo = 1;
                                    }else{ ?>                                
                                      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $controle_num_slide; ?>"></li><?php 
                                    }
                                } 
                            ?>                                                            
                              </ol>
                              <div class="carousel-inner">
                                <?php 
                                $controle_ativo = 2;
                                foreach ($fotos as $foto) { 
                                if($controle_ativo == 2){ ?> 
                                    <div class="carousel-item active">
                                      <img class="img-card" src="resources/imagens/<?php echo $resultadoBusca['id_imovel'];?>/<?php echo $foto;?>" alt="Primeiro Slide">
                                    </div><?php 
                                    $controle_ativo = 1;
                                }else{ ?>
                                    <div class="carousel-item">
                                      <img class="img-card" src="resources/imagens/<?php echo $resultadoBusca['id_imovel'];?>/<?php echo $foto;?>" alt="Segundo Slide">
                                    </div><?php 
                                    }
                                } 
                             ?>                                   
                              </div>
                              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Próximo</span>
                              </a>
                            </div>
                       </div>                    
                        <div class="card w-75">
                            <div class="body-card">
                                <p class="card-text"><?php echo  $resultadoBusca['nome_bairro']." , ".$resultadoBusca['nome_cidade']." - PE" ?></p>  
                                <h5 class="card-title"><?php echo  $resultadoBusca['titulo']; ?></h5>
                                <ul class="property-card_amenities">                               
                                    <li class="amenities_item " title="<?php echo $resultadoBusca['area_util_imovel']; ?>"> <?php echo $resultadoBusca['area_util_imovel']; ?>m²</li>                                     
                                    <li class="amenities_item " title="<?php echo  $resultadoBusca['qtd_quartos'] ?>"> <?php echo $resultadoBusca['qtd_quartos'] ?> quartos</li> 
                                    <li class="amenities_item " title="<?php echo $resultadoBusca['qtd_suites'] ?>"> <?php echo $resultadoBusca['qtd_suites'] ?> suítes</li>
                                    <li class="amenities_item " title="<?php $resultadoBusca['qtd_banheiros'] ?>"> <?php echo $resultadoBusca['qtd_banheiros'] ?> banheiros</li> 
                                    <li class="amenities_item " title="<?php echo $resultadoBusca['qtd_salas'] ?>"> <?php echo $resultadoBusca['qtd_salas'] ?> salas</li> 
                                    <li class="amenities_item " title="<?php echo $resultadoBusca['qtd_vagas_garagem'] ?>"> <?php echo $resultadoBusca['qtd_vagas_garagem'] ?> vagas</li>                          
                                </ul>  
                                <ul class="property-card__amenities">
                                    <?php                            
                                    $infraestruturas = explode(",", $resultadoBusca['infraestrutura']);
                                    foreach($infraestruturas as $infraestrutura):
                                        if($infraestrutura != ""):
                                    ?>
                                    <li class="amenities__item" title="<?php echo $infraestrutura ?>"> <?php echo $infraestrutura?></li>                                      
                                     <?php 
                                        endif;
                                        endforeach; 
                                     ?>                                            
                                </ul>  
                                <ul class="property-card__amenities">
                                    <?php 
                                    $lazeres = explode(",", $resultadoBusca['lazer']);
                                    foreach($lazeres as $lazer):
                                        if($lazer != ""):
                                    ?>
                                    <li class="amenities__item" title="<?php echo $lazer ?>"> <?php echo $lazer?></li>                                      
                                     <?php 
                                        endif;
                                        endforeach; 
                                      ?>                                          
                                </ul>   
                                <?php if($resultadoBusca['valor_aluguel_imovel'] > 0){?>                        
                                    <p class="card-text"><b>R$ <?php echo number_format($resultadoBusca['valor_aluguel_imovel'],2,",","."); ?><small> /mês</small></b></p>
                                <?php }else{ ?>
                                    <p class="card-text"><b>R$ <?php echo number_format($resultadoBusca['valor_venda_imovel'],2,",","."); ?></b><small> /mês</small></p>
                                <?php } ?>
                                    <?php if($resultadoBusca['valor_condominio'] > 0){?>
                                    <p style="font-size: 13px;" class="card-subtitle">Condomínio: <b>R$ <?php echo number_format($resultadoBusca['valor_condominio'],0,",","."); ?></b></p>
                                <?php }?>
                                    <?php if($resultadoBusca['valor_iptu'] > 0){?>
                                    <p style="font-size: 13px;" class="card-subtitle">IPTU: <b>R$ <?php echo number_format($resultadoBusca['valor_iptu'],0,",","."); ?></b></p>
                                    <?php }?>                            
                            </div>
                            <a  href="#" class="btn btn-primary" title="<?php echo $resultadoBusca['nome_corretor']; ?>" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="<?php echo $resultadoBusca['telefone1_corretor']; ?>">Clique e contacte o parceiro para mais informações.</a>
                        </div>
                    </div>
                    <br><br>
                    <?php }  ?>        
            </div><!--Fim container-->
        </div>
        <?php        
        else:
            
            echo "<script type='text/javascript'>alert('Nenhum resultado de imóvel para essa pesquisa.');location.href='principal.php'</script>";

        endif; ?>
        <?php elseif(isset($_POST['aluguel'])):
        $buscarImoveis = "SELECT i.id_imovel, i.bairro_imovel, i.cidade_imovel, i.tipo_imovel, i.qtd_quartos, i.qtd_suites, i.qtd_banheiros, i.qtd_salas, i.qtd_vagas_garagem, i.area_total_imovel, i.area_util_imovel, i.valor_condominio, i.valor_aluguel_imovel, i.valor_venda_imovel, i.valor_iptu, i.status_documento_imovel, i.ano_construcao_imovel, i.proposito_imovel, i.infraestrutura, i.lazer, i.mobiliado, i.aceita_animais, ci.id_corretor_imovel, ci.id_corretor, ci.imagem, ci.data_publicacao, ci.data_renovacao, ci.data_bloqueio, ci.titulo, ci.link_corretor_imovel, c.nome_cidade, b.nome_bairro, co.nome_corretor, co.creci_corretor, co.telefone1_corretor, co.telefone2_corretor
            FROM corretor co
            INNER JOIN corretor_imovel ci ON co.id_corretor = ci.id_corretor
            INNER JOIN imovel i  ON ci.id_imovel = i.id_imovel
            INNER JOIN bairros b ON i.bairro_imovel = b.id_bairro
            INNER JOIN cidades c ON c.id_cidade = b.id_cidade   
            WHERE ci.id_corretor = $id_corretor AND ci.isActive = '1' AND i.proposito_imovel = 'Aluguel'";
        $listaImoveis = mysqli_query($conn,$buscarImoveis); ?>    
        <div class="album py-5 bg-light">
            <div class="container">                
                <div class="row">
                    <div class="col-md-12" id="collection-heading">
                    <h6 style="text-align: left; margin-left: 5px; margin-bottom: -5px;"><b>Encontrados <?php echo mysqli_num_rows($listaImoveis);?> Imóveis para aluguel.</b></h6>
                    </div>
                </div>
                <?php 
                    $i = 1;
                    while($lista = mysqli_fetch_array($listaImoveis)){ 
                        $fotos = explode(",", $lista['imagem']);                        
                        ?>                         
                <div class="container-card">                      
                    <div class="image-card"> 
                    <div id="carouselExampleIndicators" class="carousel" data-ride="carousel" >                        
                          <ol class="carousel-indicators">
                           <?php 
                                    $controle_ativo = 2;
                                    $controle_num_slide = 1;
                                    foreach ($fotos as $foto) { 
                                    if($controle_ativo == 2){ ?>                                
                                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>                                
                                    <?php $controle_ativo = 1;
                                    }else{ ?>                                
                                      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $controle_num_slide; ?>"></li><?php 
                                    }
                                } 
                            ?>                                                            
                              </ol>
                              <div class="carousel-inner">
                                <?php 
                                $controle_ativo = 2;
                                foreach ($fotos as $foto) { 
                                if($controle_ativo == 2){ ?> 
                                    <div class="carousel-item active">
                                      <img class="img-card" src="resources/imagens/<?php echo $lista['id_imovel'];?>/<?php echo $foto;?>" alt="Primeiro Slide">
                                    </div><?php 
                                    $controle_ativo = 1;
                                }else{ ?>
                                    <div class="carousel-item">
                                      <img class="img-card" src="resources/imagens/<?php echo $lista['id_imovel'];?>/<?php echo $foto;?>" alt="Segundo Slide">
                                    </div><?php 
                                    }
                                } 
                             ?>    
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                          </a>
                        </div>
                   </div>                    
                    <div class="card w-75">
                        <div class="body-card">
                            <p class="card-text"><?php echo  $lista['nome_bairro']." , ".$lista['nome_cidade']." - PE" ?></p>  
                            <h5 class="card-title"><?php echo  $lista['titulo']; ?></h5>
                            <ul class="property-card_amenities">                           
                            <li class="amenities_item " title="<?php echo $lista['area_total_imovel'] ?>"> <?php echo $lista['area_total_imovel']?>m²</li> 
                            <li class="amenities_item " title="<?php echo  $lista['qtd_quartos'] ?>"> <?php echo $lista['qtd_quartos'] ?> quartos</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_suites'] ?>"> <?php echo $lista['qtd_suites'] ?> suítes</li>
                            <li class="amenities_item " title="<?php $lista['qtd_banheiros'] ?>"> <?php echo $lista['qtd_banheiros'] ?> banheiros</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_salas'] ?>"> <?php echo $lista['qtd_salas'] ?> salas</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_vagas_garagem'] ?>"> <?php echo $lista['qtd_vagas_garagem'] ?> vagas</li>                      
                                          
                            </ul>  
                            <ul class="property-card__amenities">
                            <?php                            
                            $infraestruturas = explode(",", $lista['infraestrutura']);
                            foreach($infraestruturas as $infraestrutura):
                                if($infraestrutura != ""):
                            ?>
                            <li class="amenities__item" title="<?php echo $infraestrutura ?>"> <?php echo $infraestrutura?></li>                                      
                             <?php 
                                endif;
                                endforeach; 
                             ?>                                            
                            </ul>  
                            <ul class="property-card__amenities">
                            <?php 
                            $lazeres = explode(",", $lista['lazer']);
                            foreach($lazeres as $lazer):
                                if($lazer != ""):
                            ?>
                            <li class="amenities__item" title="<?php echo $lazer ?>"> <?php echo $lazer?></li>                                      
                             <?php 
                                endif;
                                endforeach; 
                              ?>                                          
                            </ul>   
                            <?php if($lista['valor_aluguel_imovel'] > 0){?>                            
                                <p class="card-text"><b>R$ <?php echo number_format($lista['valor_aluguel_imovel'],2,",","."); ?><small> /mês</small></b></p>
                            <?php }else{ ?>
                                <p class="card-text"><b>R$ <?php echo number_format($lista['valor_venda_imovel'],2,",","."); ?></b><small> /mês</small></p>
                            <?php } ?>
                                <?php if($lista['valor_condominio'] > 0){?>
                                <p style="font-size: 13px;" class="card-subtitle">Condomínio: <b>R$ <?php echo number_format($lista['valor_condominio'],0,",","."); ?></b></p>
                            <?php }?>
                                <?php if($lista['valor_iptu'] > 0){?>
                                <p style="font-size: 13px;" class="card-subtitle">IPTU: <b>R$ <?php echo number_format($lista['valor_iptu'],0,",","."); ?></b></p>
                                <?php }?>                            
                        </div>
                        <a  class="btn btn-primary" title="<?php echo $lista['nome_corretor']; ?>" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Clique e contacte o parceiro para mais informações.</a>                        
                        <div class="collapse" id="collapseExample">
                          <div class="card card-body"><b>
                            <?php echo $lista['nome_corretor']; ?></b><br><?php echo $lista['telefone1_corretor']; if($lista['telefone2_corretor'] != ""){?> - <?php echo $lista['telefone2_corretor'];} ?>
                          </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <?php }  ?>        
        </div><!--Fim container-->
    </div>
    <?php elseif (isset($_POST['venda'])):
    $buscarImoveis = "SELECT i.id_imovel, i.bairro_imovel, i.cidade_imovel, i.tipo_imovel, i.qtd_quartos, i.qtd_suites, i.qtd_banheiros, i.qtd_salas, i.qtd_vagas_garagem, i.area_total_imovel, i.area_util_imovel, i.valor_condominio, i.valor_aluguel_imovel, i.valor_venda_imovel, i.valor_iptu, i.status_documento_imovel, i.ano_construcao_imovel, i.proposito_imovel, i.infraestrutura, i.lazer, i.mobiliado, i.aceita_animais, ci.id_corretor_imovel, ci.id_corretor, ci.imagem, ci.data_publicacao, ci.data_renovacao, ci.data_bloqueio, ci.titulo, ci.link_corretor_imovel, c.nome_cidade, b.nome_bairro, co.nome_corretor, co.creci_corretor, co.telefone1_corretor, co.telefone2_corretor
    FROM corretor co
    INNER JOIN corretor_imovel ci ON co.id_corretor = ci.id_corretor
    INNER JOIN imovel i  ON ci.id_imovel = i.id_imovel
    INNER JOIN bairros b ON i.bairro_imovel = b.id_bairro
    INNER JOIN cidades c ON c.id_cidade = b.id_cidade   
    WHERE ci.id_corretor = $id_corretor AND ci.isActive = '1' AND i.proposito_imovel = 'Venda'";
    $listaImoveis = mysqli_query($conn,$buscarImoveis); ?>
            <div class="album py-5 bg-light">
            <div class="container">                
                <div class="row">
                    <div class="col-md-12" id="collection-heading">
                    <h6 style="text-align: left; margin-left: 5px; margin-bottom: -5px;"><b>Encontrados <?php echo mysqli_num_rows($listaImoveis); ?> Imóveis à venda.</b></h6>
                    </div>
                </div>
                <?php 
                    $i = 1;
                    while($lista = mysqli_fetch_array($listaImoveis)){ 
                        $fotos = explode(",", $lista['imagem']);                        
                        ?>                         
                <div class="container-card">                      
                    <div class="image-card"> 
                    <div id="carouselExampleIndicators" class="carousel" data-ride="carousel" >                        
                          <ol class="carousel-indicators">
                            <?php 
                                    $controle_ativo = 2;
                                    $controle_num_slide = 1;
                                    foreach ($fotos as $foto) { 
                                    if($controle_ativo == 2){ ?>                                
                                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>                                
                                    <?php $controle_ativo = 1;
                                    }else{ ?>                                
                                      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $controle_num_slide; ?>"></li><?php 
                                    }
                                } 
                            ?>                                                            
                              </ol>
                              <div class="carousel-inner">
                                <?php 
                                $controle_ativo = 2;
                                foreach ($fotos as $foto) { 
                                if($controle_ativo == 2){ ?> 
                                    <div class="carousel-item active">
                                      <img class="img-card" src="resources/imagens/<?php echo $lista['id_imovel'];?>/<?php echo $foto;?>" alt="Primeiro Slide">
                                    </div><?php 
                                    $controle_ativo = 1;
                                }else{ ?>
                                    <div class="carousel-item">
                                      <img class="img-card" src="resources/imagens/<?php echo $lista['id_imovel'];?>/<?php echo $foto;?>" alt="Segundo Slide">
                                    </div><?php 
                                    }
                                } 
                             ?>    
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                          </a>
                        </div>
                   </div>                    
                    <div class="card w-75">
                        <div class="body-card">
                            <p class="card-text"><?php echo  $lista['nome_bairro']." , ".$lista['nome_cidade']." - PE" ?></p>  
                            <h5 class="card-title"><?php echo  $lista['titulo']; ?></h5>
                            <ul class="property-card_amenities">                           
                            <li class="amenities_item " title="<?php echo $lista['area_total_imovel'] ?>"> <?php echo $lista['area_total_imovel']?>m²</li> 
                            <li class="amenities_item " title="<?php echo  $lista['qtd_quartos'] ?>"> <?php echo $lista['qtd_quartos'] ?> quartos</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_suites'] ?>"> <?php echo $lista['qtd_suites'] ?> suítes</li>
                            <li class="amenities_item " title="<?php $lista['qtd_banheiros'] ?>"> <?php echo $lista['qtd_banheiros'] ?> banheiros</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_salas'] ?>"> <?php echo $lista['qtd_salas'] ?> salas</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_vagas_garagem'] ?>"> <?php echo $lista['qtd_vagas_garagem'] ?> vagas</li>                      
                                          
                            </ul>  
                            <ul class="property-card__amenities">
                            <?php                            
                            $infraestruturas = explode(",", $lista['infraestrutura']);
                            foreach($infraestruturas as $infraestrutura):
                                if($infraestrutura != ""):
                            ?>
                            <li class="amenities__item" title="<?php echo $infraestrutura ?>"> <?php echo $infraestrutura?></li>                                      
                             <?php 
                                endif;
                                endforeach; 
                             ?>                                            
                            </ul>  
                            <ul class="property-card__amenities">
                            <?php 
                            $lazeres = explode(",", $lista['lazer']);
                            foreach($lazeres as $lazer):
                                if($lazer != ""):
                            ?>
                            <li class="amenities__item" title="<?php echo $lazer ?>"> <?php echo $lazer?></li>                                      
                             <?php 
                                endif;
                                endforeach; 
                              ?>                                          
                            </ul>   
                            <?php if($lista['valor_aluguel_imovel'] > 0){?>                            
                                <p class="card-text"><b>R$ <?php echo number_format($lista['valor_aluguel_imovel'],2,",","."); ?><small> /mês</small></b></p>
                            <?php }else{ ?>
                                <p class="card-text"><b>R$ <?php echo number_format($lista['valor_venda_imovel'],2,",","."); ?></b><small> /mês</small></p>
                            <?php } ?>
                                <?php if($lista['valor_condominio'] > 0){?>
                                <p style="font-size: 13px;" class="card-subtitle">Condomínio: <b>R$ <?php echo number_format($lista['valor_condominio'],0,",","."); ?></b></p>
                            <?php }?>
                                <?php if($lista['valor_iptu'] > 0){?>
                                <p style="font-size: 13px;" class="card-subtitle">IPTU: <b>R$ <?php echo number_format($lista['valor_iptu'],0,",","."); ?></b></p>
                                <?php }?>                            
                        </div>
                        <a  class="btn btn-primary" title="<?php echo $lista['nome_corretor']; ?>" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Clique e contacte o parceiro para mais informações.</a>                        
                        <div class="collapse" id="collapseExample">
                          <div class="card card-body"><b>
                            <?php echo $lista['nome_corretor']; ?></b><br><?php echo $lista['telefone1_corretor']; if($lista['telefone2_corretor'] != ""){?> - <?php echo $lista['telefone2_corretor'];} ?>
                          </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <?php }  ?>        
        </div><!--Fim container-->
    </div>
<?php else: 
    $buscarImoveis = "SELECT i.id_imovel, i.bairro_imovel, i.cidade_imovel, i.tipo_imovel, i.qtd_quartos, i.qtd_suites, i.qtd_banheiros, i.qtd_salas, i.qtd_vagas_garagem, i.area_total_imovel, i.area_util_imovel, i.valor_condominio, i.valor_aluguel_imovel, i.valor_venda_imovel, i.valor_iptu, i.status_documento_imovel, i.ano_construcao_imovel, i.proposito_imovel, i.infraestrutura, i.lazer, i.mobiliado, i.aceita_animais, ci.id_corretor_imovel, ci.id_corretor, ci.imagem, ci.data_publicacao, ci.data_renovacao, ci.data_bloqueio, ci.titulo, ci.link_corretor_imovel, c.nome_cidade, b.nome_bairro, co.nome_corretor, co.creci_corretor, co.telefone1_corretor, co.telefone2_corretor
    FROM corretor co
    INNER JOIN corretor_imovel ci ON co.id_corretor = ci.id_corretor
    INNER JOIN imovel i  ON ci.id_imovel = i.id_imovel
    INNER JOIN bairros b ON i.bairro_imovel = b.id_bairro
    INNER JOIN cidades c ON c.id_cidade = b.id_cidade   
    WHERE ci.id_corretor = $id_corretor AND ci.isActive = '1'";
    $listaImoveis = mysqli_query($conn,$buscarImoveis); ?>
            <div class="album py-5 bg-light">
            <div class="container">                
                <div class="row">
                    <div class="col-md-12" id="collection-heading">
                    <h6 style="text-align: left; margin-left: 5px; margin-bottom: -5px;"><b>Encontrados <?php echo mysqli_num_rows($listaImoveis); ?> imóveis à venda ou para alugar.</b></h6>
                    </div>
                </div>
                <?php 
                    $i = 1;
                    while($lista = mysqli_fetch_array($listaImoveis)){ 
                        $fotos = explode(",", $lista['imagem']);                        
                        ?>                         
                <div class="container-card">                      
                    <div class="image-card"> 
                    <div id="carouselExampleIndicators" class="carousel" data-ride="carousel" >          
                          <ol class="carousel-indicators">
                                    <?php 
                                    $controle_ativo = 2;
                                    $controle_num_slide = 1;
                                    foreach ($fotos as $foto) { 
                                    if($controle_ativo == 2){ ?>                                
                                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>                                
                                    <?php $controle_ativo = 1;
                                    }else{ ?>                                
                                      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $controle_num_slide; ?>"></li><?php 
                                    }
                                } 
                            ?>                                                            
                              </ol>
                              <div class="carousel-inner">
                                <?php 
                                $controle_ativo = 2;
                                foreach ($fotos as $foto) { 
                                if($controle_ativo == 2){ ?> 
                                    <div class="carousel-item active">
                                      <img class="img-card" src="resources/imagens/<?php echo $lista['id_imovel'];?>/<?php echo $foto;?>" alt="Primeiro Slide">
                                    </div><?php 
                                    $controle_ativo = 1;
                                }else{ ?>
                                    <div class="carousel-item">
                                      <img class="img-card" src="resources/imagens/<?php echo $lista['id_imovel'];?>/<?php echo $foto;?>" alt="Segundo Slide">
                                    </div><?php 
                                    }
                                } 
                             ?>            
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                          </a>                          
                        </div>
                   </div>                    
                    <div class="card w-75">
                        <div class="body-card">
                            <p class="card-text"><?php echo  $lista['nome_bairro']." , ".$lista['nome_cidade']." - PE" ?></p>  
                            <h5 class="card-title"><?php echo  $lista['titulo']; ?></h5>
                            <ul class="property-card_amenities">                           
                            <li class="amenities_item " title="<?php echo $lista['area_total_imovel'] ?>"> <?php echo $lista['area_total_imovel']?>m²</li> 
                            <li class="amenities_item " title="<?php echo  $lista['qtd_quartos'] ?>"> <?php echo $lista['qtd_quartos'] ?> quartos</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_suites'] ?>"> <?php echo $lista['qtd_suites'] ?> suítes</li>
                            <li class="amenities_item " title="<?php $lista['qtd_banheiros'] ?>"> <?php echo $lista['qtd_banheiros'] ?> banheiros</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_salas'] ?>"> <?php echo $lista['qtd_salas'] ?> salas</li> 
                            <li class="amenities_item " title="<?php echo $lista['qtd_vagas_garagem'] ?>"> <?php echo $lista['qtd_vagas_garagem'] ?> vagas</li>                      
                                          
                            </ul>  
                            <ul class="property-card__amenities">
                            <?php                            
                            $infraestruturas = explode(",", $lista['infraestrutura']);
                            foreach($infraestruturas as $infraestrutura):
                                if($infraestrutura != ""):
                            ?>
                            <li class="amenities__item" title="<?php echo $infraestrutura ?>"> <?php echo $infraestrutura?></li>                                      
                             <?php 
                                endif;
                                endforeach; 
                             ?>                                            
                            </ul>  
                            <ul class="property-card__amenities">
                            <?php 
                            $lazeres = explode(",", $lista['lazer']);
                            foreach($lazeres as $lazer):
                                if($lazer != ""):
                            ?>
                            <li class="amenities__item" title="<?php echo $lazer ?>"> <?php echo $lazer?></li>                                      
                             <?php 
                                endif;
                                endforeach; 
                              ?>                                          
                            </ul>   
                            <?php if($lista['valor_aluguel_imovel'] > 0){?>                            
                                <p class="card-text"><b>R$ <?php echo number_format($lista['valor_aluguel_imovel'],2,",","."); ?><small> /mês</small></b></p>
                            <?php }else{ ?>
                                <p class="card-text"><b>R$ <?php echo number_format($lista['valor_venda_imovel'],2,",","."); ?></b><small> /mês</small></p>
                            <?php } ?>
                                <?php if($lista['valor_condominio'] > 0){?>
                                <p style="font-size: 13px;" class="card-subtitle">Condomínio: <b>R$ <?php echo number_format($lista['valor_condominio'],0,",","."); ?></b></p>
                            <?php }?>
                                <?php if($lista['valor_iptu'] > 0){?>
                                <p style="font-size: 13px;" class="card-subtitle">IPTU: <b>R$ <?php echo number_format($lista['valor_iptu'],0,",","."); ?></b></p>
                                <?php }?>                            
                        </div>
                        
                        <div style="text-align: right; margin-right: 40px; margin-top: -30px;">
                            <a aria-label="Chat on WhatsApp" href='https://wa.me/<?php $lista['whatsapp_corretor']; ?>' target="_blank" ><img alt="Chat on WhatsApp" src="resources/img/chat_on_whatsapp1_redimensionado.png" /><a />
                            <!-- <a target="_blank" href='https://wa.me/<?php //$lista['whatsapp_corretor']; ?>'><img src="resources/img/whatsapp_icon1.png" height="40px" width="40px"><b>Enviar mensagem</b></a>                        -->
                        </div> 
                        <!-- <a  class="btn btn-primary" title="<?php //echo $lista['nome_corretor']; ?>" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Clique e contacte o parceiro para mais informações.</a>                        
                        <div class="collapse" id="collapseExample">
                          <div class="card card-body"><b>
                            <?php //echo $lista['nome_corretor']; ?></b><br><?php //echo $lista['telefone1_corretor']; if($lista['telefone2_corretor'] != ""){?> - <?php //echo $lista['telefone2_corretor'];} ?>
                          </div>
                        </div> -->
                    </div>
                </div>
                <br><br>
                <?php }  ?>        
        </div><!--Fim container-->
    </div>
<?php endif; ?>
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
</body>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="resources/dist/jquery/jquery.min.js"></script>
    <script src="resources/dist/popper/popper.min.js" integrity=""></script>
    <script src="resources/dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="resources/js/script.js"></script>
    <script src="resources/js/main.min.js"></script>  
    <script>
        // $(document).ready(function(){
        // $('[data-toggle="popover"]').popover(); 
        // $('.carousel').carousel({
        //   interval: false,
        // });  
        // });  

        
        const currency = document.querySelector('#rangevalmax');
        const valor = "<?php echo $rangeValorAluguel['valor_aluguel_imovel'];?>";
        const formatter = valor.toLocaleString('pt-BR', 
            {style: 'currency', 
            currency: 'BRL',
            minimumFractionDigits: 2,
            });
        currency.innerHTML = valor;

       

        const currency1 = document.querySelector('#rangeareamax');
        const area = "<?php echo $rangeAreaImovel['area_util_imovel'];?>";
        const formatter1 = area.toLocaleString('pt-BR', 
            {style1: 'currency', 
            currency1: 'BRL',
            minimumFractionDigits1: 2,
            });
        currency1.innerHTML = area;
                  
        //seletor do carousel de fotos
        $(document).ready(function() {
          //Set the carousel options
          $('#carouselExampleIndicators').carousel({
            pause: true,
            interval: 1000,
          });
          $('.carousel-control-prev').click(function() {
          $('#carouselExampleIndicators').carousel('prev');
        });

        $('.carousel-control.next').click(function() {
          $('#carouselExampleIndicators').carousel('next');
        });
        });
   </script>  
</html>