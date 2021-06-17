<?php 
include_once ("../database/crudPost.php");
date_default_timezone_set('America/El_Salvador');
$fecha = date("Y-m-d H:i:s");

$row;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $datos =buscarPostActualizar($_GET['id']);
    $row = $datos->fetch_assoc();
}

if(isset($_POST['titulo'])){
    if(isset($_POST['titulo'])){
        $imagen = $_FILES['imagen']['name'];
    
        if(isset($imagen) && $imagen != ""){
            $tipo = $_FILES['imagen']['type'];
            $temp = $_FILES['imagen']['tmp_name'];
            
            if(!(strpos($tipo,'png') || !strpos($tipo,'jpg'))){
                $_SESSION['message'] = "La imagen debe ser jpg o png";
                $_SESSION['message_type'] = "warning";
            }else{
                editarPost($_POST['fecha'],$_SESSION['id'],$_POST['titulo'],$imagen,$_POST['texto'],$_GET['id']);
                move_uploaded_file($temp,'../img/'.$imagen);
                header("Location:editarPost.php?id=$id");
            }
        }else{
            editarPostSIMG($_POST['fecha'],$_SESSION['id'],$_POST['titulo'],$_POST['texto'],$_GET['id']);
            header("Location:editarPost.php?id=$id");
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
    <title>Actualizar post</title>
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
    <div class="d-flex justify-content-center mt-4">

        <div class="col-md-4">

        <?php if (isset($_SESSION['si'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Post actualizado</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php 
            unset($_SESSION['si']);
            }

            ?>

            <form action="editarPost.php?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
                <div>
                    <label class="form-label">Fecha</label>
                    <input type="datetime" class="form-control" name="fecha" id="" value="<?=$fecha?>" readonly>
                </div>
                <div>
                    <label class="form-label">Titulo</label>
                    <input type="text" name="titulo" id="" class="form-control" value="<?=$row['titulo']?>">
                </div>
                <div>
                    <label class="form-label">Imagen</label>
                    <input type="file" name="imagen" id="" class="form-control">
                </div>
                <div>
                    <label for="">Texto</label>
                    <textarea name="texto" id="" cols="30" rows="10" class="form-control" ><?=$row['texto']?></textarea>
                </div>
                <input type="submit" value="Actualizar" class="btn btn-secondary mt-2">
            </form>

        </div>

    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>