<?php

    session_start();

    $_SESSION['idProduto'] = $_GET['idProduto'];

    header("location:admPromocoes.php");

    
    


?>