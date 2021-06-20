<?php
    include_once ("../database/crudUsuarios.php");
    if (isset($_GET["id"])){                                //Se obtiene la id del usuario a cambiar estado
        $usuario = buscarUsuario($_GET["id"],"idUsuario");  //Se busca su informacion
        $estado = $usuario->fetch_assoc();

        if($estado['estado']=="habilitado"){                //Si esta habilitado de deshabilita
            deshabilitarUsuario($_GET["id"]);
        }else{
            habilitarUsuario($_GET["id"]);                  //Si esta deshabilitado de habilita
        }
        $_SESSION['opcion']="usuario";                      //Se cambia la busqueda a usuario
        $_SESSION['valor']=$estado['usuario'];              //Se cambia el valor de la secion al estao del usuario
    }
    header("Location:adminUsuarios.php");                   //Se redirecciona al apartado de los administradores de ususarios
?>