<?php

    require_once('../conexao.php');

    $conexao = getConexao();

    
    

?>


<!doctype html>
<html>
    <header>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script>
//            $(document).ready(function(){
//               $('#imagem').click(function(){
//                 $('#fleFoto1').trigger('click');
//                   $('#fleFoto1').live('change', function(){
//                       
//                   });
//               });
//            });
            
            function clickImagem(idObjImg, idObjFile, indice){
                var form = '.frmCadastro'+indice;
                var td = 'td'+indice;
                var filefoto = '#fleFoto'+indice
              
                $(document).ready(function(){
                   
                     $(filefoto).trigger('click');
                    
                        $(filefoto).live('change', function(){
                  
                   
                            $(form).ajaxForm({                        
                                target:'#visualizar'

                            }).submit();                    
                   
                        });
                   });
                               
                
            }
        </script>
    </header>
    
    <body>
        
        
        <div class="seg_table_sobre">
            <table width="500px" height="300px" border="1px">
                
                <?php
                    $sql = "select * from tbl_destaque";
                    $select = mysqli_query($conexao, $sql);
                    
                    $i = 0; // variavel que sera concatenada com o id de cada objeto FILE para diferencia-los
                    while($rsDestaque = mysqli_fetch_array($select)){
                ?>
                <form name="frmCadastro<?php echo($i)?>" class="frmCadastro<?php echo($i)?>" action="upload.php" method="post" enctype="multipart/form-data">
                    <tr height="50px">
                        <td colspan="2">
    <!--                        titulo-->
                            <?php echo($rsDestaque['titulo'])?>
                        </td>


                    </tr>

                    <tr height="200px">
                        <td class="td<?php echo($i)?>">
    <!--                        imagem-->
                            <img id="imagem<?php echo($i)?>" src="<?php echo($rsDestaque['foto'])?>"  onclick="clickImagem(imagem<?php echo($i)?>, fleFoto<?php echo($i)?>, <?php echo($i)?>)">
                            <input type="text" name="txtNomeFoto" value="">
                            <input type="file" name="flefoto<?php echo($i)?>" id="fleFoto<?php echo($i)?>" >
                        </td>

                        <td>
                            <textarea>
                                <?php echo($rsDestaque['texto'])?>
                            </textarea>

                        </td>                    
                    </tr>
                    <tr height="50px" align="center">
                        <td colspan="2">
                            <img src="imagens/delete.png">
                            <img src="imagens/edit.png">
                            <img src="imagens/ativado.png">
                        </td>
                    </tr>
                </form>
                
                <?php
                        $i++;
                    }
                
                ?>
            </table>
            
            <div id="visualizar" style="width:300px;height:300px;background-color:orange;">
                
            </div>
            
        </div>        
    </body>
</html>