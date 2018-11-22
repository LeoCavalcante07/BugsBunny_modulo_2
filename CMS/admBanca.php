<?php

    session_start();

    include_once('../conexao.php');
    $conexao = getConexao();


    $userLogado = "";
    
    $idUser = $_SESSION['idUsuario'];

    $sql = "select * from tbl_usuarios where id = ".$idUser;

    $select = mysqli_query($conexao, $sql);

    $rsUsuario = mysqli_fetch_array($select);

    $userLogado = $rsUsuario['nome'];


    


?>


<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        
        <meta charset="utf-8">
        
        
        <script src="../js/jquery.min.js"></script>
        <script src="../engine1/jquery.form.js"></script>
        
        <script>
            
           
        
            $(document).ready(function(){
                
               $('#fleFoto').live('change', function(){
                  
                   
                    $('#frmFoto').ajaxForm({                        
                        target:'#visualizarFoto'

                    }).submit();                    
                   
               });
                
                
//                $('#btnSalvar').click(function(){
//                   frmCadastro.submit();
//                });
                

                
                ////CÓDIGO MODAL em construção/////

                    $(".visualizara").click(function(){

                        $(".container").fadeIn(500);
                    });

                
                
        
                
            });
            
            
            function modal(){
                

                $.ajax({
                    type: "GET",
                    url: "modal_destaque.php",                     

                    success: function(dados){
                        $('.modal').html(dados);
                    }

                });

            }  
            
            
            ///////MODAL EM CONSTRUÇÃO////
        
        </script>        



    </head>
    
    <body>
        
        <div class="container">
            <div class="modal">
            
            </div>
        </div>

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
                    <div class="caixa_menu_adm">
                        <a href="index.php">                        
                            <div class="caixa_menu_adm_img">
                                <img src="imagens/admCont.png">
                            </div>

                            <div class="caixa_menu_adm_titulo">
                                <p>Conteúdo</p>
                            </div>                        
                        </a>

                    </div>
                    
                    <div class="caixa_menu_adm">
                        
                        <a href="admFaleConosco.php">
                            <div class="caixa_menu_adm_img">
                                <img src="imagens/admFale.png">
                            </div>

                            <div class="caixa_menu_adm_titulo">
                                <p>Fale Conosco</p>
                            </div>                          
                        </a>
                        
                  
                    </div>
                    
                    
                    <a href="admProduto.php">
                        <div class="caixa_menu_adm">

                            <div class="caixa_menu_adm_img">
                                <img src="imagens/admProduct.png">
                            </div>

                            <div class="caixa_menu_adm_titulo">
                                <p>Produtos</p>
                            </div>                    
                        </div>
                    </a>                    

                    
                    <div class="caixa_menu_adm">
                        <a href="admControleUsuario.php">
                        
                            <div class="caixa_menu_adm_img">
                                <img src="imagens/admUsers.png">
                            </div>

                            <div class="caixa_menu_adm_titulo">
                                <p>Usuários</p>
                            </div>    
                        </a>
                    </div>
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
            
            
            <div class="caixa_seg_bancas_opt">
                <a href="admBancaPrincipal.php">
                    <div class="caixa_bancas_opt" style="margin-right: 100px;">
                        <img src="imagens/main.png">
                        <h1>Banca Principal</h1>
                    </div>                
                </a>

                <a href="admBancas.php">
                    <div class="caixa_bancas_opt">
                        <img src="imagens/filiais.png">
                        <h1>Bancas Filiais</h1>
                    </div>                  
                </a>
              
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