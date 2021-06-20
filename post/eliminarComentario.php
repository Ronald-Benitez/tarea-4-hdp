<?php
    include_once ("../database/crudComentarios.php");
    if (isset($_GET["id"])){                            //si se trae una id a eliminar
        $idP=$_SESSION['idP'];                          //SE extrae la id del post
        borrarComentario($_GET["id"]);                  //Se borra el comentario por id
        $_SESSION['message'] = 'Comentario eliminado';  
        $_SESSION['message_type'] = 'danger';
        unset($_SESSION['idP']);                        //Se quita la sesion de id del post
    }
    header("Location:verComentarios.php?id=$idP");      //Redireccion a la vista de los comentarios
?>