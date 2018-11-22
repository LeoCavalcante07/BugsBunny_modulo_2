<?php

    include_once('conexao.php');
    $conexao = getConexao();
    

?>







<!doctype html>

<html>
    <head>
      
        <title>Nossas Bancas</title>
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
            
            <div class="caixa_banca_principal">
                <div class="caixa_banca_titulo">
                    <h1>Nossas Bancas</h1>
                </div>
                
                
                <?php
                    $sql = "select * from tbl_banca_principal where status = 1";
                
                
                
                    $select = mysqli_query($conexao, $sql);
                
                    $rsConsulta = mysqli_fetch_array($select);
                ?>
                <div class="caixa_banca_principal_img">
                    <img src="CMS/<?php echo($rsConsulta['foto'])?>">
                    
                </div>
                
                <div class="caixa_banca_descricao">
                    <p><?php echo($rsConsulta['texto'])?></p>
                </div>
                
                
                <?php 
                    $sql = "select * from tbl_banca where status = 1";
                    $select  = mysqli_query($conexao, $sql);
                    $i = 0;
                    while($rsConsulta = mysqli_fetch_array($select)){
                        
                        if($i % 2 == 0){
            
                ?>
                
                <div class="caixa_seg_secao1">
                    <div class="caixa_seg_secao1_2_titulo">
                        <h2><?php echo($rsConsulta['titulo'])?></h2>
                    </div>
                    
                    <div class="caixa_secao1_img">
                        <img src="CMS/<?php echo($rsConsulta['foto'])?>">
                    </div>
                    
                    <div class="caixa_secao1_texto">
                        <p><?php echo($rsConsulta['texto'])?> </p>
                    </div>
                </div>
                
                <?php
                        }else{
                ?>
                
                <div class="caixa_seg_secao2">
                    <div class="caixa_seg_secao1_2_titulo">
                        <h2><?php echo($rsConsulta['titulo'])?></h2>
                    </div>
                    <div class="caixa_secao2_texto">
                        <p><?php echo($rsConsulta['texto'])?></p>
                    </div>                    
                    
                    <div class="caixa_secao2_img">
                        <img src="CMS/<?php echo($rsConsulta['foto'])?>">
                    </div>
                    
                </div>
                
                <?php
                        }
                        $i++;
                    }
                ?>
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