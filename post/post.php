<?php
include_once ("../database/crudPost.php");
$datos;

if(isset($_POST["titulo"])){
    if($_POST["titulo"]!=""){
        $datos = buscarPost($_POST["titulo"],"titulo");
        if($datos->num_rows==0){
            $datos = mostrarPosts();
        }
    }else{
        $datos = mostrarPosts();
    }
    
}else{
    $datos = mostrarPosts();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Listado de post</title>
</head>
<body>
    <?php
        if(!isset($_COOKIE['session_id'])){             //Si no se tiene un token de logeo
            header('Location: ../login/login.php');
        }elseif($_SESSION['type']=="viewer"){         //Si el usuario es un viewer
            include_once ('../navBars/viewerNavbar.php');   
        }elseif($_SESSION['type']=="admin"){                //Si el usuario es un administrador
            include_once ('../navBars/adminNavbar.php');
        }else{                                          //si no tiene un rol definido
            header('Location: ../login/login.php');
        }
    ?>
    <div class="d-flex justify-content-center" style="width:98%">
        <div class="d-flex flex-column">

            <div class="row justify-content-center mt-3">
                <div class="col-md-4 align-self-center">
                    <form action="post.php" method="post">
         
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="titulo" placeholder="Buscar post" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                        </div>
       
                    </form>
                </div>
            
            </div>

            <div class="row justify-content-center mt-2">
                <div class="col-md-4 align-self-center">
                    <?php
                    while ($row = $datos->fetch_assoc()){
                    ?>
                    <a href="vistaPost.php?id=<?= $row['idPost']?>" style="text-decoration: none" class="btn btn-outline-info m-2">
                        <div class="row bg-transparent">
                    
                            <div class="card mb-3 bg-transparent">
                                <img src="../img/<?=$row['imagen'];?>" class="card-img-top bg-transparent">
                                <div class="card-body">
                                    <h5 class="card-title bg-transparent"><?=$row['titulo']?></h5>
                                    <p class="card-text bg-transparent"><small class="text-muted">Autor: <?=$row['usuario']?></small></p>
                                    <p class="card-text bg-transparent"><small class="text-muted">Creado: <?=$row['fecha']?></small></p>
                                    <p class="card-text bg-transparent"><small class="text-muted">Número: <?=$row['idPost']?></small></p>
                                </div>
                                
                            </div>
                            
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>