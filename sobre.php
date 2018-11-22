<?php

    include_once('conexao.php');
    $conexao = getConexao();

?>


<!doctype html>

    <html>
        <head>
            <title>Sobre a empresa</title>

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

                <section>
                    <div class="caixa_principal_sobre">
                        <div class="caixa_titulo_sobre">
                            <h1>Sobre a Banca</h1>
                        </div>
                        
                        <?php
                            $sql = "select * from tbl_sobre where status = 1";
                            $select = mysqli_query($conexao, $sql);
                        $i = 0;
                            while($rsSobre = mysqli_fetch_array($select)){
                        
                                if($i % 2 == 0){
                        ?>
                        
                        
                        
                            <div class="caixa_sobre_section1">                    
                                <div class="caixa_sobre_section1_img">
                                    <img src="CMS/<?php echo($rsSobre['foto'])?>">
                                </div>

                                <div class="caixa_sobre_section1_texto">
                                    <h2><?php echo($rsSobre['titulo'])?></h2>
                                    <p><?php echo($rsSobre['texto'])?></p>

                                </div>                    
                            </div>                         
                        <?php
                            }else{
                        ?>
                        
                        
                            <div class="caixa_sobre_section2">

                                <div class="caixa_sobre_section2_text">
                                    <h2><?php echo($rsSobre['titulo'])?></h2>
                                    <p><?php echo($rsSobre['texto'])?></p>
                                    
                                </div>

                                <div class="caixa_sobre_section2_img">
                                    <img src="CMS/<?php echo($rsSobre['foto'])?>">
                                </div>                    
                            </div>                            
                        
                        
                       


                        
                        <?php
                                }
                                $i++;
                            }
                        ?>                        

                    </div>            
                </section>



                <div class="caixa_anuncio">
                    <div class="anuncio">
                        <img src="imagens/facebook.png" alt="Facebook">
                    </div>

                    <div class="anuncio">
                        <img src="imagens/linkedin.png" alt="Linkedin">
                    </div>

                    <div class="anuncio">
                        <img src="imagens/twitter.png" alt= "Twitter">
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