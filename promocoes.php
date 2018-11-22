<?php

    include_once('conexao.php');
    $conexao = getConexao();

    $imgPromocao = "imagens/selecione.png";
    $tituloPromocao=""; 
    $descPromocao = "";
    $precoAtual = "";
    $precoAntigo = "";

    

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
//        $sql = "select p.nome, p.desc, p.foto, pp.preco from tbl_produto as p, tbl_preco_produto as pp where p.status = 1 and pp.to_date is null and p.idProduto = ".$id." and pp.idProduto = ".$id;
        
        $sql = "select p.nome, p.desc, p.foto, pp.preco, pp.from_date from tbl_produto as p, tbl_preco_produto as pp where p.status = 1 and pp.to_date is null and p.idProduto = ".$id." and pp.idProduto = ".$id; 
        
        
        //var_dump($sql);
        $select = mysqli_query($conexao, $sql);
        $rsConsulta = mysqli_fetch_array($select);
        
        $imgPromocao = $rsConsulta['foto'];
        $tituloPromocao = $rsConsulta['nome'];
        $descPromocao = $rsConsulta['desc'];
        $precoAtual = $rsConsulta['preco'];
        
        $from_date_preco_atual = $rsConsulta['from_date'];
        
        $sql2 = "select preco from tbl_preco_produto where idProduto = ".$id." and to_date ='".$from_date_preco_atual."'";
        
        
        
        //var_dump($sql2);
        
        $select2 = mysqli_query($conexao, $sql2);
        
        $rsPrecoAntigo = mysqli_fetch_array($select2);
        
        $precoAntigo = $rsPrecoAntigo['preco'];
        
        if($precoAtual > $precoAntigo){
            $sql = "update tbl_preco_produto set promocao = 0 where idProduto = ".$id;
            
            mysqli_query($conexao, $sql);
            header("location:promocoes.php");
        }
        
   
    }

?>


