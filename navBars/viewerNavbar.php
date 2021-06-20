<?php
  include_once ('../database/crudUsuarios.php');
  $buscar_usu=buscarUsuario($_SESSION['id'],"idUsuario");
  $datos_usu = mysqli_fetch_assoc($buscar_usu);
  if(!empty($datos_usu)){
    $_SESSION['user'] = $datos_usu['usuario'];
    $_SESSION['type'] = $datos_usu['tipo'];
    $_SESSION['state'] = $datos_usu['estado'];
  }else{
    header("Location:inde.php");
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="../usuarios/editarPerfil.php"><?php echo $_SESSION['user'];?></a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="../post/post.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../usuarios/editarPerfil.php">Perfil</a>
        </li>
      </ul>
      <a href="../login/cerrarSesion.php">
        <div class="btn btn btn-outline-light">Cerrar Sesión</div>
    </a>
    </div>
  </div>
</nav>