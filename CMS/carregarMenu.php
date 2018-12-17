<?php


    
    function carregarMenu($idNivel) {
        include_once("../conexao.php");

        $conexao = getConexao();  
        
        
        $sql = "select om.nomeOptMenu, om.icone, om.href  from tbl_opt_menu_nivel as omn join tbl_opt_menu as om on omn.idOptMenu = om.idOptMenu join tbl_niveis as n on omn.idNivel = n.id where n.id = ".$idNivel;
        
         var_dump($sql);
        
        $selectMenu = mysqli_query($conexao, $sql);
    
        
        
        
        
        $cont = 0;
        
        $arrayMenu = array();
        
        while($rsMenu = mysqli_fetch_array($selectMenu)){
            $href  = $rsMenu['href'];
            $icone  = $rsMenu['icone'];
            $nomeOptMenu  = $rsMenu['nomeOptMenu'];
            
            $arrayMenu[$cont] = '
            
            <div class="caixa_menu_adm">
                <a href="'.$href.'">                        
                    <div class="caixa_menu_adm_img">
                        <img src="'.$icone.'">
                    </div>

                    <div class="caixa_menu_adm_titulo">
                        <p>'.$nomeOptMenu.'</p>
                    </div>                        
                </a>

            </div>

            ';

            $cont++;

        }


        
        
        
        
        return $arrayMenu;
        
        
    }
    
    
    
    

?>