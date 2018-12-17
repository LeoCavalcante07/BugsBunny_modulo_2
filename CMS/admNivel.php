<?php

    session_start();

    $icone_ativacao = "imagens/desativado.png";

    $x = 0;

    $btnDinamico = "Inserir";

    $nomeNivel = "";
    $descNivel = "";

    $desc = "";

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


    if(isset($_GET['btnSalvar'])){
        
        $nomeNivel = $_GET['txtNome'];
        $desc = $_GET['txtDesc'];
        echo("<script> alert('nao ENTROU') </script>");
        if($_GET['btnSalvar'] == "Inserir"){
            


            $sql = "insert into tbl_niveis(nome, descricao) value('".$nomeNivel."', '".$desc."');";
            //var_dump($sql);

            if(mysqli_query($conexao, $sql)){
                echo("<script> alert('Dados gravados com sucesso') </script>");

            }else{
                echo("<script> alert('Houve um erro na gravação de dados') </script>");
            }   
           
            
            
            
        }else if($_GET['btnSalvar'] == "Editar"){
            echo("<script> alert('ENTROU') </script>");


            //$sql = "insert into tbl_niveis(nome, descricao) value('".$nomeNivel."', '".$desc."');";
            $sql = "update tbl_niveis set nome = '".$nomeNivel."', descricao = '".$desc."' where id = ".$_SESSION['id'];
            //var_dump($sql);

            if(mysqli_query($conexao, $sql)){
                echo("<script> alert('Dados atualizados com sucesso') </script>");

            }else{
                echo("<script> alert('Houve um erro na atualização de dados') </script>");
            }  
            
           
        }

        
        header('location:admNivel.php');
        
        
    }

    if(isset($_GET['opt'])){
        $opt = $_GET['opt'];
        $id = $_GET['id'];
        
        if($opt == "excluir"){
            $sql = "delete from tbl_niveis where id = ".$id;
            
            mysqli_query($conexao, $sql);
        }else if($opt == "editar"){
            $btnDinamico = "Editar";            
            
            $sql = "select * from tbl_niveis where id = ".$id;            
            $select = mysqli_query($conexao, $sql);
            $rsNiveis = mysqli_fetch_array($select);
            
            $_SESSION['id'] = $id;
            $nomeNivel = $rsNiveis['nome'];
            $descNivel = $rsNiveis['descricao'];
            
        }
    }

    if(isset($_GET['mudar'])){
        
        $id = $_GET['id'];
        
        if($_GET['mudar'] == 0){
            $sql = "update tbl_niveis set status = 1 where id = ".$id;
            
            $x = 1;
        }else{
            $sql = "update tbl_niveis set status = 0 where id = ".$id;
            
        }
        
        
        mysqli_query($conexao, $sql);
        
    }


?>



<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">

        <script>
        
            status =0;
            function ativar_desativar(){
                var imagemAtual = document.getElementById('imagem_ativar_desativar') ;
                
                if(status == 0){
                    imagemAtual.src = "imagens/ativado.png"; 
                    status == 1
                }else if(status == 1){
                    imagemAtual.src == "imagens/desativado.png";
                    status = 0;
                }
                 return status;
                
                
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
            
            
            
                <div class="caixa_seg_table">
                    <table width="500px" height="80px" border="1px">

                        <tr height="50px">
                            <td width="120px">
                                Nome
                            </td>

                            <td width="160px">
                                Descrição
                            </td>

                            <td>
                                Opções de ativação
                            </td>                        
                        </tr>
                        
                        <?php
                            $sql = "select * from tbl_niveis";
                        
                            $select = mysqli_query($conexao, $sql);
                            
                            while($rsNiveis = mysqli_fetch_array($select)){
                                
                                if($rsNiveis['status'] == 0){                              
                                    $icone_ativacao = "imagens/desativado.png";
                                }else if($rsNiveis['status'] == 1){
                                    $icone_ativacao = "imagens/ativado.png";
                                }
                        ?>
                        
                        <tr height="50px">
                            <td>
                                <?php echo($rsNiveis['nome']) ?>
                            </td>

                            <td>
                                <?php echo($rsNiveis['descricao']) ?>
                            </td>

                            <td>
                                <a href="admNivel.php?opt=excluir&id=<?php echo($rsNiveis['id'])?>"><img src="imagens/delete.png"></a>
                                
                                <a href="admNivel.php?opt=editar&id=<?php echo($rsNiveis['id'])?>"><img src="imagens/edit.png"></a>
                                
                                <a href="admNivel.php?id=<?php echo($rsNiveis['id'])?>&mudar=<?php echo($x)?>"><img src="<?php echo($icone_ativacao)?>" id="imagem_ativar_desativar"></a>
                            </td>                        
                        </tr> 
                        
                        <?php
                            }
                        ?>
                    </table>              
                </div>
          
                <div class="formNivel">
                    <form action="admNivel.php" method="get">
                        

                        <div class="caixa_nivel_nome">
                            Nome do nível: <input type="text" name="txtNome" value="<?php echo($nomeNivel)?>">

                        </div>
                        
                            Descrição: 
                            <textarea name="txtDesc" style="height:100px;resize: none;">
                                <?php echo($descNivel)?>
                            </textarea>
                        
                        <input type="submit" value="<?php echo($btnDinamico)?>" name="btnSalvar">
                    </form>
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