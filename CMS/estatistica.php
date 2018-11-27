<?php 

    include_once('../conexao.php');
    $conexao = getConexao();

    session_start();

    
    $userLogado = "";
    
    $idUser = $_SESSION['idUsuario'];





    



?>


<!doctype html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        
        <meta charset="utf-8">
        
        <script src="../js/jquery.min.js"></script>
        <script src="../engine1/jquery.form.js"></script>
        

    </head>
    
    <body>
        <div class="caixa_principal_estatistica">
            <div class="grafico">
                <?

                $sql = "select acesso, idProduto, nome from tbl_produto";

                $select = mysqli_query($conexao, $sql);                
                while($rsConsulta = mysqli_fetch_array($select)){
                    
                        
                ?>
                <div class="unidade_grafico">
                    <?php echo($rsConsulta['nome']);?>
                </div>   
                
                <?
                }
                ?>
            </div>

        </div>
    </body>
</html>            