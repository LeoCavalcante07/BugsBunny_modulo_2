<?php 

    include_once('../conexao.php');
    $conexao = getConexao();

    session_start();

    $btnSubmit = "Cadastrar";
    $nomeProduto = "";
    $descricao = "";
    $sinopse = "";
    $foto = "";

    
    $userLogado = "";
    
    $idUser = $_SESSION['idUsuario'];

    $sql = "select * from tbl_usuarios where id = ".$idUser;

    $select = mysqli_query($conexao, $sql);

    $rsUsuario = mysqli_fetch_array($select);

    $userLogado = $rsUsuario['nome'];


    if(isset($_POST['btnCadastrar'])){
        
        if($_POST['btnCadastrar'] == "Cadastrar"){
           
            
            $nome = $_POST['txtNomeProduto'];
            $idSubCategoria = $_POST['cbSubCategoria'];
            $desc = $_POST['txtDescProduto'];
            $foto = $_POST['txtNomeFoto'];
            $sinopse = $_POST['txtSinopseProduto'];

            $sql = "insert into tbl_produto(nome, descricao, foto, idSubCategoria, sinopse) values('".$nome."', '".$desc."', '".$foto."', ".$idSubCategoria.", '".$sinopse."')";

            //var_dump($sql);

            mysqli_query($conexao, $sql);

            header("location:admProduto.php");            
            
        }else if($_POST['btnCadastrar'] == "Editar"){
            $sql = "update tbl_produto set nome = '".$nomeProduto."', descricao = '".$descricao."', sinopse = '".$sinopse."', idSubCategoria = ".$idSubCategoria.", foto = '".$foto."' where idProduto = ".$_SESSION['idProduto'];
            
            mysqli_query($conexao, $sql);
            header("location:admProduto.php");
        }

        
    }


    if(isset($_GET['modo'])){
        
        $idProduto = $_GET['idProduto'];
        $modo = $_GET['modo'];
        $foto = $_GET['foto'];
        
        if($modo == "excluir"){
            
            //unlink($foto);
            $sql  ="delete from tbl_produto where idProduto =".$idProduto;
            
            if(mysqli_query($conexao, $sql)){
                echo("<script>alert('Produto excluido com sucesso')</script>");
                header("location:admProduto.php");   
            }else{
                echo("<script>alert('Houve um erro na exclusão do produto')</script>");
            }                        
            
            
        }else if($modo == "buscar"){
            $btnSubmit  ="Editar";
            $sql = "select p.idProduto, p.foto, p.nome, p.descricao, p.sinopse, p.idSubCategoria, sc.nomeSubCategoria from tbl_produto as p join tbl_subcategoria as sc on p.idSubCategoria = sc.idSubCategoria where idProduto = ".$idProduto;
            
            //var_dump($sql);
            $select = mysqli_query($conexao, $sql);
            $rsConsulta = mysqli_fetch_array($select);
            
            $_SESSION['idProduto'] = $rsConsulta['idProduto'];
            $nomeProduto = $rsConsulta['nome'];
            $descricao = $rsConsulta['descricao'];
            $sinopse = $rsConsulta['sinopse'];   
            $idSubCategoria = $rsConsulta['idSubCategoria'];   
            $nomeSubcategoria = $rsConsulta['nomeSubCategoria'];
            $foto = $rsConsulta['foto'];
        }
    }
    





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
                
                
                $(".caixa_estatistica").click(function(){
                    
                    $.ajax({
                        type:"GET" ,
                        url:"modal_estatistica.php",
                        
                        success: function(dados){
                            $(".modalEstatistica").html(dados);
                        }
                    });
                    
                   $(".containerEstatistica").fadeIn(500);
                });
                
   
            });
            
            
            
            
            
            
            
            
           
    
        
        </script>        
        

    </head>
    
    <body>
        
        <div class="containerEstatistica">
            <div class="modalEstatistica">
            
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
            
            <div class="segFormProduto">
                <div id="visualizarFoto" style="width: 100%;">
                    <img src="<?php echo($foto)?>">
                </div>
                <form id="frmFoto" action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" id="fleFoto" name="fleFoto">
                </form>
                
                <form id="frmCadastro" action="admProduto.php" method="post">
                    <input type="text" name="txtNomeFoto" style="display: none;" value="<?php echo($foto)?>">
                    <br>
                    Nome do produto: <input type="text" name="txtNomeProduto" value="<?php echo($nomeProduto)?>">
                    
                    <br><br>
                    
                    Categoria:                     
                    <select name="cbSubCategoria">
                        <?php
                            if($modo != "buscar"){
                                $idSubCategoria = 0;
                                $nomeSubcategoria = "Escolha um a opção";
                            }
                        ?>
                        <option value="<?php echo($idSubCategoria)?>"><?php echo($nomeSubcategoria)?></option>
                        <?php
                            $sql = "select idSubCategoria, nomeSubCategoria from tbl_subcategoria where status = 1";
                            
                            $select = mysqli_query($conexao, $sql);
                            
                            while($rsConsulta = mysqli_fetch_array($select)){
                                
                                $idSubCategoria = $rsConsulta['idSubCategoria'];
                                $nomeSubcategoria = $rsConsulta['nomeSubCategoria'];
                        ?>
                        
                            <option value="<?php echo($idSubCategoria)?>">
                                <?php echo($nomeSubcategoria)?>
                            </option>
                        
                        <?php
                            }
                        ?>
                    </select>
                    <br><br>
                    Descrição:<input type="text" name="txtDescProduto"  value="<?php echo($descricao)?>">
                    <br><br>
                    Sinopse:<br>
                    <textarea name="txtSinopseProduto" style="resize: none;">
                        <?php echo($nomeProduto)?>
                    </textarea>
                    
                    <br><br>
                    
                    <input type="submit" name="btnCadastrar" value="<?php echo($btnSubmit)?>">
                </form>
            </div>
            
            <div class="caixa_estatistica">
                <img src="imagens/grafico.png">
            </div>

            
            <div class="seg_produtos">                
                <?php 
                    $sql = "select * from tbl_produto";
                
                    //var_dump($sql);
                
                    $select = mysqli_query($conexao, $sql);
                    while($rsConsulta = mysqli_fetch_array($select)){
                
                ?>
                <a>
                <div class="caixa_seg_produto">
                    <img src="<?php echo($rsConsulta['foto'])?>">
                    
                    
                    <p><a href="auxiliar.php?idProduto=<?php echo($rsConsulta['idProduto'])?>">Adicionar Promoção</a></p>
                    <a href="admProduto.php?modo=excluir&idProduto=<?php echo($rsConsulta['idProduto'])?>&foto=<?php echo($rsConsulta['foto'])?>"> <div class="seg_icones"><img src="imagens/delete.png"></div> </a>
                    <a href="admProduto.php?modo=buscar&idProduto=<?php echo($rsConsulta['idProduto'])?>&foto=<?php echo($rsConsulta['foto'])?>"> <div class="seg_icones"><img src="imagens/edit.png"></div> </a>
                </div>                
                </a>

                
                <?php
                    }
                ?>
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