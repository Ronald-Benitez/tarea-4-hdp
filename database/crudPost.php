<?php 
include_once ("conexion.php");
/*
    Conexion ala base que abre la funcion connect() para
    establecer conexion a la base de datos
*/



function mostrarPosts(){//Funcion que extraer los datos para mostar los post
    try {
        //Conección y ejecución del query
        $sql = "SELECT * FROM post INNER JOIN usuarios ON post.idUsuario=usuarios.idUsuario ORDER BY fecha DESC";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
    
}

function tituloPost($idPost){//Funcion para traer de la base de datos el titulo mediante la id del post
    try {
        //Conección y ejecución del query
        $sql = "SELECT titulo FROM post WHERE idPost = '$idPost'";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function mostrarPostsSIMG(){//Funcion para extraer los datos del post sin la direccion de la imagen
    try {
        //Conección y ejecución del query
        $sql = "SELECT idPost,fecha,titulo,usuario FROM post INNER JOIN usuarios ON post.idUsuario=usuarios.idUsuario ORDER BY fecha DESC";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
    
}

function insertarPost($fecha,$idUsuario,$titulo,$imagen,$texto){//Funcion para crear y almacenar un nuevo post
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "INSERT INTO post(fecha,idUsuario,titulo,imagen,texto) VALUES('$fecha',$idUsuario,'$titulo','$imagen','$texto')";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
     
}

function editarPost($fecha,$idUsuario,$titulo,$imagen,$texto,$idPost){//Funcion para actualizar un post de la base mediante el id del post
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "UPDATE post SET fecha='$fecha', idUsuario='$idUsuario', titulo='$titulo', imagen='$imagen', texto='$texto' WHERE idPost='$idPost'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function editarPostSIMG($fecha,$idUsuario,$titulo,$texto,$idPost){//Funcion para editar los datos del pot sin la imagen
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "UPDATE post SET fecha='$fecha', idUsuario='$idUsuario', titulo='$titulo', texto='$texto' WHERE idPost='$idPost'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function borrarPost($idPost){//Funcion para borrar un post mediante el id del post
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "DELETE FROM post WHERE idPost=$idPost";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function buscarPost($valor,$opcion){//funcion para buscar lo datos de un post y su respectivo usuario  mediante un valor
    try {
        //Conección y ejecución del query
        $sql = "SELECT * FROM post INNER JOIN usuarios ON post.idUsuario=usuarios.idUsuario WHERE post.$opcion='$valor'";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function buscarPostSIMG($valor,$opcion){//Funcion para buscar un post con imagen mediante un valor determinado
    try {
        //Conección y ejecución del query
        $sql = "SELECT idPost,fecha,titulo,usuario FROM post INNER JOIN usuarios ON post.idUsuario=usuarios.idUsuario WHERE post.$opcion='$valor'";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function buscarPostActualizar($valor){//funcion para buscar el titulo y texto de un post a actualizar
    try {
        //Conección y ejecución del query
        $sql = "SELECT titulo,texto FROM post WHERE idPost=$valor";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}
?>