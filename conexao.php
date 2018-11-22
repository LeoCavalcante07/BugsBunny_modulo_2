 <?php





    function getConexao(){
        
        $host = "localhost";
        $user = "root";
        $password = "bcd127";
        $banco = "db_bugs_bunny";        
        
        if(!$conexao = mysqli_connect($host, $user, $password, $banco)){
            echo("<script>alert('Houve um erro na conexão com o banco')</script>");
        }   
        
        return $conexao;        
    }




?>