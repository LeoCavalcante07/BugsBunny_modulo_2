<?php

    session_start();
    
    include_once('carregarMenu.php');

    include_once('../conexao.php');
    $conexao = getConexao();



    $userLogado = "";
    
    $idUser = $_SESSION['idUsuario'];

    $sql = "select * from tbl_usuarios where id = ".$idUser;

    $select = mysqli_query($conexao, $sql);

    $rsUsuario = mysqli_fetch_array($select);

    $userLogado = $rsUsuario['nome'];

    $arrayMenu = array();

    $arrayMenu = carregarMenu($rsUsuario['idNivel']);


    if(isset($_GET['opt'])){
        
        $opt = $_GET['opt'];
        $id = $_GET['id'];
        
        if($opt == "excluir"){
            $sql = "delete from tbl_fale_conosco where id =".$id;
            
            mysqli_query($conexao, $sql);
            
            header('location:admFaleConosco.php');
        }
    }

    


    


?>



<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        
        <script src="../engine1/jquery.js"></script>
        
        <script>
            //código para abrir a modal
            $(document).ready(function(){
               
                $(".visualizar").click(function(){
                    $(".container").fadeIn(500);
                })
                
            });
            
            
            function modal(idComentario){
                
                
                $.ajax({
                    type: "GET",
                    url: "modal_fale_conosco.php",
                    data: {idRegistro:idComentario},
                       
                       
                    success: function(dados){
                        $('.modal').html(dados);
                    }
                    
                })
                
            }
            
            
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

            
            
            
<!--CONTEUDO            -->

            <div class="caixa_fale_titulo">
                <h1>Comentários </h1>
            </div>
            <div class="caixa_fale_comentarios">
                <table width="600px" border="1px">
                    <tr height="50px">
                        <td>
                            Email
                        </td>
                        
                        <td>
                            Produto                        
                        </td>
                        
                        <td>
                            Opções
                        </td>
                    </tr>
                    
                    
                    <?php
                    
                        $sql = "select id, email, informacoesProduto from tbl_fale_conosco";

                        $select = mysqli_query($conexao, $sql);

                        while($rsConsulta = mysqli_fetch_array($select)){
                    ?>
                    <tr height="50px">
                        <td>
                            <?php
                                echo($rsConsulta['email']);
                            ?>
                        </td>
                        
                        <td>
                        
                            <?php
                                echo($rsConsulta['informacoesProduto']);
                            ?>                        
                        </td>   
                        
                        <td>
                            <a href="#" class="visualizar" onclick="modal(<?php echo($rsConsulta['id']) ?>)">
                                <img src="imagens/search.png">
                            </a>
                            
                            <a href="admFaleConosco.php?opt=excluir&id=<?php echo($rsConsulta['id'])?>">
                                <img src="imagens/delete.png">
                            </a>
                            
                        </td>
                    </tr>
                    
                    <?php
                        }
                    
                    ?>
                </table>
            </div>
            
            
<!--FIM CONTEUDO            -->
            


          
            
            
            
            
            
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