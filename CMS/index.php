<?php

    session_start();


    include_once('carregarMenu.php');
    include_once('../conexao.php');    
    $conexao = getConexao();



    $userLogado = "";
    
    $idUser = $_SESSION['idUsuario'];


    //var_dump($selectMenu);


    //$sql = "select * from tbl_usuarios where id = ".$idUser;

    $sql = "select idNivel, nome from tbl_usuarios where id = ".$idUser;

    $select = mysqli_query($conexao, $sql);

    $rsUsuario = mysqli_fetch_array($select);

    $userLogado = $rsUsuario['nome'];

    $arrayMenu = array();

    $arrayMenu = carregarMenu($rsUsuario['idNivel']);





?>



<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    
    <body>

        <div class="caixa_principal">
<!--            Header     -->
            <header>

                <div class="caixa_header">
                    <div class="caixa_header_label">
                        <h1>CSM - Sistema de Gerenciamento do Site</h1>
                    </div>

                    <div class="caixa_logo">

                    </div>
                </div>     
            
<!--            Fim header    -->            
            
            </header>

            
            
<!--    Menu            -->
            <div class="caixa_menu">
                <div class="caixa_menu_seg_nav">
                    
                    <?php
                        $i = 0;
                        while($i < count($arrayMenu)){
                            echo($arrayMenu[$i]);
                            $i++;
                        }
                    
                    ?>
                    

                </div>
                
                <div class="caixa_menu_direita">
                    <div class="caixa_bem_vindo">
                        <p>Bem Vindo, <?php echo($userLogado)?>!</p>
                    </div>
                    <div class="caixa_sair">
                        <a href="../index.php"><div class="caixa_btnSair">Sign Out</div></a>
                    </div>
                </div>
            </div>
            
<!--            Fim Menu      -->
            <div class="caixa_titulo">
                <h1>Páginas</h1>
            </div>
            
            
            <div class="caixa_seg_primeria_sessao">
                <div class="caixa_opt_destaques">
                    <a href="admDestaque.php">
                        <div class="caixa_opt_destaques_img">
                            <img src="imagens/destaque.png">
                        </div>
                        <div class="caixa_opt_destaques_text">
                            <p>Destaques</p>
                        </div>
                    </a>
                </div>     


                <div class="caixa_opt_destaques">
                    <a href="admSobre.php">
                        <div class="caixa_opt_destaques_img">
                            <img src="imagens/sobre.png">
                        </div>
                        <div class="caixa_opt_destaques_text">
                            <p>Sobre</p>
                        </div>
                    </a>    
                </div>     
                
                
                
                <div class="caixa_opt_destaques">
                    <a href="admBanca.php">
                    
                        <div class="caixa_opt_destaques_img">
                            <img src="imagens/bancas.png">
                        </div>
                        <div class="caixa_opt_destaques_text">
                            <p>Bancas</p>
                        </div>                     
                    
                    </a>
   
                </div>                 
            </div>
            
            
            
            <div class="caixa_seg_segunda_sessao">
                <a href="admCelebridades.php">
                    <div class="caixa_opt_destaques">
                        <div class="caixa_opt_destaques_img">
                            <img src="imagens/celebridade.png">
                        </div>
                        <div class="caixa_opt_destaques_text">
                            <p>Celebridade</p>
                        </div>
                    </div>                  
                </a>
 
                
                
                
                <div class="caixa_opt_destaques">
                    <div class="caixa_opt_destaques_img">
                        <img src="imagens/home.png">
                    </div>
                    <div class="caixa_opt_destaques_text">
                        <p>Home</p>
                    </div>
                </div> 
                         
                
            </div>
            
            
            
            
            


          
            
            
            
            
            
<!--            FOOTER-->
            <footer>
                <div class="caixa_footer">
                    <div class="caixa_footer_texto">
                        Desenvolvido por: Leonardo Cavalcante
                    </div>
                </div>            
            </footer>

            
        </div>
    </body>
</html>