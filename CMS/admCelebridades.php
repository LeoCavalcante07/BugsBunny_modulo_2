<?php

    session_start();

    include_once('../conexao.php');
    $conexao = getConexao();

    $btnSubmit = "Salvar";

    $titulo = "";
    $texto = "";
    $imagem = "";
    $nomeImagem  = "";

    
    $iconeAtivacao = "imagens/ativado.png";


    $userLogado = "";
    
    $idUser = $_SESSION['idUsuario'];

    $sql = "select * from tbl_usuarios where id = ".$idUser;

    $select = mysqli_query($conexao, $sql);

    $rsUsuario = mysqli_fetch_array($select);

    $userLogado = $rsUsuario['nome'];


    if(isset($_POST)){
        
        if(isset($_POST['txtNomeFoto'])){
            
            $titulo = $_POST['txtTitulo']; 
            $nomeFoto = $_POST['txtNomeFoto'];
            
            
            if($_POST['btnSalvar'] == "Salvar"){
               $sql = "insert into tbl_celebridade(nomeCelebridade, foto) values('".$titulo."', '".$nomeFoto."')"; 
                
            }else if($_POST['btnSalvar'] == "Editar"){
                $sql = "update tbl_celebridade set nomeCelebridade = '".$titulo."', foto = '".$nomeFoto."' where idCelebridade = ".$_SESSION['id'];
            }
            var_dump($sql);
            
            if(mysqli_query($conexao, $sql)){
                //echo("imagem uppada com success");  
                header("location:admCelebridades.php"); 
            }
                
            
        }
                

  
        

    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
        
        if($modo == "excluir"){
            $sql = "select foto from tbl_celebridade where idCelebridade = ".$id;
            
            $select  = mysqli_query($conexao, $sql);
            
            $rsFoto = mysqli_fetch_array($select);
            
            
            unlink($rsFoto['foto']);
            
            
            
            
            $sql = "delete from tbl_celebridade where idCelebridade =".$id;
            
            if(mysqli_query($conexao, $sql)){
                //echo("<script>alert('Noticia excluida com sucesso')</script>");
                header("location:admCelebridades.php"); 
            }
            
        }else if($modo == "buscar"){
            
            $btnSubmit = "Editar";
            
            $sql = "select * from tbl_celebridade where idCelebridade = ".$id;
            $select = mysqli_query($conexao, $sql);
            
            $rsDestaque = mysqli_fetch_array($select);
            
            //$texto = $rsDestaque['texto'];
            $titulo = $rsDestaque['nomeCelebridade'];
            $nomeImagem = $rsDestaque['foto'];
            $imagem = "<img src='".$nomeImagem."'>";
                                               
        }
    }



    //para entrar nesse bloco, deve existir o id, mas sem o modo, se não confunde com ainstruçao do excluir e editar
    if(isset($_GET['addProduto'])){
       // $_SESSION['idCelebridade'] = $_GET['id'];
        header("location:admConteudoCelebridade.php?idCelebridade=".$_GET['id']);
    }




    if(isset($_GET['atualizarStatus'])){
        
        $id = $_GET['id'];
        
        if($_GET['atualizarStatus'] == 0){
            //para uma celebridade estar ativa, todas as outras devem estar desativadas, então antes de atualizar o status d euma celebridade, todas as outras devem ser atualizadas para desativado
            $sql = "update tbl_celebridade set status = 0";
           
            mysqli_query($conexao, $sql);
            
            $sql = "update tbl_celebridade set status = 1 where idCelebridade = ".$id;
        }else{
            
            
            $sql = "update tbl_celebridade set status = 0 where idCelebridade = ".$id;
        }
        
        
        
        mysqli_query($conexao, $sql);
    }







?>


