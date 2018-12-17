<?php

    session_start();
    include_once('carregarMenu.php');
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

    $arrayMenu = array();

    $arrayMenu = carregarMenu($rsUsuario['idNivel']);


    if(isset($_POST)){
        
        if(isset($_POST['txtNomeFoto'])){
            
            $titulo = $_POST['txtTitulo']; 
            $nomeFoto = $_POST['txtNomeFoto'];
            $texto = $_POST['txtTexto'];  
            
            if($_POST['btnSalvar'] == "Salvar"){
               $sql = "insert into tbl_sobre(titulo, foto, texto) values('".$titulo."', '".$nomeFoto."', '".$texto."')"; 
            }else if($_POST['btnSalvar'] == "Editar"){
                $sql = "update tbl_sobre set titulo = '".$titulo."', foto = '".$nomeFoto."', texto = '".$texto."' where idSobre = ".$_SESSION['id'];
            }
            
            if(mysqli_query($conexao, $sql)){
                echo("imagem uppada com success");  
                header("location:admSobre.php"); 
            }
                
            
        }
                

  
        

    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
        
        if($modo == "excluir"){
            
            $sql = "select foto from tbl_sobre where idSobre = ".$id;
            
            $select  = mysqli_query($conexao, $sql);
            
            $rsFoto = mysqli_fetch_array($select);
            
            
            unlink($rsFoto['foto']); 
            
            
            $sql = "delete from tbl_sobre where idSobre =".$id;
            
            if(mysqli_query($conexao, $sql)){
                echo("<script>alert('Noticia excluida com sucesso')</script>");
                header("location:admSobre.php");
            }
            
        }else if($modo == "buscar"){
            
            $btnSubmit = "Editar";
            
            $sql = "select * from tbl_sobre where idSobre = ".$id;
            $select = mysqli_query($conexao, $sql);
            
            $rsSobre = mysqli_fetch_array($select);
            
            $texto = $rsSobre['texto'];
            $titulo = $rsSobre['titulo'];
            $nomeImagem = $rsSobre['foto'];
            $imagem = "<img src='".$nomeImagem."'>";                                    
        }
    }




    if(isset($_GET['atualizarStatus'])){
        
        $id = $_GET['id'];
        
        if($_GET['atualizarStatus'] == 0){
            $sql = "update tbl_sobre set status = 1 where idSobre = ".$id;
        }else{
            $sql = "update tbl_sobre set status = 0 where idSobre = ".$id;
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
            
            
                      
            <div class="seg_destaque_form">
                <div id="visualizarFoto" onclick="escolherFoto()">
                    <?php echo($imagem)?>
                </div>
                <form id="frmFoto" action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" id="fleFoto" name="fleFoto">

                </form>
                
                <form id="frmCadastro" action="admSobre.php" method="post" enctype="multipart/form-data">
<!--                    Nome foto             -->
                    <input type="text" name="txtNomeFoto" style="display: none;" value="<?php echo($nomeImagem)?>">
                    <br><br>
                    Titulo: <input type="text" name="txtTitulo" value="<?php echo($titulo)?>">
                    <br><br>
                    Texto:  <textarea name="txtTexto" style="resize: none; height: 70px;">
                        <?php echo($texto)?>
                    </textarea>
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
            
            
            
            
            
        <div class="seg_table_sobre">
            <table width="650px" height="300px" border="1px">
                
                <?php
                    $sql = "select * from tbl_sobre";
                    $select = mysqli_query($conexao, $sql);
                    
                    $i = 0; // variavel que sera concatenada com o id de cada objeto FILE para diferencia-los
                    while($rsSobre = mysqli_fetch_array($select)){
                        
                        $status = $rsSobre['status'];
                        
                        if($status == 0){
                            $iconeAtivacao = "imagens/desativado.png";
                        }else{
                            $iconeAtivacao = "imagens/ativado.png";
                        }
                ?>
              
                    <tr height="50px">
                        <td colspan="2">
    <!--                        titulo-->
                            <?php echo($rsSobre['titulo'])?>
                        </td>


                    </tr>

                    <tr height="200px">
                        <td class="tdImagem">
    <!--                        imagem-->
                            <img id="imagem<?php echo($i)?>" src="<?php echo($rsSobre['foto'])?>">
                            
                        </td>

                        <td>
                            <textarea name="txtTexto" disabled style="height: 290px; width:200px; resize: none; background-color: white; font-size:14px;">
                                <?php echo($rsSobre['texto'])?>
                            </textarea>

                        </td>                    
                    </tr>
                    <tr height="50px" align="center">
                        <td colspan="2">
                            <a href="admSobre.php?id=<?php echo($rsSobre['idSobre'])?>&modo=excluir">                                
                                <img src="imagens/delete.png">
                            </a>
                            
                            <a href="admSobre.php?id=<?php echo($rsSobre['idSobre'])?>&modo=buscar">
                                <img src="imagens/edit.png">
                            </a>
                            
                            <a href="admSobre.php?id=<?php echo($rsSobre['idSobre'])?>&atualizarStatus=<?php echo($status)?>">
                                <img src="<?php echo($iconeAtivacao)?>">
                            </a>
                            
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