<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="../usuariosÑ/editarPerfil.php"><?php echo $_SESSION['user'];?></a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="../post/post.php">Inicio</a>
        </li>
      </ul>
      <a href="../login/cerrarSesion.php">
        <div class="btn btn btn-outline-light">Cerrar Sesión</div>
    </a>
    </div>
  </div>
</nav>