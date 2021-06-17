<?php
    include_once ("../database/crudUsuarios.php");
    if (isset($_GET["id"])){
        $usuario = buscarUsuario($_GET["id"],"idUsuario");
        $estado = $usuario->fetch_assoc();

        if($estado['estado']=="habilitado"){
            deshabilitarUsuario($_GET["id"]);
        }else{
            habilitarUsuario($_GET["id"]);
        }
        $_SESSION['opcion']="usuario";
        $_SESSION['valor']=$estado['usuario'];
    }
    header("Location:adminUsuarios.php");
?>