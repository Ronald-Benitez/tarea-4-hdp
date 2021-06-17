<?php
    include_once ("../database/crudUsuarios.php");
    if (isset($_GET["id"])){
        $idP=$_SESSION['idP'];
        borrarUsuario($_GET["id"]);
        $_SESSION['message'] = 'Usuario eliminado';
        $_SESSION['message_type'] = 'danger';
    }
    header("Location:adminUsuarios.php");
?>