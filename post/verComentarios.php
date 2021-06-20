<?php
include_once ("../database/crudPost.php");
include_once ("../database/crudComentarios.php");

date_default_timezone_set('America/El_Salvador'); //Seteo de el horario local

if (isset($_GET["id"])){                                    //si hay un post especifico
    $id = $_GET["id"];                                      //Se obtiene su id
    $comentarios = buscarComentariosGeneral($id,"idPost");  //Se busca el comentario
    $titulo = tituloPost($_GET["id"])->fetch_assoc();       //Se extrae el comentario
    $_SESSION['idP']=$id;                                   //Se crea la secion del id del post
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Vista de post</title>
</head>
<body style="width:99%">
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
    <div class="d-flex justify-content-center">
        <div class="d-flex flex-column">

            <div class="row justify-content-center my-4 ">
                <div class="col align-self-center">
                <h4 class="m-4">Comentarios del post: <?=$titulo['titulo']?></h4>

                <?php if (isset($_SESSION['message'])) { //Mensaje de error?>
                <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                    <strong><?=$_SESSION['message']?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                }

                ?>
                <?php
                while ($row = $comentarios->fetch_assoc()){//Se Extraen todoslos daotos de comentario
                    if($row['estadoC'] != "aprobado"){
                            echo "<div class='card m-2 border-warning'>";
                        }else{
                            $idC = $row['idComentario'];
                            echo "<div class='card m-2 border-success'>";
                    }
                ?>
                        <h5 class="card-header"><?=$row['usuario']?></h5>
                        <div class="card-body">
                            <div class="col">
                                <p class="card-text"><?=$row['texto']?></p>
                                <div class="text-secondary"><?=$row['fechaC']?></div>
                            </div>
                            <div class="row">
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <a href="eliminarComentario.php?id=<?=$row['idComentario']?>" class="btn btn-danger">Eliminar</a>
                                    <?php
                                        //MOSTAR SOLO COMENTARIO APROBADOS
                                        if($row['estadoC'] != "aprobado"){
                                            $idC = $row['idComentario'];
                                            echo "<a href='aprobarComentario.php?id=$idC' class='btn btn-success'>Aprobar</a>";
                                        }else{
                                            $idC = $row['idComentario'];
                                            echo "<a href='rechazarComentario.php?id=$idC' class='btn btn-warning'>Rechazar</a>";
                                        }
                                    ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>              


                <?php } ?>
                </div>
            
            </div>

        </div>
        

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>

<?php
}else{
    header("Location:adminPost.php");
}
?>