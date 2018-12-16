<?php


    
    function carregarMenu($idNivel) {
        include_once("../conexao.php");

        $conexao = getConexao();  
        
        
        $sql = "select om.nomeOptMenu, om.icone, om.href  from tbl_opt_menu_nivel as omn join tbl_opt_menu as om on omn.idOptMenu = om.idOptMenu join tbl_niveis as n on omn.idNivel = n.id where n.id = ".$idNivel;
        
         var_dump($sql);
        
        $selectMenu = mysqli_query($conexao, $sql);
    
        
        return $selectMenu;
        
        
    }
    
    
    
    

?>