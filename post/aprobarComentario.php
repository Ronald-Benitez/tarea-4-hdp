<?php
    include_once ("../database/crudComentarios.php");
    if (isset($_GET["id"])){                        //Se optiene la id del comentario a aprovar
        $idP=$_SESSION['idP'];                      //Se obtiene la id del post
        aprobarComentario($_GET["id"]);             //Se aprueba mediante la id
        $_SESSION['message'] = 'Comentario aprobado';
        $_SESSION['message_type'] = 'success';
        unset($_SESSION['idP']);                    //Se quita la sesesion del post
    }
    header("Location:verComentarios.php?id=$idP");  //Se redirecciona de nuevo al post
?>