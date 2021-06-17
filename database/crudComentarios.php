<?php 
include_once ("conexion.php");


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
function insertarComentario($fecha,$idPost,$idUsuario,$texto,$estado){
    try {
        $con=connect();
        $sql = "INSERT INTO comentarios(fechaC,idPost,idUsuario,texto,estadoC) VALUES('$fecha',$idPost,$idUsuario,'$texto','$estado')";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
     
}

function rechazarComentario($idComentario){
    try {
        $con=connect();
        $sql = "UPDATE comentarios SET estadoC='esperando' WHERE idComentario='$idComentario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function aprobarComentario($idComentario){
    try {
        $con=connect();
        $sql = "UPDATE comentarios SET estadoC='aprobado' WHERE idComentario='$idComentario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function borrarComentario($idComentario){
    try {
        $con=connect();
        $sql = "DELETE FROM comentarios WHERE idComentario='$idComentario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function buscarComentarios($valor1,$opcion1,$valor2,$opcion2){
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

function buscarComentariosGeneral($valor1,$opcion1){
    try {
        //Conección y ejecución del query
        $sql = "SELECT * FROM comentarios INNER JOIN usuarios ON comentarios.idUsuario=usuarios.idUsuario WHERE comentarios.$opcion1='$valor1' ORDER BY comentarios.fechaC DESC";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}
?>