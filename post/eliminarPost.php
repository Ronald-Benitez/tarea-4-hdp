<?php
    include_once ("../database/crudPost.php");
    if (isset($_GET["id"])){            //Si hay un id de comentario a eliminar
        borrarPost($_GET["id"]);        //Se elimina el comentario
        $_SESSION['si'] = 'si';         //Se confirma la eliminacion
    }
    header("Location:adminPost.php");   //Se redirigile a la apgina de post del admin
?>