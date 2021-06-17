<?php
session_start();

if($_POST['tipo']=="tipo"){

    $_SESSION['valor'] = $_POST['tipo2'];

}else if($_POST['tipo']=="estado"){

    $_SESSION['valor'] = $_POST['estado'];

}else{

    $_SESSION['valor'] = $_POST['busqueda'];

}

$_SESSION['opcion'] = $_POST['tipo'];

header('Location: adminUsuarios.php');

?>