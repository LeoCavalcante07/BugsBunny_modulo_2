<?php

    session_start();

    $icone_ativacao = "imagens/desativado.png";



    $btnSalvar = "Inserir";

    include_once('carregarMenu.php');

    include_once('../conexao.php');
    $conexao = getConexao();

    $nome = "";
    $desc = "";


    $userLogado = "";
    
    $idUser = $_SESSION['idUsuario'];

    $sql = "select * from tbl_usuarios where id = ".$idUser;

    $select = mysqli_query($conexao, $sql);

    $rsUsuario = mysqli_fetch_array($select);

    $userLogado = $rsUsuario['nome'];

    $arrayMenu = array();

    $arrayMenu = carregarMenu($rsUsuario['idNivel']);


    if(isset($_GET['btnSalvar'])){

        $nome = $_GET['txtNome'];
        $desc = $_GET['txtDesc'];
        
        
        if($_GET['btnSalvar'] == "Inserir"){
        
            $sql = "insert into tbl_categoria(nomeCategoria, descricao) values('".$nome."', '".$desc."')";


        }else if($_GET['btnSalvar'] == "Atualizar"){
            $sql = "update tbl_categoria set nomeCategoria = '".$nome."', descricao = '".$desc."' where idCategoria = ".$_SESSION['id'];    
            
        }
        var_dump($sql);

        mysqli_query($conexao, $sql);

        header('location:admCategoria.php');         
        
    }



    if(isset($_GET['opt'])){
        $opt = $_GET['opt'];
        $id = $_GET['id'];
        
        if($opt == "excluir"){
            $sql = "delete from tbl_categoria where idCategoria =".$id;
            
            mysqli_query($conexao, $sql);
            header("location:admCategoria.php");
            
            
        }else if($opt == "buscar"){
            $_SESSION['id'] = $id;
            $btnSalvar = "Atualizar";
            $sql = "select * from tbl_categoria where idCategoria = ".$id;
            
            $select = mysqli_query($conexao, $sql);
            
            $rsConsulta = mysqli_fetch_array($select);
            
            
            
            $nome = $rsConsulta['nomeCategoria'];
            $desc = $rsConsulta['descricao'];            

            
        }
    }





    if(isset($_GET['mudar'])){
        
        
        $id = $_GET['id'];
        
        if($_GET['mudar'] == 0){
            
            $sql = "update tbl_categoria set status = 1 where idCategoria = ".$id;
                        
            
            
        }else{
                
            $sql = "update tbl_categoria set status = 0 where idCategoria = ".$id;
            
        }
        
        //var_dump($sql);
        
        
        mysqli_query($conexao, $sql);
        
    }

?>


<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">



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
            
            
            <div class="caixa_form">
                <form action="admCategoria.php" method="get">
                    <p>Nome Categoria: <input type="text" name="txtNome" value="<?php echo($nome)?>"></p>
                    <br>
                    <p>Descrição: <input type="text" name="txtDesc" value="<?php echo($desc)?>"></p>
                    <br>            
                    <br>
                
                    <input type="submit" name="btnSalvar" value="<?php echo($btnSalvar)?>">
                    
                </form>

            </div>
            
            
            
            
            <div class="segTable">
            
                <table height="50px" width="300px" border="1px">
                    <tr>
                        <td width="100px">
                            Categoria
                        </td>
                        
                        <td width="100px">
                            Descrição
                        </td>
                        
                        <td width="100px">
                            Opções
                        </td>
                    </tr>
                    
                    <?php
                        
                        $sql = "select * from tbl_categoria";
                    
                        
                    
                        $select = mysqli_query($conexao, $sql);                                                            
                    
                        while($rsConsulta = mysqli_fetch_array($select)){
                            if($rsConsulta['status'] == 0){                              
                                    $icone_ativacao = "imagens/desativado.png";
                                }else if($rsConsulta['status'] == 1){
                                    $icone_ativacao = "imagens/ativado.png";
                                }
                            
                        
                    
                    ?>
                    
                    <tr>
                        <td>
                            <?php echo($rsConsulta['nomeCategoria'])?>
                        </td>
                        
                        <td>
                            <?php echo($rsConsulta['descricao'])?>
                        </td>
                        
                        <td>
                            <a href="admCategoria.php?id=<?php echo($rsConsulta['idCategoria'])?>&opt=excluir"><img src="imagens/delete.png"></a>
                            
                            <a href="admCategoria.php?id=<?php echo($rsConsulta['idCategoria'])?>&opt=buscar"><img src="imagens/edit.png"></a>
                            
                           <a href="admCategoria.php?id=<?php echo($rsConsulta['idCategoria'])?>&mudar=<?php echo($rsConsulta['status'])?>"><img src="<?php echo($icone_ativacao)?>" id="imagem_ativar_desativar"></a>
                            
                        </td>
                    </tr>
                    
                    
                    
                    <?php
                        }
                    
                    ?>
                </table>    
                
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