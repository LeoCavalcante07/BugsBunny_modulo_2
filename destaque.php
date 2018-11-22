<?php

    include_once('conexao.php');
    $conexao = getConexao();  

?>



<!doctype html>

<html>
    <head>
        <title>Destaques</title>
        <title>Destaques</title>
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
                        
                        <a href="CMS/index.php">
                            <div class="caixa_botao">
                                <input type="submit" name="btnEntrar"  class="btnEntrar" value="Entrar">    
                            </div>
                      </a>
                    </div>   
                    
                </div>
                
                
            </div>
            
            
        </header>
        
        
        
     

        
        <div class="caixa_global">
            <div id="caixa_especial"></div>
            
            
            <div class="caixa_destaque_principal">
                <div class="caixa_destaque_titulo">
                    <h1>Noticias em Destaque</h1>
                </div>
                
                <?php
                    $sql = "select * from tbl_destaque where status = 1";
                    $select = mysqli_query($conexao, $sql);
                    
                    $i = 0;
                    while($rsDestaque = mysqli_fetch_array($select)){
                                    
                        if($i % 2 == 0){
                ?>
                
                    <div class="caixa_destaque_section1">
                        <section>
                            <div class="caixa_destaque_section1_titulo">
                                <h2><?php echo($rsDestaque['titulo']);?></h2>
                                <h2></h2>
                            </div>

                            <div class="caixa_destaque_section1_texto">
                                <?php echo($rsDestaque['texto']);?>
                            </div>

                            <div class="caixa_destaque_section1_img">
                                <p>
                                    <img src="CMS/<?php echo($rsDestaque['foto']);?>" alt="destaque">
                                </p>

                            </div>
                        </section>
                    </div>                
                
                <?php
                }else{
                ?>
                
                
                <div class="caixa_destaque_section2">
                    <section>
                        <div class="caixa_destaque_section2_titulo">
                            <h2><?php echo($rsDestaque['titulo']);?></h2>
                        </div>
                        
                        
                        <div class="caixa_destaque_section2_img">                            
                            <img src="CMS/<?php echo($rsDestaque['foto']);?>" alt="destaque">
                        </div>
                        
                        <div class="caixa_destaque_section2_texto">
                            <p>
                                <?php echo($rsDestaque['texto']);?>
                            </p>
                        </div>                        
                        
                        

                    </section>
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