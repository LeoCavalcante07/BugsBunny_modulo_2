<?php


    if(isset($_POST)){
        
       
        
                          
        $arquivo = $_FILES['fleBanner']['name'];
        //var_dump($arquivo);
        $ext_arquivo = strrchr($arquivo, ".");
        $nome_arquivo = pathinfo($arquivo, PATHINFO_FILENAME);
        $nome_arquivo = md5(uniqid(time()).$nome_arquivo);
        $diretorio_arquivo = "arquivos/";
        $arquivos_permitidos = array(".jpg", ".png", ".jpeg");
        
        
        
        if(in_array($ext_arquivo, $arquivos_permitidos)){
            
            
            
            $arquivo_tmp = $_FILES['fleBanner']['tmp_name'];
            $foto = $diretorio_arquivo . $nome_arquivo . $ext_arquivo;
            
            // faz o ctl+c ctrl+v do arquivo para a pasta de arquivos
            if(move_uploaded_file($arquivo_tmp, $foto)){
                
                
                echo("
                
                    <img src='".$foto."'>
                
                ");
                //echo($foto);

                //Coloca na caixa de texto da foto no formulario de cadastro, o nome da imagem que vai pro banco
                echo("
                        <script>
                            frmCadastro.txtNomeBanner.value = '".$foto."';
                        </script>
                ");                
                
            }
            
        }
        
    }




?>