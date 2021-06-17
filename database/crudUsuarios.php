<?php 
include_once ("conexion.php");



function mostrarUsuarios(){
    try {
        //Conección y ejecución del query
        $sql = "SELECT * FROM usuarios";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
    
}

function ingresarUsuarios($usuario,$correo,$contrasena,$tipo){
    try {
        $con=connect();
        $sql = "INSERT INTO usuarios(usuario,correo,contrasena,tipo,estado) VALUES('$usuario','$correo','$contrasena','$tipo','habilitado')";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
     
}

function habilitarUsuario($idUsuario){
    try {
        $con=connect();
        $sql = "UPDATE usuarios SET estado='habilitado' WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function deshabilitarUsuario($idUsuario){
    try {
        $con=connect();
        $sql = "UPDATE usuarios SET estado='deshabilitado' WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function borrarUsuario($idUsuario){
    try {
        $con=connect();
        $sql = "DELETE FROM usuarios WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function buscarUsuario($valor,$opcion){
    try {
        //Conección y ejecución del query
        $sql = "SELECT * FROM usuarios WHERE $opcion='$valor'";
        $con=connect();
        $resultado=mysqli_query($con,$sql);
        $con=null;
        return $resultado;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function actualizarUsuarioSNC($usuario,$correo,$tipo,$estado,$idUsuario){
    try {
        $con=connect();
        $sql = "UPDATE usuarios SET usuario='$usuario',correo='$correo',tipo='$tipo',estado='$estado' WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function actualizarUsuarioCC($usuario,$correo,$tipo,$estado,$contrasena,$idUsuario){
    try {
        $con=connect();
        $sql = "UPDATE usuarios SET usuario='$usuario',correo='$correo',tipo='$tipo',estado='$estado',contrasena='$contrasena' WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}
?>