<?php

    session_start();

    $icone_ativacao = "imagens/desativado.png";

    $x = 0;

    $btnSalvar = "Inserir";

    include_once('../conexao.php');
    $conexao = getConexao();

    $nomeUsuario = "";
    $email = "";
    $senhaUsuario = "";

    //variavel que será usada para selecionar a opção do combox que vier do banco
    $selected = "";



    $userLogado = "";
    
    $idUser = $_SESSION['idUsuario'];

    $sql = "select * from tbl_usuarios where id = ".$idUser;

    $select = mysqli_query($conexao, $sql);

    $rsUsuario = mysqli_fetch_array($select);

    $userLogado = $rsUsuario['nome'];


    if(isset($_GET['btnSalvar'])){

        $nome = $_GET['txtNome'];
        $email = $_GET['txtEmail'];
        $nivel = $_GET['cbNivel'];
        $senhaUsuario = $_GET['txtSenha'];
        $senhaConfirm = $_GET['txtSenhaConfirm'];
        
        if($_GET['btnSalvar'] == "Inserir"){
        


            if($senhaUsuario == $senhaConfirm){
               
                $sql = "insert into tbl_usuarios(nome, email, idNivel, senha) values('".$nome."', '".$email."', '".$nivel."', '".$senhaUsuario."');";


           
            }else{
                echo("<script>alert('Senha errada')</script>");
            } 
        

        }else if($_GET['btnSalvar'] == "Atualizar"){
            $sql = "update tbl_usuarios set nome = '".$nome."', email = '".$email."', senha = '".$senhaUsuario."' where id = ".$_SESSION['id'];    
            var_dump($sql);
        }
        

        mysqli_query($conexao, $sql);

        header('location:admUsuario.php');         
        
    }



    if(isset($_GET['opt'])){
        $opt = $_GET['opt'];
        $id = $_GET['id'];
        
        if($opt == "excluir"){
            $sql = "delete from tbl_usuarios where id =".$id;
            
            mysqli_query($conexao, $sql);
            
            
        }else if($opt == "buscar"){
            $_SESSION['id'] = $id;
            $btnSalvar = "Atualizar";
            $sql = "select u.nome as nomeU, u.email, u.senha, n.nome as nomeN, 
            n.id as idNivel from tbl_usuarios as u, tbl_niveis as n where u.id = ".$id." and 
            n.id = u.idNivel";
            
            $select = mysqli_query($conexao, $sql);
            
            $rsConsulta = mysqli_fetch_array($select);
            
            
            
            $nomeUsuario = $rsConsulta['nomeU'];
            $email = $rsConsulta['email'];
            $senhaUsuario = $rsConsulta['senha'];
            $idNivel = $rsConsulta['idNivel'];
            $nomeN = $rsConsulta['nomeN'];
            
        }
    }





    if(isset($_GET['mudar'])){
        
        
        $id = $_GET['id'];
        
        if($_GET['mudar'] == 0){
            
            $sql = "update tbl_usuarios set status = 1 where id = ".$id;
                        
            
            $x = 1;
        }else{
            
            $sql = "update tbl_usuarios set status = 0 where id = ".$id;
            
        }
        
        var_dump($sql);
        
        
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
            
            
            <div class="caixa_form">
                <form action="admUsuario.php" method="get">
                    <p>Nome: <input type="text" name="txtNome" value="<?php echo($nomeUsuario)?>"></p>
                    <br>
                    <p>Email: <input type="text" name="txtEmail" value="<?php echo($email)?>"></p>
                    <br>
                    <p>
                        Nível:
                        <select name="cbNivel">
                            <?php
                                if($opt != "buscar"){
                                    $idNivel = 0;
                                    $nomeN = "Escolha";
                                }
                            ?>
                            
                            <option value="<?php echo($idNivel)?>"><?php echo($nomeN)?></option>
                            <?php 

                                $sql = "select * from tbl_niveis where id <>".$idNivel;
                                
                                $select = mysqli_query($conexao, $sql);

                                while($rsConsulta = mysqli_fetch_array($select)){                                
                            ?>
                                    <option value="<?php echo($rsConsulta['id'])?> <?php echo($selected)?>"><?php echo($rsConsulta['nome'])?></option>

                            <?php
                                }                        
                            ?>
                        </select>
                    </p> 
                    <br>
                    <p>Senha: <input type="password" name="txtSenha" value="<?php echo($senhaUsuario)?>"></p>
                    <br>
                    <p>Confime a senha: <input type="password" name="txtSenhaConfirm" value="<?php echo($senhaUsuario)?>"></p>
                    
                    <br>
                
                    <input type="submit" name="btnSalvar" value="<?php echo($btnSalvar)?>">
                    
                </form>

            </div>
            
            
            
            
            <div class="segTable">
            
                <table height="50px" width="300px" border="1px">
                    <tr>
                        <td width="100px">
                            Nome
                        </td>
                        
                        <td width="100px">
                            Cargo
                        </td>
                        
                        <td width="100px">
                            Opções
                        </td>
                    </tr>
                    
                    <?php
                        
                        $sql = "select u.id as idUsuario, u.nome as nomeUsuario, u.email, n.nome as nomeNivel, u.status as uStatus from tbl_niveis as n, tbl_usuarios as u where u.idNivel = n.id";
                    
                        
                    
                        $select = mysqli_query($conexao, $sql);                                                            
                    
                        while($rsConsulta = mysqli_fetch_array($select)){
                            
                            if($rsConsulta['uStatus'] == 0){                              
                                    $icone_ativacao = "imagens/desativado.png";
                                }else if($rsConsulta['uStatus'] == 1){
                                    $icone_ativacao = "imagens/ativado.png";
                                }
                            
                        
                    
                    ?>
                    
                    <tr>
                        <td>
                            <?php echo($rsConsulta['nomeUsuario'])?>
                        </td>
                        
                        <td>
                            <?php echo($rsConsulta['nomeNivel'])?>
                        </td>
                        
                        <td>
                            <a href="admUsuario.php?id=<?php echo($rsConsulta['idUsuario'])?>&opt=excluir"><img src="imagens/delete.png"></a>
                            
                            <a href="admUsuario.php?id=<?php echo($rsConsulta['idUsuario'])?>&opt=buscar"><img src="imagens/edit.png"></a>
                            
                           <a href="admUsuario.php?id=<?php echo($rsConsulta['idUsuario'])?>&mudar=<?php echo($x)?>"><img src="<?php echo($icone_ativacao)?>" id="imagem_ativar_desativar"></a>
                            
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