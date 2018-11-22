<?php

    session_start();

    include_once('conexao.php');
    $conexao = getConexao();

?>




<!doctype html>

<html>
    <head>
        <title>Celebridade</title>

        <link type="text/css" rel="stylesheet" href="css/style.css">
        
        
                <!-- Shared assets -->
        <link rel="stylesheet" type="text/css" href="examples/_shared/css/style.css">

        <!-- Example assets -->
        <link rel="stylesheet" type="text/css" href="examples/connected-carousels/jcarousel.connected-carousels.css">

        <script type="text/javascript" src="libs/jquery/jquery.js"></script>
        <script type="text/javascript" src="dist/jquery.jcarousel.min.js"></script>

        <script type="text/javascript" src="examples/connected-carousels/jcarousel.connected-carousels.js"></script>
        
        
        
        <meta charset="utf-8">
    </head>
    
    <body>
        <header>
            <div id="caixa_header">
                <div id="caixa_header_central">
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
                        <div class="caixa_seg_login_label">
                            <div class="caixa_login_label" style="margin-right: 30px;">
                                <p>Usuário:</p>
                            </div>

                            <div class="caixa_login_label">
                                <p>Senha:</p>
                            </div>                          
                        </div>
                        
                        <div class="caixa_seg_login_text">
                            <div class="caixa_login_text">
                                <input type="text" name="txtUsuario">                                
                            </div>
                            
                            <div class="caixa_login_text">
                                <input type="password" name="txtSenha">                           
                            </div>                            
                        </div>
                        
                        <div class="caixa_botao">
                            <input type="submit" name="btnEntrar"  class="btnEntrar"  value="Entrar">    
                        </div>
                      
                    </div>   
                    
                </div>
                
                
            </div>
            
            
        </header>
        
        
        
     

        
        <div class="caixa_global">
            <div id="caixa_especial"></div>
            
            <div class="caixa_principal_celebridade">
                
                <?php 
                    $sql = "select cc.banner, c.nomeCelebridade from tbl_conteudo_celebridade as cc, tbl_celebridade as c where cc.idCelebridade = c.idCelebridade and c.status = 1 and cc.status = 1 order by rand() limit 0,1";
                
                    //var_dump($sql);
                    $select = mysqli_query($conexao, $sql);
                
                    $rsConsulta = mysqli_fetch_array($select);
                
                
                ?>
                <div class="caixa_seg_celebridade_sec1">
                    <div class="caixa_celebridade_titulo">
                        <h1>A celebridade do mês é o galã <?php echo($rsConsulta['nomeCelebridade'])?>!</h1>
                    </div>
                    
                    <div class="caixa_celebridade_mainImg">
                        <img src="CMS/<?php echo($rsConsulta['banner'])?>">
                    </div>                    
                    
                <?php
                    $sql = "select c.idCelebridade, c.nomeCelebridade, c.status, cc.idConteudoCelebridade, cc.titulo, cc.texto, cc.foto, cc.banner, cc.idCelebridade, cc.status from tbl_conteudo_celebridade as cc, tbl_celebridade as c where c.status = 1 and cc.status = 1 and c.idCelebridade = cc.idCelebridade";
                
                    $select = mysqli_query($conexao, $sql);
                    $i = 0;
                    while($rsConsulta = mysqli_fetch_array($select)){
                
                ?>                       
                </div>
                
                <?php
                    if($i % 2 == 0){                    
                ?>
                
                <div class="caixa_seg_celebridade_sec">
                    <div class="caixa_celebridade_texto_motivo">
                        <h2><?php echo($rsConsulta['titulo'])?></h2>
                        <p><?php echo($rsConsulta['texto'])?></p>
                    </div>                 
                    <div class="caixa_celebridade_img_motivo">
                        <img src="CMS/<?php echo($rsConsulta['foto'])?>">
                    </div>                    
                </div>
                
                
                <?php
                    }else{
                ?>
                
                    <div class="caixa_celebridade_img_infancia">
                        <img src="CMS/<?php echo($rsConsulta['foto'])?>">
                    </div>   
                    
                    <div class="caixa_celebridade_texto_infancia">
                        <h2><?php echo($rsConsulta['titulo'])?></h2>
                        <p><?php echo($rsConsulta['texto'])?></p>
                    </div>                     
                
                <?php
                        }
                        $i++;
                    }
                ?>

                

<!--
                <div class="caixa_seg_celebridade_sec">
                     
                    
                    <div class="caixa_celebridade_img_infancia">

                    </div>   
                    
                    <div class="caixa_celebridade_texto_infancia">
                        <h2>A infância de Lula</h2>
                        <p>“Onde estou?” e “como vim parar aqui?” foram as primeiras perguntas que surgiram na mente confusa daquele jovem de aparentemente vinte anos. Era branco, com cabelos negros e olhos castanhos, vestia uma camisa branca e um short cinza, a roupa que normalmente usava para ir à praia.</p>
                    </div>                 
          
          
                </div>
-->
                

                
                
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