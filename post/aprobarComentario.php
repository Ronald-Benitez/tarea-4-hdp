<?php
    include_once ("../database/crudComentarios.php");
    if (isset($_GET["id"])){
        $idP=$_SESSION['idP'];
        aprobarComentario($_GET["id"]);
        $_SESSION['message'] = 'Comentario aprobado';
        $_SESSION['message_type'] = 'success';
        unset($_SESSION['idP']);
    }
    header("Location:verComentarios.php?id=$idP");
?>