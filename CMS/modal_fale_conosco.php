<?php

    $sexo = "";

    require_once('../conexao.php');

    $conexao = getConexao();

    $id = $_GET['idRegistro'];

    $sql = "select * from tbl_fale_conosco where id = ".$id;

    $select = mysqli_query($conexao, $sql);

    $rsConsulta = mysqli_fetch_array($select);

    

    if($rsConsulta['sexo'] == 'm'){
        $sexo = "Masculino";
    }else if($rsConsulta['sexo'] == 'f'){
        $sexo = "Feminino";    
    }


?>


<!doctype html>

<html>
    <head>
        <link type="text/css" rel="stylesheet" href="css/style.css">
    </head>
    <body>
        

        
        <div class="caixa_fale_form">
            
            <header>
                <div class="header" style="color: white;">
                    <h1 style="float: left; margin-right: 600px;">Informações do Comentário</h1>
                    <a href="admFaleConosco.php">
                        <img src="imagens/sair.png" style="float: left;">
                    </a>
                </div>

            </header>            
            

                <div class="caixa_form_esquerda">
                    <div class="caixa_form_esquerda_lbl">
                        <p>Nome:</p>
                        <p>Telefone:</p>
                        <p>Celular:</p>
                        <p>Email:</p>
                        <p>Sexo:</p>                            
                    </div>



                    <div class="caixa_form_esquerda_inputs">
                         <p><?php echo($rsConsulta['nome'])?></p>

                        <p><?php echo($rsConsulta['telefone'])?></p>

                        <p><?php echo($rsConsulta['celular'])?></p>

                        <p><?php echo($rsConsulta['email'])?></p>

                        <p><?php echo($sexo)?></p>
                        
                    </div>

                </div>

                <div class="caixa_form_direita">
                    <div class="caixa_form_direita_lbl">
                        <p>Profissão:</p>
                        <p>Home page:</p>
                        <p>Link do Facebook:</p>
                        <p>Informações do Produto:</p>
                        <p>Crítica/Sugestão:</p>                            
                    </div>



                    <div class="caixa_form_direita_inputs">
                         <p><?php echo($rsConsulta['profissao'])?></p>

                        <p><?php echo($rsConsulta['homePage'])?></p>

                        <p><?php echo($rsConsulta['linkFacebook'])?></p>

                        <p><?php echo($rsConsulta['informacoesProduto'])?></p>

                        <textarea name="txtCritica" style="resize: none;" readonly>
                            <?php echo($rsConsulta['critica'])?>
                        </textarea>

                    </div>                            
                </div>



            
           
        </div>     
    </body>
   
</html>