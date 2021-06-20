<?php
session_start();

if($_POST['tipo']=="tipo"){                 //busqueda por tipo de usuario

    $_SESSION['valor'] = $_POST['tipo2'];

}else if($_POST['tipo']=="estado"){         //busqueda por estado de usuarios

    $_SESSION['valor'] = $_POST['estado'];

}else{                                      //busqueda valor

    $_SESSION['valor'] = $_POST['busqueda'];

}

$_SESSION['opcion'] = $_POST['tipo'];

header('Location: adminUsuarios.php');

?>