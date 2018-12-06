<?php
    
    session_start();

    include_once('conexao.php');
    $conexao = getConexao();

    $noUser = "";

    $sqlProdutos = "select p.idProduto, p.nome, p.foto, p.status, p.acesso, pp.idProduto, pp.preco, pp.to_date, pp.promocao from tbl_produto as p, tbl_preco_produto as pp where p.status = 1 and pp.idProduto = p.idProduto and pp.to_date is null order by rand() limit 0,6";



    if(isset($_POST['btnEntrar'])){
        
        $txtUsuario = $_POST['txtUsuario'];
        $txtSenha = $_POST['txtSenha'];
        
        $sql = "select * from tbl_usuarios where status = 1 and email = '".$txtUsuario."' and senha = '".$txtSenha."'";
        
        //var_dump($sql);
        
        $select = mysqli_query($conexao, $sql);
        
        $rsConsulta = mysqli_fetch_array($select);
        
        if(@count($rsConsulta) > 0){
            $_SESSION['idUsuario'] = $rsConsulta['id'];
            
            header("location:CMS/index.php");
        }else{
            //echo("<script> alert('Usuário ou senha incorreta') </script>");
            $noUser  = "Usuário ou senha incorreto";
        }
    }


    if(isset($_GET['txtPesquisa'])){
        $pesquisa = $_GET['txtPesquisa'];
        
        $sqlProdutos = "select p.idProduto, p.nome, p.foto, p.status, p.acesso, pp.idProduto, pp.preco, 
        pp.to_date, pp.promocao from tbl_produto as p, tbl_preco_produto as pp where p.status = 1 and p.idProduto = pp.idProduto and pp.to_date is null and (p.nome like '%".$pesquisa."%' or p.sinopse like '%".$pesquisa."%') limit 6;";
        
        //var_dump($sqlProdutos);

    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        if($modo == "subcategoria"){
            $idSubCategoria = $_GET['idSubCategoria'];
            
            $sqlProdutos = "select p.idProduto, p.nome, p.foto, p.status, p.acesso, pp.idProduto, pp.preco, pp.to_date, pp.promocao from tbl_produto as p, tbl_preco_produto as pp where p.status = 1 and pp.idProduto = p.idProduto and pp.to_date is null and p.idSubCategoria = ".$idSubCategoria." order by rand() limit 0,6";
            //var_dump($sqlProdutos);
        }
        
    }


    



?>




<!doctype html>

