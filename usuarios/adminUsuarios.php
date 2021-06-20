<?php
include_once ('../database/crudUsuarios.php');

$opcion = 'tipo';//Seteo de la busqueda por tipo
$valor = 'admin';//Seteo de la busqueda por cvalor

$opciones =["usuario","correo","tipo","estado"];//Seteo de datos requeridos

if(isset($_SESSION['opcion'])){//Si hay una opcion a realizar
    $opcion = $_SESSION['opcion'];
    $valor = $_SESSION['valor'];
    unset($_SESSION['opcion']);
    unset($_SESSION['valor']);
}

$datos = buscarUsuario($valor,$opcion);//Se busca el tipo de usuario que es el que entra


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Administración de usuarios</title>
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
    <div class="d-flex justify-content-center m-4">
    
        <div class="d-flex flex-column">
            <div class="row">

                <?php if (isset($_SESSION['message'])) { //MEnsaje de alerta?>
                    <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                        <strong><?=$_SESSION['message']?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php 
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                }
                if (isset($_GET['na'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Usuario registrado</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>

            </div>
        <h3 class="m-4">Administración usuarios</h3>
            <div class="row">
                <form action="busqueda.php" method="post">

                <div class="btn-group" role="group" aria-label="Basic example">
                    
                        <div class="col-4 m-2">

                            <select class="form-select" aria-label="Default select example" id="tipo" name="tipo" onclick="generarCampos()">
                                <option selected>Selecione tipo de busqueda</option>
                                <option value="usuario">Usuario</option>
                                <option value="correo">Correo</option>
                                <option value="estado">Estado</option>
                                <option value="tipo">Tipo</option>
                            </select>

                        </div>

                        <div class="col-4 m-2" id="estado">

                            <select class="form-select" aria-label="Default select example" name="estado">
                                <option value="habilitado" selected>Selecione el estado</option>
                                <option value="habilitado">Habilitado</option>
                                <option value="deshabilitado">Deshabilidato</option>
                            </select>

                        </div>

                        <div class="col-4 m-2" id="tipo2">

                            <select class="form-select" aria-label="Default select example" name="tipo2">
                                <option value="viewer" selected>Selecione el tipo</option>
                                <option value="viewer">Viewer</option>
                                <option value="admin">Admin</option>
                            </select>

                        </div>
                        
                        <div class="col-4 m-2" id="busqueda">

                            <input type="text" name="busqueda" id="busqueda" class="form-control">

                        </div>
                        <div class="col-4 m-2">
                            <input type="submit" class="btn btn-secondary" value="Buscar">
                        </div>

                    </div>
                </form>
            </div>

            <div class="row my-3">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="registrarUsuario.php?ad=admin" class="btn btn-secondary m-1">Registrar administrador</a>
                    <a href="registrarUsuario.php?ad=viewer" class="btn btn-secondary m-1">Registrar viewer</a>
                </div>
            </div>

            <div class="row mt-4">
                <table class="table table table-light table-hover">
                    <thead>

                    <!--id, fecha, nFactura, idCliente, venta, IVA, nombre, NRC-->
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($datos)){
                            echo "<tr>";
                            foreach($opciones as $valor){
                            ?>
                            <td><?= $row[$valor] ?></td>
                        
                        <?php }?>
                            <td>
                                <a href="editarUsuario.php?id=<?= $row['idUsuario']?>" class="btn btn-primary">Editar</a>
                                <a href="eliminarUsuario.php?id=<?= $row['idUsuario']?>" class="btn btn-danger">Eliminar</a>
                                <a href="cambiarEstadoU.php?id=<?= $row['idUsuario']?>" class="btn btn-primary">Cambiar estado</a>
                            </td>
                        </tr> 
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="funcionesUSU.js"></script>
</body>
</html>