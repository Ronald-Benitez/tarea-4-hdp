<?php 
include_once ("conexion.php");
/*
    Conexion ala base que abre la funcion connect() para
    establecer conexion a la base de datos
*/

/*
function mostrarPosts(){
    try {
        //Conección y ejecución del query
        $sql = "SELECT * FROM post";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
    
}
*/
function insertarComentario($fecha,$idPost,$idUsuario,$texto,$estado){//Funcion para insertar un comentario a la base
    try {
        $con=connect();//Conexion a la base
        //Query para insentar los datos del comentario a la tabla de comentarios
        $sql = "INSERT INTO comentarios(fechaC,idPost,idUsuario,texto,estadoC) VALUES('$fecha',$idPost,$idUsuario,'$texto','$estado')";
        $resultado=mysqli_query($con,$sql); //Ejecucion del Query
        $con=null;//Cerrar conexion
    } catch (Exception $e) {
        die(e->getMessage());   //Mensaje de fallo 
    }
     
}

function rechazarComentario($idComentario){//Funcion para poner en rechazaado una solicitud de comentario
    try {
        $con=connect();//Conexion a la base
        //Query para cambiar el estado del comentario el estado del comentario
        $sql = "UPDATE comentarios SET estadoC='esperando' WHERE idComentario='$idComentario'";
        $resultado=mysqli_query($con,$sql);     //Ejecucion del Query
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function aprobarComentario($idComentario){//Funcion para aprobar la solicitud de comentario
    try {
        $con=connect();
        //Query que actualiza el estado de comentario a aprobado para que se pueda visualizar
        $sql = "UPDATE comentarios SET estadoC='aprobado' WHERE idComentario='$idComentario'";
        $resultado=mysqli_query($con,$sql);     //Ejecucion del query
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function borrarComentario($idComentario){//Funcion para mandar a eliminar un comentario de la base de datos
    try {
        $con=connect();
        //Query que eliminar un comentario de la base mediante el id
        $sql = "DELETE FROM comentarios WHERE idComentario='$idComentario'";
        $resultado=mysqli_query($con,$sql);//Ejecucion del query
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}


function buscarComentarios($valor1,$opcion1,$valor2,$opcion2){//Funcion para Extrer comentario que esten habilitados para mostrar y que pertenezcan a un post
    try {
        //Conección y ejecución del query
        $sql = "SELECT * FROM comentarios INNER JOIN usuarios ON comentarios.idUsuario=usuarios.idUsuario WHERE comentarios.$opcion1='$valor1' AND comentarios.$opcion2='$valor2' ORDER BY comentarios.fechaC DESC";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function buscarComentariosGeneral($valor1,$opcion1){//Funcopn para Traer un comentario por un valor en especifico
    try {
        /*
        Conección y ejecución del query Que busca los datos del comentario y los datos 
        del usuario que lo comento mendiante un valor y dato en especifico
        */
        $sql = "SELECT * FROM comentarios INNER JOIN usuarios ON comentarios.idUsuario=usuarios.idUsuario WHERE comentarios.$opcion1='$valor1' ORDER BY comentarios.fechaC DESC";
        $con=connect();
        $resultado=mysqli_query($con,$sql);//ejecucion del query
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}
?>