<?php 
include_once ("conexion.php");



function mostrarPosts(){
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

function tituloPost($idPost){
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

function mostrarPostsSIMG(){
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

function insertarPost($fecha,$idUsuario,$titulo,$imagen,$texto){
    try {
        $con=connect();
        $sql = "INSERT INTO post(fecha,idUsuario,titulo,imagen,texto) VALUES('$fecha',$idUsuario,'$titulo','$imagen','$texto')";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
     
}

function editarPost($fecha,$idUsuario,$titulo,$imagen,$texto,$idPost){
    try {
        $con=connect();
        $sql = "UPDATE post SET fecha='$fecha', idUsuario='$idUsuario', titulo='$titulo', imagen='$imagen', texto='$texto' WHERE idPost='$idPost'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function editarPostSIMG($fecha,$idUsuario,$titulo,$texto,$idPost){
    try {
        $con=connect();
        $sql = "UPDATE post SET fecha='$fecha', idUsuario='$idUsuario', titulo='$titulo', texto='$texto' WHERE idPost='$idPost'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function borrarPost($idPost){
    try {
        $con=connect();
        $sql = "DELETE FROM post WHERE idPost=$idPost";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function buscarPost($valor,$opcion){
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

function buscarPostSIMG($valor,$opcion){
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

function buscarPostActualizar($valor){
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