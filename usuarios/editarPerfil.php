<?php
    include_once ('../database/crudUsuarios.php');
    /*
        $_SESSION['id'] = $datos_usu['idUsuario'];
        $_SESSION['user'] = $datos_usu['usuario'];
        $_SESSION['type'] = $datos_usu['tipo'];
        $_SESSION['state'] = $datos_usu['estado'];
    */
    $datos = buscarUsuario($_SESSION['id'],"idUsuario");    //Se busca los datos del usuario
    $info = mysqli_fetch_assoc($datos);

    if(!isset($_COOKIE['session_id'])){             //Si no se tiene un token de logeo
        header('Location: ../login/login.php');
    }elseif($_SESSION['type']=="viewer"){         //Si el usuario es un viewer
        include_once ('../navBars/viewerNavbar.php');   
    }elseif($_SESSION['type']=="admin"){                //Si el usuario es un administrador
        include_once ('../navBars/adminNavbar.php');
    }else{                                          //si no tiene un rol definido
        header('Location: ../login/login.php');
    }
    if(isset($_POST['usuario'])){//Si logro enviar el formulario
        /*SE BUSCAN USUSARIOS CON LOS MISMOS DATOS*/
        $correo = buscarUsuario($_POST['correo'],"correo"); //Se busca por correo
        $cou =  mysqli_fetch_assoc($correo);
        $usuario = buscarUsuario($_POST['usuario'],"usuario");//Se busca por usuario
        $usu =  mysqli_fetch_assoc($usuario);
        $pasar = true;

        if(!empty($cou) && $cou['idUsuario']!=$_SESSION['id']){//Si ya hay un ususario registrado con ese correo
            $_SESSION['messageC'] = 'El correo ya se encuentra registrado';
            $pasar = false;
        }
        if(!empty($usu) && $usu['idUsuario']!=$_SESSION['id']){//Si hay ususario registrado con ese nombre de usuario
            $_SESSION['messageU'] = 'El usuario ya se encuentra registrado';
            $pasar = false;
        }
        if($pasar){
            if($_POST['contrasena']==""){//si la contraseña esta en blanco
                actualizarUsuarioSNC($_POST['usuario'],$_POST['correo'],$_SESSION['type'],$_SESSION['state'],$_SESSION['id']);
               
            }else{
                $contrasena = password_hash($_POST['contrasena'],PASSWORD_DEFAULT);
                actualizarUsuarioCC($_POST['usuario'],$_POST['correo'],$_SESSION['type'],$_SESSION['state'],$contrasena,$_SESSION['id']);
            }
            header('Location: editarPerfil.php');
        }
        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Editar Perfil</title>
    
</head>
<body>
    <div class="d-flex justify-content-center mt-4">
        <div class="col-md-4 ">
        <?php if (isset($_SESSION['messageC'])) { //Alerta de error por correo?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['messageC']?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
            unset($_SESSION['messageC']);
        }
        ?>
        <?php if (isset($_SESSION['messageU'])) { //Alerta de Erro por usuario repetido?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['messageU']?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
            unset($_SESSION['messageU']);
        }
        ?>
        <form action="editarPerfil.php" method="post" class="border p-4 border border-dark rounded-2">
            <div>
                <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control entrada" id="Usuario" value="<?=$info['usuario']?>">
                </div>

                <div>
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control entrada" id="Correo" value="<?=$info['correo']?>">
                </div>

                <div>
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control entrada contrasena" id="Contrasena">
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input mantener" type="checkbox" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Mantener contraseña</label>
                </div>
                <input type="submit" value="Editar Perfil" class="my-3 btn btn-outline-dark">
                <div id="alerta"></div>
            </div>
        </form>        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="funcionesUsu.js"></script>
</body>
</html>