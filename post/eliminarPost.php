<?php
    include_once ("../database/crudPost.php");
    if (isset($_GET["id"])){
        borrarPost($_GET["id"]);
        $_SESSION['si'] = 'si';
    }
    header("Location:adminPost.php");
?>