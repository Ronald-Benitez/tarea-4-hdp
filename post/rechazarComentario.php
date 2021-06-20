<?php
    include_once ("../database/crudComentarios.php");
    if (isset($_GET["id"])){                                //Si hay un id para rechazar comentario
        $idP=$_SESSION['idP'];                              //Se extrae la id del post
        rechazarComentario($_GET["id"]);                    //Se rechaza el comentario en la base
        $_SESSION['message'] = 'Comentario rechazado';      
        $_SESSION['message_type'] = 'warning';
        unset($_SESSION['idP']);                            //Se quita la sesion del id del post
    }
    header("Location:verComentarios.php?id=$idP");          //Se regresa al apartadod e ver comentarios
?>