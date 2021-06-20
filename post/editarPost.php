<?php 
include_once ("../database/crudPost.php");
date_default_timezone_set('America/El_Salvador');   //Definicion de la zona horaria local
$fecha = date("Y-m-d H:i:s");                       //Fecha actual

$row; //Variable para las filas
if (isset($_GET['id'])){                        //Si existe la id en el irl
    $id = $_GET['id'];                          //Se extrae la id
    $datos =buscarPostActualizar($_GET['id']);  //Se traen los datos actulizables del post
    $row = $datos->fetch_assoc();               //Se crea el objeto de los datos traidos
}


    if(isset($_POST['titulo'])){                //Si hay un titulo a editar
        $imagen = $_FILES['imagen']['name'];    //Extrae la imagen con el nombre
    
        if(isset($imagen) && $imagen != ""){    //Si la imagen no esta vacia
            $tipo = $_FILES['imagen']['type'];  //Se extre la imagen
            $temp = $_FILES['imagen']['tmp_name']; //Se crea la imagen temporar
            
            if(!(strpos($tipo,'png') || !strpos($tipo,'jpg'))){//si no esta en un formato valido
                $_SESSION['message'] = "La imagen debe ser jpg o png";
                $_SESSION['message_type'] = "warning";
            }else{//si estan los datos correctos se edita el post
                editarPost($_POST['fecha'],$_SESSION['id'],$_POST['titulo'],$imagen,$_POST['texto'],$_GET['id']);//Se edita el post
                move_uploaded_file($temp,'../img/'.$imagen);//se cambia la direcciona a la imagen correspondiente
                header("Location:editarPost.php?id=$id");//Se regresa a la pagina
            }
        }else{
            editarPostSIMG($_POST['fecha'],$_SESSION['id'],$_POST['titulo'],$_POST['texto'],$_GET['id']);//Se editan los datos sin la imagen
            header("Location:editarPost.php?id=$id");//Se regresa a la edicion del post
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

        <?php if (isset($_SESSION['si'])) { //Busca actualiazciones de estado "si" para lanzar la alert?>
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