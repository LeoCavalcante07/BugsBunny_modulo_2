<?php




    function logar($usuario, $senha){
        $noUser = "";

        include_once("conexao.php");

        $conexao = getConexao();        
        
        $sql = "select * from tbl_usuarios where status = 1 and email = '".$usuario."' and senha = '".$senha."'";
        
        //var_dump($sql);
        
        $select = mysqli_query($conexao, $sql);
        
        $rsConsulta = mysqli_fetch_array($select);
        
        if(@count($rsConsulta) > 0){
            $_SESSION['idUsuario'] = $rsConsulta['id'];
            
            header("location:CMS/index.php");
        }else{
            //echo("<script> alert('Usuário ou senha incorreta') </script>");
            $noUser  = "Usuário ou senha incorreto";
            
            return $noUser;
        }        
        
    }

?>