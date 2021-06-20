<?php 
include_once ("../database/crudPost.php");
date_default_timezone_set('America/El_Salvador'); //Seteo de el horario local
$fecha = date("Y-m-d H:i:s");                       //Setio de la fehca y hora actual

if(isset($_POST['titulo'])){//Si se trae un titulo 
    $imagen = $_FILES['imagen']['name']; //Se trae la imagen nueva 

    if(isset($imagen) && $imagen != ""){ //Mientras la imagen no este vacia
        $tipo = $_FILES['imagen']['type'];      //Se crea la imagen
        $temp = $_FILES['imagen']['tmp_name'];  //Direccion de la imagen

        if(!strpos($tipo,'png') && !strpos($tipo,'jpg')){//Acciones de formato incorrecto
            echo ($tipo);
            $_SESSION['message'] = "La imagen debe ser jpg o png";
            $_SESSION['message_type'] = "warning";
        }else{//Si estan bien sus datos
            insertarPost($_POST['fecha'],$_SESSION['id'],$_POST['titulo'],$imagen,$_POST['texto']);//Se inserta la imagen
            move_uploaded_file($temp,'../img/'.$imagen);//Se crea la imagen en la carpeta de imagenes
            header("Location:registroPost.php?si=si");//Se Manda la alerta de la insercion
        }
    }
}
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Registro post</title>
</head>
<body>
    <?php
        /*SESIONSES DISPONIBLES*/ 
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
    <div class="d-flex justify-content-center mt-4">

        <div class="col-md-4">

            <?php if (isset($_GET['si'])) { //Mensaje de post registrado?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Post registrado</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php 
            }
            if(isset($_SESSION['message'])){//Mensaje de warning por error de formato deimagen?>
                <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                    <strong><?=$_SESSION['message']?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } 
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            ?>

            <form action="registroPost.php" method="post" enctype="multipart/form-data">
                <div>
                    <label class="form-label">Fecha</label>
                    <input type="datetime" class="form-control entrada" name="fecha" id="Fecha" value="<?=$fecha?>" readonly>
                </div>
                <div>
                    <label class="form-label">Titulo</label>
                    <input type="text" name="titulo" id="Titulo" class="form-control entrada">
                </div>
                <div>
                    <label class="form-label">Imagen</label>
                    <input type="file" name="imagen" id="Imagén" class="form-control entrada">
                </div>
                <div>
                    <label for="">Texto</label>
                    <textarea name="texto" id="Texto" cols="30" rows="10" class="form-control entrada"></textarea>
                </div>
                <input type="submit" class="btn btn-primary mt-2" value="Guardar ">
                <div id="alerta" class="mt-2"></div>
            </form>

        </div>

    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="funcionesRPost.js"></script>
</body>
</html>