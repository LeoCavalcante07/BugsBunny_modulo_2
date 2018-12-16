<?php 

    include_once('../conexao.php');
    $conexao = getConexao();


    $todosAcessos = 0; // variavel que tem o total de acessos de todos os produtos
    $sql = "select acesso from tbl_produto  ";                             

    $select = mysqli_query($conexao, $sql);  

    while($rsConsulta = mysqli_fetch_array($select)){
        $todosAcessos = $todosAcessos + $rsConsulta['acesso'];
    }



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

        <div class="grafico">
            <h2 style="margin-left: 10px; margin-bottom: 50px;">TOP 5 ITENS MAIS ACESSADOS</h2>
            <table width="500px" height="150px" border="0px">

                <?php
                    $sql = "select acesso, idProduto, nome from tbl_produto order by acesso desc limit 0, 5";                       

                    $select = mysqli_query($conexao, $sql);


                    $i = 1;
                    while($rsConsulta = mysqli_fetch_array($select)){             $porcentagemAcesso = 0;
                        $acessosProduto = 0;

                        $acessosProduto = $rsConsulta['acesso'];

                        $porcentagemAcesso = (($acessosProduto * 100) / $todosAcessos)."%";                 

                ?>
                <tr>
                    <td width="30px">
                        <?php echo($i."°")?>
                    </td>
                    <td width="70px">
                        <?php echo($rsConsulta['nome'])?>
                    </td>


                    <td width="300px" >
                        <div class="limiteGrafico">
                            <div class="unidade_grafico" style="width: <?php echo($porcentagemAcesso)?>">

                            </div>                            
                        </div>

                    </td>

                    <td>
                        <?php echo($porcentagemAcesso)?>
                    </td>
                </tr>

                <?php
                        $i++;
                    }
                ?>
            </table>
            
            <div class="imagemSair" onclick="window.location.reload()">
            
            </div>
        </div>

    </body>
</html>            