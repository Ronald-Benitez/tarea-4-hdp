<?php
    include_once ("../database/crudComentarios.php");
    if (isset($_GET["id"])){
        $idP=$_SESSION['idP'];
        rechazarComentario($_GET["id"]);
        $_SESSION['message'] = 'Comentario rechazado';
        $_SESSION['message_type'] = 'warning';
        unset($_SESSION['idP']);
    }
    header("Location:verComentarios.php?id=$idP");
?>