<!doctype html>
<html>
    <head>
        <title>Promoções</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        
        
                <!-- Shared assets -->
        <link rel="stylesheet" type="text/css" href="examples/_shared/css/style.css">

        <!-- Example assets -->
        <link rel="stylesheet" type="text/css" href="examples/connected-carousels/jcarousel.connected-carousels.css">

        <script src="CMS/js/jquery.min.js"></script>
        <script src="CMS/js/jquery.form.js"></script>
        
        <script>
            function verPromocao(id){
                $.ajax({
                   type:"get",
                    url:"promocoes.php?id="+id,
                    success:function(){
                        alert(id)
                        //content.html();
                    }
                    
                });
            }
            

        </script>

        <script type="text/javascript" src="examples/connected-carousels/jcarousel.connected-carousels.js"></script>
        
        <meta charset="utf-8">
        
    </head>
    
    <body>
        <header>
            <div id="caixa_header">
                <div id="caixa_header_central">
                    <div id="caixa_logo">
                       
                    </div>

                    <div id="caixa_menu">
                       <a href="index.php"> 
                           <div class="caixa_optMenu">
                            <p>Home</p>
                           </div>
                        </a>

                        <a href="destaque.php">
                            <div class="caixa_optMenu">
                               <p>Destaque</p>
                            </div>
                        </a>

                        <a href="sobre.php">
                            <div class="caixa_optMenu">
                                <p>Sobre</p>
                            </div>
                        </a>
                        
                        <a href="promocoes.php">
                            <div class="caixa_optMenu">
                                <p>Promoções</p> 
                            </div>           
                        </a>

                        <a href="bancas.php">
                            <div class="caixa_optMenu">
                                <p>Bancas</p>
                            </div> 
                        </a>
                        
                        <a href="celebridade.php">
                            <div class="caixa_optMenu">
                                <p>Celebridade</p>
                            </div> 
                        </a>
                        
                        <a href="faleConosco.php">
                            <div class="caixa_optMenu" >
                                <p>Fale Conosco</p> 
                            </div>           
                        </a>
                        
                    </div>

                    <div id="caixa_login">
                        <div class="caixa_seg_login_label">
                            <div class="caixa_login_label" style="margin-right: 30px;">
                                <p>Usuário:</p>
                            </div>

                            <div class="caixa_login_label">
                                <p>Senha:</p>
                            </div>                          
                        </div>
                        
                        <div class="caixa_seg_login_text">
                            <div class="caixa_login_text">
                                <input type="text" name="txtUsuario">                                
                            </div>
                            
                            <div class="caixa_login_text">
                                <input type="password" name="txtSenha">                           
                            </div>                            
                        </div>
                        
                        <div class="caixa_botao">
                            <input type="submit" name="btnEntrar"  class="btnEntrar"  value="Entrar">    
                        </div>
                      
                    </div>   
                    
                </div>
                
                
            </div>
            
            
        </header>

        
        <div class="caixa_global">
            <div id="caixa_especial"></div>
            
            <div class="caixa_principal_promocoes">
                <div class="caixa_promocoes_titulo">
                    <h1>Aproveite nossas promoções!</h1>
                </div>
                
                <div class="caixa_promocoes_principal">
                    <div class="caixa_promocoes_principal_imagem">
                        <img src="<?php echo($imgPromocao)?>">
                        
                    </div>
                            <div class="caixa_promocoes_principal_detalhes">
                                <div class="caixa_promocoes_principal_detalhes_nome">
                                    <p><?php echo($tituloPromocao)?></p>
                                </div>
                                
                                <div class="caixa_promocoes_principal_detalhes_descricao">
                                    <p><?php echo($descPromocao)?> </p>
                                </div>
                                
                                <div class="caixa_promocao_detalhes_preco_antigo">
                                    <p>R$<?php echo($precoAntigo)?></p>
                                </div>
                                
                                <div class="caixa_promocao_detalhes_preco_atual">
                                    <p>R$<?php echo($precoAtual)?></p>
                                </div>                                
                                
                            </div>                    
                </div>
                
                <div class="caixa_promocoes_section1">

                    
                    <?php
                        $sql = "select * from tbl_produto as p, tbl_preco_produto as pp where p.status = 1 and pp.promocao = 1 and p.idProduto = pp.idProduto";
                        $select = mysqli_query($conexao, $sql);
                    
                        //var_dump($sql);
                        
                        while($rsConsulta = mysqli_fetch_array($select)){
                    ?>
                    <div class="caixa_promocoes_produto">
                        <a href="promocoes.php?id=<?php echo($rsConsulta['idProduto'])?>" class="verPromocao">
                            <div class="caixa_promocoes_seg_imagem">
                                <div class="caixa_promocoes_imagem">
                                    <img src="<?php echo($rsConsulta['foto'])?>">
                                </div>

                            </div>
                        </a>
                        
                     


                    </div>
                    
                    <?php
                        }
                    ?>
                    


                </div>
                

            </div>
            
            
            <div class="caixa_anuncio">
                <div class="anuncio">
                    <img src="imagens/facebook.png" alt="facebook">
                </div>
                
                <div class="anuncio">
                    <img src="imagens/linkedin.png" alt="linkedin">
                </div>
                
                <div class="anuncio">
                    <img src="imagens/twitter.png" alt="twitter">
                </div>                
                                
            </div>               
            
            
        </div>        
        
        <footer>
            <div id="caixa_footer">
                <div class="caixa_footer_central">
                    <div class="caixa_footer_cima">
                        <p>Copyrights© 2018. Todos os direitos reservados.</p> 
                        
                    </div>
                    
                    <div class="caixa_footer_baixo">
                          <p>Bugs Bunny S/A. Avenidas das Rosas, 1789, 11° andar, São Paulo - SP.</p>
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="js/slider.js"></script>
    </body>
</html>    