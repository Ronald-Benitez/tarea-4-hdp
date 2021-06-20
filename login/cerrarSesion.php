<?php //PROCESO DE CIERRE DE SESION
//Se quitan los valores de la sesion
unset($_SESSION['id']);
unset($_SESSION['user']); 
unset($_SESSION['type']);
session_destroy();                                              //Destruccion de la sesion
setcookie('session_id','562tfydwhsbdj2iqdwkn',time()+-1,'/');   //Destruccion de la cookie
header('Location: ../index.php');                         //Redireccion al login
?>