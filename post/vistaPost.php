<?php
include_once ("../database/crudPost.php");
include_once ("../database/crudComentarios.php");

date_default_timezone_set('America/El_Salvador'); //Seteo de el horario local

if (isset($_GET["id"])){                //id del post
    $id = $_GET["id"];                  
    $datos = buscarPost($id,"idPost");  //Se busca el post especifico
    $row = $datos->fetch_assoc();       //Se extrauen sus datos

    $comentarios = buscarComentarios($id,"idPost","aprobado","estadoC");//Se buscan los comentarios

    if (isset($_POST['comentario']) && $_POST['comentario'] != ""){//Si hay un comentario no vacio
        echo (date("Y-m-d H:i:s"));//Se Marca la fecha
        echo ("si");
        insertarComentario(date("Y-m-d H:i:s"),$id,$_SESSION['id'],$_POST['comentario'],"esperando");//Se crea la sollicitud para comentario
        $_SESSION['message'] = "Comentario registrado";
        $_SESSION['message_type'] = "success";
    }

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
            include_once ('../navBars/viewerNavbar.php');   
        }elseif($_SESSION['type']=="admin"){                //Si el usuario es un administrador
            include_once ('../navBars/adminNavbar.php');
        }else{                                          //si no tiene un rol definido
            header('Location: ../login/login.php');
        }
    ?>
    <div class="d-flex justify-content-center">
        <div class="d-flex flex-column">
            <div class="row justify-content-center mt-4">
            
                <div class="col-6">

                    <!-- Carta que muestra el post-->
                    <div class="card mb-3 px-2">
                        <h3 class="card-title text-center m-4"><?=$row['titulo']?></h3>
                        <img src="../img/<?=$row['imagen'];?>" class="card-img-top ">
                        <div class="card-body">
                            <p class="card-text p-4"><?=$row['texto']?></p>
                            <p class="card-text"><small class="text-muted">Autor: <?=$row['usuario']?></small></p>
                            <p class="card-text"><small class="text-muted">Creado: <?=$row['fecha']?></small></p>
                            <p class="card-text"><small class="text-muted">NÃºmero: <?=$row['idPost']?></small></p>
                        </div>
                            
                    </div>
                
                </div>
            
            </div>
            
            
            <?php if($_SESSION['state']=="habilitado"){ //Si no esta habilitado el usuario no puede comentar?>
            <div class="row justify-content-center mt-2">
            
                <div class="col-6 align-self-center">

                    <?php if (isset($_SESSION['message'])) { //MEnsaje de alerta?>
                        <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                            <strong><?=$_SESSION['message']?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['message']);
                        unset($_SESSION['message_type']);
                    }?>

                    <form action="vistaPost.php?id=<?=$id?>" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="comentario" placeholder="Agregar comentario" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Comentar</button>
                        </div>
                    
                    </form>            

                </div>
            </div>
            <?php } ?>
            <div class="row justify-content-center my-4 ">
                <div class="col-6 align-self-center">
                
                <?php
                while ($row = $comentarios->fetch_assoc()){//Se cargan los comentarios
                ?>
                    <div class="card m-1">
                        <div class="card-header">
                            <?=$row['usuario']?>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p><?=$row['texto']?></p>
                            <footer class="blockquote-footer"><?=$row['fechaC']?></footer>
                            </blockquote>
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
}
?>