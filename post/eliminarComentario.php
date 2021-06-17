<?php
    include_once ("../database/crudComentarios.php");
    if (isset($_GET["id"])){
        $idP=$_SESSION['idP'];
        borrarComentario($_GET["id"]);
        $_SESSION['message'] = 'Comentario eliminado';
        $_SESSION['message_type'] = 'danger';
        unset($_SESSION['idP']);
    }
    header("Location:verComentarios.php?id=$idP");
?>