<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">

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
                
   
            });
            
            
           
    
        
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
                    
                    
                    
                        <div class="caixa_menu_adm">
                            <a href="admProduto.php">                                
                                <div class="caixa_menu_adm_img">
                                    <img src="imagens/admProduct.png">
                                </div>

                                <div class="caixa_menu_adm_titulo">
                                    <p>Produtos</p>
                                </div>   
                            </a>
                        </div>
                                       

                    
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
            
<!-- ----------------------------- Fim Menu      -->
            
            
            <div class="seg_destaque_form">
                <div id="visualizarFoto" onclick="escolherFoto()">
                    
                    <?php echo($imagem)?>
                </div>
                <form id="frmFoto" action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" id="fleFoto" name="fleFoto">

                </form>
                
                <form id="frmCadastro" action="admCelebridades.php" method="post" enctype="multipart/form-data">
<!--                    Nome foto             -->
                    <input type="text" name="txtNomeFoto" style="display: none;" value="<?php echo($nomeImagem)?>">
                    <br><br>
                    Nome da Celebridade: <input type="text" name="txtTitulo" value="<?php echo($titulo)?>">
                    
                
                    <br><br>
                    <input type="submit" id="btnSalvar" name="btnSalvar" value="<?php echo($btnSubmit)?>">   
                    
<!--
                    <a href="#" class="visualizara" onclick="modal()">
                        <div class="eye_destaque" id="verModal">

                        </div>                    
                    </a>
-->

                </form>
            </div>
            
            
            
            
            
<!--            //////////////////////////////////-->
            
            
            
            
            
        <div class="seg_table_sobre">
            <table width="500px" height="300px" border="1px">
                
                <?php
                    $sql = "select * from tbl_celebridade";
                    $select = mysqli_query($conexao, $sql);
                    
                    $i = 0; // variavel que sera concatenada com o id de cada objeto FILE para diferencia-los
                    while($rsDestaque = mysqli_fetch_array($select)){
                        
                        $status = $rsDestaque['status'];
                        
                        if($status == 0){
                            $iconeAtivacao = "imagens/desativado.png";
                        }else{
                            $iconeAtivacao = "imagens/ativado.png";
                        }
                ?>
              
                    <tr height="50px">
                        <td colspan="2">
    <!--                        titulo-->
                            
                            
                        
                            <?php echo($rsDestaque['nomeCelebridade'])?>
                            
                            
                        </td>


                    </tr>

                    <tr height="200px">
                        <td class="tdImagem">
    <!--                        imagem-->
                            <img id="imagem<?php echo($i)?>" src="<?php echo($rsDestaque['foto'])?>">
                            
                        </td>

<!--
                        <td>
                            <textarea name="txtTexto" disabled style="height: 290px; width:200px; resize: none; background-color: white; font-size:14px;">
                                <?php echo($rsDestaque['texto'])?>
                            </textarea>

                        </td>                    
-->
                    </tr>
                    <tr height="50px" align="center">
                        <td colspan="2" >
                            <a href="admCelebridades.php?id=<?php echo($rsDestaque['idCelebridade'])?>&modo=excluir">                                
                                <img src="imagens/delete.png">
                            </a>
                            
                            <a href="admCelebridades.php?id=<?php echo($rsDestaque['idCelebridade'])?>&modo=buscar">
                                <img src="imagens/edit.png">
                            </a>
                            
                            <a href="admCelebridades.php?id=<?php echo($rsDestaque['idCelebridade'])?>&addProduto">
                                <img src="imagens/add.png">
                            </a>
                            
                            
                            <a href="admCelebridades.php?id=<?php echo($rsDestaque['idCelebridade'])?>&atualizarStatus=<?php echo($status)?>">
                                <img src="<?php echo($iconeAtivacao)?>">
                            </a>                            
                            
                            

                            
                        </td>
                    </tr>
              
                
                <?php
                       
                    }
                
                ?>
            </table>
          
            
        </div>              
            
            
            
            
            
            
            
<!--            ///////////////////////////-->
            

            
            
            
<!-- ---------------FOOTER-->
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