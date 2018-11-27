<?php
    
    //$arrayDados=[];

    include_once("conexao.php");

    $conexao = getConexao();


    $imgPromocao = "";
    $tituloPromocao = "";
    $sinopse = "";
    $precoAntigo = "";
    $precoAtual = "";

    $idProduto = $_GET['id'];

//    $sql = "(select 'null' as nome, 'null' as sinopse, 'null' as foto, preco as precoAntigo, '0' as precoNovo, 'null' as from_date from tbl_preco_produto where idProduto = 4 and to_date ='2018-11-22'
//    )union(
//    select p.nome, p.sinopse, p.foto, 'null' as precoAntigo, pp.preco as precoNovo, pp.from_date from tbl_produto as p, tbl_preco_produto as pp where p.idProduto = 3 and pp.idProduto = 3 and p.status = 1 and pp.to_date is null);";



    $sql = "select p.acesso, p.nome, p.foto, p.sinopse, pp.preco, pp.from_date from tbl_produto as p, tbl_preco_produto as pp where p.status = 1 and to_date is null and p.idProduto = ".$idProduto." and p.idProduto = pp.idProduto";

    

    var_dump($sql);
    
    $select = mysqli_query($conexao, $sql);

    $rsConsulta = mysqli_fetch_array($select);
    
    $imgPromocao = $rsConsulta['foto'];

    $acesso = $rsConsulta['acesso'] + 1;

    $tituloPromocao = $rsConsulta['nome'];

    $sinopse = $rsConsulta['sinopse'];

    $precoAtual = $rsConsulta['preco'];

    $from_date = $rsConsulta['from_date'];

    $sql = "select preco from tbl_preco_produto where to_date ='".$from_date."' and idProduto = ".$idProduto;

    var_dump($sql);

    $select = mysqli_query($conexao, $sql);

    $rsConsulta = mysqli_fetch_array($select);

    $precoAntigo = "R$".$rsConsulta['preco'];


    // faz a contagem de acessos
    $sql = "update tbl_produto set acesso = ".$acesso." where idProduto = ".$idProduto;

    var_dump($sql);

    mysqli_query($conexao, $sql);
    

        
     
?>

<!doctype html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        

    </head>
    <body>
        
        
        <div class="caixa_promocoes_principal" style="height: 500px; background-color: black; margin-top: 200px;">
            <div class="caixa_promocoes_principal_imagem">
                <img src="CMS/<?php echo($imgPromocao)?>">

            </div>            
            
            <div class="caixa_promocoes_principal_detalhes">
                <div class="caixa_promocoes_principal_detalhes_nome">
                    <p><?php echo($tituloPromocao)?></p>
                </div>

                <div style="width: 60px; height: 60px;">
                    <p>Sinopse:</p>
                </div>

                <div class="caixa_promocoes_principal_detalhes_descricao">
                    <p><?php echo($sinopse)?> </p>
                </div>

                <div class="caixa_promocao_detalhes_preco_antigo">
                    <p><?php
                            if($precoAntigo != "R$")
                                echo($precoAntigo)

                        ?>
                    </p>
                </div>

                <div class="caixa_promocao_detalhes_preco_atual">
                    <p>R$<?php echo($precoAtual)?></p>
                </div>                                

            </div>                    
        </div> 
        
        <div class="imgSair" onclick="window.location.reload()">
            
        </div>
        
    </body>
</html>