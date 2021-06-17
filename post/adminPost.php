<?php
include_once ("../database/crudPost.php");
$datos;

if(isset($_POST["titulo"])){
    if($_POST["titulo"]!=""){
        $datos = buscarPostSIMG($_POST["titulo"],"titulo");
        if($datos->num_rows==0){
            $datos = mostrarPostsSIMG();
        }
    }else{
        $datos = mostrarPostsSIMG();
    }
    
}else{
    $datos = mostrarPostsSIMG();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Administración de post</title>
</head>
<body>
    <?php
        if(!isset($_COOKIE['session_id'])){             //Si no se tiene un token de logeo
            header('Location: ../login/login.php');
        }elseif($_SESSION['type']=="viewer"){         //Si el usuario es un viewer
            header('Location: ../post/post.php');
        }elseif($_SESSION['type']=="admin"){                //Si el usuario es un administrador
            include_once ('../navBars/adminNavbar.php');
        }else{                                          //si no tiene un rol definido
            header('Location: ../login/login.php');
        }
    ?>
    <center>
        <div class="d-flex justify-content-center m-4" style="width:80%">
                
            <div class="d-flex flex-column">
            
                <div class="row justify-content-center mt-3">
                    <div class="col align-self-center">
                        <form action="adminPost.php" method="post">
            
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="titulo" placeholder="Buscar post" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                            </div>
        
                        </form>
                    </div>
                
                </div>

                <div class="row justify-content-center mt-3">
                    <div class="col align-self-center">
                    <?php if (isset($_SESSION['si'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Post eliminado</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                    unset($_SESSION['si']);
                    }

                ?>
                    </div>
                </div>
                
                <?php if(isset($_POST["titulo"])){ ?>
                    <div class="row">
                <?php }else{ ?>
                    <div class="row row-cols-3 row-cols-md- 2g-4">
                <?php
                }
                while ($row = $datos->fetch_assoc()){
                ?>
                    <div class="col">
                        
                        <div class="card">
                            <div class="card-header">
                                <?=$row['usuario']?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?=$row['titulo']?></h5>
                                <p class="card-text">Creado: <?=$row['fecha']?></p>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <a href="editarPost.php?id=<?=$row['idPost']?>" class="btn btn-outline-secondary">Editar</a>
                                    <a href="eliminarPost.php?id=<?=$row['idPost']?>" class="btn btn-outline-secondary">Eliminar</a>
                                    <a href="verComentarios.php?id=<?=$row['idPost']?>" class="btn btn-outline-secondary">Comentarios</a>
                                </div>
                            </div>
                        </div>
                                
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>