<html>
    <head>
        <!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
        <title>Home</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        
        
                <!-- Shared assets -->
        <link rel="stylesheet" type="text/css" href="examples/_shared/css/style.css">

        <!-- Example assets -->
        <link rel="stylesheet" type="text/css" href="examples/connected-carousels/jcarousel.connected-carousels.css">

        <script type="text/javascript" src="libs/jquery/jquery.js"></script>
        <script type="text/javascript" src="dist/jquery.jcarousel.min.js"></script>

        <script type="text/javascript" src="examples/connected-carousels/jcarousel.connected-carousels.js"></script>
        
        <script type="text/javascript" src="engine1/jquery.form.js"></script>
        

        
           
        <script>
            //código para abrir a modal
            $(document).ready(function(){
               
                $(".abrirDetalhes").click(function(){
                    $(".containerIndex").fadeIn(500);
                })
                
            });
            
            
            function modal(idProduto){
                
                
                $.ajax({
                    type: "GET",
                    url: "modal_detalhes.php",
                    data: {id:idProduto},
                       
                       
                    success: function(dados){
                        $('.containerIndex').html(dados);
                    }
                    
                })
                
            }
            
            
            
            
            
     
            
            function clickMenu(){  
                
                if(document.getElementById("menuMobile").style.width == "0px"){
                    document.getElementById("menuMobile").style.width = "300px";

                    document.getElementById("menuMobile").style.transition = "1s";                    
                }else{
                    document.getElementById("menuMobile").style.width = "0px";

                    document.getElementById("menuMobile").style.transition = "1s";                    
                }


                
                

            }
            
            function pesquisa(){
                document.getElementById('formPesquisa').submit();
            }
            
          
                        
            
        </script>        
        
        
        
        <meta charset="utf-8">
    </head>
    
    <body>

            
        <header>
            
            <div class="containerIndex">
                <div class="modalIndex">

                </div>
            </div>              
            <div id="caixa_header">
                <div id="caixa_header_central">
                    <div class="iconeMenu" onclick="clickMenu()">
                    
                    </div>
                    
                    <div class="menuMobile" id="menuMobile">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="destaque.php">Destaque</a></li>
                            <li><a href="sobre.php">Sobre</a></li>
                            <li><a href="promocoes.php">Promoção</a></li>
                            <li><a href="bancas.php">Bancas</a></li>
                            <li><a href="celebridade.php">Celebridades</a></li>
                            <li><a href="faleConosco.php">Fale Conosco</a></li>
                        </ul>
                    </div>
                    
                    <div id="caixa_logo">
                       
                    </div>

                    
                    
                    <div id="caixa_menu">
                       <a href="index.php"> 
                           <div class="caixa_optMenu">
                            <p>Home</p>
                           </div>
                        </a>

                        <a href="destaque.php">
                            <div class="caixa_optMenu">
                               <p>Destaque</p>
                            </div>
                        </a>

                        <a href="sobre.php">
                            <div class="caixa_optMenu">
                                <p>Sobre</p>
                            </div>
                        </a>
                        
                        <a href="promocoes.php">
                            <div class="caixa_optMenu">
                                <p>Promoções</p> 
                            </div>           
                        </a>

                        <a href="bancas.php">
                            <div class="caixa_optMenu">
                                <p>Bancas</p>
                            </div> 
                        </a>
                        
                        <a href="celebridade.php">
                            <div class="caixa_optMenu">
                                <p>Celebridade</p>
                            </div> 
                        </a>
                        
                        <a href="faleConosco.php">
                            <div class="caixa_optMenu" >
                                <p>Fale Conosco</p> 
                            </div>           
                        </a>
                        
                    </div>

                    <div id="caixa_login">
                        <form action="index.php" method="post">
                            <p style="margin-bottom: 10px;">Usuário: <input type="text" name="txtUsuario"> </p>

                            <p style="margin-bottom: 5px;">Senha: <input type="password" name="txtSenha"></p>

                            
                                                
                            <input type="submit" name="btnEntrar"  class="btnEntrar" value="Entrar">                                                           
                        </form>

                    </div>   
                    
                    
                    
                </div>
                
                
            </div>  
            
            
        </header>
            
            
        
        <div class="caixa_global">
            <div id="caixa_especial"></div>
        
    <!--        -------------Conteudo---------------->
            <div id="caixa_principal">
                
                
                <div id="secao_slider">
                    
                    
                    <!-- Start WOWSlider.com BODY section -->
                    <div id="wowslider-container1">
                    <div class="ws_images"><ul>
                            <li><img src="data1/images/bg.png" alt="bg" title="Animes" id="wows1_0"/></li>
                            <li><a href="http://wowslider.net"><img src="data1/images/bg5.png" alt="jquery image carousel" title="Revistas Cientificas" id="wows1_1"/></a></li>
                            <li><img src="data1/images/slide2.jpg" alt="slide2" title="Livros" id="wows1_2"/></li>
                        </ul></div>
                        <div class="ws_bullets"><div>
                            <a href="#" title="bg"><span><img src="data1/tooltips/bg.png" alt="bg"/>1</span></a>
                            <a href="#" title="bg5"><span><img src="data1/tooltips/bg5.png" alt="bg5"/>2</span></a>
                            <a href="#" title="slide2"><span><img src="data1/tooltips/slide2.jpg" alt="slide2"/>3</span></a>
                        </div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.net">bootstrap slideshow</a> by WOWSlider.com v8.8</div>
                    <div class="ws_shadow"></div>
                    </div>	
                    <script type="text/javascript" src="engine1/wowslider.js"></script>
                    <script type="text/javascript" src="engine1/script.js"></script>
                    <!-- End WOWSlider.com BODY section -->  
                    
                    
                </div>      
                
                
                <div id="imgHome">
                    
                </div>
                
                <section>
                    
                    <div id="caixa_itens">
                        
                        <?php
