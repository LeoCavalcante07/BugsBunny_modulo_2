<?php
    
    $arrayDados=[];

    include_once("conexao.php");

    $conexao = getConexao();

    $imgPromocao = "";
    $tituloPromocao = "";
    $sinopse = "";
    $precoAntigo = "";
    $precoAtual = "";

    $sql = "(select 'xxxx' as nome, 'null' as sinopse, 'null' as foto, preco as precoAntigo, '0' as precoNovo, 'null' as from_date from tbl_preco_produto where idProduto = 4 and to_date ='2018-11-22'
    )union(
    select p.nome, p.sinopse, p.foto, 'null' as precoAntigo, pp.preco as precoNovo, pp.from_date from tbl_produto as p, tbl_preco_produto as pp where p.idProduto = 3 and pp.idProduto = 3 and p.status = 1 and pp.to_date is null);";

    var_dump($sql);
    
    $select = mysqli_query($conexao, $sql);
    
    $rsConsulta = mysqli_fetch_array($select);
    $arrayDados = $rsConsulta;
        
    
    //$rsConsulta object = $rsConsulta;
    var_dump($rsConsulta);

echo(count($rsConsulta));
        
     
?>

<!doctype html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        
        
    </head>
    <body>
        
        
        <div class="caixa_promocoes_principal" style="background-color: black; margin-top: 250px;">
            <div class="caixa_promocoes_principal_imagem">
<!--                <img src="CMS//<?php //echo($rsConsulta[0]['precoAntigo'])?>">-->
                <?php echo($rsConsulta['precoAntigo'])?>

            </div>
                         
        </div>        
        
    </body>
</html>