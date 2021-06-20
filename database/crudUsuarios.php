<?php 
include_once ("conexion.php");



function mostrarUsuarios(){//Funcion para traer los datos de un los usuarios
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

function ingresarUsuarios($usuario,$correo,$contrasena,$tipo){//funcion apra agregar un nuevo usuario a la base de datos
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "INSERT INTO usuarios(usuario,correo,contrasena,tipo,estado) VALUES('$usuario','$correo','$contrasena','$tipo','habilitado')";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
     
}

function habilitarUsuario($idUsuario){//Funcion para cambiar el estado de un usuario a habilitado
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "UPDATE usuarios SET estado='habilitado' WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function deshabilitarUsuario($idUsuario){//funcion para deshabilitar las aaciones de un usuario
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "UPDATE usuarios SET estado='deshabilitado' WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function borrarUsuario($idUsuario){//funcion para eliminar un usuario
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "DELETE FROM usuarios WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function buscarUsuario($valor,$opcion){ //funcion para buscar los datos de un usuario
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

function actualizarUsuarioSNC($usuario,$correo,$tipo,$estado,$idUsuario){//funcion para actulizar los datos de un usuario sin la contraseña
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "UPDATE usuarios SET usuario='$usuario',correo='$correo',tipo='$tipo',estado='$estado' WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}

function actualizarUsuarioCC($usuario,$correo,$tipo,$estado,$contrasena,$idUsuario){//funcion para actulizar los datos de un usuario con su contraseña
    try {
        //Conección y ejecución del query
        $con=connect();
        $sql = "UPDATE usuarios SET usuario='$usuario',correo='$correo',tipo='$tipo',estado='$estado',contrasena='$contrasena' WHERE idUsuario='$idUsuario'";
        $resultado=mysqli_query($con,$sql);
        $con=null;
    } catch (Exception $e) {
        die(e->getMessage());
    }
}
?>