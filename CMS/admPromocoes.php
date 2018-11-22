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

    
    $_SESSION['idProduto'];
    //var_dump($_SESSION['idProduto']);


    if(isset($_GET['btnAtualizar'])){
        //var_dump($_SESSION['idProduto']);
        $novoPreco = $_GET['txtNovoPreco'];
        $dtAlteracao = $_GET['txtDtAlteracao'];
        
        
        ///////
        $sql2 = "select preco from tbl_preco_produto where to_date is null and idProduto = ".$_SESSION['idProduto'];
        
        $select = mysqli_query($conexao, $sql2);
                        
        $rsConsulta= mysqli_fetch_array($select);
        
        $precoAntigo = $rsConsulta['preco'];   
        
        
        /////
        
        
        $sql = "update tbl_preco_produto set promocao = 0, to_date = '".$dtAlteracao."' where to_date is null and idProduto = ".$_SESSION['idProduto'];
        

        
        mysqli_query($conexao, $sql);
       // header("location:admPromocoes.php");
        
        //$idProduto = $_SESSION['idProduto'];        
        
        $statusPromocao = 1;
        if($novoPreco > $precoAntigo){// caso o preço atual seja maior que o anterior, o produto não deve estar em promocao, logo, status = 0
            //echo("nao sei pq entrou");
            $statusPromocao = 0;
        }
        

        
        
        $sql3 = "insert into tbl_preco_produto(idProduto, preco, from_date, promocao) values(".$_SESSION['idProduto'].", ".$novoPreco.", '".$dtAlteracao."', ".$statusPromocao.")";
        
        
        mysqli_query($conexao, $sql3);
        //header("location:admPromocoes.php");
        
        
        
    
        
    }


    


    





?>




<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        
        <meta charset="utf-8">
        

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
            
            
            <div class="seg_form_promocoes">
                <form action="admPromocoes.php" method="get">
                    <p>Novo Preço:</p>
                    <p><input type="text" name="txtNovoPreco" required></p>
                    <br><br>
                    <p>Data de alteração do valor:</p>
                    <p><input type="text" name="txtDtAlteracao" required></p>
<!--                    Essa data deve ser a data de encerramento do preço anterior-->
                    
                    <input type="submit" name="btnAtualizar" value="Atualizar">
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