//                            $sql = "select c.nomeCategoria, sc.nomeSubCategoria from tbl_categoria as c, tbl_subcategoria as sc where c.status = 1 and sc.status = 1 and c.idCategoria = sc.idCategoria";
                                    
                            $sql = "select * from tbl_categoria where status = 1";
                                    
                            $select = mysqli_query($conexao, $sql);
                                    
                            while($rsConsulta = mysqli_fetch_array($select)){
                                
                                    
                            
                        ?>
                        <div class="item_1">
                            
                            <?php 
                                echo($rsConsulta['nomeCategoria']);
                                    
                                $sql2 = "select * from tbl_subcategoria where status = 1 and idCategoria = ".$rsConsulta['idCategoria'];
                            
                                $select2 = mysqli_query($conexao, $sql2);
                                
                                while($rsConsulta2 = mysqli_fetch_array($select2)){
                                
                            ?>
                            <div class="subMenu">
                                <ul>
                                    <li>
                                        <a href="index.php?modo=subcategoria&idSubCategoria=<?php echo($rsConsulta2['idSubCategoria'])?>" style="text-decoration: none;">
                                         <?php
                                        $rsConsulta2['nomeSubCategoria'] = str_replace(" ","&nbsp;",$rsConsulta2['nomeSubCategoria']);
                                echo($rsConsulta2['nomeSubCategoria'])?>
                                        </a>
                                        
                                    </li>
                                </ul>
                                
                            </div>
                            
                            <?php
                                }
                            ?>
                            
                        </div>  
                        
                        <?php
                            }
                        ?>
                    </div>

                  
                    <div id="caixa_conteudo_seg">
                        
                        <div class="segPesquisa">
                            <form id="formPesquisa" method="get" action="index.php">
                                <input type="text" name="txtPesquisa" style="height: 20px; width: 100px; float: left; border: none;">
                            </form>


                            <img src="imagens/search.png" style="float: left; margin-left: 10px; margin-top: 2px;" onclick="pesquisa()">
                        </div>                        
                        
                        <?php
                            $sql = $sqlProdutos;

                            $select = mysqli_query($conexao, $sql);

                            while($rsConsulta = mysqli_fetch_array($select)){
                        ?>
                        <div class="caixa_produto">
                            <div class="caixa_imagem">
                                <img src="CMS/<?php echo($rsConsulta['foto'])?>">

                            </div>

                            <div class="caixa_descricao">
                                <p>
                                    Nome: <?php echo($rsConsulta['nome'])?>
                                </p>
                                <p>
                                    Preço: <?php echo($rsConsulta['preco'])?>
                                </p>                                
                            </div>

                            <div class="caixa_detalhes">
                                <a class="abrirDetalhes" href="#" onclick="modal(<?php echo($rsConsulta['idProduto'])?>)"><p>Detalhes</p></a>
                            </div>
                        </div>

                        <?php
                            }
                        ?>

                    </div>


                  
                </section>
            </div>

            
            
            
            
            <div class="caixa_anuncio">
                <div class="anuncio">
                    <img src="imagens/facebook.png" alt="facebook">
                </div>
                
                <div class="anuncio">
                    <img src="imagens/linkedin.png" alt="linkedin">
                </div>
                
                <div class="anuncio">
                    <img src="imagens/twitter.png" alt="twitter">
                </div>                
                
                
            </div>  
                        
        </div>


        <footer>
            <div id="caixa_footer">
                <div class="caixa_footer_central">
                    <div class="caixa_footer_cima">
                        <p>Copyrights© 2018. Todos os direitos reservados.</p> 
                        
                    </div>
                    
                    <div class="caixa_footer_baixo">
                          <p>Bugs Bunny S/A. Avenidas das Rosas, 1789, 11° andar, São Paulo - SP.</p>
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="js/slider.js"></script>
    </body>
</html>