<?php 
include_once ("../database/crudUsuarios.php");
date_default_timezone_set('America/El_Salvador');
$fecha = date("Y-m-d H:i:s");

$tipo="viewer";
$pasar = true;

if(isset($_GET['ad'])){
    $tipo=$_GET['ad'];
    $_SESSION['ad']=$tipo;
}

if(isset($_SESSION['ad'])){
    $tipo=$_SESSION['ad'];
}


if(isset($_POST['usuario'])){
    $correo = buscarUsuario($_POST['correo'],"correo");
    $cou =  mysqli_fetch_assoc($correo);
    $usuario = buscarUsuario($_POST['usuario'],"usuario");
    $usu =  mysqli_fetch_assoc($usuario);

    if(!empty($cou)){
        $_SESSION['messageC'] = 'El correo ya se encuentra registrado';
        $pasar = false;
    }

    if(!empty($usu) && !$pasar){
        $_SESSION['messageU'] = 'El usuario ya se encuentra registrado';
    }else{
        $contrasena = password_hash($_POST['contrasena'],PASSWORD_DEFAULT);
        ingresarUsuarios($_POST['usuario'],$_POST['correo'],$contrasena,$tipo);
        
        if(isset($_SESSION['ad'])){
            unset($_SESSION['ad']);
            header("Location:adminUsuarios.php?na=na");
        }else{
            header("Location:../login/login.php?na=na");
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
    <title>Registro de usuario</title>
</head>
<body>
    <?php
        if(isset($_COOKIE['session_id']) && $_SESSION['type']=="admin"){             //Si no se tiene un token de logeo
          include_once ('../navBars/adminNavbar.php');
        }
    ?>
    <div class="d-flex justify-content-center mt-4">

        <div class="col-md-4">
        <h4 class="my-4 text-center">Registrar usuario</h4>
        <?php if (isset($_SESSION['messageC'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['messageC']?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
            unset($_SESSION['messageC']);
        }
        ?>
        <?php if (isset($_SESSION['messageU'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['messageU']?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
            unset($_SESSION['messageU']);
        }
        ?>
            <form action="registrarUsuario.php" method="post" enctype="multipart/form-data" class="border p-4">
                <div>
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control entrada" id="Usuario">
                </div>
                <div>
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control entrada" id="Correo">
                </div>
                <div>
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control entrada" id="Contrasena">
                </div>
                <input type="submit" value="Registrar" class="my-3">
                <div id="alerta"></div>
            </form>

        </div>

    </div>
    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="funcionesUsu.js"></script>
</body>
</html>