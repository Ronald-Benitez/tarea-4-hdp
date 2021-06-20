<?php
    include_once ("../database/crudUsuarios.php");
    if (isset($_GET["id"])){                        //Si hay una id para editar
        $idP=$_SESSION['idP'];                      
        borrarUsuario($_GET["id"]);                 //Se elimina el usuario por la id en sesion
        $_SESSION['message'] = 'Usuario eliminado'; //Se manda el mensaje de mensaje eliminado
        $_SESSION['message_type'] = 'danger';
    }
    header("Location:adminUsuarios.php");//Se redirecciona a la eidicon de usuarios 
?>