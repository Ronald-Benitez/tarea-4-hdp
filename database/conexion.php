<?php
session_start();

function connect(){

    $conn = mysqli_connect(
        'bc6czfoxtrluyaagzqw2-mysql.services.clever-cloud.com',
        'uyktohqypvfglgwp',
        '104NwIEkmDGEmYaDAjjz',
        'bc6czfoxtrluyaagzqw2'
      ) or die(mysqli_erro($mysqli));
    return $conn;
}

?>