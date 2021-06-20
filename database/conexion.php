<?php
session_start();//inicio de session 

function connect(){//funcion de conexion  la base de datos

    $conn = mysqli_connect(
        'bc6czfoxtrluyaagzqw2-mysql.services.clever-cloud.com',//Direccion de la base
        'uyktohqypvfglgwp',                                    //Usuario de la base
        '104NwIEkmDGEmYaDAjjz',                                //Contraseña
        'bc6czfoxtrluyaagzqw2'                                 //Nombre de la base
      ) or die(mysqli_erro($mysqli));                          //Error al conectar
    return $conn;
}

?>