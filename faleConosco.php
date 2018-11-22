<?php
    
    include_once('conexao.php');
    $conexao = getConexao();
    
   
//    var_dump($conexao);




    if(isset($_GET["btnEnviar"])){


        $nome = $_GET["txtNome"];
        $tel = $_GET["txtTel"];
        $cel = $_GET["txtCel"];
        $email = $_GET["txtEmail"];
        $sexo = $_GET["rdoSexo"];
        $profissao = $_GET["txtProfissao"];
        $homePage = $_GET["txtHomePage"];
        $facebook = $_GET["txtFacebook"];
        $infProduto = $_GET["txtInfProduto"];
        $critica = $_GET["txtCritica"];   




        $sql = "insert into tbl_fale_conosco(nome, telefone, celular, email, sexo, profissao, homePage, linkFacebook, informacoesProduto, critica) values('".$nome."', '".$tel."', '".$cel."', '".$email."', '".$sexo."', '".$profissao."', '".$homePage."', '".$facebook."', '".$infProduto."', '".$critica."');";

        //var_dump($sql);


        mysqli_query($conexao, $sql);

        header('location:faleConosco.php');            
        

    }





?>

<!doctype html>
<html>
    <head>
        <title>Fale Conosco</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        
        
                <!-- Shared assets -->
        <link rel="stylesheet" type="text/css" href="examples/_shared/css/style.css">

        <!-- Example assets -->
        <link rel="stylesheet" type="text/css" href="examples/connected-carousels/jcarousel.connected-carousels.css">

        <script type="text/javascript" src="libs/jquery/jquery.js"></script>
        <script type="text/javascript" src="dist/jquery.jcarousel.min.js"></script>

        <script type="text/javascript" src="examples/connected-carousels/jcarousel.connected-carousels.js"></script>
        
        <script>
            function validar(obj, opcao){
                
                if(opcao == "nome"){
                    texto = obj.value;
                    texto = texto.replace(/[^a-z A-Z\s]/g, "");
                    obj.value = texto; 
                    
                }else if(opcao == "tel"){
                    numero = obj.value;
                    obj.value = obj.value.replace(/[^0-9()-]/g, "");
                    x = numero.toString().length;
                    
                    
                    switch(x){
                        case 3:
                            obj.value = "(" + numero + ")";
                            break;
                        case 9:
                            obj.value = obj.value + "-";
                            break;
                            
                    }
                        
                    
                }else if(opcao == "cel"){
                    numero = obj.value;
                    obj.value = obj.value.replace(/[^0-9()-]/g, "");
                    x = numero.toString().length;
                    
                    
                    switch(x){
                        case 3:
                            obj.value = "(" + numero + ")";
                            break;
                        case 10:
                            obj.value = obj.value + "-";
                            break;
                            
                    }
                        
                    
                }
                
                             
            }
        </script>
        
        
        
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
                            <input type="submit" name="btnEntrar" class="btnEntrar" value="Entrar">    
                        </div>
                      
                    </div>   
                    
                </div>
                
                
            </div>
            
            
        </header>

        
        <div class="caixa_global">
            <div id="caixa_especial"></div>
            
            
            <div class="caixa_principal_fale">
                <div class="caixa_fale_icon">
                
                </div>
                <div class="caixa_fale_titulo">
                    <h1>Fale Conosco</h1>
                </div>
                <div class="caixa_fale_texto">
                    <p>A Bugs Bunny se importa com a opinião do cliente. Por isso foi feita a seção Fale Conosco, para que você nos envie, elogios, criticas e sugestões!</p>
                </div>
                
                <div class="caixa_fale_form">
                    <form action="faleConosco.php" method="get">
                        
                        <div class="caixa_form_esquerda">
                            <div class="caixa_form_esquerda_lbl">
                                <p>Nome:*</p>
                                <p>Telefone:</p>
                                <p>Celular:*</p>
                                <p>Email:*</p>
                                <p>Sexo:*</p>                            
                            </div>
                            
                            
                            
                            <div class="caixa_form_esquerda_inputs">
                                 <p><input type="text" name="txtNome" onkeyup="validar(this, 'nome')" required></p>
                                
                                <p><input type="tel" name="txtTel" placeholder="ex: (ddd)xxxx-xxxx" onkeyup="validar(this, 'tel')" maxlength="14"></p>
                                
                                <p><input type="tel" name="txtCel" placeholder="ex: (ddd)xxxxx-xxxx" onkeyup="validar(this, 'cel')" maxlength="15" required></p>
                                
                                <p><input type="email" name="txtEmail" placeholder="ex: nome@gmail.com" required></p>

                                <p><input type="radio" name="rdoSexo" value="m" checked>Masculino</p>
                                <p><input type="radio" name="rdoSexo" value="f">Feminino</p>
                            </div>
                           
                        </div>
                        
                        <div class="caixa_form_direita">
                            <div class="caixa_form_direita_lbl">
                                <p>Profissão: * </p>
                                <p>Home page: </p>
                                <p>Link do Facebook: </p>
                                <p>Informações do Produto: </p>
                                <p>Crítica/Sugestão: </p>                            
                            </div>
                            
                            
                            <div class="caixa_form_direita_inputs">
                                 <p><input type="text" name="txtProfissao" onkeyup="validar(this, 'nome')" required></p>
                                
                                <p><input type="text" name="txtHomePage"></p>
                                
                                <p><input type="text" name="txtFacebook"></p>
                                
                                <p><input type="text" name="txtInfProduto"></p>

                                <textarea name="txtCritica"></textarea>
                                
                            </div>                            
                        </div>
                        
                        
                        
                        <input type="submit" name="btnEnviar" class="btnSalvar" value="Enviar">
                    </form>
                </div>
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