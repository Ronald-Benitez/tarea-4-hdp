<?php 
include_once ("../database/crudUsuarios.php");
date_default_timezone_set('America/El_Salvador');   //Seteo de la zona horaria
$fecha = date("Y-m-d H:i:s");                       //Seteo de la fecha y hora

$tipo="viewer";                                     //Seteo del unico tipo de usuario a registrar
$pasar = true;

if(isset($_GET['ad'])){                             //Si se est añadiento un administrador
    $tipo=$_GET['ad'];                              //El tipo seña el administrador
    $_SESSION['ad']=$tipo;                          //Se crea la sescion del tipo administrador
}

if(isset($_SESSION['ad'])){
    $tipo=$_SESSION['ad'];                          //El tipo se cambia a session 
}


if(isset($_POST['usuario'])){                               //Usuario a registar
    $correo = buscarUsuario($_POST['correo'],"correo");     //Obetencion de datos por correo
    $cou =  mysqli_fetch_assoc($correo);
    $usuario = buscarUsuario($_POST['usuario'],"usuario");  //Obtencion de datos por nombre de usuario
    $usu =  mysqli_fetch_assoc($usuario);

    if(!empty($cou)){                                       //Si hay datos con ese correo
        $_SESSION['messageC'] = 'El correo ya se encuentra registrado';
        $pasar = false;
    }

    if(!empty($usu) && !$pasar){                            //Si ya exite ese ususario
        $_SESSION['messageU'] = 'El usuario ya se encuentra registrado';
    }else{
        $contrasena = password_hash($_POST['contrasena'],PASSWORD_DEFAULT);     //Encriptacion de la contra
        ingresarUsuarios($_POST['usuario'],$_POST['correo'],$contrasena,$tipo); //Se guardan los datos
        
        if(isset($_SESSION['ad'])){//Si es un admin
            unset($_SESSION['ad']);//Se limina la session de admin
            header("Location:adminUsuarios.php?na=na"); //Se redirige al administrador de ususarios
        }else{
            header("Location:../login/login.php?na=na");//Devulve al login
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
        <?php if (isset($_SESSION['messageC'])) { //Mensaje de correo ya registrado?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['messageC']?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
            unset($_SESSION['messageC']);
        }
        ?>
        <?php if (isset($_SESSION['messageU'])) {//Mensaje de usuario ya registrado ?>
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
                    <input class="mantener d-none" type="checkbox">
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