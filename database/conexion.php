<?php
session_start();

function connect(){

    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'blog'
      ) or die(mysqli_erro($mysqli));
    return $conn;
}

?>